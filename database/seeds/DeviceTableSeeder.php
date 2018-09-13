<?php

use Illuminate\Database\Seeder;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->insert([
            'serial_number' => 'A06V022016030800',
            'imei' => '867567021267495',
        ]);

        DB::table('devices')->insert([
            'serial_number' => '123',
            'imei' => '123',
        ]);
    }
}
