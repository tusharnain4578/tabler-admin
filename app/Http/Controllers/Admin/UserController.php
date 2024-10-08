<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\ResponseService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends \App\Foundation\Controller
{
    /**
     * Constructor for UserController
     * 
     * @param \App\Services\UserService $service
     * @param \App\Services\ResponseService $responseService
     */
    public function __construct(
        protected UserService $service,
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
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $hasUsers = $this->service->hasRegisteredUsers();
        return view('admin.users.create', compact('hasUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->service->create($request);
        $this->flashToast('success', 'User Created!');
        return $this->responseService->json(success: true, redirectTo: route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->toast = $this->service->isDeletable($user) && $this->service->delete($user) ?
            ['type' => 'success', 'message' => 'User deleted!'] :
            ['type' => 'warning', 'message' => 'User can\'t be removed.'];

        return $this->responseService->json(success: true, toast: $this->toast);
    }
}
