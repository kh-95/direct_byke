<!-- Price Per Minute Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price_per_minute', __('models/general_settings.fields.price_per_minute').':') !!}
    {!! Form::number('price_per_minute', null, ['class' => 'form-control']) !!}
</div>




<!-- VAT Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vat', __('models/general_settings.fields.vat').':') !!}
    {!! Form::number('vat', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax', __('models/general_settings.fields.tax').':') !!}
    {!! Form::number('tax', null, ['class' => 'form-control']) !!}
</div>



<!-- Pre End Warning Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pre_end_warning', __('models/general_settings.fields.pre_end_warning').':') !!}
    {!! Form::number('pre_end_warning', null, ['class' => 'form-control']) !!}
</div>





    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    </div>

