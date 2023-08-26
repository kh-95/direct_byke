@extends('layouts.app')
@section('title')
    {{__('validation.details_city')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('validation.details_city')}}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('cities.index') }}"
                   class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('cities.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
