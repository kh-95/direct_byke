<div class="section-body">
    <div class="card">
        <div class="card-body">

            <div class="hhhh table-responsive">
                <table class="table client">
                    <tbody style="font-weight: bold;">
                    <tr>
                        @foreach (config('app.available_locales') as $l)
                            <td>
                                {{ __('models/bike_types.fields.name_' . $l) }} : &nbsp; &nbsp; &nbsp;
                                {{ optional($bike_type)->{'name_' .$l} }}
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        @foreach (config('app.available_locales') as $l)
                            <td>
                                {{ __('models/bike_types.fields.name_' . $l) }} : &nbsp; &nbsp; &nbsp;
                                {{ optional($bike_type)->{'desc_' .$l} }}
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td width="50%">
                            {{ __('models/bike_types.fields.image_data') }} : &nbsp; &nbsp; &nbsp;
                            <a href="{{ ($bike_type->image_url) }}" target="_blank"
                               data-title="{{$bike_type->image_url }}">
                                <img id='edit_preview_photo'
                                     class="img-thumbnail user-img user-profile-img profilePicture"
                                     src="{{($bike_type->image_url)}}" width="20%"/>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

