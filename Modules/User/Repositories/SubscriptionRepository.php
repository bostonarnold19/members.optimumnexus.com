<?php

namespace Modules\User\Repositories;

use Modules\Core\Repositories\AbstractEloquentRepository;
use Modules\User\Interfaces\SubscriptionRepositoryInterface;

class SubscriptionRepository extends AbstractEloquentRepository implements SubscriptionRepositoryInterface
{
    public function storeSubscription($expired_at, $user_id, $product_name)
    {
        $subscription_data = array(
            'product_name' => $product_name,
            'user_id' => $user_id,
            'status' => 1,
            'expired_at' => $expired_at,
        );
        $this->save($subscription_data);
        return;
    }

    public function findLastProductAvail($user_id, $product_name)
    {
        return $this->where('user_id', $user_id)
            ->where('product_name', $product_name)
            ->get()
            ->last();
    }
}
