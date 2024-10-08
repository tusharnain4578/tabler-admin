<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Middleware\PermissionMiddleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Admin\UserRequest;
use App\Services\ResponseService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Enums\Permission as PermissionEnum;
use App\Models\User;

class UserController extends \App\Foundation\Controller implements HasMiddleware
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
     * Permission middleware for resource controller methods
     * 
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using(PermissionEnum::USER_LIST), only: ['index']),
            new Middleware(PermissionMiddleware::using(PermissionEnum::USER_CREATE), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using(PermissionEnum::USER_DELETE), only: ['destroy']),
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
