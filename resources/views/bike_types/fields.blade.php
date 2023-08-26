<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
        <?php
        $error = 'content_' . $l . '_error'
        ?>
    <div class="form-group col-sm-6">
        {!! Form::label('name'. $l , __('models/bike_types.fields.name_' . $l ).':') !!}
        {!! Form::text('name_'. $l , null, ['class' => 'form-control']) !!}
        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach



@foreach (config('app.available_locales') as $l)
        <?php
        $error = 'desc_' . $l . '_error'
        ?>
        <div class="form-group col-sm-6">
        {!! Form::label('desc_' . $l , __('models/bike_types.fields.desc_' . $l ).':') !!}
        {!! Form::textarea('desc_' . $l , null,
            ['class' => 'form-control width-100'
            ,  'rows' => 10, 'cols' => 50,
             'style'=>"height: 137px;",
             'id'=>'desc_'.$l
            ]
      ) !!}
        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach


<div class="form-group col-sm-6 d-flex">
    <div class="col-sm-4 col-md-6 pl-0 form-group">
        {!! Form::label('text',__('models/bike_types.fields.image' )) !!}
        <br>
        <label
            class="image__file-upload btn btn-primary text-white"
            tabindex="2"> Choose
            {!! Form::file('image_data', ['class' => 'form-control d-none', 'id' => 'pfImage']) !!}
        </label>
    </div>
    <div class="col-sm-3 preview-image-video-container float-right mt-1">
        @if ($bike_type->image_url)

            <a href="{{ ($bike_type->image_url) }}" data-lightbox="image"
               data-title="{{$bike_type->image_url }}">
                <img id='edit_preview_photo'
                     class="img-thumbnail user-img user-profile-img profilePicture"
                     src="{{($bike_type->image_url)}}"/>
            </a>
        @else
            <img id='edit_preview_photo'
                 class="img-thumbnail user-img user-profile-img profilePicture"
                 src=""/>
        @endif

    </div>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bike_types.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>

