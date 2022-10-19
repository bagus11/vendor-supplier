<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Models\Product;
use App\Models\CompanyAttachment;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ResponseFormatter;
use DataTables;
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
        // Array ISO
        $arr_iso = json_decode($_POST['arr_iso']);
        $push_iso = [];
        $numberBank = $request->numberBank;
        $bankName = $request->bankName;
        $termOfPayment = $request->termOfPayment;

        $supplierLast = Suppliers::orderby('created_at','desc')->first();
        $supplierID = $supplierLast->id + 1; 
        // Other Address
        // dd($arr_address);
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
        if($arr_iso)
        {
            foreach($arr_iso as $iso)
            {
                if($iso[1] ==0 && $iso[2]==0)
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
            'supplierYearOfEstablishment' => $request->supplierYearOfEstablishment,
            'supplierNumberOfEmployee' => $request->supplierNumberOfEmployee,
        ];
        $payment=[
            'bankId' => '1',
            'supplierId' =>$supplierID,
            'numberBank' => $numberBank,
            'termOfPayment' => $termOfPayment,
        ];

        // store company attachment
        
        $fileNPWP = $request->file('npwp_attachment')->getClientOriginalName();
        $filePKP = $request->file('pengukuhan_attachment')->getClientOriginalName();
        $fileRegistrationCertificate = $request->file('skt_attachment')->getClientOriginalName();
        $fileCompanyProfile = $request->file('cp_attachment')->getClientOriginalName();

        $pathNPWP = $request->file('npwp_attachment')->store('public/npwp');
        $pathSIUP = $request->file('pengukuhan_attachment')->store('public/siup');
        $pathRegistrationCertificate = $request->file('skt_attachment')->store('public/registrationCertificate');
        $pathCompanyProfile = $request->file('cp_attachment')->store('public/companyProfile');

        $companyAttachment =[
            'numberPKP' => $request->numberPKP,
            'numberNPWP' => $request->numberNPWP,
            'nameNPWP' => $request->nameNPWP,
            'addressNPWP' => $request->addressNPWP,
            'fileNPWP' => $pathNPWP,
            'filePKP' => $filePKP,
            'fileRegistrationCertificate' => $pathRegistrationCertificate,
            'fileCompanyProfile' => $pathCompanyProfile,
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
            'supplierCategory' => 'required',
            'supplierYearOfEstablishment' => 'required',
            'supplierNumberOfEmployee' => 'required',
            
            // master supplier address
            'address' => 'required|array',
            'address.*.supplierAddress' => 'required',
            'address.*.flagMainAddress' => 'required',
            'address.*.supplierPhone' => 'required|numeric|phone_number|size:13',
            'address.*.supplierEmail' => 'email',
            'address.*.supplierWebsite' => 'required',
            'address.*.supplierFax' => 'required',
            'address.*.supplierProvince' => 'required',
            'address.*.supplierCity' => 'required',
            'address.*.supplierDistricts' => 'required',
            'address.*.supplierVillage' => 'required',
            'address.*.supplierPostalCode' => 'required',
            'address.*.supplierAddressType' => 'required',
            
            // master PIC
            'pic' => 'required|array',
            'pic.*picName' => 'required',
            'pic.*picDepartement' => 'required',
            'pic.*picPhone' => 'required|numeric|phone_number|size:13',
            'pic.*picEmail' => 'email',
            
            // company attachment
            'numberPKP' => 'required',
            'numberNPWP' => 'required|string',
            'nameNPWP' => 'required',
            'addressNPWP' => 'required',
            'fileNPWP' => 'required|mimes:pdf,png,jpg,jpeg|max:21000',
            'filePKP' => 'required|mimes:pdf,png,jpg,jpeg|max:21000',
            'fileRegistrationCertificate' => 'required|mimes:pdf,png,jpg,jpeg|max:21000',
            'fileCompanyProfile' => 'required|mimes:pdf,png,jpg,jpeg|max:21000',
            
            // iso supplier
            'iso' => 'required|array',
            'iso.*.id' => 'exists:iso_suppliers,id',
            'iso.*.applied' => 'required',
            'iso.*.certified' => 'required',
            
            // payment supplier
            'bankId' => 'required',
            'numberBank' => 'required',
            'termOfPayment' => 'required|numeric',
        ]);

        if($validator->fails()){
        return response()->json([
            'message'=>$validator->errors(), 
            'status'=>422
        ]);
        }else{

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

            });
        }

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
        return response()->json([
            'supplierDetail'=>$supplier,
            'otherAdress'=>$otherAdress,
            'iso'=>$iso,
            'pic'=>$pic
        ]);
    }
}
