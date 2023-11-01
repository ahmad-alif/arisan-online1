<?php

namespace Database\Seeders;

use App\Models\Arisan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Arisan::create([
            'nama_arisan' => 'Arisan Ginjal',
            'img_arisan' => '',
            'start_date' => '2023-10-10',
            'end_date' => '2024-10-10',
        ]);

        Arisan::create([
            'nama_arisan' => 'Arisan Rumah',
            'img_arisan' => '',
            'start_date' => '2023-1-10',
            'end_date' => '2024-1-10',
        ]);

        Arisan::create([
            'nama_arisan' => 'Arisan Emas',
            'img_arisan' => '',
            'start_date' => '2023-5-1',
            'end_date' => '2024-5-1',
        ]);
    }
}
