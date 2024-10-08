<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Middleware\PermissionMiddleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\JsonResponse;
use App\Services\ResponseService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Enums\Permission as PermissionEnum;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends \App\Foundation\Controller implements HasMiddleware
{
    /**
     * Constructor for RoleController
     * @param \App\Services\RoleService $service
     * @param \App\Services\ResponseService $responseService
     */
    public function __construct(
        protected RoleService $service,
        protected ResponseService $responseService
    ) {
    }

    /**
     * Permission middleware for resource controller methods
     * 
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using(PermissionEnum::ROLE_LIST), only: ['index']),
            new Middleware(PermissionMiddleware::using(PermissionEnum::ROLE_CREATE), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using(PermissionEnum::ROLE_UPDATE), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using(PermissionEnum::ROLE_DELETE), only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->dataTable()->toJson();
        }
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->service->create($request);
        $this->flashToast('success', 'Role Created!');
        return $this->responseService->json(success: true, redirectTo: route('admin.roles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions()->get(['id'])->keyBy('id');
        return view('admin.roles.edit', compact('permissions', 'role', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        $this->toast = $this->service->update($role, $request) ?
            ['type' => 'success', 'message' => 'Role Updated!'] :
            ['type' => 'warning', 'message' => 'No Changes Made!'];

        return $this->responseService->json(success: true, toast: $this->toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->service->delete($role);
        return $this->responseService->json(success: true, toast: ['type' => 'success', 'message' => 'Role Deleted!']);
    }
}
