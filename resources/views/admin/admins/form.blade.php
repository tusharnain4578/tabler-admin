@php
    $admin = $admin ?? null;
    $isUpdate = !!$admin;
    $url = $admin ? route('admin.admins.update', $admin) : route('admin.admins.store');
@endphp

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/css/intlTelInput.css" rel="stylesheet">
@endpush

@include('admin.layouts.components.select2')

<form action="{{ $url }}" method="POST" id="admin-form">
    @csrf
    @if ($admin)
        @method('PUT')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-admin.input name='name' label="Full Name" placeholder="Enter full name" :value="$admin?->name" required />
        </div>
        <div class="col-md-6">
            <x-admin.input name='username' label="Username" placeholder="Create username" :value="$admin?->username" required />
        </div>
        <div class="col-xl-4 col-md-6">
            <x-admin.input name='email' label="Email" placeholder="Enter email" :value="$admin?->email" required />
        </div>
        <div class="col-xl-4 col-md-6">
            <x-admin.input name='phone_number' id="phone_number" type='tel' label="Phone Number"
                placeholder="Enter phone number" :value="$admin?->phone_number" required />
        </div>

        @if (!$isUpdate)
            <div class="col-xl-4 col-md-6">
                <x-admin.input name='password' type="password" label="Password" placeholder="Create password"
                    :value="$admin?->password" required />
            </div>
        @endif

    </div>

    <hr>

    <div class="row">
        <div class="col-12">
            <x-admin.select name="roles[]" label="Assign Role" class="select2" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @selected($admin?->roles?->contains($role))>{{ $role->name }}</option>
                @endforeach
            </x-admin.select>
        </div>
    </div>

    <div class="text-end">
        @if ($admin)
            <x-admin.button label='Update' icon='ti ti-device-floppy' submit />
        @else
            <x-admin.button label='Create' icon='ti ti-plus' submit />
        @endif
    </div>

</form>

@push('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.2/build/js/intlTelInput.js">
    </script>

    {!! JsValidator::formRequest(\App\Http\Requests\Admin\AdminRequest::class, '#admin-form') !!}

    <script>
        $(document).ready(function() {

            const isUpdate = @js($isUpdate);

            var input = document.querySelector("#phone_number");
            var iti = window.intlTelInput(input, {
                // initialCountry: [],
                // onlyCountries: [],
                // preferredCountries: []
            });


            ajaxForm('#admin-form', {
                responseRedirect: true,
                disableFormAfterSuccess: true,
                handleToast: true
            });
        });
    </script>
@endpush
