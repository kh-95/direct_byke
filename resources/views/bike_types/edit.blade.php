@extends('layouts.app')
@section('title')
    @lang('validation.edit_bike_type')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0"> @lang('validation.edit_bike_type') </h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('bike_types.index') }}" class="btn btn-primary">رجوع</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($bike_type, ['route' => ['bike_types.update', $bike_type->id], 'method' => 'patch' , 'files' => true]) !!}
                                <div class="row">
                                    @include('bike_types.fields')
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
