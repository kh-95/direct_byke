
        <?php
        $error = 'name' . '_error'
        ?>
    <div class="form-group col-sm-6">
        {!! Form::label('name' , __('models/roles.fields.name'  ).':') !!}
        {!! Form::text('name' , null, ['class' => 'form-control','id'=>'name_']) !!}
        <span style="color:red;" id={{$error}}></span>
    </div>



<div class="row">
    <div class="col-lg-12">

        <div class="form-group">
            <h2>
                <label>      @lang('models/roles.plural')
                </label>
                <br>
            </h2>
            @inject('permissionModel','Spatie\Permission\Models\Permission')
            <div class="row">
                @foreach ($permissions as $value)
                        <?php
                        $permissions = $permissionModel->where('category', $value->category)->pluck('id')->toarray();
                        $role_has_permissions = \DB::table("role_has_permissions")->whereIn('permission_id', $permissions)
                            ->where('role_id', $role->id)
                            ->pluck('permission_id')->toArray();
                        $checked = 0;
                        if (isset($role) && $role->id != null) {
                            if ($role_has_permissions) {
                                if (sizeof($permissions) == sizeof($role_has_permissions)) {
                                    $checked = 1;
                                }
                            }
                        }
                        ?>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                {{ __( 'validation.' .''. $value->name) }}
                                <label class="custom-check pull-right"
                                       for="{{ str_replace(' ', '_', __($value->category)) }}">
                                    <input type="checkbox" class="selectSameGroup"
                                           id="{{ str_replace(' ', '_', __($value->category)) }}"
                                           value="" {{ ($checked == 1 ? 'checked' : '')}}>
                                    <span class="checkmark"></span>
                                    {{ __( 'validation.select_all') }}
                                </label>
                            </div>
                            <div class="panel-body">
                                @foreach ($permissionModel->where('category', $value->category)->get() as $value)
                                    <div class="col-md-6">
                                        <label class="custom-check">
                                            {!! Form::checkbox('permission[]', $value->id,
                                             $role->hasPermissionTo($value->name) ? true : false,
                                             ['class' => str_replace(' ', '_', __($value->category))]) !!}
                                            <span class="checkmark"></span>

                                            {{ __( 'validation.' .''. $value->name) }}
                                        </label>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('roles.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>


@section('scripts')
    <script>
        $(".selectSameGroup").click(function () {
            let group = $(this).attr('id');
            $('.' + group).prop('checked', $(this).prop('checked'));
        });
    </script>

    <script>
        $(document).ready(function () {
            onlyForLanguage('#name_ar', 'ar', 'برجاء الكتابة باللغة العربية فقط');
            onlyForLanguage('#name_en', 'en', 'Only English, Please.');
        });
    </script>

@endsection
