<?php

namespace Modules\User\Http\Controllers;

use App\Mail\RegistrationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mail;
use Modules\User\Interfaces\SubscriptionRepositoryInterface;
use Modules\User\Interfaces\UserRepositoryInterface;
use Modules\User\Services\SubscriptionService;

class UserApiController extends Controller
{
    protected $user_repository;
    protected $subscription_repository;
    protected $subscription_service;

    public function __construct(
        UserRepositoryInterface $user_repository,
        SubscriptionRepositoryInterface $subscription_repository,
        SubscriptionService $subscription_service
    ) {
        $this->user_repository = $user_repository;
        $this->subscription_service = $subscription_service;
        $this->subscription_repository = $subscription_repository;
    }

    public function userCheck(Request $request)
    {
        $user = $this->user_repository->where('email', $request->email)
            ->where('status', 'active')
            ->first();
        if (!empty($user)) {
            $subscription = $this->subscription_repository->where('user_id', $user->id)
                ->where('status', 'active')
                ->where('product_name', 'modal')
                ->first();
            if (!empty($subscription)) {
                return response()->json([
                    'user' => $user,
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Product Owner is not subscribe to the modal service',
                ], 400);
            }
        } else {
            return response()->json([
                'error' => 'User not found',
            ], 404);
        }
    }

    public function sendMailRegistrationForm(Request $request)
    {
        $today = Carbon::now();
        $expiration_value = $request->expiration_value;
        $date_type = $request->date_type;
        $expired_at = $this->subscription_service->calculateExpiration(
            $today,
            $date_type,
            $expiration_value
        );
        $existing_user = $this->user_repository->where('email', $request->email)->first();
        if (empty($existing_user)) {
            $password = str_random(6);
            $user_data = array(
                'email' => $request->email,
                'status' => 'active',
                'password' => bcrypt($password),
            );
            $user = $this->user_repository->save($user_data);
            $this->subscription_repository->storeSubscription(
                $expired_at,
                $user->id,
                $request->product_name,
                $request->payment_type
            );
            Mail::to($user->email)->send(new RegistrationMail($password));
        } else {
            $product = $this->subscription_repository->findLastProductAvail($existing_user->id, $request->product_name);
            if (empty($product)) {
                $this->subscription_repository->storeSubscription(
                    $expired_at,
                    $existing_user->id,
                    $request->product_name,
                    $request->payment_type
                );
            } else {
                switch ($product->status) {
                    case 'expired':
                        $this->subscription_repository->storeSubscription(
                            $expired_at,
                            $existing_user->id,
                            $request->product_name,
                            $request->payment_type
                        );
                        return;
                    case 'active':
                        $parse_date = Carbon::parse($product->expired_at);
                        $product_expired_at = $this->subscription_service->calculateExpiration(
                            $parse_date,
                            $date_type,
                            $expiration_value
                        );
                        $this->subscription_repository->storeSubscription(
                            $product_expired_at,
                            $existing_user->id,
                            $request->product_name,
                            $request->payment_type
                        );
                        return;
                    default:
                        return;
                }
                return;
            }

        }
    }
}
