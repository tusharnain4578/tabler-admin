@push('style')
    <link href="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/css/intlTelInput.css" rel="stylesheet">
@endpush

<form action="{{ route('admin.users.store') }}" method="POST" id="user-form">
    @csrf
    <div class="row">
        @if ($hasUsers)
            <div class="col-12">
                <x-admin.input name='sponsor_username' label="Sponsor Username (Username of person who referred)" placeholder="Enter Sponsor Username"
                    required />
            </div>
        @endif
        <div class="col-lg-6">
            <x-admin.input name='name' label="Name" placeholder="Enter name" required />
        </div>
        <div class="col-lg-6">
            <x-admin.input name='username' label="Username" placeholder="Enter username" required />
        </div>
        <div class="col-lg-6">
            <x-admin.input name='email' label="Email Address" placeholder="Enter email address" required />
        </div>
        <div class="col-lg-6">
            <x-admin.input name='phone_number' id="phone_number" type='tel' label="Phone Number"
                placeholder="Enter phone number" required />
        </div>

        <div class="col-lg-6">
            <x-admin.input name='password' type="password" label="Password" placeholder="Create password" required />
        </div>
        <div class="col-lg-6">
            <x-admin.input name='confirm_password' type="password" label="Confirm Password"
                placeholder="Confirm password" required />
        </div>
    </div>


    <div class="text-end">
        <x-admin.button label="Create" icon='ti ti-plus' submit />
    </div>
</form>

@push('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.2/build/js/intlTelInput.js">
    </script>

    {!! JsValidator::formRequest(\App\Http\Requests\Admin\UserRequest::class, '#user-form') !!}

    <script>
        $(document).ready(function() {

            var input = document.querySelector("#phone_number");
            var iti = window.intlTelInput(input);

            ajaxForm('#user-form', {
                responseRedirect: true,
                disableFormAfterSuccess: true,
                handleToast: true
            });
        });
    </script>
@endpush
