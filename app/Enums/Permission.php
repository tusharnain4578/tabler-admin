<?php

namespace App\Enums;

class Permission extends BaseEnum
{
    const string ADMIN_PANEL = 'admin_panel';
    const string PERMISSION_LIST = 'permission:list';
    const string PERMISSION_CREATE = 'permission:create';
    const string ROLE_LIST = 'role:list';
    const string ROLE_CREATE = 'role:create';
}