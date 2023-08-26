@extends('layouts.app')
@section('title')
    @lang('validation.districts')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>    @lang('validation.districts')
            </h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('districts.create')}}" class="btn btn-primary form-btn">

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

                                <div class="col-md-3">
                                    {!! Form::label('keyword',__('models/districts.fields.search')) !!}
                                    {!! Form::text('keyword', request('keyword'),
                                     ['class' => 'form-control '
                                                            ,'autocomplete'=>'off',
                                                           'id'=>'keyword']) !!}
                                </div>

                                <div class="col-md-2">
                                    {!! Form::label('keyword',__('models/regions.fields.status')) !!}
                                    {!! Form::select('status', ['' => __('models/regions.fields.status'),
                                     '1' => __('crud.active'),
                                     '0' => __('crud.inactive'),
                                     ], request('status'), ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-2">
                                    {!! Form::label('name', __('validation.regions')) !!}
                                    {!! Form::select('region_id', [
                                    '' => __('validation.regions')] + $regions, request('region_id'), ['class' => 'form-control']) !!}
                                </div>

                                @if(!empty($cities))
                                    <div class="form-group col-sm-2">
                                        {!! Form::label('name', __('validation.cities')) !!}
                                        {!! Form::select('city_id', [
                                        '' => __('validation.cities')] + $cities, request('city_id'), ['class' => 'form-control']) !!}
                                    </div>
                                @endif


                                <div class="col-md-1">
                                    <label class="col-md-2"></label>
                                    <button class="btn btn-dark search-btn pull-left" style="margin-top: 30px;"
                                            type="submit">
                                        <i class="fa fa-search fa-x"></i></button>
                                </div>

                            </div>
                        </div>
                    </form>
                    @include('districts.table')
                </div>
           </div>
        </div>
    </section>
@endsection
