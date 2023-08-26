
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<div class="hhhh table-responsive">
    <table class="table" id="clients-table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">@lang('models/clients.fields.user_name')</th>
            <th class="text-center">@lang('models/clients.fields.phone_number')</th>
            <th class="text-center">@lang('models/clients.fields.email')</th>
            <th class="text-center">@lang('models/clients.fields.subscription_date')</th>
            <th class="text-center">@lang('models/clients.fields.otp_status')</th>
            <th class="text-center">@lang('models/clients.fields.is_Active')</th>



            <th class="text-center" colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $client->fullname }}</td>
                <td class="text-center">{{ $client->phone }}</td>
                <td class="text-center">{{ $client->email }}</td>
                <td class="text-center">{{ $client->created_at }}</td>
                @if($client->is_send_otp == 1 )
                    <td class=" text-center">
                        <img src="{{ asset('img/correct.png') }}"
                             class="shadow-light"></td>
                @else
                    <td class=" text-center">
                        <img src="{{ asset('img/remove.png') }}"
                             class="shadow-light"></td>
                @endif
                @if($client->is_active == 1 )
                    <td class=" text-center">
                        <img src="{{ asset('img/correct.png') }}"
                             class="shadow-light"></td>
                @else
                    <td class=" text-center">
                        <img src="{{ asset('img/remove.png') }}"
                             class="shadow-light"></td>
                @endif




                <td class=" text-center">

                    <div class='btn-group'>
                        <a href="{!! route('clients.show', [$client->id]) !!}" class='btn btn-primary action-btn '><i
                                class="fa fa-eye"></i></a>
                    </div>
                    <div>
                    <input data-id="{{$client->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                               data-offstyle="danger" data-toggle="toggle" data-on="{{__('validation.active')}}"
                               data-off="{{__('validation.in_active')}}" {{ !$client->is_active ? 'checked' : '' }}
                        >
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>


    </table>
</div>
@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function () {
            $('.toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{url('changeStatusUser')}}?status=" + status + "&user_id=" + user_id,
                    success: function (data) {
                        console.log(data.success)
                        $('#user').text(data.success).show();
                        setTimeout(function () {
                            $('#user').delay(900).slideUp(300);
                        });
                        setTimeout(location.reload.bind(location), 600);
                    }

                });
            })
        })
    </script>
@endsection
