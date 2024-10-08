<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

if (!class_exists('Bc')) {
    /**
     * @method static void resource(string $name, string $pluralTitle, ?string $singularTitle = null)
     */
    class Bc extends Breadcrumbs
    {
        // No need to implement anything, this just provides IDE support for new macro named 'resource'
    }
}


Bc::macro('resource', function (string $name, string $pluralTitle, ?string $singularTitle = null) {
    Bc::for("admin.$name.index", function ($trail) use ($name, $pluralTitle) {
        $trail->parent("admin.dashboard");
        $trail->push($pluralTitle, route("admin.$name.index"));
    });

    Bc::for("admin.$name.create", function ($trail) use ($name, $pluralTitle, $singularTitle) {
        $trail->parent("admin.$name.index");
        $trail->push('Add New ' . ($singularTitle ?? $pluralTitle), route("admin.$name.create"));
    });

    Bc::for("admin.$name.edit", function ($trail) use ($name, $pluralTitle, $singularTitle) {
        $trail->parent("admin.$name.index");
        $trail->push('Edit ' . ($singularTitle ?? $pluralTitle));
    });

    Bc::for("admin.$name.show", function ($trail) use ($name, $pluralTitle) {
        $trail->parent("admin.$name.index");
        $trail->push("Details");
    });
});





Bc::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.home'));
});




Bc::resource(name: 'roles', pluralTitle: 'Roles', singularTitle: 'Role');

Bc::resource(name: 'permissions', pluralTitle: 'Permissions', singularTitle: 'Permission');

Bc::resource(name: 'admins', pluralTitle: 'Admins', singularTitle: 'Admin');

Bc::resource(name: 'users', pluralTitle: 'Users', singularTitle: 'User');