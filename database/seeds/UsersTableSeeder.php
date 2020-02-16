<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => '管理者ユーザ',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'admin_flg' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        // SET auto-increment start value
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 10000;");
    }
}
