
<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
    <?php
    $error = 'content_' . $l . '_error'
    ?>
    <div class="form-group col-sm-12 col-lg-12">
        <div class="form-group col-sm-6">
            {!! Form::label('name'. $l , __('models/offers.fields.name_' . $l )) !!}
            {!! Form::text('name_'. $l , null, ['class' => 'form-control']) !!}
        </div>

        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach

<!-- percentage Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('percentage', __('models/offers.fields.percentage')) !!}
        {!! Form::number('percentage', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- start Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('start_at', __('models/offers.fields.start_at')) !!}
        {!! Form::date('start_at', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- end Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('end_at', __('models/offers.fields.end_at')) !!}
        {!! Form::date('end_at', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('offers.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>


