<?php

use Illuminate\Database\Seeder;
use App\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(1234)
        ]);
    }
}
