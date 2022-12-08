<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Models\Product;
use App\Models\CompanyAttachment;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ResponseFormatter;
use DataTables;
use App\Helpers\FunctionHelper;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\Districts;
use App\Models\IsoMaster;
use App\Models\IsoSupplier;
use App\Models\Payment;
use App\Models\Pic;
use App\Models\SupplierAddress;
use App\Models\Villages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use \Mpdf\Mpdf as PDF;


class SupplierDataController extends Controller
{

    public function get_regency(Request $request)
    {
        $province = $request->prov;
        $regency = Regencies::where('provinsi_id', $province)->get();
        return response()->json(['regency'=>$regency]);
    }
    public function get_district(Request $request)
    {
        $kab = $request->regency_id;
        $district = Districts::where('kabkot_id', $kab)->get();
        return response()->json(['district'=>$district]);
    }
    public function get_village(Request $request)
    {
        $kec = $request->district_id;
        $village = Villages::where('kecamatan_id', $kec)->get();
        return response()->json(['village'=>$village]);
    }
    public function get_kdpos(Request $request)
    {
        $id_kel = $request->kel_id;
        $kel = Villages::findOrFail($id_kel);
        return response()->json(['kel'=>$kel]);
    }
    public function post_supplier(Request $request)
    {
        $supplierProvince = $request->supplierProvince;
        $supplierCity = $request->supplierCity;
        $supplierDistricts = $request->supplierDistricts;
        $supplierVillage = $request->supplierVillage;
        $supplierPostalCode = $request->supplierPostalCode;
        $supplierAddress = $request->supplierAddress;
        $supplierPhone = $request->supplierPhone;
        $supplierFax = $request->supplierFax;
        $supplierEmail = $request->supplierEmail;
        $supplierWebsite = $request->supplierWebsite;

        // Array Address 
        $arr_address = json_decode($_POST['arr_address']);
        $push_address = [];
        // $message_address =[];
        
        // Array PIC
        $arr_pic =json_decode($_POST['arr_pic']); 
        $push_pic = [];
        
        $numberPKP = $request->numberPKP;
        $numberNPWP = $request->numberNPWP;
        $nameNPWP = $request->nameNPWP;
        $addressNPWP = $request->addressNPWP;
        $metode = $request->metode;
        // Array ISO
        $arr_iso = json_decode($_POST['arr_iso']);
        $push_iso = [];
        $numberBank = $request->numberBank;
        $bankName = $request->bankName;
        $termOfPayment = $request->termOfPayment;

        $supplierLast = Suppliers::orderby('id','desc')->first();
        $supplierID = $supplierLast!=null? $supplierLast->id + 1: 1; 

        // Array Alamat
        // $jenis_alamat_lain = $request->jenis_alamat_lain;
        // $alamat_lain = json_decode($_POST['alamat_lain']);
        // $no_telp_lain = json_decode($_POST['no_telp_lain']);
        // $supplierFax_lain = json_decode($_POST['supplierFax_lain']);
        // $email_lain = json_decode($_POST['email_lain']);
        // $website_lain = json_decode($_POST['website_lain']);

       

        // Other Address
        if($arr_address)
        {
            foreach($arr_address as $address)
            {
                if($address[0]==''&& $address[1]=='' && $address[2] && $address[3] && $address[4] == '' && $address[5] =='')
                {
    
                }else{
                    $address_array=[
                        'supplierId' => $supplierID,
                        'supplierAddress' => $address[0],
                        'supplierAddressType' => $address[1],
                        'supplierPhone' => $address[2],
                        'supplierFax' => $address[3],
                        'supplierEmail' => $address[4],
                        'supplierWebsite' => $address[5],
                        'flagMainAddress' => '2',
                        'created_at'=>date('Y-m-d H:i:s')
                    ];
                    array_push($push_address, $address_array);
                }
            }
        }
        // PIC Contact
        if($arr_pic)
        {
            foreach($arr_pic as $pic)
            {
                if($pic[0]=='' && $pic[1]=='' && $pic[2] && $pic[3]=='')
                {
    
                }else{
                    $pic_array=[
                        'supplierId' => $supplierID,
                        'picDepartement' => $pic[0],
                        'picName' => $pic[1],
                        'picPhone' => $pic[2],
                        'picEmail' => $pic[3],
                        'created_at'=>date('Y-m-d H:i:s')
                    ];
                    array_push($push_pic, $pic_array);
                }
            }
        }

        // Array ISO
        $iso_array=[];
      
        if($arr_iso)
        {
            foreach($arr_iso as $iso)
            {
                if($iso==[])
                {
    
                }else{
                    $iso_array=[
                        'isoId' => $iso[0],
                        'supplierId' =>$supplierID,
                        'applied' => $iso[1],
                        'certified' => $iso[2],
                        'created_at'=>date('Y-m-d H:i:s')
                    ];
                 
                    array_push($push_iso, $iso_array);
                }
            }
        }
        $supplier=[
            'supplierName' => $request->supplierName,
            'supplierType' => $request->supplierType,
            'supplierCategory' => 'PKP',
            'userId' => Auth::user()->id,
            'penanggungJawab' => $request->penanggung_jawab,
            'supplierYearOfEstablishment' => $request->supplierYearOfEstablishment,
            'supplierNumberOfEmployee' => $request->supplierNumberOfEmployee,
        ];
        $payment=[
            'bankId' => $metode ==1?'0':$bankName,
            'supplierId' =>$supplierID,
            'numberBank' => $metode ==1 ?'0':$numberBank ,
            'termOfPayment' =>  $metode ==1 ?'0':$termOfPayment,
            'payment_type'=>$metode,
            'payment_status'=>'LUNAS'
        ];

       

        //    $companyAttachment=[];
        $supplier_address=[
            'supplierId' => $supplierID,
            'supplierAddress' => $supplierAddress,
            'flagMainAddress' =>'1',
            'supplierPhone' => $supplierPhone,
            'supplierEmail' => $supplierEmail,
            'supplierWebsite' => $supplierWebsite,
            'supplierFax' => $supplierFax,
            'supplierProvince' => $supplierProvince,
            'supplierCity' => $supplierCity,
            'supplierDistricts' => $supplierDistricts,
            'supplierVillage' => $supplierVillage,
            'supplierPostalCode' => $supplierPostalCode,
            'supplierAddressType' => 'HO',
        ];

        $validator = Validator::make($request->all(), [
            // master supplier
            'supplierName' => 'required',
            'supplierType' => 'required',
            // 'supplierCategory' => 'required',
            'supplierYearOfEstablishment' => 'required',
            'supplierNumberOfEmployee' => 'required',
            // Address
            'supplierAddress'=>'required',
            'supplierPhone'=>'required',
            'supplierEmail'=>'required',
            'supplierWebsite'=>'required',
            'supplierFax'=>'required',

            // company attachment
            'numberPKP' => 'required',
            'numberNPWP' => 'required|string',
            'nameNPWP' => 'required',
            'addressNPWP' => 'required',
            'npwp_attachment' => 'required|mimes:pdf,png,jpg,jpeg|max:10000',
            'pengukuhan_attachment' => 'required|mimes:pdf,png,jpg,jpeg|max:10000',
            'skt_attachment' => 'required|mimes:pdf,png,jpg,jpeg|max:10000',
            'cp_attachment' => 'required|mimes:pdf,png,jpg,jpeg|max:10000',
            'penanggung_jawab'=>'required'
            // payment supplier
            // 'numberBank' => 'required',
            // 'bankName' => 'required',
            // 'termOfPayment' => 'required|numeric',
        ],[
            'supplierName.required'=>'Nama supplier tidak boleh kosong',
            'supplierType.required'=>'Jenis usaha tidak boleh kosong',
            'supplierYearOfEstablishment.required'=>'Tahun pendirian tidak boleh kosong',
            'supplierNumberOfEmployee.required'=>'Jumlah karyawan tidak boleh kosong',
            'supplierNumberOfEmployee.required'=>'Jumlah karyawan tidak boleh kosong',
            'numberPKP.required'=>'No Pengukuhan tidak boleh kosong',
            'numberNPWP.required'=>'No NPWP tidak boleh kosong',
            'nameNPWP.required'=>'Nama NPWP tidak boleh kosong',
            'addressNPWP.required'=>'Alamat NPWP tidak boleh kosong',
            'penanggung_jawab.required'=>'Penanggung Jawab tidak boleh kosong',
            // Address
            'supplierAddress.required'=>'Alamat Utama tidak boleh kosong',
            'supplierPhone.required'=>'No HP tidak boleh kosong',
            'supplierFax.required'=>'Fax tidak boleh kosong',
            'supplierEmail.required'=>'Email tidak boleh kosong',
            'supplierWebsite.required'=>'Website tidak boleh kosong',
            
            // Attachment
            'npwp_attachment.required'=>'NPWP Attachment tidak boleh kosong',
            'npwp_attachment.mimes'=>'File NPWP harus berupa format : PDF,PNG,JPG,JPEG',
            'npwp_attachment.max'=>'File NPWP max 21MB',

            'pengukuhan_attachment.required'=>'File PKP tidak boleh kosong',
            'pengukuhan_attachment.mimes'=>'File PKP harus berupa format : PDF,PNG,JPG,JPEG',
            'pengukuhan_attachment.max'=>'File PKP max 21MB',

            'skt_attachment.required'=>'File Surat Keterangan Terdaftar tidak boleh kosong',
            'skt_attachment.mimes'=>'File Surat Keterangan Terdaftar harus berupa format : PDF,PNG,JPG,JPEG',
            'skt_attachment.max'=>'File Surat Keterangan Terdaftar max 21MB',

            'cp_attachment.required'=>'File Company Profile tidak boleh kosong',
            'cp_attachment.mimes'=>'File Company Profile harus berupa format : PDF,PNG,JPG,JPEG',
            'cp_attachment.max'=>'File Company Profile max 21MB',

            // 'numberBank.required'=>'No Rekening tidak boleh kosong',
            // 'bankName.required'=>'Nama Bank tidak boleh kosong',
            // 'termOfPayment.required'=>'Jangka Waktu Pembayaran tidak boleh kosong',


        ]);

        // $validasi_array = Validator::make($request->arr_address,[
        //     'no_telp_lain.*'=>'required|number',

        // ]);

        if($validator->fails()){
        return response()->json([
            'message'=>$validator->errors(), 
            'status'=>422
        ]);
        }else{
         // store company attachment
            $fileNPWP_ext = $request->file('npwp_attachment')->getClientOriginalExtension(); 
            $fileNPWP = $request->file('npwp_attachment')->storeAs('NPWP_'.$supplierID.'.'.$fileNPWP_ext,'');
            
            $filePKP_ext = $request->file('pengukuhan_attachment')->getClientOriginalExtension(); 
            $filePKP = $request->file('pengukuhan_attachment')->storeAs('Pengukuhan_'.$supplierID.'.'.$filePKP_ext,'');
            
            $fileRegistrationCertificatefilePKP_ext = $request->file('skt_attachment')->getClientOriginalExtension(); 
            $fileRegistrationCertificate = $request->file('skt_attachment')->storeAs('SKT_'.$supplierID.'.'.$fileRegistrationCertificatefilePKP_ext,'');
            $fileCompanyProfile_ext = $request->file('cp_attachment')->getClientOriginalExtension(); 
            $fileCompanyProfile = $request->file('cp_attachment')->storeAs('CP_'.$supplierID.'.'.$fileCompanyProfile_ext,'');

            $pathNPWP = $request->file('npwp_attachment')->store('public/npwp');
            $pathSIUP = $request->file('pengukuhan_attachment')->store('public/siup');
            $pathRegistrationCertificate = $request->file('skt_attachment')->store('public/registrationCertificate');
            $pathCompanyProfile = $request->file('cp_attachment')->store('public/companyProfile');

            $companyAttachment =[
                'numberPKP' => $request->numberPKP,
                'numberNPWP' => $request->numberNPWP,
                'nameNPWP' => $request->nameNPWP,
                'supplierId' => $supplierID,
                'addressNPWP' => $request->addressNPWP,
                'fileNPWP' => $fileNPWP,
                'filePKP' => $filePKP,
                'fileRegistrationCertificate' => $fileRegistrationCertificate,
                'fileCompanyProfile' => $fileCompanyProfile,
            ];
          
            DB::transaction(function() use ($push_iso,$push_pic,$push_address,$supplier,$payment,$companyAttachment,$supplier_address){
                // Main Address
            SupplierAddress::create($supplier_address); 
            if(count($push_iso) > 0)
                {
                    IsoSupplier::insert($push_iso);
                }
                if(count($push_pic) > 0)
                {
                    Pic::insert($push_pic);
                }
                if(count($push_address) > 0)
                {
                    SupplierAddress::insert($push_address);
                }
                // Suppllier 
                Suppliers::create($supplier);
                // Payment
                Payment::create($payment);
                // Company Attachment
                CompanyAttachment::create($companyAttachment);
                
                // call function sending email
                $this->sendMail($supplier_address, $supplier);
            });
        }
        
        return response()->json([
            'message'=>'Data berhasil disimpan', 
            'status'=>200,
            'other_address'=>$push_address,
            'push_iso'=>$push_iso,
            'push_pic'=>$push_pic,
            'MainSupplier'=>$supplier,
            'Payment'=>$payment,
        ]);

    }
    public function supplierDetail(Request $request)
    {
        $supplier = DB::table('suppliers')
        ->join('supplier_addresses', 'suppliers.id', '=', 'supplier_addresses.supplierId')
        ->join('tbl_provinsi', 'supplier_addresses.supplierProvince', '=', 'tbl_provinsi.id')
        ->join('tbl_kabkot', 'supplier_addresses.supplierCity', '=', 'tbl_kabkot.id')
        ->join('tbl_kecamatan', 'supplier_addresses.supplierDistricts', '=', 'tbl_kecamatan.id')
        ->join('tbl_kelurahan', 'supplier_addresses.supplierVillage', '=', 'tbl_kelurahan.id')
        ->join('payments', 'suppliers.id', '=', 'payments.supplierId')
        ->join('banks', 'banks.id', '=', 'payments.bankId')
        ->select('suppliers.*', 'supplier_addresses.supplierAddress', 'supplier_addresses.flagMainAddress', 'supplier_addresses.supplierPhone', 'supplier_addresses.supplierEmail', 'supplier_addresses.supplierWebsite', 'supplier_addresses.supplierFax', 'supplier_addresses.supplierPostalCode', 'supplier_addresses.supplierAddressType', 'tbl_provinsi.provinsi as province_name', 'tbl_kabkot.kabupaten_kota as regency_name', 'tbl_kecamatan.kecamatan as district_name', 'tbl_kelurahan.kelurahan as village_name', 'payments.numberBank', 'payments.termOfPayment', 'banks.nameBank')
        // ->select('*')
        ->where('suppliers.id', $request->id)
        ->where('supplier_addresses.flagMainAddress', 1)
        ->get();

        $pic = Pic::where('supplierId', $request->id)->get();
        $otherAdress = SupplierAddress::
        where('supplierId', $request->id)
        ->where('flagMainAddress', 2)
        ->get();
        $iso = DB::table('iso_suppliers')
                ->join('iso_masters', 'iso_masters.id','=','iso_suppliers.isoId')
                ->select('iso_suppliers.applied','iso_suppliers.certified','iso_masters.iso')
                ->where('iso_suppliers.supplierId',$request->id)->get();

        $attachment = CompanyAttachment::where('supplierId', $request->id)->get();
        return response()->json([
            'supplierDetail'=>$supplier,
            'otherAdress'=>$otherAdress,
            'attachment'=>$attachment,
            'iso'=>$iso,
            'pic'=>$pic
        ]);
    }

    public function sendMail($supplier_address, $supplier)
    {
        $emails = [
         'bagus.slamet@pralon.com'
        ];
        $data=[
            'supplier'=>$supplier,
            'supplier_address'=>$supplier_address
        ];
        $message = view('email.mail',$data);
        $mailData = [
            'title' => 'Penambahan Supplier Baru',
            'subject'=>$message,
            'footer' => 'Email otomatis dari PT.Pralon(ICT Division)'
        ];
        Mail::to($emails)
        ->cc('bagus.oetomo11@gmail.com')
        ->send(new SendMail($mailData));
    }

    public function reportSupplier(Request $request)
    {
        try {
            // require_once __DIR__ . '/vendor/autoload.php';
            // init set timer
            ini_set('max_execution_time', 1800);
            // filename
            // $resultNamePDF = 'report-suppier'.date('Y-m-d H:i:s').'pdf';
            $resultNamePDF = 'report-suppier.pdf';

            // create file pdf
            $document = new PDF([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_header' => '3',
                'margin_top' => '20',
                'margin_bottom' => '20',
                'margin_footer' => '2',
            ]);

            // get logo
            // $document->Image('public/logo.png', 0, 0, 210, 140, 'jpg', '', true, false);
            $imageLogo = '<img src="'.$_SERVER['DOCUMENT_ROOT'].'/logo.png" width="70px" style="float: right;"/>';
            $document->WriteHTML($imageLogo);
            $document->WriteHTML('<br>');
            $document->WriteHTML('<br>');
            // get data supplier
            $getSupplier = DB::table('suppliers')
            ->join('supplier_addresses', 'suppliers.id', '=', 'supplier_addresses.supplierId')
            ->join('tbl_provinsi', 'supplier_addresses.supplierProvince', '=', 'tbl_provinsi.id')
            ->join('tbl_kabkot', 'supplier_addresses.supplierCity', '=', 'tbl_kabkot.id')
            ->join('tbl_kecamatan', 'supplier_addresses.supplierDistricts', '=', 'tbl_kecamatan.id')
            ->join('tbl_kelurahan', 'supplier_addresses.supplierVillage', '=', 'tbl_kelurahan.id')
            ->join('payments', 'suppliers.id', '=', 'payments.supplierId')
            ->join('banks', 'banks.id', '=', 'payments.bankId')
            ->select('suppliers.*', 'supplier_addresses.supplierAddress', 'supplier_addresses.flagMainAddress', 'supplier_addresses.supplierPhone', 'supplier_addresses.supplierEmail', 'supplier_addresses.supplierWebsite', 'supplier_addresses.supplierFax', 'supplier_addresses.supplierPostalCode', 'supplier_addresses.supplierAddressType', 'tbl_provinsi.provinsi as province_name', 'tbl_kabkot.kabupaten_kota as regency_name', 'tbl_kecamatan.kecamatan as district_name', 'tbl_kelurahan.kelurahan as village_name','tbl_kelurahan.kd_pos as postal_code' ,'payments.numberBank', 'payments.termOfPayment', 'banks.nameBank')
            ->where('suppliers.id', $request->id)
            ->where('supplier_addresses.flagMainAddress', 1)
            ->get();
          
            // get data other address
            $otherAddresses = SupplierAddress::
            where('supplierId', $request->id)
            ->where('flagMainAddress', 2)
            ->get();

            // get data PIC
            $pics = Pic::where('supplierId', $request->id)->get();
            
            // get data ISO
            $iso = DB::table('iso_suppliers')
                ->join('iso_masters', 'iso_masters.id','=','iso_suppliers.isoId')
                ->select('iso_suppliers.applied','iso_suppliers.certified','iso_masters.iso')
                ->where('iso_suppliers.supplierId',$request->id)->get();

            // get company attachment
            $companyAttachment = CompanyAttachment::where('supplierId', $request->id)->get();
            
            // Set some header informations for output
            $header = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$resultNamePDF.'"',
                'Content-Transfer-Encoding' => 'binary',
                'Accept-Ranges' => 'bytes'
            ];

            // content
            $document->SetDisplayMode('fullpage');
          
            $document->WriteHTML('<center><h1 style="text-align:center">'.$getSupplier[0]->supplierName.'</h1></center>');
            $document->WriteHTML('<span>Email : '.$getSupplier[0]->supplierEmail.'</span>');
            $document->WriteHTML('<span>Phone : '.$getSupplier[0]->supplierPhone.'</span>');
            $document->WriteHTML('<span>Fax : '.$getSupplier[0]->supplierFax.'</span>');
            $document->WriteHTML('<span>Website : '.$getSupplier[0]->supplierWebsite.'</span>');
            $document->WriteHTML('<p>Alamat :</p>');
            $document->WriteHTML('<span>'.$getSupplier[0]->supplierAddress.', '.$getSupplier[0]->village_name.', '.$getSupplier[0]->district_name.', '.$getSupplier[0]->regency_name.', '.$getSupplier[0]->province_name.' - '.$getSupplier[0]->postal_code.'</span>');
            // $document->writeHTML('<br/>');
            $document->WriteHTML('<hr/>');
            
            $document->simpleTables = true;
            
            $document->WriteHTML(view('suppliers.supplier-report', [
                'otherAddresses' => $otherAddresses,
                'pics' => $pics,
                'isoes' => $iso,
                'companyAttachment' => $companyAttachment
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

    public function report_supplier($id){
        $validasi_1 = Suppliers::where('id',$id)->count();
        if($validasi_1 == 0)
        {
            return "Supplier Tidak ada";
        }

        try {
            // require_once __DIR__ . '/vendor/autoload.php';
            // init set timer
            // ini_set('max_execution_time', 1800);
            // filename
            // $resultNamePDF = 'report-suppier'.date('Y-m-d H:i:s').'pdf';
            $resultNamePDF = 'report-suppier.pdf';

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

            // get logo
            // $document->Image('public/logo.png', 0, 0, 210, 140, 'jpg', '', true, false);
            $imageLogo = '<img src="'.public_path('logo.png').'" width="70px" style="float: right;"/>';
            // $document->WriteHTML("
            // <table style='width:100%'>
            // <tr>
            //     <td style='width:90%'>
            //         <p style='font-size:9px'>PT Pralon <br>
            //     Synergy Building #08-08 <br>
            //     Tangerang 15143 - Indonesia<br>
            //     +62 21 304 38808<br>
            //     www.pralon.com</p>
            //     </td>
            //     <td style='float:right'>
            //     $imageLogo
            //     </td>
            // </tr>
            // </table>");
          
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
            $getSupplier = DB::table('suppliers')
            ->join('supplier_addresses', 'suppliers.id', '=', 'supplier_addresses.supplierId')
            ->join('tbl_provinsi', 'supplier_addresses.supplierProvince', '=', 'tbl_provinsi.id')
            ->join('tbl_kabkot', 'supplier_addresses.supplierCity', '=', 'tbl_kabkot.id')
            ->join('tbl_kecamatan', 'supplier_addresses.supplierDistricts', '=', 'tbl_kecamatan.id')
            ->join('tbl_kelurahan', 'supplier_addresses.supplierVillage', '=', 'tbl_kelurahan.id')
            ->join('payments', 'suppliers.id', '=', 'payments.supplierId')
            ->join('banks', 'banks.id', '=', 'payments.bankId')
            ->select('suppliers.*', 'supplier_addresses.supplierAddressType','supplier_addresses.supplierAddress', 'supplier_addresses.flagMainAddress', 'supplier_addresses.supplierPhone', 'supplier_addresses.supplierEmail', 'supplier_addresses.supplierWebsite', 'supplier_addresses.supplierFax', 'supplier_addresses.supplierPostalCode', 'supplier_addresses.supplierAddressType', 'tbl_provinsi.provinsi as province_name', 'tbl_kabkot.kabupaten_kota as regency_name', 'tbl_kecamatan.kecamatan as district_name', 'tbl_kelurahan.kelurahan as village_name','tbl_kelurahan.kd_pos as postal_code' ,'payments.numberBank', 'payments.termOfPayment', 'banks.nameBank','payments.payment_status', 'payments.payment_type')
            ->where('suppliers.id', $id)
            ->where('supplier_addresses.flagMainAddress', 1)
            ->get();
            $footer = '<table width="100%" style="font-size: 10px;">
            <tr>
             
                <td width="64%" align="center"></td>
                <td width="33%" style="text-align: right;">Halaman : {PAGENO}</td>
            </tr>
             </table>';
            // get data other address
            $otherAddresses = SupplierAddress::
            where('supplierId', $id)
            ->where('flagMainAddress', 2)
            ->get();

            // get data PIC
            $pics = Pic::where('supplierId', $id)->get();
            
            // get data ISO
            $iso = DB::table('iso_suppliers')
                ->join('iso_masters', 'iso_masters.id','=','iso_suppliers.isoId')
                ->select('iso_suppliers.applied','iso_suppliers.certified','iso_masters.iso')
                ->where('iso_suppliers.supplierId',$id)->get();

            // get company attachment
            $companyAttachment = CompanyAttachment::where('supplierId', $id)->get();
            $payment = DB::table('payments')
                        ->join('banks', 'banks.id','=','payments.bankId')
                        ->select('payments.*', 'banks.nameBank')
                        ->where('payments.supplierId', $id)->get();
            // Set some header informations for output
            $header = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$resultNamePDF.'"',
                'Content-Transfer-Encoding' => 'binary',
                'Accept-Ranges' => 'bytes'
            ];

            // content
            // $document->SetDisplayMode('fullpage');
            $document->WriteHTML('<center><h4 style="text-align:center;text-decoration: underline; ">Form Data Penyedia Eksternal</h4></center>');
            // $document->writeHTML('<br/>');

            
            $document->simpleTables = true;
            $document->SetHTMLFooter($footer);
            $document->SetHTMLHeader($headers);
            $document->WriteHTML(view('suppliers.supplier-report', [
                'otherAddresses' => $otherAddresses,
                'pics' => $pics,
                'isoes' => $iso,
                'getSupplier'=>$getSupplier,
                'payment'=>$payment,
                'tgl'=>FunctionHelper::tgl_indo(date('Y-m-d')),
                'companyAttachment' => $companyAttachment
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
