<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Helpers\Traits\images;
use App\Models\Admin;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;
use Hash;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public $model;

    public function __construct()
    {
        // $this->middleware(['can:admins index'])->only('index');
        // $this->middleware(['can:admins show'])->only('show');
        // $this->middleware(['can:admins create'])->only('store');
        // $this->middleware(['can:admins edit'])->only('update');
        // $this->middleware(['can:admins delete'])->only('destroy');

    }

    public function index(Request $request)
    {
        $users = Admin::latest();



        if ($request->keyword) {
            $users = $users->where(function ($q) use ($request) {
                $q->where('fullname', 'like', '%' . $request->keyword . '%');
                $q->orWhere('phone', 'like', '%' . $request->keyword . '%');
                $q->orWhere('email', 'like', '%' . $request->keyword . '%');
                $q->orWhere('is_active', 'like', '%' . $request->keyword . '%');

            });
        }

            $users = $users->paginate(10);

        return view('users.index')
            ->with('users', $users);
    }

    public function create()
    {
        $user = new Admin();
        $roles = Role::pluck('name' , 'id')->all();
        return view('users.create', compact('roles', 'user'));
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = Admin::create($input);
        $user->assignRole($request->input('role_name'));

        $file = new images();
        $destinationPath = "storage/users/";
        $file->images($request, $destinationPath, $user);
        Flash::success('User saved successfully.');
        return redirect(route('users.index'));
    }

    public function show($id)
    {
        $user = Admin::find($id);
        dd($user->getAllPermissions());
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        return view('users.show')->with('user', $user);
    }

    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::pluck('name', 'id')->all();

        $userRole = $user->roles->pluck('id', 'id')->all();
        $permissions = Permission::selectRaw('category,display_name,name')->get();

        $userPermission = $user->getAllPermissions();
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        return view('users.edit',
            compact('roles', 'userRole', 'permissions', 'userPermission'))->with('user', $user);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = Admin::find($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user->fill($input);
        $user->save();
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('role_name'));

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $user = Admin::find($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        $user->delete();
        Flash::success('User deleted successfully.');
        return redirect(route('users.index'));
    }


    public function changeStatusAdmin(Request $request)
    {
        $user = Admin::find($request->user_id);
        $user->is_active = $request->status;
        $user->save();
        if ($request->status == 1) {
            return response()->json(['success' => 'Status change successfully to active.']);
        } else {
            return response()->json(['success' => 'Status change successfully to in active .']);
        }
    }
}
