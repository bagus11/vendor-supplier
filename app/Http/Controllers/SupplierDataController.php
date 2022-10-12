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
        $regency = Regencies::where('province_id', $province)->get();
        return response()->json(['regency'=>$regency]);
    }
    public function get_district(Request $request)
    {
        $kab = $request->regency_id;
        $district = Districts::where('regency_id', $kab)->get();
        return response()->json(['district'=>$district]);
    }
    public function get_village(Request $request)
    {
        $kec = $request->district_id;
        $village = Villages::where('district_id', $kec)->get();
        return response()->json(['village'=>$village]);
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
        $arr_address = $request->arr_address;
        $push_address = [];
        // $message_address =[];
        
        // Array PIC
        $arr_pic = $request->arr_pic;
        $push_pic = [];
        
        $numberPKP = $request->numberPKP;
        $numberNPWP = $request->numberNPWP;
        $nameNPWP = $request->nameNPWP;
        $addressNPWP = $request->addressNPWP;
        // Array ISO
        $arr_iso = $request->arr_iso;
        $push_iso = [];
        $numberBank = $request->numberBank;
        $bankName = $request->bankName;
        $termOfPayment = $request->termOfPayment;

        // Other Address
        if($arr_address)
        {
            foreach($arr_address as $address)
            {
                if($address[0]==''&& $address[1]=='' && $address[2] && $address[3] && $address[4] == '' && $address[5] =='')
                {
    
                }else{
                    $address_array=[
                        'supplierId' => Auth::user()->id,
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
                        'supplierId' => Auth::user()->id,
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
                        'supplierId' => Auth::user()->id,
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
            'supplierYearOfEstablishment' => $request->supplierYearOfEstablishment,
            'supplierNumberOfEmployee' => $request->supplierNumberOfEmployee,
        ];
        $payment=[
            'bankId' => $bankName,
            'supplierId' => Auth::user()->id,
            'numberBank' => $numberBank,
            'termOfPayment' => $termOfPayment,
        ];

            // store company attachment
                // $fileNPWP = $request->file('fileNPWP')->getClientOriginalName();
                // $filePKP = $request->file('filePKP')->getClientOriginalName();
                // $fileRegistrationCertificate = $request->file('fileRegistrationCertificate')->getClientOriginalName();
                // $fileCompanyProfile = $request->file('fileCompanyProfile')->getClientOriginalName();

                // $pathNPWP = $request->file('fileNPWP')->store('public/npwp');
                // $pathSIUP = $request->file('filePKP')->store('public/siup');
                // $pathRegistrationCertificate = $request->file('fileRegistrationCertificate')->store('public/registrationCertificate');
                // $pathCompanyProfile = $request->file('fileCompanyProfile')->store('public/companyProfile');

            // $companyAttachment =[
            //     'numberPKP' => $request->numberPKP,
            //     'numberNPWP' => $request->numberNPWP,
            //     'nameNPWP' => $request->nameNPWP,
            //     'addressNPWP' => $request->addressNPWP,
            //     'fileNPWP' => $pathNPWP,
            //     // 'filePKP' => $pathPKP,
            //     'fileRegistrationCertificate' => $pathRegistrationCertificate,
            //     'fileCompanyProfile' => $pathCompanyProfile,
            // ];
            $companyAttachment=[];

            $supplier_address=[
                'supplierId' => Auth::user()->id,
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
                'supplierYearOfEstablishment' => 'required',
                'supplierNumberOfEmployee' => 'required',
            ]);
    
          if($validator->fails()){
            return response()->json([
                'message'=>$validator->errors(), 
                'status'=>422
            ]);
          }else{

              // DB::transaction(function() use ($push_iso,$push_pic,$push_address,$supplier,$payment,$companyAttachment,$supplier_address){
              //     if(count($push_iso) > 0)
              //     {
              //         IsoSupplier::insert($push_iso);
              //     }
              //     if(count($push_pic) > 0)
              //     {
              //         Pic::insert($push_pic);
              //     }
              //     if(count($push_address) > 0)
              //     {
              //         SupplierAddress::insert($push_address);
              //     }
              //     // Suppllier 
              //     Suppliers::create($supplier);
              //     // Payment
              //     Payment::create($payment);
              //     // Company Attachment
                  
              //     // CompanyAttachment::create($companyAttachment);
      
              //     // Main Address
              //     SupplierAddress::create($supplier_address);
              // });
          }

    }
}
