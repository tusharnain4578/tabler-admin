<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="{{ $id }}">
                <thead>
                    <tr>
                        @if (isset($data) && is_array($data))
                            @foreach ($data as $data_value)
                                <th @isset($data_value['classname']) class="{{ $data_value['classname'] }}" @endisset
                                    @isset($data_value['width']) width="{{ $data_value['width'] }}" @endisset>
                                    {{ $data_value['title'] }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
