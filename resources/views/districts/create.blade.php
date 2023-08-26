@extends('layouts.app')
@section('title')
   {{__('validation.new_district')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">   {{__('validation.new_district')}}
            </h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('districts.index') }}" class="btn btn-primary">@lang('crud.back')</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::open(['route' => 'districts.store']) !!}
                                <div class="row">
                                    @include('districts.fields')
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection