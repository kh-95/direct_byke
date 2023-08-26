<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
        <?php
        $error = 'content_' . $l . '_error'
        ?>
    <div class="form-group col-sm-6 col-lg-6">
        {!! Form::label('name'. $l , __('models/bikes.fields.name_' . $l ).':') !!}
        {!! Form::text('name_'. $l , null, ['class' => 'form-control']) !!}

        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach


<div class="form-group col-sm-6">
    {!! Form::label('name', __('validation.bike_types')) !!}
    {!! Form::select('bike_type_id' , $bike_types->pluck('name_'.app()->getLocale(),'id')->toArray(),
            $bike->bike_type_id  ,[
            'placeholder' => __('models/bikes.fields.choose' ),
           'class' => 'form-control ',
        ]) !!}
</div>


<div class="form-group col-sm-6 d-flex">
    <div class="col-sm-4 col-md-6 pl-0 form-group">
        {!! Form::label('text',__('models/bikes.fields.bike_image' )) !!}
        <br>
        <label
            class="image__file-upload btn btn-primary text-white"
            tabindex="2"> Choose
            {!! Form::file('image_data', ['class' => 'form-control d-none', 'id' => 'pfImage']) !!}

        </label>
    </div>
    <div class="col-sm-3 preview-image-video-container float-right mt-1">
        @if ($bike->image_url)

            <a href="{{ ($bike->image_url) }}" data-lightbox="image"
               data-title="{{$bike->image_url }}">
                <img id='edit_preview_photo'
                     class="img-thumbnail user-img user-profile-img profilePicture"
                     src="{{($bike->image_url)}}"/>
            </a>
        @else
            <img id='edit_preview_photo'
                 class="img-thumbnail user-img user-profile-img profilePicture"
                 src=""/>
        @endif

    </div>

</div>

<div class="form-group col-sm-6">
    {{__('models/bikes.fields.duration' )}}

    <div>
        <button type="button"
                class="addDuartion form-control btn-primary">{{__('models/bikes.fields.add_another_duration')}}</button>
        <br>
        @if(sizeof($bike->durations) > 0)
            @foreach ($bike->durations as $bike_duration)
                <div>
                    <input placeholder=" {{__('models/bikes.fields.duration')}}" type="text" name="durations[]"
                           value="{{$bike_duration->duration }}"
                           class="form-control">
                </div>
                <br>
            @endforeach
        @else
            <input placeholder=" {{__('models/bikes.fields.duration')}}" type="text" name="durations[]" value=""
                   class="form-control">
            <br>
        @endif

    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bikes.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>

@section('scripts')

    <script>
        $(document).on('click', '.addDuartion', function () {
            var html = '<div><input placeholder="{{__('models/bikes.fields.duration')}}" type="tex1" name="durations[]" class="form-control">' + '</div> <br>';
            $(this).parent().append(html);
        });
    </script>

@endsection

