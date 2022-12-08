<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterAspek;
use App\Models\MasterDepartement;
use App\Models\Masterjawaban;
use App\Models\MasterPertanyaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class MasterPertanyaanController extends Controller
{
    public function index(){
        return view('master_pertanyaan.pertanyaan-index');
    }
    public function get_data_pertanyaan(Request $request){
        $data_pertanyaan = DB :: table('master_pertanyaans')
        ->select('master_pertanyaans.*','master_aspeks.name as aspek_name','master_departements.name as departement_name')
        ->join('master_aspeks','master_aspeks.id','=','master_pertanyaans.aspek_id')
        ->join('master_departements','master_departements.id', '=','master_pertanyaans.departement_id')
        ->where('master_pertanyaans.departement_id','like','%'.$request->select_departement.'%')
        ->where('master_pertanyaans.aspek_id','like','%'.$request->select_aspek.'%')
        ->get();
        // dd($data_pertanyaan);
        return response()->json([
            'data_pertanyaan'=>$data_pertanyaan,
        ]);
    }
    public function get_aspek_name()
    {
        $aspek_name = MasterAspek::where('flg_aktif',1)->get();
        $departement_name = MasterDepartement::where('flg_aktif',1)->get();
        return response()->json([
            'aspek_name'=>$aspek_name,
            'departement_name'=>$departement_name,
        ]);
    }
    public function save_pertanyaan(Request $request)
    {
        $pertanyaan_name = $request->pertanyaan_name;
        $aspek_id = $request->aspek_id;
        $departement_id = $request->departement_id;
    
    
        $status =500;
        $message='';
        $validator = Validator::make($request->all(),[
            'pertanyaan_name'=>'required',
            'aspek_id'=>'required',
            'departement_id'=>'required',
        ],[
            'pertanyaan_name.required'=>'Pertanyaan tidak boleh kosong',
            'aspek_id.required'=>'Aspek tidak boleh kosong',
            'departement_id.required'=>'Departement tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$pertanyaan_name,
                'aspek_id'=>$aspek_id,
                'departement_id'=>$departement_id,
                'flg_aktif'=>0
            ];
            $insert = MasterPertanyaan::create($post);
            if($insert){
                $status =200;
                $message='Data telah tersimpan';
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }
    public function update_status_pertanyaan(Request $request){
        $id=$request->id;
        $flg_aktif=$request->flg_aktif;
        $post=[
            'flg_aktif'=>$flg_aktif==1?0:1
        ];
        $message ='Data Gagal diupdate';
        $update = MasterPertanyaan::find($id);
        $update->update($post);
        if($update){
            $message='Data berhasil diupdate';
        }
        return response()->json([
            'message'=>$message,
        ]);
    }
    public function detail_pertanyaan(Request $request)
    {
        $detail_pertanyaan = DB::table('master_pertanyaans')->select('master_pertanyaans.*', 'master_aspeks.name as aspek_name','master_departements.name as departement_name')->join('master_aspeks','master_aspeks.id','=','master_pertanyaans.aspek_id')->join('master_departements','master_departements.id', '=','master_pertanyaans.departement_id')->where('master_pertanyaans.id',$request->id)->get();
        $aspek_name = MasterAspek::where('flg_aktif',1)->get();
        $departement_name = MasterDepartement::where('flg_aktif',1)->get();
        return response()->json([
            'detail_pertanyaan'=>$detail_pertanyaan,
            'aspek_name'=>$aspek_name,
            'departement_name'=>$departement_name,
        ]);
    }
    public function update_pertanyaan(Request $request)
    {
        $pertanyaan_name_update = $request->pertanyaan_name_update;
        $aspek_id_update = $request->aspek_id_update;
        $departement_id_update = $request->departement_id_update;
        $pertanyaan_id = $request->pertanyaan_id;
    
    
        $status =500;
        $message='';
        $validator = Validator::make($request->all(),[
            'pertanyaan_name_update'=>'required',
            'aspek_id_update'=>'required',
            'departement_id_update'=>'required',
        ],[
            'pertanyaan_name_update.required'=>'Pertanyaan tidak boleh kosong',
            'aspek_id_update.required'=>'Aspek tidak boleh kosong',
            'departement_id_update.required'=>'Departement tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post=[
                'name'=>$pertanyaan_name_update,
                'aspek_id'=>$aspek_id_update,
                'departement_id'=>$departement_id_update,
            ];
            $update = MasterPertanyaan::find($pertanyaan_id);
            $update->update($post);
            if($update){
                $status =200;
                $message='Data telah tersimpan';
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }
    public function delete_pertanyaan(Request $request){
        $id= $request->id;
        $message='';
        $status=500;
        // Validasi, jika pertanyaan sudah dipakai, maka tidak bisa dihapus
        $validasi_1 = Masterjawaban::where('pertanyaan_id', $id)->count();
        if($validasi_1 ==1){
            $message="Data sudah dipakai tidak bisa dihapus";
        }else{
            $delete = MasterPertanyaan::find($id);
            $delete->delete();
            if($delete){
                $message ="Data berhasil dihapus";
                $status =200;
            }
        }
        return response()->json([
            'message'=>$message,
            'status'=>$status,
        ]);
    }
}
