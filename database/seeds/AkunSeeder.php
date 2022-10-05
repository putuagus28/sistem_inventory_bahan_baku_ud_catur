<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        User::create([
            'name' => 'admin',
            'jenis_kelamin' => 'L',
            'telepon' => '0819291299',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        User::create([
            'name' => 'pegawai',
            'jenis_kelamin' => 'P',
            'telepon' => '0819291299',
            'username' => 'pegawai',
            'password' => bcrypt('pegawai'),
            'role' => 'pegawai',
            'email' => 'pegawai@gmail.com',
        ]);
    }
}
