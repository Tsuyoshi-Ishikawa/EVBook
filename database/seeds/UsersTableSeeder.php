<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    
    public function run()
    {
        $param = [
            'name' => 'yamamoto',
            'email' => 'test2@test.com',
            'password' => Hash::make('yamamotopass') 
        ];
        $user = new User;
        $user->fill($param)->save();

        $param = [
            'name' => 'yamada',
            'email' => 'test3@test.com',
            'password' => Hash::make('yamadapass')
        ];
        $user = new User;
        $user->fill($param)->save();

        $param = [
            'name' => 'yamashita',
            'email' => 'test4@test.com',
            'password' => Hash::make('yamashitapass')
        ];
        $user = new User;
        $user->fill($param)->save();
    }
}
