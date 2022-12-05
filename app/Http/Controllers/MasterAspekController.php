<?php

namespace App\Http\Controllers;

use App\Models\MasterAspek;
use App\Models\MasterDepartement;
use App\Models\MasterPertanyaan;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
class MasterAspekController extends Controller
{
    public function index(Request $request){
        if($request->ajax()) {
            $data = MasterAspek::whereNotNull('flg_aktif')->orderBy('id', 'asc');
            return DataTables::eloquent($data)
            ->addColumn('action', function($row){
                $update_menus = auth()->user()->can('update-master_aspek');
                $delete_menus = auth()->user()->can('delete-master_aspek');
                
                if($update_menus ==true  && $delete_menus == true){
                    $btn = '<button title="Detail" class="editAspek bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>
                  <button title="Delete" class="deleteAspek bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                  <i class="fas fa-solid fa-trash"></i>
                  </button>
                  ';
                }else if($update_menus == true && $delete_menus == false){
                    $btn = '<button title="Detail" class="editAspek bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>';
                }else if($update_menus == false && $delete_menus == true){
                    $btn ='<button title="Delete" class="deleteAspek bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-trash"></i>
                    </button>';
                }
                else{
                    $btn = '<span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>';
                }
                return $btn;
            })->addColumn('status', function($row){
            $checkbox = $row->flg_aktif == 1 ? 'active':'innactive' ;
            return $checkbox;
            })->toJson();
        }
        return view('master_aspek.aspek-index');
    }
    public function add_aspek(Request $request){
        $aspek_name =  $request->aspek_name;
        $status =500;
        $message ='';
        $validator = Validator::make($request->all(),[
            'aspek_name'=>'required',
        ],[
            'aspek_name.required'=>'Nama Aspek tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$aspek_name,
                'flg_aktif'=>0
            ];
            $insert = MasterAspek::create($post);
            if($insert){
                $status =200;
                $message ='Data Berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
    public function get_aspek(Request $request){
        $detail = MasterAspek::find($request->id);
        return response()->json([
            'detail'=>$detail, 
        ]);
    }
    public function update_aspek(Request $request){
        $id = $request->id_aspek_update;
        $aspek_name_update = $request->aspek_name_update;
        $is_active = $request->is_active;
        $validator = Validator::make($request->all(),[
            'aspek_name_update'=>'required',
        ],[
            'aspek_name_update.required'=>'Nama Aspek tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$aspek_name_update,
                'flg_aktif'=>$is_active
            ];
            $update = MasterAspek::find($id);
            $update->update($post);
            if($update){
                $status =200;
                $message ='Data Berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
    public function get_departement(Request $request){
        if($request->ajax()) {
            $data = MasterDepartement::whereNotNull('flg_aktif')->orderBy('id', 'asc');
            return DataTables::eloquent($data)
            ->addColumn('action', function($row){
                $update_menus = auth()->user()->can('update-departement');
                $delete_menus = auth()->user()->can('delete-departement');
                
                if($update_menus ==true  && $delete_menus == true){
                    $btn = '<button title="Detail" class="editDepartement bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>
                  <button title="Delete" class="deleteDepartement bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                  <i class="fas fa-solid fa-trash"></i>
                  </button>
                  ';
                }else if($update_menus == true && $delete_menus == false){
                    $btn = '<button title="Detail" class="editDepartement bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-eye"></i>
                  </button>';
                }else if($update_menus == false && $delete_menus == true){
                    $btn ='<button title="Delete" class="deleteDepartement bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'">
                    <i class="fas fa-solid fa-trash"></i>
                    </button>';
                }
                else{
                    $btn = '<span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>';
                }
                return $btn;
            })->addColumn('status', function($row){
            $checkbox = $row->flg_aktif == 1 ? 'active':'innactive' ;
            return $checkbox;
            })->toJson();
        }
    }
    public function add_departement(Request $request){
        $departement_name =  $request->departement_name;
        $status =500;
        $message ='';
        $validator = Validator::make($request->all(),[
            'departement_name'=>'required',
        ],[
            'departement_name.required'=>'Nama Departement tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$departement_name,
                'flg_aktif'=>0
            ];
            $insert = MasterDepartement::create($post);
            if($insert){
                $status =200;
                $message ='Data Berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
   public function delete_aspek(Request $request)
   {
        $message='';
        $id = $request->id;
        $status =500;
        // Validasi jika data sudah tercantum, tidak dapat dihapus
        $validasi_1 = MasterPertanyaan::where('aspek_id',$id)->count();
        if($validasi_1 >= 1){
            $message="Data sudah dipakai tidak dapat dihapus";
        }else{
            $aspek = MasterAspek::find($id);
            $delete = $aspek->delete();
            if($delete){
                $message="Data berhasil dihapus";
                $status =200;
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);
   }
   public function detail_departement(Request $request){
    $detail = MasterDepartement::find($request->id);
    return response()->json([
        'detail'=>$detail
    ]);
   }
   public function update_departement(Request $request)
   {
        $id = $request->id_departement_update;
        $departement_name_update = $request->departement_name_update;
        $is_active = $request->is_active;
        $validator = Validator::make($request->all(),[
            'departement_name_update'=>'required',
        ],[
            'departement_name_update.required'=>'Nama Departement tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$departement_name_update,
                'flg_aktif'=>$is_active
            ];
            $update = MasterDepartement::find($id);
            $update->update($post);
            if($update){
                $status =200;
                $message ='Data Berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
    public function delete_departement(Request $request)
    {
            $message='';
            $status =500;
            $id = $request->id;
            // Validasi, jika sudah terpakai di Pertanyaan, tidak dapat dihapus
            $validasi_1  = MasterPertanyaan::where('departement_id',$id)->count();
            if($validasi_1 >= 1 )
            {
                $message="Data sudah dipakai tidak dapat dihapus";
            }else{
                $aspek = MasterDepartement::find($id);
                $delete = $aspek->delete();
                if($delete){
                    $message="Data berhasil dihapus";
                    $status =200;
                }
            }
            return response()->json([
                'status'=>$status,
                'message'=>$message,
            ]);
    }
    
}