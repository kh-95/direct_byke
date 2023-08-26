<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/whouses.fields.id').':') !!}
    <p>{{ $whoUs->id }}</p>
</div>

<!-- Content Ar Field -->
<div class="form-group">
    {!! Form::label('content_ar', __('models/whouses.fields.content_ar').':') !!}
    <p>{{ $whoUs->content_ar }}</p>
</div>

<!-- Content En Field -->
<div class="form-group">
    {!! Form::label('content_en', __('models/whouses.fields.content_en').':') !!}
    <p>{{ $whoUs->content_en }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/whouses.fields.created_at').':') !!}
    <p>{{ $whoUs->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/whouses.fields.updated_at').':') !!}
    <p>{{ $whoUs->updated_at }}</p>
</div>

