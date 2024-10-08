<?php

namespace App\Services;
use App\Http\Requests\Admin\PermissionRequest;
use App\Models\Permission;
use Yajra\DataTables\EloquentDataTable;

class PermissionService
{
    public function dataTable(): EloquentDataTable
    {
        $query = Permission::query();
        return datatables()->eloquent($query);
    }

    public function update(Permission $permission, PermissionRequest $request): Permission|bool
    {
        $permission->fill($request->validated());

        if ($permission->isDirty()) {
            $permission->save();
            return $permission;
        }
        return false;
    }
}