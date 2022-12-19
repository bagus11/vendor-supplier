<?php

namespace App\Http\Controllers;

use App\Models\MasterDepartement;
use App\Models\MasterJabatan;
use App\Models\MasterKantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class MasterJabatanController extends Controller
{
    public function index()
    {
        return view('master_jabatan.master_jabatan-index');
    }
    public function get_kantor()
    {
        $data = MasterKantor::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function save_kantor(Request $request)
    {
        $status =500;
        $message ="Data gagal disimpan";
        $kantor_name = $request->kantor_name;
        $kantor_address = $request->kantor_address;
        $kantor_type = $request->kantor_type;
        $kantor_city = $request->kantor_city;
        $validator = Validator::make($request->all(),[
            'kantor_name'=>'required|unique:master_kantors,name',
            'kantor_address'=>'required',
            'kantor_city'=>'required',
            'kantor_type'=>'required',
        ],[
            'kantor_name.required'=>'nama Kantor tidak boleh kosong',
            'kantor_name.unique'=>'Nama Kantor sudah ada',
            'kantor_address.required'=>'Alamat tidak boleh kosong',
            'kantor_city.required'=>'Kota tidak boleh kosong',
            'kantor_type.required'=>'Tipe kantor tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post =[
                'name'=>$kantor_name,
                'address'=>$kantor_address,
                'city'=>$kantor_city,
                'type'=>$kantor_type,
                'flg_aktif'=>0,
            ];
            $insert = MasterKantor::create($post);
            if($insert){
                $status =200;
                $message ='Data berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
    public function update_status_kantor(Request $request)
    {
        $id=$request->id;
        $flg_aktif=$request->flg_aktif;
        $post=[
            'flg_aktif'=>$flg_aktif==1?0:1
        ];
        $message ='Data Gagal diupdate';
        $update = MasterKantor::find($id);
        $update->update($post);
        if($update){
            $message='Data berhasil diupdate';
        }
        return response()->json([
            'message'=>$message,
        ]);
    }
    public function detail_kantor(Request $request)
    {
        $data = MasterKantor::find($request->id);
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function detail_jabatan(Request $request)
    {
        $data = DB::table('master_jabatans')->select('master_jabatans.*', 'master_departements.name as departement_name')
                                            ->join('master_departements','master_departements.id','=','master_jabatans.departement_id')
                                            ->where('master_jabatans.id',$request->id)->first();
     
        $departement = MasterDepartement::all();
        return response()->json([
            'data'=>$data,
            'departement'=>$departement,
        ]);
    }
    public function get_jabatan()
    {
        $data =DB::table('master_jabatans')
                        ->select('master_jabatans.*','master_departements.name as departement_name')
                        ->join('master_departements','master_departements.id','=','master_jabatans.departement_id')
                        ->get();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function save_jabatan(Request $request)
    {
        $status =500;
        $message ="Data gagal disimpan";
        $jabatan_departement_id = $request->jabatan_departement_id;
        $jabatan_name = $request->jabatan_name;
        $validator = Validator::make($request->all(),[
            'jabatan_name'=>'required|unique:master_jabatans,name',
            'jabatan_departement_id'=>'required',
            
        ],[
            'jabatan_name.required'=>'Nama Jabatan tidak boleh kosong',
            'jabatan_name.unique'=>'Nama Jabatan sudah ada',
            'jabatan_departement_id.required'=>'Departemen tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post =[
                'name'=>$jabatan_name,
                'departement_id'=>$jabatan_departement_id,
            ];
            $insert = MasterJabatan::create($post);
            if($insert){
                $status =200;
                $message ='Data berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
    public function update_status_jabatan(Request $request)
    {
        $id=$request->id;
        $flg_aktif=$request->flg_aktif;
        $post=[
            'flg_aktif'=>$flg_aktif==1?0:1
        ];
        $message ='Data Gagal diupdate';
        $update = MasterJabatan::find($id);
        $update->update($post);
        if($update){
            $message='Data berhasil diupdate';
        }
        return response()->json([
            'message'=>$message,
        ]);
    }
    public function update_kantor(Request $request)
    {
        $status =500;
        $message ="Data gagal disimpan";
        $kantor_id = $request->kantor_id;
        $kantor_name_update = $request->kantor_name_update;
        $kantor_address_update = $request->kantor_address_update;
        $kantor_type_update = $request->kantor_type_update;
        $kantor_city_update = $request->kantor_city_update;
        $validator = Validator::make($request->all(),[
            'kantor_name_update'=>'required',
            'kantor_address_update'=>'required',
            'kantor_city_update'=>'required',
            'kantor_type_update'=>'required',
        ],[
            'kantor_name_update.required'=>'nama Kantor tidak boleh kosong',
            'kantor_name.unique'=>'Nama Kantor sudah ada',
            'kantor_address_update.required'=>'Alamat tidak boleh kosong',
            'kantor_city_update.required'=>'Kota tidak boleh kosong',
            'kantor_type_update.required'=>'Tipe kantor tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post =[
                'name'=>$kantor_name_update,
                'address'=>$kantor_address_update,
                'type'=>$kantor_type_update,
                'city'=>$kantor_city_update,
            ];
            $update = MasterKantor::find($kantor_id);
            $update->update($post);
            if($update){
                $status =200;
                $message ='Data berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
    public function update_jabatan(Request $request)
    {
        $status =500;
        $message ="Data gagal disimpan";
        $jabatan_id = $request->jabatan_id;
        $jabatan_name_update = $request->jabatan_name_update;
        $jabatan_departement_id_update = $request->jabatan_departement_id_update;

        $validator = Validator::make($request->all(),[
            'jabatan_name_update'=>'required',
            'jabatan_departement_id_update'=>'required',
          
        ],[
            'jabatan_name_update.required'=>'Nama Jabatan tidak boleh kosong',
            'jabatan_departement_id_update.required'=>'Departement Jabatan tidak boleh kosong',
        
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post =[
                'name'=>$jabatan_name_update,
                'departement_id'=>$jabatan_departement_id_update,
              
            ];
            $update = MasterJabatan::find($jabatan_id);
            $update->update($post);
            if($update){
                $status =200;
                $message ='Data berhasil disimpan';
            }
        }
        return response()->json([
            'message'=>$message, 
            'status'=>$status
        ]);
    }
}
