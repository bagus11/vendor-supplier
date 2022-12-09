<?php

namespace App\Http\Controllers;

use App\Models\MasterDepartement;
use App\Models\MasterFormPenilaian;
use App\Models\MasterFormPenilaianHeader;
use App\Models\MasterPertanyaan;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\FunctionHelper;
class MasterPenilaianController extends Controller
{
    public function index()
    {
        return view('form-penilaian.penilaian-index');
    }
    public function get_penilaian_headers(Request $request)
    {
        $data = DB::table('master_form_penilaian_headers')
                    ->select('master_form_penilaian_headers.*','master_departements.name as departement_name')
                    ->join('master_departements','master_departements.id','=','master_form_penilaian_headers.departement_id')
                    ->where('master_departements.id','like','%'.$request->departement_id.'%')
                    ->whereBetween(DB::raw('DATE(master_form_penilaian_headers.created_at)'), [$request->tgl_from, $request->tgl_to])
                    ->groupBy('master_form_penilaian_headers.supplier_id')
                    ->get();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function get_penilaian_log(Request $request)
    {
        $data = DB::table('master_form_penilaian_headers')
                    ->select('master_form_penilaian_headers.*','master_departements.name as departement_name')
                    ->join('master_departements','master_departements.id','=','master_form_penilaian_headers.departement_id')
                    ->where('master_form_penilaian_headers.supplier_id', $request->supplier_id)
                    ->get();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function get_supplier_name(Request $request)
    {
        $supplier_name = Suppliers::where('status','active')->get();
        $departement_name = MasterDepartement::where('flg_aktif',1)->get();
        return response()->json([
            'departement_name'=>$departement_name,
            'supplier_name'=>$supplier_name,
        ]);
    }
    public function get_pertanyaan(Request $request)
    {
        $master_aspeks = DB::table('master_pertanyaans')
        ->join('master_aspeks','master_aspeks.id','=','master_pertanyaans.aspek_id')
        ->select('master_aspeks.name as aspek_name','master_pertanyaans.*')
        ->where('master_pertanyaans.departement_id', $request->departement_id)
        ->where('master_pertanyaans.flg_aktif',1)
        ->orderBy('master_pertanyaans.id','asc')
        ->get();
        return response()->json([
            'master_aspeks'=>$master_aspeks,
        ]);
    }
    public function save_form_penilaian(Request $request)
    {
        $departement_id = $request->departement_id;
        $supplier_id = $request->supplier_id;
        $pertanyaan_array = $request->pertanyaan_array;
        $supplier_name = Suppliers::find($supplier_id);
        $post_array =[];
        $post_header =[];
        $status =500;
        $message ='Data Gagal disimpan, harap hubungi ICT Developer';
        foreach($pertanyaan_array as $row){
            $departement_name = MasterDepartement::find($departement_id);
            $penilaian_header = MasterFormPenilaianHeader::orderby('id','desc')->first();
            $post =[
                'name'=>$departement_name->name.' '.$supplier_name->supplierName.' '.FunctionHelper::tgl_indo(date('Y-m-d')),
                'aspek_id'=>$row[1],
                'departement_id'=>$departement_id,
                'pertanyaan_id'=>$row[0],
                'form_id'=>$penilaian_header!=null? $penilaian_header->id + 1: 1, 
                'created_at'=>date('Y-m-d H:i:s')
            ];
            array_push($post_array,$post);
            $post_header =[
                'name'=>$departement_name->name.' '.$supplier_name->supplierName.' '.FunctionHelper::tgl_indo(date('Y-m-d')),
                'supplier_name'=>$supplier_name->supplierName,
                'rating_code'=>$supplier_id.date('YmdHis').$departement_id,
                'flg_aktif'=>0,
                'departement_id'=>$departement_id,
                'supplier_id'=>$supplier_id,
                'status'=>'WAITING',
                'created_at'=>date('Y-m-d H:i:s')
            ];
        }
        // dd($post_header);
        if(count($post_array) > 0){
            DB::transaction(function() use($post_array,$post_header) {
                $insert = MasterFormPenilaianHeader::create($post_header);
                if($insert){
                     MasterFormPenilaian::insert($post_array);
                }
            });
            // Cek jika data ada, pesan masuk,
            $validasi_2 = MasterFormPenilaianHeader::where('rating_code',$supplier_id.date('YmdHis').$departement_id)->count();
            if($validasi_2 ==1){
                $status=200;
                $message='Data berhasil disimpan';
            }
            return response()->json([
                'status'=>$status,
                'message'=>$message,
            ]);
        }
    }
    public function update_status_penilaian_header(Request $request)
    {
        $id=$request->id;
        $flg_aktif=$request->flg_aktif;
        $post=[
            'flg_aktif'=>$flg_aktif==1?0:1
        ];
        $message ='Data Gagal diupdate';
        $update = MasterFormPenilaianHeader::find($id);
        $update->update($post);
        if($update){
            $message='Data berhasil diupdate';
        }
        return response()->json([
            'message'=>$message,
        ]);
    }
}
