@extends('layouts.app')
@section('title')
    @lang('models/clients.plural')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('models/clients.plural')</h1>
{{--            <div class="section-header-breadcrumb">--}}
{{--                <a href="{{ route('clients.create')}}" class="btn btn-primary form-btn">@lang('crud.add_new')<i--}}
{{--                        class="fas fa-plus"></i></a>--}}
{{--            </div>--}}
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get" class="main-form" role="search">
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-3">
                                    {!! Form::label('keyword',__('models/clients.fields.search')) !!}
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

                    @include('clients.table')
                </div>
            </div>
        </div>

        @include('stisla-templates::common.paginate', ['records' => $clients->appends(request()->all())])

    </section>
@endsection



