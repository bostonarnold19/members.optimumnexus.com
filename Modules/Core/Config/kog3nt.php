<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Web App Details
    |--------------------------------------------------------------------------
    |
    | Details CMS
    |
     */

    'title' => 'Totalpreneur',

    'tagline' => null,

    'description' => null,

    /*
    |--------------------------------------------------------------------------
    | Password Generator
    |--------------------------------------------------------------------------
    |
    | Generate password when creating user
    |
     */

    'password_generated' => 'kog3nt' . '-' . mt_rand(5, 99999),

    /*
    |--------------------------------------------------------------------------
    | Background Color
    |--------------------------------------------------------------------------
    |
    | List of colors: white(will get image name full-background.jpg),(info),
    | (red,danger),(purple,primary),(green,success),(orange,warning),rose
    |
     */

    'background' => 'info',

    'side_bar' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Category Type
    |--------------------------------------------------------------------------
    |
    | List of Category Type
    |
     */

    'category_type' => [
        'Funnel',
        'Page',
    ],

    /*
    |--------------------------------------------------------------------------
    | Saas Apps
    |--------------------------------------------------------------------------
    |
    | Saas Apps Settings
    |
     */

    'product_name' => [
        'bagel',
        'om',
        'sw2',
    ],

    'payment_type' => [
        'free',
        'paid',
    ],

    'date_type' => [
        'day',
        'month',
        'year',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Message
    |--------------------------------------------------------------------------
    |
    | Default Message
    |
     */

    'onsubmit_msg' => 'Are you sure you want to do this?',

    /*
    |--------------------------------------------------------------------------
    | Page Type
    |--------------------------------------------------------------------------
    |
    | List of Page Type
    |
     */

    'page_type' => [
        'Own Wordpress Site' => 'wp',
        'External Link' => 'external',
    ],

];
