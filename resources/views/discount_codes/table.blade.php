<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>



</style>
<div class="alert alert-success" role="alert" id="user" style="display: none"></div>

<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th class=" text-center">@lang('validation.attributes.discount_code')</th>
            <th class=" text-center">@lang('validation.attributes.rate')</th>
            <th class=" text-center">@lang('validation.attributes.start_at')</th>
            <th class=" text-center">@lang('validation.attributes.end_at')</th>
            <th class=" text-center">@lang('validation.attributes.number_usage')</th>
            <th class=" text-center">@lang('validation.attributes.status')</th>
            <th class=" text-center">@lang('validation.attributes.created_at')</th>





            <th class=" text-center" colspan="5">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($discount_codes as $key => $discount_code)
            <tr>
                <td class=" text-center">{{ $discount_code->discount_code }}</td>
                <td class=" text-center">{{ $discount_code->rate_discount_code }}</td>
                <td class=" text-center">{{ $discount_code->start_at }}</td>
                <td class=" text-center">{{ $discount_code->end_at }}</td>
                <td class=" text-center">{{ $discount_code->number_usage }}</td>
                @if($discount_code->is_active == 1 )
                    <td class=" text-center">
                        <img src="{{ asset('img/correct.png') }}"
                             class="shadow-light"></td>
                @else
                    <td class=" text-center">
                        <img src="{{ asset('img/remove.png') }}"
                             class="shadow-light"></td>
                @endif
                <td class=" text-center">{{ $discount_code->created_at }}</td>
                <td class=" text-center" colspan="5">
                <div class='btn-group'>
                        {!! Form::open(['route' => ['discount_codes.destroy', $discount_code->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>

                                <a href="{!! route('discount_codes.edit', [$discount_code->id]) !!}"
                                   class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>

                        </div>
                        <div class='btn-group'>
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}

                        </div>
                        <div class='btn-group'>
                        <a href="{!! route('discount_codes.show', [$discount_code->id]) !!}" class='btn btn-primary action-btn '><i
                                class="fa fa-eye"></i></a>
                    </div>

                        <input data-id="{{$discount_code->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                               data-offstyle="danger" data-toggle="toggle" data-on="{{__('validation.active')}}"
                               data-off="{{__('validation.in_active')}}" {{ !$discount_code->is_active ? 'checked' : '' }}
                        >
                    </div>
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $discount_codes->withQueryString()->links() !!}
    </div>
</div>


@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function () {
            $('.toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var discount_code_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{url('changeStatusDiscountCode')}}?status=" + status + "&discount_code_id=" + discount_code_id,
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


