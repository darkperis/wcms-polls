<?php
use Darkpony\WCMSPolls\Poll;
use Faker\Generator as Faker;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence
    ];
});
