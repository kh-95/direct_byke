<!-- Name Field -->

@foreach (config('app.available_locales') as $l)
    <div class="form-group">
        {{__('models/regions.fields.name_' . $l ) . ':'}}
        <p>{{ $region['name_'.$l] }}</p>
    </div>
@endforeach

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $region->is_active === 1 ? 'Active' : "Not Active" }}</p>
</div>