@extends('layouts.app')
@section('title')
    @lang('validation.edit_offer')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0"> @lang('validation.edit_offer') </h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('offers.index') }}" class="btn btn-primary">رجوع</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($offer, ['route' => ['offers.update', $offer->id], 'method' => 'patch']) !!}
                                <div class="row">
                                    @include('offers.edit_fields')
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
