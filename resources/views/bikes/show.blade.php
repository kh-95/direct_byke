@extends('layouts.app')
@section('title')
    @lang('validation.details_bike')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('validation.details_bike')</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('bikes.index') }}"
                   class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('bikes.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
