@extends('layouts.app')
@section('title')
    @lang('crud.details') @lang('models/clients.singular')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('crud.details') @lang('models/clients.singular') </h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('clients.index') }}"
                   class="btn btn-primary form-btn float-right">@lang('crud.back')</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        @include('clients.show_fields')
    </section>
@endsection

