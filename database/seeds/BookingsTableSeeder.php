<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1件ずつ保存したいので、forで回す
        for ($i = 0; $i < 20; $i++) {
            factory(App\Booking::class, 1)->create();
        }
    }
}
