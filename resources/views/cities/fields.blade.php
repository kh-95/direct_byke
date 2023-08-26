@foreach (config('app.available_locales') as $l)
        <?php
        $error = 'content_' . $l . '_error'
        ?>
    <div class="form-group col-sm-6">
        {!! Form::label('name'. $l , __('models/cities.fields.name_' . $l ).':') !!}
        {!! Form::text('name_'. $l , null, ['class' => 'form-control']) !!}
        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach


<div class="form-group col-sm-6">
    {!! Form::label('name', __('validation.regions')) !!}
    {!! Form::select('region_id' , $regions->pluck('name_'.app()->getLocale(),'id')->toArray(),
            $city->region_id  ,[
            'placeholder' => __('models/bikes.fields.choose' ),
           'class' => 'form-control ',
        ]) !!}
</div>

<div class="form-group col-sm-6">
</div>


<div class="form-group col-sm-6">
    {!! Form::label('lat', __('models/regions.fields.lat')) !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('lon', __('models/regions.fields.lon')) !!}
    {!! Form::text('lon', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cities.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>


