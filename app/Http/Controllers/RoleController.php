<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
   public function index(Request $request){
    if($request->ajax()) {
        $data = Role::whereNotNull('name');
        return DataTables::eloquent($data)
        ->addColumn('action', function($row){
            $btn = '<button title="Detail" class="editRoles bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
            <i class="fas fa-solid fa-eye"></i>
          </button>
          <button title="Delete" class="deleteRoles bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
          <i class="fas fa-solid fa-trash"></i>
          </button>
          ';
            return $btn;
        })->toJson();
    }
    return view('roles.roles-index');
   }
   public function save_roles(Request $request){
        $roles_name = $request->roles_name;
        $status=500;
        $message="Data Gagal disimpan";
        $validator = Validator::make($request->all(),[
            'roles_name'=>'required|unique:roles,name',
        ],[
            'roles_name.required'=>'Nama Role tidak boleh kosong',
            'roles_name.unique'=>'Nama Role sudah ada',
        
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$roles_name,
                'guard_name'=>'web',
            ];
            $insert = Role::create($post);
            if($insert){
                $status=200;
                $message="Data berhasil disimpan";
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
   }
   public function get_premission(Request $request)
   {
        if($request->ajax()) {
            $data = Permission::whereNotNull('name')->orderBy('id','desc');
            return DataTables::eloquent($data)
            ->addColumn('action', function($row){
                $btn = '
            <button title="Delete" class="deletePermission bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
            <i class="fas fa-solid fa-trash"></i>
            </button>
            ';
                return $btn;
            })->toJson();
        }
    }
    public function save_permission(Request $request){
        $menus_name = $request->menus_name;
        $permission_option = $request->permission_option;
        $status=500;
        $message="Data Gagal disimpan";
        
        $permission_name = $permission_option.'-'.$menus_name;
        if($menus_name =='' || $permission_option ==''){
            $message="Permission harus diisi";
            $status =422;
        }else{
            // Validasi 
            $validasi_1 = Permission::where('name', $permission_name)->count();
            if($validasi_1 == 1){
                $message="Permission name sudah ada";
                $status =422;
            }else{
                $post=[
                    'name'=>$permission_name,
                    'guard_name'=>'web'
                ];
                $insert = Permission::create($post);
                if($insert){
                    $status=200;
                    $message ="Data berhasil disimpan";
                }
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }
    public function permission_menus_name(){
    $data = DB::table('view_menus')
                ->select('*')
                ->get();
    return response()->json([
        'menus_name'=>$data,
    ]);

    }
    public function delete_roles(Request $request){
    $id = $request->id;
    $status =500;
    $message ='';
    // Validasi, jika data sudah ada di role has permission / Role User, maka data tidak bisa dihapus
    $validasi_1 = RoleHasPermission::where('role_id',$id)->count();
    if($validasi_1 == 1)
    {
        $status =422;
        $message ='Role sudah dipakai, tidak bisa dihapus';
    }else{
        $validasi_2 =ModelHasRole::where('role_id', $id)->count();
        if($validasi_2 == 1)
        {
            $status =422;
            $message ='Role sudah dipakai, tidak bisa dihapus';
        }else{
            $delete = Role::find($id);
            $delete->delete();
            if($delete){
                $status =200;
                $message ='Data berhasil dihapus';
            }
        }
    }
    return response()->json([
        'status'=>$status,
        'message'=>$message
    ]);
    }
    public function detail_roles(Request $request){
        $detail = Role::where('id', $request->id)->get();
        return response()->json([
            'detail'=>$detail
            
        ]);
    }
    public function update_roles(Request $request){
        $id = $request->roles_id;
        $roles_name_update = $request->roles_name_update;
        $status =500;
        $message ='';
        $validator = Validator::make($request->all(),[
            'roles_name_update'=>'required|unique:roles,name',
        ],[
            'roles_name_update.required'=>'Nama Role tidak boleh kosong',
            'roles_name_update.unique'=>'Nama Role sudah ada',
        
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$roles_name_update,
                'guard_name'=>'web',
            ];
            $update =Role::where('id', $id)->update($post);
            if($update){
                $status=200;
                $message="Data berhasil disimpan";
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }
    public function delete_permission(Request $request){
        $id = $request->id;
        $status = 500;
        $message='';
        // Validasi, Jika data sudah tercantum di Role Has Permsission, maka data tidak akan di hapus
        $validasi_1 = RoleHasPermission::where('permission_id', $id)->count();
        if($validasi_1 == 1){
            $status=422;
            $message='Permission sudah digunakan di Role Has Permission';
        }else{
            $delete = Permission::find($id);
            $delete->delete();
            if($delete){
                $status =200;
                $message ='Data berhasil dihapus';
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }
    

    }