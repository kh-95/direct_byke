<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


@extends('layouts.app')
@section('title')
    @lang('models/roles.plural')
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>    @lang('models/roles.plural')</h1>
            <div class="section-header-breadcrumb">

                    <a href="{{ url('roles/create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> {{ __('crud.add_new') }}
                    </a>

            </div>
        </div>

        @include('flash::message')

        <div class="section-body">
            <div class="card">
                <div class="card-body">

                    @if (!empty($roles) && count($roles) > 0)
                        <div class="table-responsive">
                            <table class="table" id="users-table">
                                <thead>
                                <th class="text-center">#</th>
                                <th class="text-center">{{ __('models/roles.fields.name') }}</th>
                                <th class="text-center">{{ __('models/roles.fields.is_active') }}</th>
                                <th class="text-center">{{ __('models/roles.fields.actions') }}</th>

                                </thead>
                                <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $role->name}}</td>
                                        @if($role->is_active == 1 )
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
                                                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}



                                                    <div class='btn-group'>
                                                        <a href="{!! route('roles.edit', [$role->id]) !!}"
                                                           class='btn btn-warning action-btn edit-btn'><i
                                                                class="fa fa-edit"></i></a>
                                                    </div>

                                                    <div class='btn-group'>
                        <a href="{!! route('roles.show', [$role->id]) !!}" class='btn btn-primary action-btn '><i
                                class="fa fa-eye"></i></a>

                    </div>



                                                    <div class='btn-group'>
                                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
                                                    </div>
                                                    <input data-id="{{$role->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                               data-offstyle="danger" data-toggle="toggle" data-on="{{__('validation.active')}}"
                               data-off="{{__('validation.in_active')}}" {{ !$role->is_active ? 'checked' : '' }}
                        >


                    </div>
                                            {!! Form::close() !!}
                                        </td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {!! $roles->render() !!}
                            </div>


                            @else
                                <div>
                                    <h3 class="text-info"
                                        style="text-align: center">{{ __('models/roles.fields.no_data_found') }}</h3>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function () {
            $('.toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var role_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{url('changeStatusRole')}}?status=" + status + "&role_id=" + role_id,
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
