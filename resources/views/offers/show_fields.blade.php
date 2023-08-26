<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
    <div class="form-group">
        {{__('models/offers.fields.name_' . $l ) . ':'}}
        <p>{{ $offer['name_'.$l] }}</p>
    </div>
@endforeach

<!-- precentage Field -->
<div class="form-group">
    {{__('models/offers.fields.percentage') . ':'}}
    <p>{{ $offer->percentage }}</p>
</div>

<!-- start Field -->
<div class="form-group">
    {{__('models/offers.fields.start_at') . ':'}}
    <p>{{ $offer->start_at }}</p>
</div>

<!-- end Field -->
<div class="form-group">
    {{__('models/offers.fields.end_at') . ':'}}
    <p>{{ $offer->end_at }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $offer->is_active === 1 ? 'Active' : "Not Active" }}</p>
</div>

<!-- created_at Field -->
<div class="form-group">
    {{__('models/offers.fields.created_at') . ':'}}
    <p>{{ $offer->created_at }}</p>
</div>

<hr>

<!-- Add New Duration Field -->
<div class="form-group w-75">
    {{__('models/offers.fields.new_bike' ) . ':'}}
    {!! Form::open(['route' => 'offers.addBike']) !!}
    {!! Form::hidden('offer_id', $offer->id) !!}
    <div class="form-group col-sm-12 col-lg-12">
        <div class="form-group col-sm-6">
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
    {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}
</div>
<hr>

@foreach($offer->bikes as $bike)
    <div style="gap: 30px" class="form-group w-50 d-flex align-items-center">
        <div>
            {{__('models/bikes.fields.name_ar' ) . ':'}}
            <p>{{ $bike->name_ar }}</p>
        </div>
        <div>
            {{__('models/bikes.fields.name_en' ) . ':'}}
            <p>{{ $bike->name_en }}</p>
        </div>
        <div>
            {{__('models/bike_types.fields.name_ar' ) . ':'}}
            <p>{{ $bike->BikeType->name_ar }}</p>
        </div>
        <div>
            {{__('models/bike_types.fields.name_en' ) . ':'}}
            <p>{{ $bike->BikeType->name_en }}</p>
        </div>
        {!! Form::open(['route' => ['offers.removeBike'], 'method' => 'post']) !!}
        <div class='btn-group'>
            <div class='btn-group'>
                {!! Form::hidden('bike_id', $bike->id) !!}
                {!! Form::hidden('offer_id', $offer->id) !!}
                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this Duration ?")']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <hr>
@endforeach



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
                    placeholder: "Select a Bike or Search with bike name or type",
                    allowClear: true
                }
            );
        });
    </script>
@endsection
