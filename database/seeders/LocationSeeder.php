<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'city' => 'Kobeberg',
            'address' => '604 Moore Corners',
            'opening_hours' => '08:30:00',
            'closing_hours' => '15:00:00',
            'image' => 'user_1_location_1.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Port Floyd',
            'address' => '61580 Madisyn Lakes Suite 411',
            'opening_hours' => '08:30:00',
            'closing_hours' => '15:00:00',
            'image' => 'user_1_location_2.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'North Brookview',
            'address' => '464 Mayer Lake Suite 931',
            'opening_hours' => '09:30:00',
            'closing_hours' => '15:30:00',
            'image' => 'user_1_location_3.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Camronmouth',
            'address' => '4983 Weimann Burg Apt.642',
            'opening_hours' => '08:30:00',
            'closing_hours' => '17:00:00',
            'image' => 'user_1_location_4.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Royalbury',
            'address' => '2932 Robel Brook Suite 263',
            'opening_hours' => '10:00:00',
            'closing_hours' => '15:30:00',
            'image' => 'user_1_location_5.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Western Cape',
            'address' => '16516 Oking Mayor 345',
            'opening_hours' => '11:00:00',
            'closing_hours' => '15:30:00',
            'image' => 'user_1_location_6.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Ohio',
            'address' => '1726 Colombus 391',
            'opening_hours' => '09:00:00',
            'closing_hours' => '17:30:00',
            'image' => 'user_1_location_7.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Indianapolis',
            'address' => '271 Indiana 2001',
            'opening_hours' => '07:00:00',
            'closing_hours' => '17:30:00',
            'image' => 'user_1_location_8.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Michigan',
            'address' => '813 Detroit 721',
            'opening_hours' => '08:00:00',
            'closing_hours' => '17:00:00',
            'image' => 'user_1_location_9.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Oregon',
            'address' => '212 El Paso 928',
            'opening_hours' => '10:00:00',
            'closing_hours' => '19:00:00',
            'image' => 'user_1_location_10.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Arizona',
            'address' => '2736 Phoenix 742',
            'opening_hours' => '09:30:00',
            'closing_hours' => '19:00:00',
            'image' => 'user_1_location_11.png'
        ]);

        DB::table('locations')->insert([
            'city' => 'Florida',
            'address' => '1211 Jacksonville 302',
            'opening_hours' => '10:30:00',
            'closing_hours' => '19:30:00',
            'image' => 'user_1_location_12.png'
        ]);
    }
}
