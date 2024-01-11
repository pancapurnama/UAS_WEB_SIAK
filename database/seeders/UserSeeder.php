<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = Dosen::all();
        $siswa = Siswa::all();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'roles' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Adi Wahyu Pribadi',
            'email' => 'adi@mail.com',
            'password' => Hash::make('adi123'),
            'roles' => 'dosen',
            'nip' => '1234567890',
        ]);

        DB::table('users')->insert([
            'name' => 'Muhammad Arby Tyas Januar Hikmat',
            'email' => 'arby@mail.com',
            'password' => Hash::make('arby123'),
            'roles' => 'siswa',
            'npm' => '4521210044',
        ]);


        // update user_id to dosen table as user id
        foreach ($dosen as $g) {
            DB::table('dosens')->where('nip', $g->nip)->update([
                'user_id' => DB::table('users')->where('nip', $g->nip)->first()->id
            ]);
        }

        // update user_id to siswa table as user id
        foreach ($siswa as $s) {
            DB::table('siswas')->where('npm', $s->npm)->update([
                'user_id' => DB::table('users')->where('npm', $s->npm)->first()->id
            ]);
        }
    }
}
