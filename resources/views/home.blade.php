@extends('layouts.app')
@section('title')
    {{trans('validation.home')}}
@endsection
@section('content')
    <style>
        @if(app()->getLocale() == 'ar')
        .text_dir {

            text-align: left !important;
        }

        @else
        .text_dir {
            text-align: right !important;
        }

        @endif
    </style>
    <section class="section">
        <div class="section-header">
            <h1>{{trans('validation.home')}}</h1>
            <div class="section-header-breadcrumb">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h3 class="main-color">
                            {{trans('validation.dashboard_statistics')}}
                        </h3>
                    </div>
                </div>

                
                <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                    <div class="card border-danger statistics-card">
                        <div class="card-body bg-danger text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-clone fa-5x"></i>
                                </div>
                                <div class="col-9 text_dir">
                                <h1><a href="{{ route('clients.index') }}"
                                        </a>
                                        </h1>
                                    <h4>{{trans('validation.clients_active')}}</h4>
                                    <h5>{{$clients_count}}</h5>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                   
                <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                    <div class="card border-danger statistics-card">
                        <div class="card-body bg-danger text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-clone fa-5x"></i>
                                </div>
                                <div class="col-9 text_dir">
                                <h1><a href="{{ route('users.index') }}"
                                        </a>
                                        </h1>
                                    <h4>{{trans('validation.managers_active')}}</h4>
                                    <h5>{{$users_count}}</h5>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection






