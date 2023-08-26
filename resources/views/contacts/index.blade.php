@extends('layouts.app')
@section('title')
    @lang('models/contacts.plural')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>    @lang('models/contacts.plural')
            </h1>
        </div>
        <div class="section-body">
           <div class="card">
                <div class="card-body">
                <form action="" method="get" class="main-form" role="search">
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-3">
                                    {!! Form::label('keyword',__('models/contacts.fields.search')) !!}
                                    {!! Form::text('keyword', request('keyword'),
                                     ['class' => 'form-control '
                                                            ,'autocomplete'=>'off',
                                                           'id'=>'keyword']) !!}
                                </div>

                                <div class="col-md-2">
                                    {!! Form::label('keyword',__('models/regions.fields.status')) !!}
                                    {!! Form::select('status', ['' => __('models/regions.fields.status'),
                                     'replied' => __('crud.replied'),
                                     'pending' => __('crud.pending'),
                                     ], request('messgae_status'), ['class' => 'form-control']) !!}
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
                    @include('contacts.table')
                </div>
           </div>
        </div>
    </section>
@endsection