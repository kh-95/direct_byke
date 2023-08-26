<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>


</style>
<div class="alert alert-success" role="alert" id="user" style="display: none"></div>

<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class=" text-center"> {{__('models/bikes.fields.name_' . app()->getLocale() )}}</th>
            <th class=" text-center"> {{__('models/bike_types.fields.name_' . app()->getLocale() )}}</th>
            <th class="text-center">@lang('validation.QR_code')</th>
            <th class=" text-center"> {{__('models/bikes.fields.bike_image' )}}</th>
            <th class="text-center">@lang('validation.enabled')</th>
            <th class=" text-center" colspan="5">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bikes as $key => $bike)
            <tr>
                <td class=" text-center">{{$loop->iteration}}</td>
                <td class=" text-center">{{ $bike->{'name_' . app()->getLocale()} }}</td>
                <td class=" text-center">{{ $bike->BikeType->{'name_' . app()->getLocale()} }}</td>
                <td class=" text-center">
                    <img style="width: 80px" src="{{asset('/storage/QR/'.$bike->QR_code)}} ">
                </td>

                <td class=" text-center">
                    <a href="{{ ($bike->image_url) }}" target="_blank"
                       data-title="{{$bike->image_url }}">
                        <img id='edit_preview_photo'
                             class="img-thumbnail user-img user-profile-img profilePicture"
                             src="{{($bike->image_url)}}" style="width: 80px"/>
                    </a>

                </td>


                @if($bike->is_active == 1 )
                    <td class=" text-center">
                        <img src="{{ asset('img/correct.png') }}"
                             class="shadow-light"></td>
                @else
                    <td class=" text-center">
                        <img src="{{ asset('img/remove.png') }}"
                             class="shadow-light"></td>
                @endif
                <td class=" text-center" colspan="5">
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['bikes.destroy', $bike->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>

                            <a href="{!! route('bikes.edit', [$bike->id]) !!}"
                               class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>

                        </div>
                        <div class='btn-group'>
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}

                        </div>
                        <div class='btn-group'>
                            <a href="{!! route('bikes.show', [$bike->id]) !!}" class='btn btn-primary action-btn '><i
                                    class="fa fa-eye"></i></a>
                        </div>
                        <div class='btn-group'>
                            <a href="{!! route('bikes.QRToPdf', [$bike->id]) !!}" title="Download QR Code"
                               class='btn btn-primary action-btn '><i
                                    class="fa fa-download"></i></a>
                        </div>

                        <input data-id="{{$bike->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                               data-offstyle="danger" data-toggle="toggle" data-on="{{__('validation.active')}}"
                               data-off="{{__('validation.in_active')}}" {{ !$bike->is_active ? 'checked' : '' }}
                        >
                    </div>
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $bikes->withQueryString()->links() !!}
    </div>
</div>


@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function () {
            $('.toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var bike_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{url('changeStatusBike')}}?status=" + status + "&bike_id=" + bike_id,
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


