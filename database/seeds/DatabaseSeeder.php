<?php

use App\Models\Category;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductRelative;
use App\Models\User;
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
    Currency::create(['symbol' => '$', 'slug' => 'dollar']);
    Currency::create(['symbol' => '€', 'slug' => 'euro']);
    Currency::create(['symbol' => '£', 'slug' => 'pound']);

    //language
    Language::create(['slug' => 'Français']);
    Language::create(['slug' => 'English']);

    User::create([
      'name' => 'Fengyu CHEN',
      'avatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim('doulmi@126.com'))) . "?s=80&d=identicon&r=g",
      'email' => 'doulmi@126.com',
      'confirmation_code' => str_random(64),
      'password' => bcrypt('123456'),
      'isAdmin' => 1
    ]);

    factory(User::class, 30)->create();

    factory(Category::class, 10)->create();
    factory(Product::class, 1000)->create();

    $products = Product::pluck('id')->toArray();
    foreach ($products as $product) {
      $ids = $this->faker->randomElements($products, 5);
      foreach ($ids as $id) {
        ProductRelative::create([
          'product_id' => $product,
          'relative_product_id' => $id
        ]);
      }
    }
  }
}
