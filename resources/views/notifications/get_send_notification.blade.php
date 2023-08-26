@extends('layouts.app')
@section('title')
    @lang('models/notifications.plural')
@endsection
@section('content')

    <section class="section">


        <div class="section-header">
            <h1> @lang('validation.notification_sended')</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('notification.form-notification')}}"
                   class="btn btn-primary form-btn">@lang('validation.send_notification')<i
                        class="fas fa-plus"></i></a>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">


                    <div class="hhhh table-responsive">
                        <table class="table" id="stages-table">

                            @if(count($notifications) > 0)
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{{__('validation.title_notification')}}</th>
                                    <th class="text-center">{{__('validation.content_notification')}}</th>
                                    <th class="text-center">{{__('validation.notifications_date')}}</th>
                                    <th class="text-center">{{__('validation.send_to')}}</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($notifications as $notification)
                                    <tr>
                                        <td class="text-center"> {{$loop->iteration}}</td>
                                        <td class="text-center">
                                            {!! $notification->{'title_' .app()->getLocale() } !!}
                                        </td>
                                        <td class="text-center">
                                            {!! $notification->{'content_' .app()->getLocale() } !!}
                                        </td>
                                        <td class="text-center">
                                            {{Carbon\Carbon::parse($notification->created_at)->format('Y-m-d')}}
                                        </td>
                                        <td class="text-center">
                                            {{$notification->sender_type}}
                                        </td>

                                    </tr>
                                @endforeach



                                @else
                                    <tr>
                                        <td class="text-center">
                                            <h2>@lang('لا يوجد اشعارات')</h2></td>
                                    </tr>
                                @endif

                                </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <div class='row justify-content-center'>
            <div class='col-md-12'>
                @include('stisla-templates::common.paginate', ['records' => $notifications])
            </div>
        </div>
    </section>
@endsection





