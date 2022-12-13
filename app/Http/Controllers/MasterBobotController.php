<?php

namespace App\Http\Controllers;

use App\Models\MasterBobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class MasterBobotController extends Controller
{
    public function index()
    {
        return view('master-bobot.master_bobot_index');
    }
    
    public function get_bobot(){
        $data = DB::table('master_bobot')
                ->join('master_aspeks','master_aspeks.id','=','master_bobot.aspek_id')
                ->join('master_departements','master_departements.id','=','master_bobot.departement_id')
                ->select('master_bobot.*','master_aspeks.name as aspek_name','master_departements.name as departement_name')
                ->get();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function save_bobot(Request $request)
    {
        $status=500;
        $message='Data gagal disimpan';
        $aspek_id = $request->aspek_id;
        $departement_id = $request->departement_id;
        $score = $request->score;
        $validator = Validator::make($request->all(),[
            'aspek_id'=>'required',
            'departement_id'=>'required',
            'score'=>'required',
         
        ],[
            'aspek_id.required'=>'Aspek tidak boleh kosong',
            'departement_id.required'=>'Departement tidak boleh kosong',
            'score.required'=>'Score tidak boleh kosong',
          
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            // Validasi jika, hanya boleh 1 saja
            $validasi_2 = MasterBobot::
                        where('aspek_id',$aspek_id)
                        ->where('departement_id',$departement_id)->count();
            if($validasi_2 > 0){
                $message='Data sudah ada';
            }else{

                $post=[
                    'aspek_id'=>$aspek_id,
                    'departement_id'=>$departement_id,
                    'score'=>$score,
                ];
                $insert = MasterBobot::create($post);
                if($insert){
                    $status =200;
                    $message='Data telah tersimpan';
                }
            }
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);

    }
    public function get_detail_bobot(Request $request)
    {
        $data = DB::table('master_bobot')
        ->join('master_aspeks','master_aspeks.id','=','master_bobot.aspek_id')
        ->join('master_departements','master_departements.id','=','master_bobot.departement_id')
        ->select('master_bobot.*','master_aspeks.name as aspek_name','master_departements.name as departement_name')
        ->where('master_bobot.id', $request->id)
        ->get();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function udpate_bobot(Request $request)
    {
        $status=500;
        $message='Data gagal disimpan';
        $score_update = $request->score_update;
        $validator = Validator::make($request->all(),[
            'score_update'=>'required',
        ],[
            'score_update.required'=>'Score tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
        $post=[
            'score'=>$score_update,
        ];
        $update = MasterBobot::find($request->bobot_id);
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
    public function delete_bobot(Request $request)
    {
        $status =500;
        $message ='Data gagal dihapus';
        $id = $request->id;
        $delete = MasterBobot::find($id);
        $delete->delete();
        if($delete){
            $status =200;
            $message ='Data berhasil dihapus';
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }
}
