<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::truncate();

        $user_role = new UserRole();
        $user_role->name = 'super_admin';
        $user_role->role_serial = 1;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->name = 'admin';
        $user_role->role_serial = 2;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->name = 'employee';
        $user_role->role_serial = 3;
        $user_role->save();

        $user_role = new UserRole();
        $user_role->name = 'user';
        $user_role->role_serial = 4;
        $user_role->save();

        UserPermission::truncate();

        $permission = new UserPermission();
        $user_role->id = 10;
        $permission->title = 'can_create';
        $permission->permission_serial = 1;
        $permission->save();

        $permission = new UserPermission();
        $user_role->id = 20;
        $permission->title = 'can_edit';
        $permission->permission_serial = 2;
        $permission->save();

        $permission = new UserPermission();
        $user_role->id = 30;
        $permission->title = 'can_delete';
        $permission->permission_serial = 3;
        $permission->save();

        User::truncate();

        $user = new User();
        $user->first_name = 'super';
        $user->last_name = 'admin';
        $user->user_name = 'super admin';
        $user->telegram_id = '812239513';
        // $user->role_id = 1;
        $user->mobile_number = '016123';
        $user->email = 'superadmin@gmail.com';
        $user->password = Hash::make('!@#$%^&*');
        $user->save();
        $user->roles()->attach([1,2]);
        $user->permissions()->attach([1,2,3]);

        $user = new User();
        $user->first_name = 'it';
        $user->last_name = 'admin';
        $user->user_name = 'IT_ADMIN';
        $user->telegram_id = '812239513';
        // $user->role_id = 2;
        $user->mobile_number = '016124';
        $user->email = 'itadmin@tpit.org';
        $user->password = Hash::make('E5h+4bm');
        $user->save();
        $user->roles()->attach([2]);
        $user->permissions()->attach([1,2,3]);

        $user = new User();
        $user->first_name = 'eng';
        $user->last_name = 'admin';
        $user->user_name = 'eng_admin';
        $user->telegram_id = '8122395136';
        // $user->role_id = 2;
        $user->mobile_number = '01612456';
        $user->email = 'engadmin@tpit.org';
        $user->password = Hash::make('Cdb+4Hw');
        $user->save();
        $user->roles()->attach([2]);
        $user->permissions()->attach([1,2,3]);

        // $user = new User();
        // $user->first_name = 'mr';
        // $user->last_name = 'admin 3';
        // $user->user_name = 'admin3';
        // $user->telegram_id = '8122395137';
        // // $user->role_id = 2;
        // $user->mobile_number = '01612457';
        // $user->email = 'admin2@gmail.com';
        // $user->password = Hash::make('12345678');
        // $user->save();
        // $user->roles()->attach([2]);
        // $user->permissions()->attach([2]);

        // $user = new User();
        // $user->first_name = 'mr';
        // $user->last_name = 'employee';
        // $user->user_name = 'employee';
        // $user->telegram_id = '812239534';
        // // $user->role_id = 2;
        // $user->mobile_number = '0161241';
        // $user->email = 'employee@gmail.com';
        // $user->password = Hash::make('12345678');
        // $user->save();
        // $user->roles()->attach([3]);

        // $user = new User();
        // $user->first_name = 'mr';
        // $user->last_name = 'employee_2';
        // $user->user_name = 'employee_2';
        // $user->telegram_id = '812239523';
        // // $user->role_id = 2;
        // $user->mobile_number = '0161242';
        // $user->email = 'employee2@gmail.com';
        // $user->password = Hash::make('12345678');
        // $user->save();
        // $user->roles()->attach([3]);


        // $user = new User();
        // $user->first_name = 'mr';
        // $user->last_name = 'employee_3';
        // $user->user_name = 'employee_3';
        // $user->telegram_id = '812239533';
        // // $user->role_id = 2;
        // $user->mobile_number = '0161243';
        // $user->email = 'employee3@gmail.com';
        // $user->password = Hash::make('12345678');
        // $user->save();
        // $user->roles()->attach([3]);


        // $user = new User();
        // $user->first_name = 'mr';
        // $user->last_name = 'user';
        // $user->user_name = 'user';
        // $user->telegram_id = '812239513';
        // // $user->role_id = 3;
        // $user->mobile_number = '016125';
        // $user->email = 'user@gmail.com';
        // $user->password = Hash::make('12345678');
        // $user->save();
        // $user->roles()->attach([3]);

    }
}
