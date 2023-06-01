<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BioskopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bioskops = [
            [
                'nama' => 'XXI',
                'lokasi' => 'Cibinong City Mall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'CGV',
                'lokasi' => 'Central Park Mall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Cinema 21',
                'lokasi' => 'Plaza Senayan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mitra 21',
                'lokasi' => 'Kuningan City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Empire XXI',
                'lokasi' => 'Gandaria City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('bioskops')->insert($bioskops);
    }
}
