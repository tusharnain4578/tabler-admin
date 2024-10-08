<?php

namespace App\Services;

use App\Http\Requests\Admin\UserRequest;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use App\Models\User;

class UserService
{
    public function dataTable(): EloquentDataTable
    {
        $query = User::select([
            'users.*',
            'sponsors.username as sponsor_username',
            'sponsors.name as sponsor_name',
        ])->leftJoin('users as sponsors', 'users.sponsor_id', '=', 'sponsors.id');

        return datatables()->eloquent($query)
            ->addColumn(
                'created_at',
                fn(User $user) => format_date($user->created_at)
            )
            ->orderColumn(
                'created_at',
                fn(Builder $query, string $order) => $query->orderBy('users.created_at', $order)
            )
            ->filterColumn(
                'sponsor_username',
                fn(Builder $query, string $keyword) => $query->where('sponsors.username', 'like', "%{$keyword}%")
            )
            ->filterColumn(
                'sponsor_name',
                fn(Builder $query, string $keyword) => $query->where('sponsors.name', 'like', "%{$keyword}%")
            );
    }

    public function create(UserRequest $request): User
    {
        $sponsorUsername = $request->validated('sponsor_username');
        $sponsor = $sponsorUsername ? $this->getByUsername($sponsorUsername, ['id']) : null;

        $user = new User($request->validated());
        $user->sponsor_id = $sponsor?->id;
        $user->save();

        return $user;
    }

    public function hasRegisteredUsers(): bool
    {
        return User::exists();
    }

    public function getByUsername(string $username, array|string $columns = ['*']): User|null
    {
        return User::where('username', $username)->first($columns);
    }
}