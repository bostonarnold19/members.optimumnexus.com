<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\User\Entities\Role;
use Modules\User\Entities\Subscription;
use Modules\User\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();

        $admin = new User();
        $admin->first_name = 'John';
        $admin->last_name = 'Doe';
        $admin->email = 'admin@admin.com';
        $admin->status = 'active';
        $admin->password = bcrypt('admin');
        $admin->save();

        $admin->roles()->attach($role_admin);

        $today = Carbon::now();
        $expired_at = $today->addMonths(1);

        $subscription1 = new Subscription();
        $subscription1->user_id = 1;
        $subscription1->product_name = 'scraper';
        $subscription1->status = 'active';
        $subscription1->payment_type = 'paid';
        $subscription1->expired_at = $expired_at;
        $subscription1->save();

        $subscription2 = new Subscription();
        $subscription2->user_id = 1;
        $subscription2->product_name = 'modal';
        $subscription2->status = 'active';
        $subscription2->payment_type = 'paid';
        $subscription2->expired_at = $expired_at;
        $subscription2->save();
    }
}
