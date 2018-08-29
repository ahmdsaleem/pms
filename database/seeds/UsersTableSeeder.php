<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role=Role::create([
            'id' => 1,
            'name' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Ahmad Saleem',
            'email'  =>'ahmadshk1996@gmail.com',
            'password' => bcrypt('ahmad9697'),
            'role_id' => '1',
        ]);
    }
}
