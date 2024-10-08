<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Middleware\PermissionMiddleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Admin\AdminRequest;
use App\Services\ResponseService;
use App\Services\AdminService;
use Illuminate\Http\Request;
use App\Enums\Permission;
use App\Models\Admin;
use App\Models\Role;

class AdminController extends \App\Foundation\Controller implements HasMiddleware
{
    /**
     * Constructor for AdminController
     * 
     * @param \App\Services\AdminService $service
     * @param \App\Services\ResponseService $responseService
     */
    public function __construct(
        protected AdminService $service,
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
            new Middleware(PermissionMiddleware::using(Permission::ADMIN_LIST), only: ['index']),
            new Middleware(PermissionMiddleware::using(Permission::ADMIN_CREATE), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using(Permission::ADMIN_UPDATE), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using(Permission::ADMIN_DELETE), only: ['destroy']),
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
        return view('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $this->service->create($request);
        $this->flashToast('success', 'Admin Created!');
        return $this->responseService->json(success: true, redirectTo: route('admin.admins.index'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $updated = !!$this->service->update($admin, $request);
        $this->toast = $updated ?
            ['type' => 'success', 'message' => 'Admin Updated!'] :
            ['type' => 'warning', 'message' => 'Nothing to update!'];

        return $this->responseService->json(success: $updated, toast: $this->toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $this->service->delete($admin);
        return $this->responseService->json(success: true, toast: ['type' => 'success', 'message' => 'Admin Deleted!']);
    }
}
