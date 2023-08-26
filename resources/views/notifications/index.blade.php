@extends('layouts.app')
@section('title')
    @lang('models/notifications.plural')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('models/notifications.plural')</h1>


        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                <form action="" method="get" class="main-form" role="search">
                        <div class="form-group">
                            <div class="row">

                            <div class="col-md-3">
                                    {!! Form::label('keyword',__('models/notifications.title/sender_type')) !!}
                                    {!! Form::text('keyword', request('keyword'),
                                     ['class' => 'form-control '
                                                            ,'autocomplete'=>'off',
                                                           'id'=>'keyword']) !!}
                                </div>


                                <div class="col-md-1">
                                    <label class="col-md-2"></label>
                                    <button class="btn btn-dark search-btn pull-left" style="margin-top: 30px;"
                                            type="submit">
                                        <i class="fa fa-search fa-x"></i></button>
                                </div>

                            </div>
                        </div>
                    </form>
                    @include('notifications.table')
                </div>
            </div>
        </div>

        @include('stisla-templates::common.paginate', ['records' => $notifications])

    </section>
@endsection

