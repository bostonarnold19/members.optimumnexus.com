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
        $expired_at = $today->addMonths($months);
        $existing_user = $this->user_repository->where('email', $request->email)->first();
        if (empty($existing_user)) {
            $user = $this->user_repository->save($user_data);
            $this->subscription_repository->storeSubscription($expired_at, $user->id, $request->product_name);
            Mail::to($user->email)->send(new RegistrationMail($password));
        } else {
            $product = $this->subscription_repository->findLastProductAvail($existing_user->id, $request->product_name);
            if (empty($product)) {
                $this->subscription_repository->storeSubscription($expired_at, $existing_user->id, $request->product_name);
            } else {
                $parse_date = Carbon::parse($product->expired_at);
                $product_expired_at = $parse_date->addMonths($months);
                $this->subscription_repository->storeSubscription(
                    $product_expired_at,
                    $existing_user->id,
                    $request->product_name
                );
            }
        }
    }
}
