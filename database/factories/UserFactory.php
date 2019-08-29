<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
//User Table

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $status = array('Active','deactive','disable','enable');
    $email_status = array('verified','notverified','none');
    $email_token = array('verfakljfddhjsdbakguyBUBJBJBUBUified','dfajfhaufsdubjhbUGYGUBJjsbUUBjbs2ieu','sjfakbsjfshuibwkbiIUIHIBKBKB@bisfjs');
    $phone = array('092349308402','29384729347','9247023948023');
    $type = array('type1','type2','type3');
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->firstName,
        'username' => $faker->firstName,
        'email' => $faker->email,
        'type' => $type[random_int(0, 2)],
        'companyId' => random_int(1, 5),
        'odl_password' => \Illuminate\Support\Facades\Hash::make('pass'),
        'password' => \Illuminate\Support\Facades\Hash::make('pass'),
        'phone' => $phone[random_int(0, 2)],
        'emailVerifyToken' => $email_token[random_int(0, 2)],
        'emailVerified' => $email_status[random_int(0, 2)],
        'enabled' => $status[random_int(0, 3)]
    ];
});
