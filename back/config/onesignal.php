<?php

return [
    /*
    |--------------------------------------------------------------------------
    | One Signal App Id
    |--------------------------------------------------------------------------
    |
    |
    */
    'app_id' => env('ONESIGNAL_APP_ID'),

    /*
    |--------------------------------------------------------------------------
    | Rest API Key
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'rest_api_key' => env('REST_API_KEY'),
    'user_auth_key' => env('ONESIGNAL_AUTH_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Notifications URLs
    |--------------------------------------------------------------------------
    |
    |
    |
    */
   'notifications' => [

       'news'          => env('FRONT_DOMAIN').'/news/',

       'publications'  => env('FRONT_DOMAIN').'/publications/',

       'chairs'        => env('FRONT_DOMAIN').'/chairs/',

       'lecturers'     => env('FRONT_DOMAIN').'/lecturers/',

       'laboratories'  => env('FRONT_DOMAIN').'/laboratories/',

       'laboratories'  => env('FRONT_DOMAIN').'/subjects/',

       'timetable'     => [

           'lessons'      => env('FRONT_DOMAIN').'/timetable/lessons/',

           'examinations' => env('FRONT_DOMAIN').'/timetable/examinations/',

       ],

   ],
];
