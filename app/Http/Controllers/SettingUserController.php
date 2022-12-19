<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use App\Models\MasterKantor;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingUserController extends Controller
{
    public function index()
    {
       return view('user.user_index');
    }
    public function get_user(Request $request)
    {
       $data = DB::table('users')->leftJoin('master_jabatans','master_jabatans.id','=','users.jabatan_id')
       ->leftJoin('master_kantors','master_kantors.id','=','users.kode_kantor')
       ->select('master_jabatans.name as jabatan_name','master_kantors.name as kantor_name', 'users.*')->get();
       return response()->json([
        'data'=>$data,
        ]);
    }
    public function update_status_user(Request $request)
    {
        $id=$request->id;
        $flg_aktif=$request->flg_aktif;
       
        $post=[
            'flg_aktif'=>$flg_aktif==1?0:1
        ];
        $message ='Data Gagal diupdate';
        $update = User::find($id);
        $update->update($post);
        if($update){
            $message='Data berhasil diupdate';
        }
        return response()->json([
            'message'=>$message,
        ]);
    }
    public function detail_user(Request $request)
    {
        $data = DB::table('users')->leftJoin('master_jabatans','master_jabatans.id','=','users.jabatan_id')
                                  ->leftJoin('master_kantors','master_kantors.id','=','users.kode_kantor')
                                  ->select('master_jabatans.name as jabatan_name','master_kantors.name as kantor_name', 'users.*')
                                  ->where('users.id', $request->id)->first();
        $master_jabatans = MasterJabatan::all();
        $master_kantor = MasterKantor::all();
        return response()->json([
            'data'=>$data,
            'master_jabatans'=>$master_jabatans,
            'master_kantor'=>$master_kantor,
        ]);
    }
    public function update_user(Request $request)
    {
        $status =500;
        $message ="Data gagal disimpan";
        $user_id = $request->user_id;
        $user_name = $request->user_name;
        $kode_kantor = $request->kode_kantor;
        $jabatan_id = $request->jabatan_id;
      
        $validator = Validator::make($request->all(),[
            'user_name'=>'required',
            'kode_kantor'=>'required',
            'jabatan_id'=>'required',
           
          
        ],[
            'user_name.required'=>'Nama User tidak boleh kosong',
            'kode_kantor.required'=>'Kantor User tidak boleh kosong',
            'jabatan_id.required'=>'Jabatan User tidak boleh kosong',
          
        
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
        }else{
            $post =[
                'name'=>$user_name,
                'kode_kantor'=>$kode_kantor,
                'jabatan_id'=>$jabatan_id,
            ];
            $update = User::find($user_id);
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
