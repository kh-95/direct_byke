<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('validation.edit_profile')}}</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>

            <form method="POST" action="{{route('updateProfile')}}" id="editProfileForm" enctype="multipart/form-data">
                <div class="alert alert-info">
                    Note: This is just UI. you need to develop Backend for update
                </div>




                <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="alert alert-danger d-none" id="editProfileValidationErrorsBox"></div>
                    <input type="hidden" name="user_id" id="pfUserId">
                    <input type="hidden" name="is_active" value="1">
                    {{csrf_field()}}



                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{trans('models/employees.fields.first_name')}}:</label><span class="required">*</span>
                            <input type="text" name="fullname" id="fullname" value="{{$user->fullname ?? ''}}" class="form-control" required autofocus tabindex="1">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{trans('models/employees.fields.email')}}:</label><span class="required">*</span>
                            <input type="text" name="email" id="pfEmail" value="{{$user->email ?? ''}}" class="form-control" required tabindex="3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{trans('models/employees.fields.phone_number')}}:</label><span class="required">*</span>
                            <input type="text" name="phone" id="pfphone" value="{{$user->phone ?? ''}}" class="form-control" required autofocus tabindex="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2">
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="control-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}" name="password_confirmation" tabindex="2">
                        <div class="invalid-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="btnPrEditSave"
                                data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                            {{trans('crud.save')}}
                        </button>
                        <button type="button" class="btn btn-light ml-1" data-dismiss="modal">
                            {{trans('crud.cancel')}}
                        </button>
                    </div>
                </div>
            </form>
            {!! Form::close() !!}
        </div>
    </div>
</div>