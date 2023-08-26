<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('discount_code' , __('models/discount_codes.fields.discount_code')) !!}
        {!! Form::text('discount_code' , null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('rate_discount_code' , __('models/discount_codes.fields.rate')) !!}
        {!! Form::number('rate_discount_code' , null, ['class' => 'form-control']) !!}
    </div>

</div>

<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('start_at' , __('models/discount_codes.fields.start_at')) !!}
        {!! Form::date('start_at' , null, ['class' => 'form-control']) !!}
    </div>

</div>
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('end_at' , __('models/discount_codes.fields.end_at')) !!}
        {!! Form::date('end_at' , null, ['class' => 'form-control']) !!}
    </div>

</div>




<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('discount_codes.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>

