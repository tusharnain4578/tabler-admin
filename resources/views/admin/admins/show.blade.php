@extends('admin.layouts.app', [
    'pageTitle' => Breadcrumbs::current()->title,
    'breadcrumbs' => Breadcrumbs::render('admin.admins.show'),
    'buttons' => [['label' => 'Edit User', 'icon' => 'ti ti-edit', 'url' => route('admin.admins.edit', $admin)]],
])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
