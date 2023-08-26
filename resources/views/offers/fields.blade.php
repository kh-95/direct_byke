
<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
    <?php
    $error = 'content_' . $l . '_error'
    ?>
    <div class="form-group col-sm-12 col-lg-12">
        <div class="form-group col-sm-6">
            {!! Form::label('name'. $l , __('models/offers.fields.name_' . $l )) !!}
            {!! Form::text('name_'. $l , null, ['class' => 'form-control']) !!}
        </div>

        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach

<!-- percentage Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('percentage', __('models/offers.fields.percentage')) !!}
        {!! Form::number('percentage', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- start Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('start_at', __('models/offers.fields.start_at')) !!}
        {!! Form::date('start_at', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- end Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('end_at', __('models/offers.fields.end_at')) !!}
        {!! Form::date('end_at', null, ['class' => 'form-control']) !!}
    </div>
</div>




<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('name', __('validation.bikes')) !!}
        <select class="js-example-basic-multiple form-control" name="bike_id[]" multiple="multiple">
            <option value="">Select Bike</option>
            @foreach($bike_types as $bike_type)
                <optgroup label="{{$bike_type->name_en . ' (Bike Type)'}}">
                    @foreach($bike_type->bikes as $bike)
                        @if($bike->offer_id == null)
                            <option value="{{$bike->id}}">{{$bike->name_en}}</option>
                        @endif
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
</div>







<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('offers.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>






@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2(
                {
                    matcher(params, data) {
                        const originalMatcher = $.fn.select2.defaults.defaults.matcher;
                        const result = originalMatcher(params, data);

                        if (
                            result &&
                            data.children &&
                            result.children &&
                            data.children.length
                        ) {
                            if (
                                data.children.length !== result.children.length &&
                                data.text.toLowerCase().includes(params.term.toLowerCase())
                            ) {
                                result.children = data.children;
                            }
                            return result;
                        }

                        return null;
                    },
                    placeholder: "Select a state or Search with bike name or type",
                    allowClear: true
                }
            );
        });
    </script>
@endsection

