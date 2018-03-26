<?php

namespace Modules\User\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Interfaces\SubscriptionRepositoryInterface;
use Modules\User\Interfaces\UserRepositoryInterface;
use Modules\User\Services\SubscriptionService;

class UserController extends Controller
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
        $this->middleware('auth');
    }

    public function productList(Request $request)
    {
        return view('user::index');
    }

    public function updateWpSite(Request $request, $id)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $user = $this->user_repository->update($id, $data);
            DB::commit();
            $status = 'success';
            $message = 'User wp site has been updated.';
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Internal Server Error. Try again later.';
            DB::rollBack();
        }
        return redirect()->back()->with($status, $message);
    }
}
