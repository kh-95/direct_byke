<div class="card">
    <div class="card-inner-group">
        <div class="card-inner">
            <div class="user-card user-card-s2 mb-2">
                <div class="user-avatar md">
                    <span><img src="{{asset('assets/img/chat-person.png')}}" class="img-circle"></span>
                </div>
                <div class="user-info">
                    <h3>{{$channel->account->name}}</h3>
                    <span class="sub-text">{{$channel->account->client->name ?? ''}} </span>
                </div>
            </div>

        </div>
        @if($channel->account->client_id)
            <div class="card-inner">
                <div class="aside-wg">
                    <h6 class="overline-title-alt mb-2">بيانات العميل
                        <a class="btn btn-xs btn-primary pull-left" data-toggle="modal"
                           data-target="#myModal">
                            <i class="fa fa-edit"></i>
                        </a>

                    </h6>
                    <ul class="user-contacts">
                        <li><em class="icon fa fa-envelope"></em><span>{{$channel->account->client->email ?? ''}}</span>
                        </li>
                        <li>
                            <em class="icon fa fa-mobile fa-2x"></em><span>{{$channel->account->client->telephone_active ?? ''}}</span>
                        </li>
                        <li>
                            <em><img src="{{asset('assets/img/sudi.jpg')}}" class="icon"></em><span
                                class="country-name">{{$channel->account->client->address ?? ''}}
                                                </span> <span class="city-name"></span>
                        </li>
                    </ul>
                </div>
                @if($tasks->count() > 0)
                    <div class="aside-wg">
                        <h6 class="overline-title-alt mb-2">طلبات الدعم المفتوحه </h6>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class=" text-center">الكود</th>
                                <th class=" text-center">التاريخ</th>
                                <th class=" text-center">الحالة</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tasks as $task)
                                <tr>
                                    <td class=" text-center">{{$task->support_code}}</td>
                                    <td class=" text-center">{{\Carbon\Carbon::parse($task->created_at)->format('y/m/d')}}</td>
                                    <td class="text-success text-center">
                                        {{$task->status}}
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                    </div>

                @else
                    <h3>لا يوجد تاسكات مفتوحة</h3>
                @endif
            </div>

        @else
            <h2>غير مسجل لعميل</h2>
        @endif
    </div>
</div>
