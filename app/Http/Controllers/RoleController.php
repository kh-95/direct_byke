<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use \Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Role();
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role;
        $permissions = Permission::selectRaw('category,display_name,name')->groupBy('category')->get();
        return view('role.create', compact('permissions', 'role'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ];
        $messages = ([
            'name.required' => 'يرجي ادخال اسم الصلاحيه بالعربية',
            'permission.required' => 'يرجي ادخال نوع الصلاحيه',
        ]);
        $this->validate($request, $rules, $messages);
        $role = Role::create([
            'name' => $request->name,
            'is_active' => '1',
        ]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'تم اضافه الصلاحيه بنجاح');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::selectRaw('category,display_name,name')->groupBy('category')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        DB::table('roles')->where('id', $id)->update([
            'name' => $request->name,

        ]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'تم تعديل الصلاحيه بنجاح');
    }

    public function destroy($id)
    {
        $role = $this->model->find($id);
        if ($role->users()->count()) {
            Flash::error(__('لا يمكن الحذف .. يوجد مستخدمين مرتبطة به'));
            return back();
        }
        $role->delete();
        Flash::success('تم حذف الصلاحيه بنجاح ');
        return back();

    }


    public function show($id)
    {

        $role = Role::find($id);
        return view('role.show' )->with('role', $role);
    }



    public function changeStatusRole(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->is_active = $request->status;
        $role->save();
        if ($request->status == 1) {
            return response()->json(['success' => 'Status change successfully to active.']);
        } else {
            return response()->json(['success' => 'Status change successfully to in active .']);
        }
    }
}
