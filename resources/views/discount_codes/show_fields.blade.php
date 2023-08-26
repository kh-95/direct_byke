<!-- Name Field -->
<div class="form-group">
    {{__('models/discount_codes.fields.discount_code') . ':'}}
    <p>{{ $discount_code->discount_code }}</p>
</div>

<!-- rate Field -->
<div class="form-group">
    {{__('models/discount_codes.fields.rate') . ':'}}
    <p>{{ $discount_code->rate_discount_code }}</p>
</div>

<!-- start_at Field -->
<div class="form-group">
    {{__('models/discount_codes.fields.start_at') . ':'}}
    <p>{{ $discount_code->start_at }}</p>
</div>

<!-- end_at Field -->
<div class="form-group">
    {{__('models/discount_codes.fields.end_at') . ':'}}
    <p>{{ $discount_code->end_at }}</p>
</div>

<!-- number_usage Field -->
<div class="form-group">
    {{__('models/discount_codes.fields.number_usage') . ':'}}
    <p>{{ $discount_code->number_usage }}</p>
</div>

<!-- status Field -->
<div class="form-group">
    {{__('models/discount_codes.fields.status') . ':'}}
    <p>{{ $discount_code->is_active ? 'Active' : 'Not Active' }}</p>
</div>

<!-- created_at Field -->
<div class="form-group">
    {{__('models/discount_codes.fields.created_at') . ':'}}
    <p>{{ $discount_code->created_at }}</p>
</div>
