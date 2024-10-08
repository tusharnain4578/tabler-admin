@extends('admin.layouts.app', [
    'pageTitle' => Breadcrumbs::current()->title,
    'breadcrumbs' => Breadcrumbs::render('admin.admins.create'),
])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.admins.form')
                </div>
            </div>
        </div>
    </div>
@endsection
