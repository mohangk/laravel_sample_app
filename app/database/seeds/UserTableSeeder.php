<?php

class UserTableSeeder extends Seeder {

  public function run() {

    $this->command->info("The environment is ".App::environment());

    DB::table('users')->delete();

    User::create(array(
      'name' => 'Mohan Krishnan',
      'email' => 'mohan@example.com',
      'password' => Hash::make('password')
    ));

    User::create(array(
      'name' => 'Tommy Sullivan',
      'email' => 'tommy@example.com',
      'password' => Hash::make('password')
    ));

    User::create(array(
      'name' => 'Huong Vu',
      'email' => 'zi@example.com',
      'password' => Hash::make('password')
    ));

    $user_count = User::count();
    $this->command->info("User table seeded with $user_count users.");
  }
}
