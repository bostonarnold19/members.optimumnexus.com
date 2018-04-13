<?php

use Illuminate\Database\Seeder;
use Modules\User\Entities\Role;
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
        $role_client = Role::where('name', 'Client')->first();

        $admin = new User();
        $admin->first_name = 'Admin';
        $admin->last_name = 'Admin';
        $admin->email = 'admin@admin.com';
        $admin->status = 'active';
        $admin->password = bcrypt('admin');
        $admin->api_token = str_random(60);
        $admin->save();
        $admin->roles()->attach($role_admin);

        $client = new User();
        $client->first_name = 'Client';
        $client->last_name = 'Client';
        $client->email = 'client@client.com';
        $client->status = 'active';
        $client->password = bcrypt('client');
        $client->api_token = str_random(60);
        $client->save();
        $client->roles()->attach($role_client);

        // $today = Carbon::now();
        // $expired_at = $today->addMonths(1);

        // $subscription1 = new Subscription();
        // $subscription1->user_id = 1;
        // $subscription1->product_name = 'scraper';
        // $subscription1->status = 'active';
        // $subscription1->payment_type = 'paid';
        // $subscription1->expired_at = $expired_at;
        // $subscription1->save();

        // $subscription2 = new Subscription();
        // $subscription2->user_id = 1;
        // $subscription2->product_name = 'modal';
        // $subscription2->status = 'active';
        // $subscription2->payment_type = 'paid';
        // $subscription2->expired_at = $expired_at;
        // $subscription2->save();

        // $subscription3 = new Subscription();
        // $subscription3->user_id = 1;
        // $subscription3->product_name = 'bagel';
        // $subscription3->status = 'active';
        // $subscription3->payment_type = 'paid';
        // $subscription3->expired_at = $expired_at;
        // $subscription3->save();
    }
}
