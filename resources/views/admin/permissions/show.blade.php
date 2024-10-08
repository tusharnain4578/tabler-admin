@extends('admin.layouts.app', [
    'pageTitle' => Breadcrumbs::current()->title,
    'breadcrumbs' => Breadcrumbs::render('admin.permissions.show'),
    'buttons' => [['label' => 'Edit Permission', 'icon' => 'ti ti-edit', 'url' => route('admin.permissions.edit', $permission)]],
])


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="fs-4 fw-bold mb-2">Permission Name
                            </div>
                            <div class="fs-3">{{ $permission->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="fs-4 fw-bold mb-2">Label
                            </div>
                            <div class="fs-3">{{ $permission->label }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
