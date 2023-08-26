<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('fullname' , __('validation.name').':') !!}
        {!! Form::text('fullname' , null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('email' , __('validation.email_').':') !!}
        {!! Form::text('email' , null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Phone Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('phone' , __('validation.phone').':') !!}
        {!! Form::text('phone' , null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group col-sm-6" id="form">
    {!! Form::label('text',__('validation.image')) !!}
    <!-- <div style="display: none;"> -->
        <input type="file"  name="image_data" />
    <!-- </div> -->
</div>


<!-- Password Field -->
<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('password' , __('validation.password_').':') !!}
        {!! Form::password('password' , ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('validation.password_confirmation')) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
    <div class="form-group col-sm-6">
        {!! Form::label('name', __('validation.roles')) !!}
        <select class="js-example-basic-multiple form-control" name="role_name">
            <option value="">Select Role Name</option>
            @foreach($roles as $role)
                @if (isset($selected_role) && $selected_role == $role)
                    <option selected value="{{$role}}">{{$role}}</option>
                @else
                    <option value="{{$role}}">{{$role}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">{{__('crud.cancel')}}</a>
</div>


