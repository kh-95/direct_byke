@extends('layouts.app')
@section('title')
    @lang('validation.discount_codes')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>    @lang('validation.discount_codes')
            </h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('discount_codes.create')}}" class="btn btn-primary form-btn">

                    @lang('crud.add_new')
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
           <div class="card">
                <div class="card-body">
                <form action="" method="get" class="main-form" role="search">
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-2">

                                    {!! Form::label('keyword',__('models/regions.fields.search')) !!}
                                    {!! Form::text('keyword', request('keyword'),
                                     ['class' => 'form-control '
                                                            ,'autocomplete'=>'off',
                                                           'id'=>'keyword']) !!}
                                </div>

                                <div class="col-md-2">
                                    {!! Form::label('keyword',__('models/discount_codes.fields.status')) !!}
                                    {!! Form::select('status', ['' => __('models/discount_codes.fields.status'),
                                     '1' => __('crud.active'),
                                     '0' => __('crud.inactive'),
                                     ], request('status'), ['class' => 'form-control']) !!}
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
                    @include('discount_codes.table')
                </div>
           </div>
        </div>
    </section>
@endsection