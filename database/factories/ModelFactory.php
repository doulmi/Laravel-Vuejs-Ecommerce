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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
  static $password;

  return [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'password' => $password ?: $password = bcrypt('123456'),
    'avatar' => $faker->imageUrl(128, 128),
    'language_id' => 1,
    'currency_id' => 1,
    'remember_token' => str_random(10),
    'confirmed' => true
  ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
  $name = $faker->name;
  return [
    'name_fr' => $name . '_fr',
    'name_en' => $name . '_en',
    'active' => true,
    'avatar' => 'https://res.cloudinary.com/hcu8jcnmr/image/upload/c_lpad,w_300,h_300/jwykwsnfvbtddavr7jeu1.jpg',
    'slug' => $faker->unique()->slug
  ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
  static $categories;

  $name = $faker->company;
  return [
    'name_fr' => $name . '_fr',
    'name_en' => $name . '_en',
    'active' => true,
    'avatar' => 'https://res.cloudinary.com/hcu8jcnmr/image/upload/c_fit,w_600,h_600/rpzfghps4kx3qrgxy8oj.jpg',
    'price' => $faker->numberBetween(0.99, 99.99),
    'stock' => $faker->numberBetween(1, 20),
    'category_id' => $faker->randomElement($categories ? $categories : $categories = \App\Category::pluck('id')->toArray()),
    'images' => implode('||', [
      'https://res.cloudinary.com/hcu8jcnmr/image/upload/c_fit,w_600,h_600/evzorn1pgl5ink1y5wb3.jpg',
      'https://res.cloudinary.com/hcu8jcnmr/image/upload/c_fit,w_600,h_600/ne9bxhq3pu91olgj3nyo.jpg',
      'https://res.cloudinary.com/hcu8jcnmr/image/upload/c_fit,w_600,h_600/azds5i4uuerrwmcapeja.jpg',
    ]),
    'slug' => $faker->unique()->slug
  ];
});
