@extends('admin.layouts.app', [
    'pageTitle' => Breadcrumbs::current()->title,
    'breadcrumbs' => Breadcrumbs::render('admin.users.create'),
])

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @include('admin.users.form')
                </div>
            </div>
        </div>
    </div>
@endsection
