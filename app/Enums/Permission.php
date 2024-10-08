<?php

namespace App\Enums;

class Permission extends BaseEnum
{
    const string ADMIN_PANEL = 'admin_panel';
    const string PERMISSION_LIST = 'permission:list';
    const string PERMISSION_UPDATE = 'permission:update';
    const string ROLE_LIST = 'role:list';
    const string ROLE_CREATE = 'role:create';
    const string ROLE_UPDATE = 'role:update';
    const string ROLE_DELETE = 'role:delete';
    const string ADMIN_LIST = 'admin:list';
    const string ADMIN_CREATE = 'admin:create';
    const string ADMIN_UPDATE = 'admin:update';
    const string ADMIN_DELETE = 'admin:delete';
    const string USER_LIST = 'user:list';
    const string USER_CREATE = 'user:create';
    const string USER_DELETE = 'user:delete';
}