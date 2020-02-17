<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\EventPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3,8), true);
    $txt = $faker->realText(rand(1000,4000));

    $data = [
        'creator_id' => rand(1,2),
        'category_id' => (rand(1,5) == 5) ? 1 : 2,
        'slug'  => Str::slug($title),
        'title' => $title,
        'excerpt' => $faker->text(rand(40,100)),
        'content' =>  $txt,
        'users_count' => rand(1,40),
        'users_limit' => rand(2,50),
        'event_date' => $faker->dateTimeBetween('-2 months', '-1 days'),
        'messages_ids' => Str::random(40),
        'auth_users_ids' => Str::random(40),
    ];
    return $data;
});
