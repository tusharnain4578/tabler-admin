@extends('admin.layouts.app', [
    'pageTitle' => Breadcrumbs::current()->title,
    'breadcrumbs' => Breadcrumbs::render('admin.users.index'),
    'buttons' => [['label' => 'Add new user', 'icon' => 'ti ti-plus', 'url' => route('admin.users.create')]],
])

@include('admin.layouts.components.datatable')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('admin.layouts.components.datatable_header', [
                'id' => 'users-table',
                'data' => [
                    ['title' => 'Sr.', 'classname' => 'text-center'],
                    ['title' => 'Username'],
                    ['title' => 'Name'],
                    ['title' => 'Sponsor Username'],
                    ['title' => 'Sponsor Name'],
                    ['title' => 'Email'],
                    ['title' => 'Registerd At'],
                    ['title' => 'Action'],
                ],
            ])
        </div>
    </div>
@endsection

@push('script')
    <script>
        var dtTable = null;

        const Action = {
            deleteUrl: @js(route('admin.users.destroy', ':id')),
            delete: function(username) {
                return `<a href="javascript:;" data-delete-id="${username}" class="cursor-pointer mx-1"><i class="ti ti-trash text-danger h1"></i></a>`;
            },
        };

        $(document).ready(function() {
            dtTable = $('#users-table').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: @js(route('admin.users.index')),
                order: [
                    [6, 'desc'] // created_at
                ],
                oLanguage: {
                    sLengthMenu: "_MENU_ entries per page",
                },
                createdRow: function(row, data, dataIndex) {
                    $('td:eq(0)', row).addClass('text-center');
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'username',
                        name: 'username',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'sponsor_username',
                        name: 'sponsor_username',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'sponsor_name',
                        name: 'sponsor_name',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return Action.delete(data);
                        }
                    },
                ],
            }).on('draw', function() {
                $('[data-delete-id]').on('click', deleteUser);
            });


            function deleteUser() {
                const id = $(this).data('delete-id');
                askConfirmation({
                    variant: 'danger',
                    icon: 'ti ti-trash',
                    message: `You are about to delete the <strong>user</strong>.<br>If you proceed, you won't be able to revert this.`,
                    onConfirm: async function() {
                        const url = Action.deleteUrl.replace(':id', id);
                        await $.ajax({
                            url: url,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.success) {
                                    response.toast && toast.open(response.toast);
                                    dtTable.draw();
                                }
                            },
                            error: function() {
                                toast.open('error', 'Something Went Wrong!');
                            }
                        });
                    }
                });
            }
        });
    </script>
@endpush
