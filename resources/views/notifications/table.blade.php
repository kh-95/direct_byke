<div class="hhhh table-responsive">
    <table class="table" id="stages-table">

        @if(count($notifications) > 0)
            <thead>
            <tr>
                <th class="text-center">#</th>

                @foreach (config('app.available_locales') as $l)
                <th class=" text-center"> {{__('validation.notification_title_' . $l )}}</th>
            @endforeach
            @foreach (config('app.available_locales') as $l)
                <th class=" text-center"> {{__('validation.notification_content_' . $l )}}</th>
            @endforeach
                
                <th class="text-center">{{__('validation.notifications_date')}}</th>
                <th class="text-center">{{__('validation.notifications_sendto')}}</th>
                <th class=" text-center" colspan="5">@lang('crud.action')</th>
            </tr>
            </thead>
            <tbody>


            @foreach($notifications as $notification)

           

                <tr>
                    <td class="text-center"> {{$loop->iteration}}</td>
                    <td class="text-center">
                        {{$notification->title_en}}
                        </td>

                        <td class="text-center">
                        {{$notification->title_ar}}
                    </td>

                    <td class="text-center">
                        {{$notification->content_en}}
                        </td>

                        <td class="text-center">
                        {{$notification->content_ar}}
                    </td>



                    <td class="text-center">
                        {{Carbon\Carbon::parse($notification->created_at)->format('Y-m-d')}}
                    </td>


                    <td class="text-center">
                        {{$notification->sender_type}}
                    </td>

                    <td class="text-center">
                        <a href="{!! route('notifications.show',[$notification->id]) !!}"
                           class='btn action-btn show_session'
                           style="color: #ffffff; background-color: #1e2d99" id="Session_Stage">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>

                </tr>
            @endforeach



            @else
                <tr>
                    <td class="text-center">
                        <h2>@lang('validation.no_found_notifications')</h2></td>
                </tr>
            @endif

            </tbody>
    </table>
</div>

