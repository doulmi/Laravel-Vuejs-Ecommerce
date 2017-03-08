<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  private $faker;

  public function __construct(Faker\Generator $faker)
  {
    $this->faker = $faker;
  }

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
//         $this->call(UsersTableSeeder::class);
    //currency
    \App\Currency::create(['symbol' => '$', 'slug' => 'dollar']);
    \App\Currency::create(['symbol' => '€', 'slug' => 'euro']);
    \App\Currency::create(['symbol' => '£', 'slug' => 'pound']);

    //language
    \App\Language::create(['slug' => 'Français']);
    \App\Language::create(['slug' => 'English']);

    User::create([
      'name' => 'Fengyu CHEN',
      'avatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim('doulmi@126.com'))) . "?s=80&d=identicon&r=g",
      'email' => 'doulmi@126.com',
      'confirmation_code' => str_random(64),
      'password' => bcrypt('123456'),
      'isAdmin' => 1
    ]);

    factory(\App\User::class, 30)->create();

    factory(\App\Category::class, 10)->create();
    factory(\App\Product::class, 1000)->create();

    $products = \App\Product::pluck('id')->toArray();
    foreach ($products as $product) {
      $ids = $this->faker->randomElements($products, 5);
      foreach ($ids as $id) {
        \App\ProductRelative::create([
          'product_id' => $product,
          'relative_product_id' => $id
        ]);
      }
    }
  }
}
