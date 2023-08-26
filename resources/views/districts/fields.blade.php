<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
    <?php
    $error = 'content_' . $l . '_error'
    ?>
        <div class="form-group col-sm-6">
            {!! Form::label('name'. $l , __('models/districts.fields.name_' . $l ).':') !!}
            {!! Form::text('name_'. $l , null, ['class' => 'form-control']) !!}
        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach



{{--<div class="form-group col-sm-12 col-lg-12">--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        {!! Form::label('name', __('validation.cities')) !!}--}}
{{--        <select class="js-example-basic-multiple form-control" name="city_id">--}}
{{--            <option value="">Select City</option>--}}
{{--            @foreach($regions as $region)--}}
{{--                <optgroup label="{{$region->name_en . ' (Regions)'}}">--}}
{{--                    @foreach($region->cities as $city)--}}
{{--                        @if (isset($district) && $district->city->id == $city->id)--}}
{{--                            <option selected value="{{$city->id}}">{{$city->name_en}}</option>--}}
{{--                        @else--}}
{{--                            <option value="{{$city->id}}">{{$city->name_en}}</option>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </optgroup>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
{{--</div>--}}


<div class="form-group col-sm-6">
    {!! Form::label('region_id', __('models/cities.fields.region_id').':') !!}
    {!! Form::select('region_id' , $regions->pluck('name_'.app()->getLocale(),'id')->toArray(),
           !empty(request()->input('region_id')) ? request()->input('region_id') : $district->city->region_id
        ,[
            'placeholder' => __('validation.select'),
           'class' => 'form-control ',
           'id' => 'region'
        ]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/establishments.fields.city_id').':') !!}
    <select id="city" name="city_id" class="form-control project-input"
            placeholer=" __('models/establishments.fields.select')">
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('lat', __('models/regions.fields.lat')) !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('lon', __('models/regions.fields.lon')) !!}
    {!! Form::text('lon', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('districts.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>



@section('scripts')

    <script>
        $(document).ready(function () {
            $(document).find('#region').change();
        });
        $(document).on('change', '#region', function () {
            var regionID = $(this).val();
            if (regionID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-city-list')}}?region_id=" + regionID,
                    success: function (res) {
                        if (res) {
                            var selected_city = '{{ $district->city_id ?? '' }}';
                            selected_city = Number(selected_city);
                            console.log({selected_city})

                            $("#city").empty();
                            $("#city").append('<option>Select</option>');
                            $.each(res, function (key, value) {
                                var is_selected = '';
                                console.log({value})
                                console.log(value == selected_city)
                                if (value.id == selected_city) {
                                    is_selected = 'selected';
                                }
                                $("#city").append('<option value="' + value.id + '"' + is_selected + '>' + value.{{'name_' .app()->getLocale() }} + '</option>');

                            });
                        } else {
                            $("#city").empty();
                        }
                    }, complete: function () {
                        $(document).find('#city').change();
                    }
                });
            } else {
                $("#city").empty();
            }
        });
    </script>


@endsection

{{--@section('scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.js-example-basic-multiple').select2(--}}
{{--                {--}}
{{--                    matcher(params, data) {--}}
{{--                        const originalMatcher = $.fn.select2.defaults.defaults.matcher;--}}
{{--                        const result = originalMatcher(params, data);--}}

{{--                        if (--}}
{{--                            result &&--}}
{{--                            data.children &&--}}
{{--                            result.children &&--}}
{{--                            data.children.length--}}
{{--                        ) {--}}
{{--                            if (--}}
{{--                                data.children.length !== result.children.length &&--}}
{{--                                data.text.toLowerCase().includes(params.term.toLowerCase())--}}
{{--                            ) {--}}
{{--                                result.children = data.children;--}}
{{--                            }--}}
{{--                            return result;--}}
{{--                        }--}}

{{--                        return null;--}}
{{--                    },--}}
{{--                    placeholder: "Select a City or Search with City name or Region",--}}
{{--                    allowClear: true--}}
{{--                }--}}
{{--            );--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}

