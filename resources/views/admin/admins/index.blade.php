@extends('admin.layouts.app', [
    'pageTitle' => Breadcrumbs::current()->title,
    'breadcrumbs' => Breadcrumbs::render('admin.admins.index'),
    'buttons' => [
        auth('admin')->user()->can(Permission::ADMIN_CREATE)
            ? ['label' => 'Add new admin', 'icon' => 'ti ti-plus', 'url' => route('admin.admins.create')]
            : null,
    ],
])

@include('admin.layouts.components.datatable')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('admin.layouts.components.datatable_header', [
                'id' => 'users-table',
                'data' => [
                    ['title' => 'Sr.', 'width' => '5%', 'classname' => 'text-center'],
                    ['title' => 'Full Name', 'width' => '30%'],
                    ['title' => 'Username', 'width' => '20%'],
                    ['title' => 'Email', 'width' => '20%'],
                    ['title' => 'Roles', 'width' => '20%'],
                    ['title' => 'Action', 'width' => '20%'],
                ],
            ])
        </div>
    </div>
@endsection

@push('script')
    <script>
        var dtTable = null;

        const Action = {
            editUrl: @js(route('admin.admins.edit', ':id')),
            deleteUrl: @js(route('admin.admins.destroy', ':id')),
            canEdit: @js(
                auth('admin')->user()->can(Permission::ADMIN_UPDATE)
            ),
            canDelete: @js(
                auth('admin')->user()->can(Permission::ADMIN_DELETE)
            ),
            edit: function(username) {
                if (!Action.canEdit)
                    return '';
                const url = this.editUrl.replace(':id', username);
                return `<a href="${url}" class="cursor-pointer mx-1"><i class="ti ti-edit text-primary h1"></i></a>`;
            },
            delete: function(username) {
                if (!Action.canDelete)
                    return '';
                return `<a href="javascript:;" data-delete-id="${username}" class="cursor-pointer mx-1"><i class="ti ti-trash text-danger h1"></i></a>`;
            },
        };

        $(document).ready(function() {
            dtTable = $('#users-table').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: @js(route('admin.admins.index')),
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
                        data: 'name',
                        name: 'name',
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
                        data: 'email',
                        name: 'email',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'roles',
                        name: 'roles_count',
                        render: function(data, type, row, meta) {
                            let roles = '';
                            data && data.length > 0 && data.forEach((role) => {
                                roles +=
                                    `<span class="badge bg-blue text-blue-fg me-1 mt-1">${role.name}</span>`;
                            });
                            return roles;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return Action.edit(data) + Action.delete(data);
                        }
                    },
                ],
            }).on('draw', function() {
                $('[data-delete-id]').on('click', deleteAdmin);
            });


            function deleteAdmin() {
                const id = $(this).data('delete-id');
                askConfirmation({
                    variant: 'danger',
                    icon: 'ti ti-trash',
                    message: `You are about to delete the <strong>admin</strong>.<br>If you proceed, you won't be able to revert this.`,
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
