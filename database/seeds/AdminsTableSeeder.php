<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('admins')->insert([
      [
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => Hash::make('adminadmin'),
        'created_at' => '2020_07_04',
        'updated_at' => '2020_07_04'
      ],
    ]);
  }
}
