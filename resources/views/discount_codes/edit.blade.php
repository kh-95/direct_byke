@extends('layouts.app')
@section('title')
    @lang('validation.edit_discount_code')
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0"> @lang('validation.edit_discount_codes') </h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('discount_codes.index') }}" class="btn btn-primary">رجوع</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($discount_code, ['route' => ['discount_codes.update', $discount_code->id], 'method' => 'patch']) !!}
                                <div class="row">
                                    @include('discount_codes.fields')
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