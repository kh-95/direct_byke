<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/termsConditions.fields.id').':') !!}
    <p>{{ $termsConditions->id }}</p>
</div>

<!-- Content Ar Field -->
<div class="form-group">
    {!! Form::label('content_ar', __('models/termsConditions.fields.content_ar').':') !!}
    <p>{{ $termsConditions->content_ar }}</p>
</div>

<!-- Content En Field -->
<div class="form-group">
    {!! Form::label('content_en', __('models/termsConditions.fields.content_en').':') !!}
    <p>{{ $termsConditions->content_en }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/termsConditions.fields.created_at').':') !!}
    <p>{{ $termsConditions->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/termsConditions.fields.updated_at').':') !!}
    <p>{{ $termsConditions->updated_at }}</p>
</div>

