<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
//         $this->call(UsersTableSeeder::class);
    factory(\App\User::class, 30)->create();

    factory(\App\Category::class, 10)->create();
    factory(\App\Product::class, 1000)->create();
  }
}
