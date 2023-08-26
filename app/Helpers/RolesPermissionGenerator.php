<?php
namespace App\Helpers;

use Spatie\Permission\Models\Permission;

class RolesPermissionGenerator
{
    public function handle(array $models , array $methods, string $guard_name) : array
    {
        $permissions = [];
        foreach ($models as $model) {
            $permission = Permission::firstOrCreate(
                ['name' => $model,
                'guard_name' => $guard_name],
                [
                'name' => $model,
                'guard_name' => $guard_name,

                'parent_id' => null
            ]);
            if ($model === 'clients') {
                $permissions[] = Permission::firstOrCreate(
                    ['name' =>  "$model index",
                    'guard_name' => $guard_name,
                    'parent_id' => $permission->id],
                    [
                    'name' =>  "$model index",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id
                ]);
                $permissions[] = Permission::firstOrCreate([
                    'name' => "$model show",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ],[
                    'name' => "$model show",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ]);
                $permissions[] = Permission::firstOrCreate([
                    'name' => "$model activate",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ],[
                    'name' => "$model activate",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ]);
                continue;
            } else if ($model === 'contactMessages') {
                $permissions[] = Permission::firstOrCreate([
                    'name' => "$model index",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ],[
                    'name' => "$model index",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ]);
                $permissions[] = Permission::firstOrCreate([
                    'name' => "$model reply",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ],[
                    'name' => "$model reply",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ]);
                continue;
            } else if ($model === 'appContent') {
                $permissions[] = Permission::firstOrCreate([
                    'name' => "about",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ],[
                    'name' => "about",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ]);
                $permissions[] = Permission::firstOrCreate([
                    'name' => "termsAndConditions",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ],[
                    'name' => "termsAndConditions",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ]);
                $permissions[] = Permission::firstOrCreate([
                    'name' => "privacyPolicy",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ],[
                    'name' => "privacyPolicy",
                    'guard_name' => $guard_name,

                    'parent_id' => $permission->id

                ]);
                continue;
            }
            foreach ($methods as $method) {
                $permissions[] = Permission::firstOrCreate([
                    'name' =>  "$model $method",
                    'guard_name' => $guard_name,
                    'parent_id' => $permission->id
                ],[
                    'name' =>  "$model $method",
                    'guard_name' => $guard_name,
                    'parent_id' => $permission->id
                ]);
            }
        }
        return $permissions;
    }
}
