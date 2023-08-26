<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>



</style>
<div class="alert alert-success" role="alert" id="user" style="display: none"></div>

<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            @foreach (config('app.available_locales') as $l)
                <th class=" text-center"> {{__('models/offers.fields.name_' . $l )}}</th>
            @endforeach
            <th class=" text-center"> {{__('models/offers.fields.percentage')}}</th>
            <th class=" text-center"> {{__('models/offers.fields.start_at')}}</th>
            <th class=" text-center"> {{__('models/offers.fields.end_at')}}</th>
            <th class=" text-center"> {{__('models/offers.fields.status')}}</th>
            <th class=" text-center"> {{__('models/offers.fields.created_at')}}</th>





            <th class=" text-center" colspan="5">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $key => $offer)
            <tr>
                <td class=" text-center">{{ $offer->name_ar }}</td>
                <td class=" text-center">{{ $offer->name_en }}</td>
                <td class=" text-center">{{ $offer->percentage }}</td>
                <td class=" text-center">{{ $offer->start_at }}</td>
                <td class=" text-center">{{ $offer->end_at }}</td>
                @if($offer->is_active == 1 )
                    <td class=" text-center">
                        <img src="{{ asset('img/correct.png') }}"
                             class="shadow-light"></td>
                @else
                    <td class=" text-center">
                        <img src="{{ asset('img/remove.png') }}"
                             class="shadow-light"></td>
                @endif
                <td class=" text-center">{{ $offer->created_at }}</td>
                <td class=" text-center" colspan="5">
                <div class='btn-group'>
                        {!! Form::open(['route' => ['offers.destroy', $offer->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>

                                <a href="{!! route('offers.edit', [$offer->id]) !!}"
                                   class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>

                        </div>
                        <div class='btn-group'>
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}

                        </div>
                        <div class='btn-group'>
                        <a href="{!! route('offers.show', [$offer->id]) !!}" class='btn btn-primary action-btn '><i
                                class="fa fa-eye"></i></a>
                    </div>

                        <input data-id="{{$offer->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                               data-offstyle="danger" data-toggle="toggle" data-on="{{__('validation.active')}}"
                               data-off="{{__('validation.in_active')}}" {{ !$offer->is_active ? 'checked' : '' }}
                        >
                    </div>
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $offers->withQueryString()->links() !!}
    </div>
</div>


@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function () {
            $('.toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var offer_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{url('changeStatusOffer')}}?status=" + status + "&offer_id=" + offer_id,
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


