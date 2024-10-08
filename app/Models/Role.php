<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'guard_name', 'priority'];


}
