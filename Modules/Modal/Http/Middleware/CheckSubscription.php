<?php

namespace Modules\Modal\Http\Middleware;

use Closure;
use Modules\User\Interfaces\SubscriptionRepositoryInterface;

class CheckSubscription
{
    protected $subscription_repository;
    protected $auth;

    public function __construct(SubscriptionRepositoryInterface $subscription_repository)
    {
        $this->subscription_repository = $subscription_repository;
        $this->auth = auth()->user();
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth->hasRole('Admin')) {
            return $next($request);
        }
        $subscription = $this->subscription_repository->where('user_id', $this->auth->id)
            ->where('status', 'active')
            ->where('product_name', 'sw2')
            ->first();

        if (!empty($subscription)) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
