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

       $jvzoo_project= \App\Project::create([
          'name'=>'Jvzoo Project',
           'platform_id' => $jvzoo->id,
       ]);

       $jvzoo_field1= \App\PlatformField::create([
           'platform_id' => $jvzoo->id,
           'name' => 'API URL',
           'input_name' => 'api_url'
       ]);

       $jvzoo_field1_value=\App\PlatformFieldValue::create([
          'platform_field_id' => $jvzoo_field1->id,
           'project_id' => $jvzoo_project->id,
           'value'=> 'https://api.jvzoo.com/v2.0'
       ]);


        $jvzoo_field2= \App\PlatformField::create([
            'platform_id' => $jvzoo->id,
            'name' => 'Application Key',
            'input_name' => 'app_key'
        ]);

        $jvzoo_field2_value=\App\PlatformFieldValue::create([
            'platform_field_id' => $jvzoo_field2->id,
            'project_id' => $jvzoo_project->id,
            'value'=> 'c4ab184147f311239c6f234895717284467c6744d32ed87ca4103f9aa5375c1a'
        ]);


        $jvzoo_field3= \App\PlatformField::create([
            'platform_id' => $jvzoo->id,
            'name' => 'Password',
            'input_name' => 'password'
        ]);

        $jvzoo_field3_value=\App\PlatformFieldValue::create([
            'platform_field_id' => $jvzoo_field3->id,
            'project_id' => $jvzoo_project->id,
            'value'=> 'x'
        ]);


        $codecanyon= \App\Platform::create([
            'name' => 'Code Canyon'
        ]);

        $codecanyon_project= \App\Project::create([
            'name'=>'CodeCanyon Project',
            'platform_id' => $codecanyon->id,
        ]);

        $codecanyon_field1= \App\PlatformField::create([
            'platform_id' => $codecanyon->id,
            'name' => 'APPLICATION Full URL',
            'input_name' => 'api_url'
        ]);

        $codecanyon_field1_value=\App\PlatformFieldValue::create([
            'platform_field_id' => $codecanyon_field1->id,
            'project_id' => $codecanyon_project->id,
            'value'=> 'https://www.codecanyon.com'
        ]);


        $codecanyon_field2= \App\PlatformField::create([
            'platform_id' => $codecanyon->id,
            'name' => 'App Secret Key',
            'input_name' => 'app_key'
        ]);

        $codecanyon_field2_value=\App\PlatformFieldValue::create([
            'platform_field_id' => $codecanyon_field2->id,
            'project_id' => $codecanyon_project->id,
            'value'=> 'c4ab184147f311239c6f234895717284467c6744d32ed87ca4103f9aa5375c1a'
        ]);



        factory(App\User::class,5)->create();
        factory(App\Platform::class,5)->create();
        factory(App\Project::class,7)->create();
        $user->projects()->attach(\App\Project::all()->pluck('id'));
        factory(App\Customer::class,50)->create();

    }
}
