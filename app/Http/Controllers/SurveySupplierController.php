<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionHelper;
use App\Models\MasterFormPenilaianHeader;
use App\Models\Masterjawaban;
use App\Models\MasterPertanyaan;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mpdf\Mpdf as PDF;
use Illuminate\Support\Facades\Storage;
class SurveySupplierController extends Controller
{
    public function index($id,$user_id){
        // Validasi selain user ID yg tercantum, tidak bisa buka halaman ini
        if(auth()->user()->id != $user_id)
        {
            abort(403,'Anda tidak dapat mengakses halaman Survey ini');
        }
        // Validasi, jika data ID yg dikirim tidak tercantum di Form Penilaian, di catch false
        $validasi_1 = MasterFormPenilaianHeader::where('id',$id)->count();
        if($validasi_1 == 0){
            abort(403,'Form Survey Supplier Tidak ada');
        }
        // Validasi, jika status data sudah done, maka tidak bisa melakukan survey
        $validasi_2 = MasterFormPenilaianHeader::where('id',$id)->get();
        if($validasi_2[0]->status =="DONE"){
            abort(403,'Anda sudah melakukan survey');
        } 
        $survey_header = DB::table('master_form_penilaian_headers')
                            ->select('master_form_penilaian_headers.*','master_departements.name as departement_name')
                            ->join('master_departements','master_departements.id','=','master_form_penilaian_headers.departement_id')
                            ->where('master_form_penilaian_headers.id',$id)
                            ->get();
        $aspek = DB::table('master_form_penilaians')
                    ->select('master_aspeks.name','master_aspeks.id')
                    ->join('master_aspeks','master_aspeks.id','=','master_form_penilaians.aspek_id')
                    ->where('master_form_penilaians.form_id',$id)
                    ->groupBy('master_aspeks.name')
                    ->orderBy('master_form_penilaians.id','asc')
                    ->get();
        $data =[
            'survey_header'=>$survey_header,
            'aspek'=>$aspek,
        ];
        return view('form-penilaian.survey-supplier-index',$data);
    }
    public function save_survey(Request $request){
        $survey_id =$request->survey_id;
        $arr_jawaban =$request->arr_jawaban;
        $departement_id = $request->departement_id;
        $keterangan = $request->keterangan;
        $arr_post = [];
        $status = 500;
        $message = 'Data gagal disimpan';
       
        foreach($arr_jawaban as $row){
            $aspek_id = MasterPertanyaan::find($row[0]);
            $score =0;
            if($row[1]==1 && $row[2]==0 && $row[3]==0 && $row[4]==0 && $row[5]==0){
                $score =1;
            }else if($row[1]==0 && $row[2]==1 && $row[3]==0 && $row[4]==0 && $row[5]==0){
                $score =2;
            }else if($row[1]==0 && $row[2]==0 && $row[3]==1 && $row[4]==0 && $row[5]==0){
                $score =3;
            }else if($row[1]==0 && $row[2]==0 && $row[3]==0 && $row[4]==1 && $row[5]==0){
                $score =4;
            }elseif($row[1]==0 && $row[2]==0 && $row[3]==0 && $row[4]==0 && $row[5]==1){
                $score =5;
            }
            $post=[
                'aspek_id'=>$aspek_id->aspek_id ==null?'test':$aspek_id->aspek_id,
                'pertanyaan_id'=>$row[0],
                'departement_id'=>$departement_id,
                'form_id'=>$survey_id,
                'a'=>$row[1],
                'b'=>$row[2],
                'c'=>$row[3],
                'd'=>$row[4],
                'e'=>$row[5],
                'score'=>$score,
                'penilaian_id'=>$row[6],
                'created_at'=>date('Y-m-d H:i:s')
            ];
            array_push($arr_post,$post);
        }
    //    dd($arr_post);
       if(count($arr_post) > 0){
        DB::transaction(function() use($arr_post,$keterangan,$survey_id) {
          $insert = Masterjawaban::insert($arr_post);
          if($insert){
          
                $update = MasterFormPenilaianHeader::find($survey_id);
                $update->update([
                    'keterangan'=>$keterangan,
                    'status'=>'DONE'
                ]);
            
          }
        });
       }
    //    Cek Jika ada, maka status ==200
       $validasi_1 = Masterjawaban::where('form_id',$survey_id)->count();
       if($validasi_1 != 0){
            $status =200;
            $message ='Data berhasil disimpan';
       }
       return response()->json([
        'status'=>$status,
        'message'=>$message,
    ]);
    }
    public function report_survey_supplier($id)
    {
        $validasi_1 = MasterFormPenilaianHeader::where('id',$id)->count();
        if($validasi_1 == 0)
        {
            return "Supplier Tidak ada";
        }
        try {
            $resultNamePDF = 'report_survey_supplier'.date("YmdHis").'.pdf';

            // create file pdf
            $document = new PDF([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_header' => '5',
                'margin_top' => '5',
                'margin_bottom' => '5',
                'margin_footer' => '2',
                'margin_left' => '5',
                'margin_right' => '5',
            ]);
            $imageLogo = '<img src="'.public_path('icon.jpg').'" width="70px" style="float: right;"/>';
            $headers='';
            $headers .= '<table width="100%">
            <tr>
            <td style="padding-left:10px;"><span style="font-size: 16px; font-weight: bold;">PT PRALON</span><br><span style="font-size:9px;">Synergy Building #08-08
            Tangerang 15143 - Indonesia
            +62 21 304 38808</span></td>
            <td style="width:33%"></td>
                <td style="width: 50px; text-align:right;">'.$imageLogo.'</td>
            </tr>
             
        </table><br>';
        $document->WriteHTML($headers);
            // get data supplier
          
            $footer = '<table width="100%" style="font-size: 10px;">
            <tr>
             
                <td width="64%" align="center"></td>
                <td width="33%" style="text-align: right;">Halaman : {PAGENO}</td>
            </tr>
             </table>';
        
            // Set some header informations for output
            $header = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$resultNamePDF.'"',
                'Content-Transfer-Encoding' => 'binary',
                'Accept-Ranges' => 'bytes'
            ];

            // content
            // $document->SetDisplayMode('fullpage');
            $document->WriteHTML('<center><h4 style="text-align:center;">Form Survey (Evaluasi Supplier)</h4></center>');
            // $document->writeHTML('<br/>');
            $master_header = MasterFormPenilaianHeader::find($id);
            $master_aspek = DB::table('master_form_penilaians')->select('master_aspeks.name','master_aspeks.id as aspek_id')
                                ->join('master_pertanyaans','master_pertanyaans.id','=','master_form_penilaians.pertanyaan_id')
                                ->join('master_aspeks','master_aspeks.id','=','master_form_penilaians.aspek_id')
                                ->where('master_form_penilaians.form_id',$id)
                                ->groupBy('master_aspeks.name')
                                ->orderBy('master_pertanyaans.id', 'asc')
                                ->get();
            $document->simpleTables = true;
            $document->SetHTMLFooter($footer);
            $document->SetHTMLHeader($headers);
            $document->WriteHTML(view('suppliers.survey-supplier', [
              'master_header'=> $master_header,
              'master_aspek'=> $master_aspek,
            ]));
            // Save PDF on your public storage
            Storage::disk('public')->put($resultNamePDF, $document->Output($resultNamePDF, "S"));
            // dd($result);
            // Get file back from storage with the give header informations
            return Storage::disk('public')->download($resultNamePDF, 'Request', $header);


        } catch (\Mpdf\MpdfException $e) {
            // Process the exception, log, print etc.
            echo $e->getMessage();
        }
    }
    public function report_evaluasi_supplier($id)
    {
        $validasi_1 = Suppliers::where('id',$id)->count();
        if($validasi_1 == 0)
        {
            return "Supplier Tidak ada";
        }
        try {
            $resultNamePDF = 'report_survey_supplier'.date("YmdHis").'.pdf';

            // create file pdf
            $document = new PDF([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_header' => '0',
                'margin_top' => '0',
                'margin_bottom' => '5',
                'margin_footer' => '2',
                'margin_left' => '5',
                'margin_right' => '5',
            ]);
            $imageLogo = '<img src="'.public_path('icon.jpg').'" width="70px" style="float: right;"/>';
            $headers='';
            $headers .= '<table width="100%">
            <tr>
            <td style="padding-left:10px;"><span style="font-size: 16px; font-weight: bold;">PT PRALON</span><br><span style="font-size:9px;">Synergy Building #08-08
            Tangerang 15143 - Indonesia
            +62 21 304 38808</span></td>
            <td style="width:33%"></td>
                <td style="width: 50px; text-align:right;">'.$imageLogo.'</td>
            </tr>
             
        </table><br>';
        $document->WriteHTML($headers);
            // get data supplier
            $footer = '<table width="100%" style="font-size: 10px;">
            <tr>
             
                <td width="64%" align="center"></td>
                <td width="33%" style="text-align: right;">Halaman : {PAGENO}</td>
            </tr>
             </table>';
            // Set some header informations for output
            $header = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$resultNamePDF.'"',
                'Content-Transfer-Encoding' => 'binary',
                'Accept-Ranges' => 'bytes'
            ];

            // content
            // $document->SetDisplayMode('fullpage');
            $document->WriteHTML('<center><h4 style="text-align:center;margin-top:-25px;">Form Evaluasi Suppleir</h4></center>');
            // $document->writeHTML('<br/>');
            $master_header = Suppliers::find($id);
            $master_aspek =DB::table('master_form_penilaians')
                            ->select('master_aspeks.name as aspek_name','master_aspeks.id as aspekId')
                            ->join('master_aspeks','master_aspeks.id','master_form_penilaians.aspek_id')
                            ->join('master_form_penilaian_headers','master_form_penilaian_headers.id','=','master_form_penilaians.form_id')
                            ->where('master_form_penilaian_headers.supplier_id',$id)
                            ->groupBy('master_aspeks.name')
                            ->orderBy('master_aspeks.id','asc')
                            ->get();
            $document->simpleTables = true;
            $document->SetHTMLFooter($footer);
            $document->SetHTMLHeader($headers);
            $document->WriteHTML(view('suppliers.evaluasi-supplier', [
              'master_header'=> $master_header,
              'master_aspek'=> $master_aspek,
              'tgl'=>FunctionHelper::tgl_indo(date('Y-m-d'))
            ]));
            // Save PDF on your public storage
            Storage::disk('public')->put($resultNamePDF, $document->Output($resultNamePDF, "S"));
            // dd($result);
            // Get file back from storage with the give header informations
            return Storage::disk('public')->download($resultNamePDF, 'Request', $header);


        } catch (\Mpdf\MpdfException $e) {
            // Process the exception, log, print etc.
            echo $e->getMessage();
        }
    }
}
