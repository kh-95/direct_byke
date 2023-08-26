<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
    <div class="form-group">
        {{__('models/cities.fields.name_' . $l ) . ':'}}
        <p>{{ $city['name_'.$l] }}</p>
    </div>
@endforeach

<!-- region Field -->
@foreach (config('app.available_locales') as $l)
    <div class="form-group">
        {{__('models/regions.fields.name_' . $l ) . ':'}}
        <p>{{ $city->region['name_'.$l] }}</p>
    </div>
@endforeach

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $city->is_active === 1 ? 'Active' : "Not Active" }}</p>
</div>