<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole=Role::where('name','admin')->first();
        $userRole=Role::where('name','user')->first();

        $admin=User::create([
            'name' =>'Admin User',
            'email' =>'admin@admin.com',
            'password' =>Hash::make('adminadmin')
        ]);

        $user=User::create([
           'name' =>'User',
           'email' =>'user@user.com',
           'password' =>Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
