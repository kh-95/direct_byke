<!-- User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_name', __('models/clients.fields.user_name').'  : ') !!}
    {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', __('models/clients.fields.phone_number').'  : ') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>


<!-- User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_iso', __('models/clients.fields.phone_iso').'  : ') !!}
    {!! Form::text('phone_iso', "SA", ['class' => 'form-control' , 'readonly' => 'readonly']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_dial', __('models/clients.fields.phone_dial').'  : ') !!}
    {!! Form::text('phone_dial', "+966", ['class' => 'form-control' , 'readonly' => 'readonly']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('region_id', __('models/cities.fields.region_id').'  : ') !!}
    {!! Form::select('region_id' , $regions->pluck('name_'.app()->getLocale(),'id')->toArray(),
            $client->region_id
        ,[
            'placeholder' => 'اختر منطقة',
           'class' => 'form-control ',
           'id' => 'region'
        ]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/establishments.fields.city_id').'  : ') !!}
    <select id="city" name="city_id" class="form-control project-input"
            placeholer=" __('models/establishments.fields.select')">
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('zone_id', __('models/establishments.fields.zone_id').' : ') !!}
    <select id="zone" name="zone_id" class="form-control project-input"
            placeholer=" __('models/establishments.fields.select')">
    </select>
</div>


<!-- Enabled Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enabled', __('models/coupons.fields.enabled').'  : ') !!}
    {!! Form::select('enabled',[
               '1' => __('models/coupons.fields.yes'),
               '0' => __('models/coupons.fields.no'),
           ],null,[
                'placeholder'  => __('models/coupons.fields.select'),
               'class' =>'form-control'
           ]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/clients.fields.password').'  : ') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', __('models/clients.fields.password_confirmation').'  : ') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('clients.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>





