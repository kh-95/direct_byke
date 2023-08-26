<!-- New Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', __('models/contactuses.fields.phone_number').':') !!}
    {!! Form::text('new_phone', null, ['class' => 'form-control']) !!}
</div>




<!-- Snapshat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('snapshat', __('models/contactuses.fields.snapshat').':') !!}
    {!! Form::text('snap_link', null, ['class' => 'form-control']) !!}
</div>



<!-- Instagram Field -->
<div class="form-group col-sm-6">
    {!! Form::label('instagram', __('models/contactuses.fields.instagram').':') !!}
    {!! Form::text('insta_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Whatsapp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('whatsapp', __('models/contactuses.fields.whatsapp').':') !!}
    {!! Form::text('whatsapp', null, ['class' => 'form-control']) !!}
</div>


<!-- Whatsapp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facebook', __('models/contactuses.fields.facebook').':') !!}
    {!! Form::text('facebook_link', null, ['class' => 'form-control']) !!}
</div>



    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    </div>

