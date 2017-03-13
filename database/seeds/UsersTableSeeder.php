<?php

use Illuminate\Database\Seeder;

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
            'name' => '0l1VR',
            'email' => 'admin22@xxii.fr',
            'password' => bcrypt('admin22'),
            'actif' =>1,
            'validate' => 1,
            'ban_ip' => '::1',
            'phone' => '123456789',
            'society' => 'xxii',
            'adress' => '22 rue de Ed niewport',
            'town' => 'paris',
            'country' => 'FR',
            'option' => '1',
            'iban' => '123456789',
            'max_exp_online_month' => '22',
            'validate' => '1',
            'actif' => '1',
            'option_1' => '1',
        ]);      
    }
}
