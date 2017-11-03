<?php

namespace Modules\User\Services;

class SubscriptionService
{
    public function calculateExpiration($parse_date, $date_type, $expiration_value)
    {
        switch ($date_type) {
            case 'day':
                return $parse_date->addDays($expiration_value);
            case 'month':
                return $parse_date->addMonths($expiration_value);
            case 'year':
                return $parse_date->addYears($expiration_value);
            default:
                return;
        }
    }

}
