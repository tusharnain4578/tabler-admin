@php
    $role = $role ?? null;
    $isUpdate = !!$role;
@endphp

<form action="{{ $actionUrl }}" method="{{ $method }}" id="role-form">
    @csrf
    @if ($isUpdate)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <x-admin.input name='name' label='Role Name' placeholder='Enter role name' :value="$role?->name" required />
        </div>
        <div class="col-md-6">
            <x-admin.input name='priority' label='Priority' placeholder='Enter priority' :value="$role?->priority" required />
        </div>

        <div class="col-12">
            <h4 class="form-label required">
                Permissions
            </h4>
            @error('permissions')
                <h5 class="text-danger">
                    {{ $message }}
                </h5>
            @enderror
        </div>

        <div class="col-12">
            <x-admin.checkbox label='All' id="all-permissions-check" />
        </div>

        @foreach ($permissions as $permission)
            <div class="col-lg-3 col-md-4 col-6 mt-2">
                <x-admin.checkbox class="permission" name='permissions[]{{ $permission->name }}' :label="$permission->label"
                    :value="$permission->name" :checked="isset($rolePermissions[$permission->id])" skip-errors />
            </div>
        @endforeach

        <div class="col-12">
            @if ($isUpdate)
                <x-admin.button class="float-end btn-block" label='Update' icon='ti ti-device-floppy' submit />
            @else
                <x-admin.button class="float-end btn-block" label='Create' icon='ti ti-plus' submit />
            @endif
        </div>
    </div>

</form>

@push('script')
    {!! JsValidator::formRequest(\App\Http\Requests\Admin\RoleRequest::class, '#role-form') !!}
    <script>
        $(document).ready(function() {
            const isUpdate = @js($isUpdate);
            const $allPermissionsCheck = $('#all-permissions-check');
            const $permissions = $('.permission');

            $allPermissionsCheck.on('click', function() {
                $permissions.prop('checked', $allPermissionsCheck.is(':checked'));
            });

            $permissions.on('change', function() {
                if (!$(this).is(':checked')) {
                    $allPermissionsCheck.prop('checked', false);
                } else if ($permissions.length === $permissions.filter(':checked').length) {
                    $allPermissionsCheck.prop('checked', true);
                }
            });

            $permissions.trigger('change');

            ajaxForm('#role-form', {
                responseRedirect: !isUpdate,
                disableFormAfterSuccess: !isUpdate,
                handleToast: isUpdate
            });
        });
    </script>
@endpush
