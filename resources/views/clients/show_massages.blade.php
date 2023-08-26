@extends('layouts.app')
@section('title')
    @lang('models/clients.plural')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
{{--            <h1>@lang('models/clients.fields.client_massages')</h1>--}}
            <h1>@lang('models/clients.fields.client_massages')</h1>

        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get" class="main-form" role="search">
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-3">
                                    {!! Form::label('keyword',__('models/clients.fields.client_name/phone_number')) !!}
                                    {!! Form::text('keyword', request('keyword'),
                                     ['class' => 'form-control '
                                                            ,'autocomplete'=>'off',
                                                           'id'=>'keyword']) !!}
                                </div>


                                <div class="col-md-1">
                                    <label class="col-md-2"></label>
                                    <button class="btn btn-dark search-btn pull-left" style="margin-top: 10px;"
                                            type="submit">
                                        <i class="fa fa-search fa-x"></i></button>
                                </div>

                            </div>
                        </div>
                    </form>

                    <div class="hhhh table-responsive">
                        <table class="table" id="clients-table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">@lang('models/clients.fields.user_name')</th>
                                <th class="text-center">@lang('models/clients.fields.phone_number')</th>
                                <th class="text-center">@lang('models/clients.fields.email')</th>
                                <th class="text-center">@lang('models/clients.fields.massage')</th>
                                <th class="text-center">@lang('models/clients.fields.created_at')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($massages as $record)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $record->name }}</td>
                                    <td class="text-center">{{ $record->phone_number }}</td>
                                    <td class="text-center">{{ $record->email }}</td>
                                    <td class="text-center">{{ $record->massage }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d h:i:s') }}</td>

                                </tr>
                            @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('stisla-templates::common.paginate', ['records' => $massages->appends(request()->all())])

    </section>
@endsection



