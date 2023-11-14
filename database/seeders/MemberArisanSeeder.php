<?php

namespace Database\Seeders;

use App\Models\MemberArisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberArisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MemberArisan::create([
            'id_arisan' => '9',
            'id_user' => '1',
        ]);
        MemberArisan::create([
            'id_arisan' => '9',
            'id_user' => '11',
        ]);
    }
}
