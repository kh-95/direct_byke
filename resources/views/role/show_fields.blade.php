<!-- Name Field -->
<div class="form-group">
    {{__('models/roles.fields.name') . ':'}}
    <p>{{ $role->name }}</p>
</div>

<!-- Guard Name Field -->
<div class="form-group">
    {{__('models/roles.fields.guard') . ':'}}
    <p>{{ $role->guard_name }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $role->is_active === 1 ? 'Active' : "Not Active" }}</p>
    <hr>
</div>

<!-- Permissions -->
@foreach($role->permissions as $permission)
    <div style="gap: 30px" class="form-group w-50 d-flex align-items-center">
        <div>
            {{__('models/roles.fields.permission' ) . ':'}}
            <p>{{ $permission->name }}</p>
        </div>
        <div>
            {{__('models/roles.fields.category' ) . ':'}}
            <p>{{ $permission->category }}</p>
        </div>
        <div>
            {{__('models/roles.fields.routes' ) . ':'}}
            <p>{{ $permission->routes }}</p>
        </div>

    </div>
    <hr>
@endforeach


