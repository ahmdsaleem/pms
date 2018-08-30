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

        $role1=Role::create([
            'id' => '1',
            'name' => 'admin',
        ]);

        $role2=Role::create([
            'id' => '2',
            'name' => 'user',
        ]);


        $user = User::create([
            'name' => 'Ahmad Saleem',
            'email'  =>'ahmadshk1996@gmail.com',
            'password' => bcrypt('ahmad9697'),
            'role_id' => '1',
        ]);
    }
}
