@extends('layouts.app')
@section('title')
    @lang('validation.details_offer')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Region Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('offers.index') }}"
                   class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('offers.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
