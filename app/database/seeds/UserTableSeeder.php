<?php

use Woodling\Woodling;

class UserTableSeeder extends Seeder {

  public function run() {

    $this->command->info("The environment is ".App::environment());

    DB::table('users')->delete();

    Woodling::saved("User", [
      'name' => 'Mohan Krishnan',
      'email' => 'mohan@example.com'
      ]);

    Woodling::saved("User", [
      'name' => 'Tommy Sullivan',
      'email' => 'tommy@example.com'
      ]);

    Woodling::saved("User", [
      'name' => 'Huong Vu',
      'email' => 'zi@example.com'
    ]);

    $user_count = User::count();
    $this->command->info("User table seeded with $user_count users.");
  }
}
