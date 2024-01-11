<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswas')->insert([
            'nama' => 'Muhammad Arby Tyas Januar Hikmat',
            'npm' => '4521210044',
            'kelas_id' => 1,
            'telp' => '081234567890',
            'alamat' => 'Depok',
        ]);
    }
}
