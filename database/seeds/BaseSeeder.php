<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //currency
    \App\Currency::create(['symbol' => '$', 'slug' => 'dollar']);
    \App\Currency::create(['symbol' => '€', 'slug' => 'euro']);
    \App\Currency::create(['symbol' => '£', 'slug' => 'pound']);

    //language
    \App\Language::create(['slug' => 'Français']);
    \App\Language::create(['slug' => 'English']);
  }
}
