<?php

namespace Modules\User\Http\Controllers;

use App\Mail\RegistrationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mail;
use Modules\User\Interfaces\SubscriptionRepositoryInterface;
use Modules\User\Interfaces\UserRepositoryInterface;

class UserRegistrationController extends Controller
{
    protected $user_repository;

    protected $subscription_repository;

    public function __construct(
        UserRepositoryInterface $user_repository,
        SubscriptionRepositoryInterface $subscription_repository
    ) {
        $this->user_repository = $user_repository;
        $this->subscription_repository = $subscription_repository;
    }

    public function sendMailRegistrationForm(Request $request)
    {
        $password = str_random(6);
        $user_data = array(
            'email' => $request->email,
            'password' => bcrypt($password),
        );
        $months = $request->months;
        $today = Carbon::today();
        $existing_user = $this->user_repository->where('email', $request->email)->first();
        if (empty($existing_user)) {
            $user = $this->user_repository->save($user_data);
            $expired_at = $today->addMonths($months);
            $subscription_data = array(
                'product_name' => $request->product_name,
                'user_id' => $user->id,
                'status' => 1,
                'expired_at' => $expired_at,
            );
            $this->subscription_repository->save($subscription_data);
        } else {
            $product = $this->subscription_repository->where('user_id', $existing_user->id)
                ->where('product_name', $request->product_name)
                ->get()
                ->last();

            if (empty($product)) {
                $expired_at = $today->addMonths($months);
                $subscription_data = array(
                    'product_name' => $request->product_name,
                    'user_id' => $existing_user->id,
                    'status' => 1,
                    'expired_at' => $expired_at,
                );
                $this->subscription_repository->save($subscription_data);
                dd('nice');
            } else {
            }
        }

        Mail::to($user->email)->send(new RegistrationMail($password));
    }
}
