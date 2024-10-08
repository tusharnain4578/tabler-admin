<?php

namespace App\Services;

use App\Http\Requests\Admin\RoleRequest;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleService
{
    public function dataTable(): EloquentDataTable
    {
        $query = Role::withCount('permissions');
        return datatables()->eloquent($query);
    }

    public function create(RoleRequest $request): Role
    {
        return DB::transaction(function () use ($request) {
            $permissionNames = $request->validated('permissions', []);
            $role = Role::create($request->validated());
            $role->givePermissionTo($permissionNames);
            return $role;
        });
    }

    public function update(Role $role, RoleRequest $request): Role|bool
    {
        return DB::transaction(function () use ($role, $request) {
            $role->fill($request->validated());
            $permissionNames = $request->validated('permissions', []);
            $rolePermissionNames = $role->permissions()->select(['name'])->pluck('name')->toArray();

            $hasChanges = false;

            if ($role->isDirty('name', 'priority')) {
                $role->save();
                $hasChanges = true;
            }

            if (!array_equals($permissionNames, $rolePermissionNames)) {
                $role->syncPermissions($permissionNames);
                $hasChanges = true;
            }

            return $hasChanges ? $role : false;
        });
    }

    public function delete(Role $role): bool|null
    {
        return $role->delete();
    }

}