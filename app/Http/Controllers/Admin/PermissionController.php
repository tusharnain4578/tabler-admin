<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PermissionRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends \App\Foundation\Controller
{
    /**
     * Constructor for PermissionController
     * @param \App\Services\PermissionService $service
     * @param \App\Services\ResponseService $responseService
     */
    public function __construct(
        protected PermissionService $service,
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
        return view('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $this->toast = $this->service->update($permission, $request) ?
            ['type' => 'success', 'message' => 'Permission Updated!'] :
            ['type' => 'warning', 'message' => 'No Changes Made!'];

        return $this->responseService->json(success: true, toast: $this->toast);
    }

}
