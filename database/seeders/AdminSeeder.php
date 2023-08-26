<?php

namespace Database\Seeders;

use App\Enums\Admin\User\RoleEnum;
use App\Helpers\RolesPermissionGenerator;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /*public function run(RolesPermissionGenerator $rolesPermissionGenerator): void
    {

        // $adminModels = [
        //     'clients', 'contactMessages', 'admins', 'roles', 'storesTypes', 'about', 'termsAndConditions', 'privacyPolicy'
        // ];
        $adminModels = [
            'users','admins','roles','contactuses','bikes','discountcodes'
        ];
        $methods = ['index' , 'create' ,  'edit',  'delete', 'show' , 'activate' ,'updateContactus','show_contactus'];


        $adminPermissions = $rolesPermissionGenerator->handle($adminModels, $methods,'admin');


        //main roles
    //     $roleAdmin = Role::firstOrCreate(
    //         [
    //             'name' => RoleEnum::ADMIN->value,
    //         'guard_name' => 'admin'

    //     ],[
    //         'name' => RoleEnum::ADMIN->value,
    //         'guard_name' => 'admin'

    //     ]);
    //     $storeOwner = Role::firstOrCreate([
    //         'name' => RoleEnum::OWNER->value,
    //         'guard_name' => 'employee'
    //     ],[
    //         'name' => RoleEnum::OWNER->value,
    //         'guard_name' => 'employee'
    //     ]);
    //     $storeOwner->givePermissionTo($merchantPermissions);
    //     try {
    //         $admin = User::factory()->create([
    //             'name' => 'Admin',
    //             'email' => 'admin@admin.com',
    //             'password' => bcrypt('12345678'),
    //             'is_active' => 1,
    //         ]);
    //     }catch (QueryException $e){
    //         $admin =User::where('email','admin@admin.com')->first();
    //     }
    //     $roleAdmin->givePermissionTo($adminPermissions);
    //     $admin->assignRole($roleAdmin);

    //     //test role
    //     $roleModerator = Role::firstOrCreate([ 'name' => RoleEnum::MODERATOR->value,
    //         'guard_name' => 'admin'],[
    //         'name' => RoleEnum::MODERATOR->value,
    //         'guard_name' => 'admin'
    //     ]);
    //     try {
    //         $moderator = User::factory()->create([
    //             'name' => 'moderator',
    //             'email' => 'moderator@admin.com',
    //             'password' => bcrypt('12345678'),
    //             'is_active' => 1,
    //         ]);
    //     }catch (QueryException $e){
    //         $moderator =User::where('email','moderator@admin.com')->first();
    //     }
    //     $moderator->assignRole($roleModerator);
    // }
}*/
}
