<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosens')->insert([
            'nama' => 'Adi Wahyu Pribadi',
            'nip' => '1234567890',
            'mapel_id' => 1,
            'no_telp' => '081234567890',
            'alamat' => 'Depok',
        ]);
    }
}
