<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use DataTables;
use Illuminate\Support\Facades\DB;

class UserAccess extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request->ajax()) {
            $data = Role::whereNotNull('name')->orderBy('id', 'asc');
            return DataTables::eloquent($data)
            ->addColumn('action', function($row){
                $btn = '<button title="Add Permission" class="addPermission bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                <i class="fas fa-solid fa-plus"></i>
              </button>
              <button title="List Permission" class="listPermission bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
              <i class="fas fa-solid fa-list"></i>
              </button>
              ';
                return $btn;
            })->toJson();
        }
        return view('user_access.user_access');
    }
    public function get_data_role_user(Request $request){
        if($request->ajax()) {
            $data = DB::table('model_has_roles')->select('roles.name as roles_name','users.id as user_id', 'users.name as user_name')
                    ->join('users', 'users.id','=', 'model_has_roles.model_id')
                    ->join('roles','roles.id','=', 'model_has_roles.role_id');
            return DataTables::queryBuilder($data)
            ->addColumn('action', function($row){
                $btn = '<button title="Detail" class="editRole bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->user_id.'">
                <i class="fas fa-solid fa-eye"></i>
              </button>
              ';
                return $btn;
            })->toJson();
        }
    }
    public function get_username(Request $request){
        $data = User::all();
        $role = Role::all();
        return response()->json([
            'role'=>$role,
            'data'=>$data,
        ]);
    }
    public function add_roles_user(Request $request){
        $role_id =$request->role_id;   
        $user_id =$request->user_id;   
        $status =500;
        $message ='';
        // Validasi, jika data sudah ada. Maka tidak akan di simpan
        $validasi_1 = ModelHasRole::where('model_id',$user_id)->count();
        if($validasi_1 == 1){
            $status =422;
            $message ='User sudah terdaftar';
        }else{
            $role_name = Role::where('id', $role_id)->get();
            $user = User::find($user_id);
           $user->assignRole($role_name[0]->name);

                $status =200;
                $message ='Data berhasil disimpan';
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);
    }
    public function get_permisssion(Request $request){
       $permission_innactive =  Permission::select(DB::raw('id,name,"0" as is_active'))
                                            ->whereNotIn('id',DB::table('role_has_permissions')
                                            ->select('permission_id')
                                            ->where('role_id',$request->id))
                                            ->get();
       $permission_active = DB::table('permissions')
                                ->select('*')
                                ->join('role_has_permissions', 'role_has_permissions.permission_id','=','permissions.id')
                                ->where('role_id',$request->id)
                                ->get();
        return response()->json([
            'permission_innactive'=>$permission_innactive,
            'permission_active'=>$permission_active,
        ]);
    }
    public function add_role_permission(Request $request){
        $permission = $request->checkArray;
        $role_id = $request->role_id_permission;
      
        $status =500;
        $message ='';
        $role = Role::find($role_id);
        $role->givePermissionTo($permission);
        // $role->syncPermissions($permission);

        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);
    }
    public function delete_role_permission(Request $request){
        $permission = $request->checkArray;
        $role_id = $request->role_id_permission;
      
        $status =500;
        $message ='';
       
        foreach($permission as $row){
            $role_permission = DB::table('role_has_permissions')->where('permission_id',$row)->where('role_id',$role_id)->delete();
            if($role_permission){
                $message="Data berhasil dihapus";
                $status=200;
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);
    }
    public function detail_role_user(Request $request)
    {
        $user_id = $request->id;
        $detail = DB::table('model_has_roles')->select('model_has_roles.*','roles.name as roles_name', 'users.name as user_name')->join('users', 'users.id','=','model_has_roles.model_id')->join('roles', 'roles.id', 'model_has_roles.role_id')->where('users.id', $user_id)->get();
        $role =Role::all();
        return response()->json([
            'detail'=>$detail,
            'role'=>$role,
        ]);
    }
    public function update_roles_user(Request $request){
        $role_id =$request->role_id;   
        $user_id =$request->user_id;   
        $status =500;
        $message ='';
        $role_name = Role::where('id', $role_id)->get();
        $delete = DB::table('model_has_roles')->where('model_id', $user_id)->delete();
        if($delete){
            $user = User::find($user_id);
            $user->assignRole($role_name[0]->name);
            $status =200;
            $message ='Data berhasil disimpan';
        }
        
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);
    }
}
