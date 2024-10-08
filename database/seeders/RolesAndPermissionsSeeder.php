<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Enums\Permission as PermissionEnum;
use App\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission_names = PermissionEnum::all();

        $now = now();
        $guard = 'admin';

        $permission_array = $permission_names->map(function (string $permission_name) use ($now, $guard) {
            return [
                'name' => $permission_name,
                'label' => ucwords(str_replace(['_', ':'], ' ', $permission_name)),
                'guard_name' => $guard,
                'created_at' => $now,
                'updated_at' => $now
            ];
        })->toArray();

        Permission::insert($permission_array);


        $permissions = Permission::all();


        $superadminRole = Role::create(['name' => 'superadmin', 'priority' => 1, 'guard_name' => $guard]);
        $superadminRole->syncPermissions($permissions);

        $admin = Admin::getByUsername('admin')->assignRole($superadminRole);
        $admin->assignRole($superadminRole);
    }
}
