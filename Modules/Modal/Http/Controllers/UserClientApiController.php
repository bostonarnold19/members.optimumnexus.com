<?php

namespace Modules\Modal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Modal\Interfaces\UserClientRepositoryInterface;
use Modules\User\Interfaces\SubscriptionRepositoryInterface;
use Modules\User\Interfaces\UserRepositoryInterface;

class UserClientApiController extends Controller
{
    protected $user_client_repository;
    protected $subscription_repository;
    protected $user_repository;

    public function __construct(
        UserClientRepositoryInterface $user_client_repository,
        UserRepositoryInterface $user_repository,
        SubscriptionRepositoryInterface $subscription_repository
    ) {
        $this->user_client_repository = $user_client_repository;
        $this->user_repository = $user_repository;
        $this->subscription_repository = $subscription_repository;
    }

    public function registerClient(Request $request)
    {
        $user = $this->user_repository->where('email', $request->owner_email)
            ->where('status', 1)
            ->first();
        if (!empty($user)) {
            $subscription = $this->subscription_repository->where('user_id', $user->id)
                ->where('status', 'active')
                ->where('product_name', 'modal')
                ->first();
            if (!empty($subscription)) {
                $client_data = array(
                    'user_id' => $user->id,
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                );
                $client = $this->user_client_repository->save($client_data);
                return response()->json([
                    'client' => $client,
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
}
