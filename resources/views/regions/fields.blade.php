<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
        <?php
        $error = 'content_' . $l . '_error'
        ?>
    <div class="form-group col-sm-6">
        {!! Form::label('name'. $l , __('models/regions.fields.name_' . $l ).':') !!}
        {!! Form::text('name_'. $l , null, ['class' => 'form-control']) !!}

        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach

<div class="form-group col-sm-6">
    {!! Form::label('lat', __('models/regions.fields.lat')) !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('lon', __('models/regions.fields.lon')) !!}
    {!! Form::text('lon', null, ['class' => 'form-control']) !!}
</div>

{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('radius', __('models/regions.fields.radius')) !!}--}}
{{--    {!! Form::text('radius', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('regions.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>

