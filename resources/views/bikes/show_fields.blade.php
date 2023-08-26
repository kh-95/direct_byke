<div class="section-body">
    <div class="card">
        <div class="card-body">

            <div class="hhhh table-responsive">
                <table class="table client">
                    <tbody style="font-weight: bold;">
                    <tr>
                        @foreach (config('app.available_locales') as $l)
                            <td>
                                {{ __('models/bikes.fields.name_' . $l) }} : &nbsp; &nbsp; &nbsp;
                                {{ optional($bike)->{'name_' .$l} }}
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>
                            {{ __('models/bikes.fields.bike_type_name') }} : &nbsp; &nbsp; &nbsp;
                            {{ $bike->BikeType->{'name_' . app()->getLocale()} }}
                        </td>
                    </tr>

                    <tr>


                        <td>
                            {{__('models/bikes.fields.QR_code')}} : &nbsp; &nbsp; &nbsp;
                            <img style="width: 80px" src="{{asset('/storage/QR/'.$bike->QR_code)}} ">
                        </td>

                        <td width="50%">
                            {{ __('models/bikes.fields.bike_image') }} : &nbsp; &nbsp; &nbsp;
                            <a href="{{ ($bike->image_url) }}" target="_blank"
                               data-title="{{$bike->image_url }}">
                                <img id='edit_preview_photo'
                                     class="img-thumbnail user-img user-profile-img profilePicture"
                                     src="{{($bike->image_url)}}" width="20%"/>
                            </a>
                        </td>
                    </tr>


                    @if(sizeof($bike->durations) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 10px">#</th>
                                    <th class="text-center"
                                        style="width: 10px">{{__('models/bikes.fields.duration')}}</th>
                                    <th class="text-center"
                                        style="width: 10px">{{__('models/bikes.fields.price_of_duration')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($bike->durations as $bike_duration)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$bike_duration->duration}}</td>
                                        <td class="text-center">{{$bike_duration->price_of_duration  }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>





