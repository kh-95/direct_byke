<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/contactuses.fields.id').':') !!}
    <p>{{ $contactUs->id }}</p>
</div>

<!-- Phone Number Field -->
<div class="form-group">
    {!! Form::label('phone_number', __('models/contactuses.fields.phone_number').':') !!}
    <p>{{ $contactUs->phone_number }}</p>
</div>

<!-- Snapshat Field -->
<div class="form-group">
    {!! Form::label('snapshat', __('models/contactuses.fields.snapshat').':') !!}
    <p>{{ $contactUs->snapshat }}</p>
</div>

<!-- Youtube Field -->
<div class="form-group">
    {!! Form::label('youtube', __('models/contactuses.fields.youtube').':') !!}
    <p>{{ $contactUs->youtube }}</p>
</div>

<!-- Instagram Field -->
<div class="form-group">
    {!! Form::label('instagram', __('models/contactuses.fields.instagram').':') !!}
    <p>{{ $contactUs->instagram }}</p>
</div>

<!-- Whatsapp Field -->
<div class="form-group">
    {!! Form::label('whatsapp', __('models/contactuses.fields.whatsapp').':') !!}
    <p>{{ $contactUs->whatsapp }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/contactuses.fields.created_at').':') !!}
    <p>{{ $contactUs->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/contactuses.fields.updated_at').':') !!}
    <p>{{ $contactUs->updated_at }}</p>
</div>

