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
        $user = $this->user_repository->save($user_data);
        $months = $request->months;
        $today = Carbon::today();
        $expired_at = $today->addMonths($months);
        $subscription_data = array(
            'product_name' => $request->product_name,
            'user_id' => $user->id,
            'status' => 1,
            'expired_at' => $expired_at,
        );
        $this->subscription_repository->save($subscription_data);
        Mail::to($user->email)->send(new RegistrationMail($password));
    }
}
