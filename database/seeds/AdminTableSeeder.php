<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'created_at' => '2020_07_04',
                'updated_at' => '2020_07_04'
            ],
        ]);
    }
}