<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminRequest;
use App\Models\Role;
use App\Models\Admin;
use App\Services\ResponseService;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends \App\Foundation\Controller
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
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admin.admins.show', compact('admin'));
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
