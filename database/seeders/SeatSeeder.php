<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SeatSeeder extends Seeder
{
    public function run()
    {
        $seats = [];

        for ($i = 1; $i <= 30; $i++) {
            $seats[] = [
                'seat_number' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('seats')->insert($seats);
    }
}
