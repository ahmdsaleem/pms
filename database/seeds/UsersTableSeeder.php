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


       $jvzoo= \App\Platform::create([
            'name' => 'jvzoo'
        ]);

       $jvzoo_field1= \App\PlatformField::create([
           'platform_id' => $jvzoo->id,
           'name' => 'API URL',
           'input_name' => 'api_url'
       ]);


        $jvzoo_field2= \App\PlatformField::create([
            'platform_id' => $jvzoo->id,
            'name' => 'Application Key',
            'input_name' => 'app_key'
        ]);


        $jvzoo_field3= \App\PlatformField::create([
            'platform_id' => $jvzoo->id,
            'name' => 'Password',
            'input_name' => 'password'
        ]);


        $codecanyon= \App\Platform::create([
            'name' => 'Code Canyon'
        ]);

        $codecanyon_field1= \App\PlatformField::create([
            'platform_id' => $codecanyon->id,
            'name' => 'APPLICATION Full URL',
            'input_name' => 'api_url'
        ]);


        $codecanyon_field2= \App\PlatformField::create([
            'platform_id' => $codecanyon->id,
            'name' => 'App Secret Key',
            'input_name' => 'app_key'
        ]);




        factory(App\User::class,5)->create();
//        $user->projects()->attach(\App\Project::all()->pluck('id'));
//        factory(App\Customer::class,50)->create();

    }
}
