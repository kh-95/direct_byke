<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>



</style>
<div class="alert alert-success" role="alert" id="user" style="display: none"></div>

<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th class=" text-center"> @lang('validation.name')</th>
            <th class=" text-center">@lang('validation.email_')</th>
            <th class="text-center">@lang('validation.enabled')</th>
            <th class="text-center">@lang('validation.created_at')</th>
            <th class="text-center">@lang('validation.phone_number')</th>
            <th class="text-center">@lang('validation.role')</th>




            <th class=" text-center" colspan="5">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
            <?php
            $userRole = \Spatie\Permission\Models\Role::where('id', $user->role_name)->first();
            ?>

            <tr>
                <td class=" text-center">{{ $user->fullname }}</td>
                <td class=" text-center">{{ $user->email }}</td>
                @if($user->is_active == 1 )
                    <td class=" text-center">
                        <img src="{{ asset('img/correct.png') }}"
                             class="shadow-light"></td>
                @else
                    <td class=" text-center">
                        <img src="{{ asset('img/remove.png') }}"
                             class="shadow-light"></td>
                @endif
                <td class=" text-center">{{ $user->created_at }}</td>
                <td class=" text-center">{{ $user->phone }}</td>


                <td class=" text-center">{{ $user->getRoleNames()[0] }}  </td>
                <td class=" text-center" colspan="5">
                <div class='btn-group'>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>

                                <a href="{!! route('users.edit', [$user->id]) !!}"
                                   class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>

                        </div>
                        <div class='btn-group'>
                            @if(auth()->user()->id != $user->id)

                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}

                        </div>
                        <div class='btn-group'>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-primary action-btn '><i
                                class="fa fa-eye"></i></a>
                    </div>

                        <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                               data-offstyle="danger" data-toggle="toggle" data-on="{{__('validation.active')}}"
                               data-off="{{__('validation.in_active')}}" {{ !$user->is_active ? 'checked' : '' }}
                        >
                        @endif
                    </div>
                    {!! Form::close() !!}

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
                    url: "{{url('changeStatusAdmin')}}?status=" + status + "&user_id=" + user_id,
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


