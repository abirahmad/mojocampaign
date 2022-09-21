<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = "Maniruzzaman";
        $user->last_name = "Akash";
        $user->username = "akash";
        $user->phone_no = "01951233084";
        $user->email = "manirujjamanakash@gmail.com";
        $user->password = Hash::make('123456');
        $user->is_approved = 1;
        $user->location = 'Dhaka';
        $user->date_of_birth = '1995-12-30';
        $user->save();
        $user->assignRole('Super Admin');

        $user = new User();
        $user->first_name = "Siraji ";
        $user->last_name = "";
        $user->username = "siraji";
        $user->phone_no = "012";
        $user->email = "siraji@gmail.com";
        $user->password = Hash::make('123456');
        $user->is_approved = 1;
        $user->save();
        $user->assignRole('Super Admin');

        $user = new User();
        $user->first_name = "User";
        $user->last_name = "";
        $user->username = "user";
        $user->phone_no = "0123";
        $user->email = "user@gmail.com";
        $user->password = Hash::make('123456');
        $user->is_approved = 0;
        $user->save();
        $user->assignRole('User');
    }
}
