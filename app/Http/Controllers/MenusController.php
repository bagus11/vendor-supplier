<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\Submenus;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request->ajax()) {
            $data = Menus::whereNotNull('status')->orderBy('id', 'asc');
            return DataTables::eloquent($data)
            ->addColumn('action', function($row){
                $update_menus = auth()->user()->can('update-menus');
                $delete_menus = auth()->user()->can('delete-menus');

                if($update_menus ==true  && $delete_menus == true){
                    $btn = '<button title="Detail" class="editMenus bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>
                  <button title="Delete" class="deleteMenus bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                  <i class="fas fa-solid fa-trash"></i>
                  </button>
                  ';
                }else if($update_menus == true && $delete_menus == false){
                    $btn = '<button title="Detail" class="editMenus bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>';
                }else if($update_menus == false && $delete_menus == true){
                    $btn ='<button title="Delete" class="deleteMenus bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-trash"></i>
                    </button>';
                }
                else{
                    $btn = '<span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>';
                }
             
                return $btn;
            })->addColumn('status', function($row){
            $checkbox = $row->status == 1 ? 'active':'innactive' ;
            return $checkbox;
            })->toJson();
        }
        return view('menus.index');

        if($request->role()->hasRole('ICT')){
            return view('menus.index');
        }else{
            abort(403);
        }
    }
    public function get_submenus(Request $request){
        if($request->ajax()) {
            $data = Submenus::whereNotNull('status')->orderBy('id', 'asc');
            return DataTables::eloquent($data)
            ->addColumn('action', function($row){
                $update_menus = auth()->user()->can('update-menus');
                $delete_menus = auth()->user()->can('delete-menus');
                
                if($update_menus ==true  && $delete_menus == true){
                    $btn = '<button title="Detail" class="editSubmenus bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>
                  <button title="Delete" class="deleteSubmenus bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                  <i class="fas fa-solid fa-trash"></i>
                  </button>
                  ';
                }else if($update_menus == true && $delete_menus == false){
                    $btn = '<button title="Detail" class="editSubmenus bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>';
                }else if($update_menus == false && $delete_menus == true){
                    $btn ='<button title="Delete" class="deleteSubmenus bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-trash"></i>
                    </button>';
                }
                else{
                    $btn = '<span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>';
                }
                return $btn;
            })->addColumn('status', function($row){
            $checkbox = $row->status == 1 ? 'active':'innactive' ;
            return $checkbox;
            })->toJson();
        }
        return view('menus.index');
    }
    public function save_menus(Request $request){
        $menus_name = $request->menus_name;
        $menus_link = $request->menus_link;
        $type_menus = $request->type_menus;
        $description_menus = $request->description_menus;
        $status =500;
        $message='';
        $validator = Validator::make($request->all(),[
            'menus_name'=>'required|unique:menuses,name',
            'menus_link'=>'required|unique:menuses,link',
            'type_menus'=>'required',
            'description_menus'=>'required',
        ],[
            'menus_name.required'=>'Nama Menu tidak boleh kosong',
            'menus_name.unique'=>'Nama Menu sudah ada',
            'type_menus.required'=>'Tipe Menu tidak boleh kosong',
            'menus_link.required'=>'Link Menu tidak boleh kosong',
            'menus_link.unique'=>'Link Menu sudah ada',
            'description_menus.required'=>'Deskripsi Menu tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            if($type_menus ==1){
                $post=[
                    'name'=>$menus_name,
                    'link'=>$menus_link,
                    'description'=>$description_menus,
                    'status'=>0,
                    'type'=>$type_menus,
                    'permission_name'=>'view-'.$menus_link
                ];
            }else{
                $post=[
                    'name'=>$menus_name,
                    'link'=>'',
                    'description'=>$description_menus,
                    'status'=>0,
                    'type'=>$type_menus,
                    'permission_name'=>'view-'.$menus_link
                ];
            }
          
            $insert = Menus::create($post);
            if($insert){
                $post_permission =[
                    'name'=>'view-'.$menus_link,
                    'guard_name'=>'web'
                ];
                Permission::create($post_permission);
                
                $status =200;
                $message='Data telah tersimpan';
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);

    }
    public function save_submenus(Request $request){
        $submenus_name = $request->submenus_name;
        $type_submenus = $request->type_submenus;
        $submenus_link = $request->submenus_link;
        $description_submenus = $request->description_submenus;
    
        $status =500;
        $message='';
        $validator = Validator::make($request->all(),[
            'submenus_name'=>'required|unique:menuses,name',
            'type_submenus'=>'required|unique:menuses,link',
            'submenus_link'=>'required',
            'description_submenus'=>'required',
        ],[
            'submenus_name.required'=>'Nama Submenu tidak boleh kosong',
            'submenus_name.unique'=>'Nama Submenu sudah ada',
            'type_menus.required'=>'Tipe Submenu tidak boleh kosong',
            'type_submenus.required'=>'Link Submenu tidak boleh kosong',
            'type_submenus.unique'=>'Link Submenu sudah ada',
            'description_submenus.required'=>'Deskripsi Submenu tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$submenus_name,
                'link'=>$submenus_link,
                'description'=>$description_submenus,
                'status'=>0,
                'id_menus'=>$type_submenus,
                'permission_name'=>'view-'.$submenus_link
            ];
            $insert = Submenus::create($post);
            if($insert){
                $post_permission =[
                    'name'=>'view-'.$submenus_link,
                    'guard_name'=>'web'
                ];
                Permission::create($post_permission);
                $status =200;
                $message='Data telah tersimpan';
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);

    }
    public function menus_name(Request $request){
        $menus_name = Menus::where('type',2)->get();
        return response()->json([
            'menus_name'=>$menus_name,
        ]);
    }
    public function getDetailMenus(Request $request){
        $detail = Menus::where('id', $request->id)->get();
       
        return response()->json([
            'detail'=>$detail,
        ]);
    }
    public function update_menus(Request $request){
        $menus_name_update = $request->menus_name_update;
        $description_menus_update = $request->description_menus_update;
        $status =500;
        $message='';
        $validator = Validator::make($request->all(),[
            'menus_name_update'=>'required',
            'description_menus_update'=>'required',
        ],[
            'menus_name_update.required'=>'Nama Menu tidak boleh kosong',
            'description_menus_update.required'=>'Deskripsi Menu tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422,
              
            ]);
        }else{
            $status = $request->menus_status_update;
            $post=[
                'name'=>$menus_name_update,
                'description'=>$description_menus_update,
                'status'=>$status,
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            
            $update = Menus::where('id', $request->id_menus_update)->update($post);
            if($update){
                $status =200;
                $message='Data telah tersimpan';
            }else{
                $message='Gagal disimpan';
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);

    }
    public function deleteMenus(Request $request){
        $message='';
        $id = $request->id;
        DB::transaction(function() use($request,$message) {
            $id = $request->id;
            $menus = Menus::find($id);
            $permission_name = $menus->permission_name;
            $menus->delete();
            $permission = Permission::where('name', $permission_name);
            $permission->delete();
        });
        $check_submenus = Menus::where('id', $id)->count();
        if($check_submenus == 1){
            $message="Data gagal dihapus";
        }else{
            $message="Data berhasil dihapus";
        }
        return response()->json([
            'message'=>$message
        ]);
    }
    public function getDetailSubmenus(Request $request){
        $detail = DB::table('submenuses')->select('submenuses.*', 'menuses.name as menus_name')->join('menuses','menuses.id','=','submenuses.id_menus')->where('submenuses.id', $request->id)->get();
        $menus_name = Menus::where('type',2)->get();
        return response()->json([
            'detail'=>$detail,
            'menus_name'=>$menus_name
        ]); 
    }
    public function deleteSubmenus(Request $request){
        $message='';
        $id = $request->id;
        DB::transaction(function() use($request,$message) {
            $id = $request->id;
            $menus = Submenus::find($id);
            $permission_name = $menus->permission_name;
            $menus->delete();
            $permission = Permission::where('name', $permission_name);
            $permission->delete();
        });
        $check_submenus = Submenus::where('id', $id)->count();
        if($check_submenus == 1){
            $message="Data gagal dihapus";
        }else{
            $message="Data berhasil dihapus";
        }
        return response()->json([
            'message'=>$message
        ]);
  }
      
    public function update_submenus(Request $request){
        $submenus_name_update = $request->submenus_name_update;
        $type_submenus_update = $request->type_submenus_update;
        $id_submenus_update = $request->id_submenus_update;
        $submenus_status = $request->status;
        $description_submenus_update = $request->description_submenus_update;
        $status =500;
        $message='';
        $validator = Validator::make($request->all(),[
            'submenus_name_update'=>'required',
            'description_submenus_update'=>'required',
        ],[
            'submenus_name_update.required'=>'Nama Menu tidak boleh kosong',
            'description_submenus_update.required'=>'Deskripsi Menu tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422,
              
            ]);
        }else{
            $status = $request->menus_status_update;
            $post=[
                'name'=>$submenus_name_update,
                'description'=>$description_submenus_update,
                'status'=>$submenus_status,
                'id_menus'=>$type_submenus_update,
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $update = Submenus::where('id', $id_submenus_update)->update($post);
            if($update){
                $status =200;
                $message='Data telah tersimpan';
            }else{
                $message='Gagal disimpan';
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }
}
