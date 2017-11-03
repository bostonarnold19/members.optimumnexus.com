<?php

namespace Modules\Modal\Http\Middleware;

use Closure;
use Modules\User\Interfaces\SubscriptionRepositoryInterface;

class CheckSubscription
{
    protected $subscription_repository;

    public function __construct(SubscriptionRepositoryInterface $subscription_repository)
    {
        $this->subscription_repository = $subscription_repository;
        $this->auth = auth()->user();
    }
    public function handle($request, Closure $next)
    {
        $subscription = $this->subscription_repository->where('user_id', $this->auth->id)
            ->where('status', 'active')
            ->where('product_name', 'modal')
            ->first();

        if (!empty($subscription)) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
