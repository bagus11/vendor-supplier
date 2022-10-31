<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Models\SupplierAddress;
use App\Models\Pic;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Provinces;
use App\Models\IsoMaster;
use App\Models\CompanyAttachment;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ResponseFormatter;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Bank;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Http\Controllers\MailController;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
            public function __construct()
            {
                $this->middleware('auth');
            }
    public function index(Request $request)
    {
      
        if($request->ajax()) {
            // $data = DB::table('suppliers')
            // ->join('supplier_addresses','supplier_addresses.supplierId','=','suppliers.userId')
            // ->select('suppliers.supplierName','supplier_addresses.supplierPhone','supplier_addresses.supplierFax','supplier_addresses.supplierEmail','suppliers.id')
            // ->where('supplier_addresses.flagMainAddress',1)->get();
            
            // $data = Suppliers::with(['supplierAddress'])->whereHas('supplierAddress', function($query){
            //     $query->where('flagMainAddress', 1);
            // });
            // $data = Suppliers::query();
            $data = SupplierAddress::with('supplier')->where('flagMainAddress', 1)->orderBy('supplierId','DESC');

            // dd($data);
            return DataTables::eloquent($data)
            ->addColumn('action', function($row){
                $btn = '<button class="editPost bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="'.$row->id.'" >
                Detail
              </button>';
                
                return $btn;
            })->toJson();
        }

        return view('suppliers.supplier-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $provinces = Provinces::all();
        $master_iso = IsoMaster::all();
        $master_bank = Bank::all();
        return view('suppliers.supplier-create', 
        [
            'products' => $products,
            'provinces' => $provinces,
            'master_iso' => $master_iso,
            'master_bank' => $master_bank,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataValidation = $request->validate([
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

        if($dataValidation) {
            $result = [];

            // store master supplier
            $suppliers = Suppliers::create([
                'userId' => Auth::user()->id,
                'supplierName' => $request->supplierName,
                'supplierType' => $request->supplierType,
                'supplierCategory' => $request->supplierCategory,
                'supplierYearOfEstablishment' => $request->supplierYearOfEstablishment,
                'supplierNumberOfEmployee' => $request->supplierNumberOfEmployee,
            ]);

            // store address supplier
            foreach ($request->address as $address) {
                $supplierAddress = SupplierAddress::create([
                    'supplierId' => Auth::user()->id,
                    'supplierAddress' => $address['supplierAddress'],
                    'flagMainAddress' => $address['flagMainAddress'],
                    'supplierPhone' => $address['supplierPhone'],
                    'supplierEmail' => $address['supplierEmail'],
                    'supplierWebsite' => $address['supplierWebsite'],
                    'supplierFax' => $address['supplierFax'],
                    'supplierProvince' => $address['supplierProvince'],
                    'supplierCity' => $address['supplierCity'],
                    'supplierDistricts' => $address['supplierDistricts'],
                    'supplierVillage' => $address['supplierVillage'],
                    'supplierPostalCode' => $address['supplierPostalCode'],
                    'supplierAddressType' => $address['supplierAddressType'],
                ]);
            }
            
            // store pic supplier
            foreach ($request->pic as $pic) {
                $pics = Pic::create([
                    'supplierId' => Auth::user()->id,
                    'picName' => $pic['picName'],
                    'picDepartement' => $pic['picDepartement'],
                    'picPhone' => $pic['picPhone'],
                    'picEmail' => $pic['picEmail'],
                ]);
            }

            // store company attachment
            $fileNPWP = $request->file('fileNPWP')->getClientOriginalName();
            $filePKP = $request->file('filePKP')->getClientOriginalName();
            $fileRegistrationCertificate = $request->file('fileRegistrationCertificate')->getClientOriginalName();
            $fileCompanyProfile = $request->file('fileCompanyProfile')->getClientOriginalName();

            $pathNPWP = $request->file('fileNPWP')->store('public/npwp');
            $pathSIUP = $request->file('filePKP')->store('public/siup');
            $pathRegistrationCertificate = $request->file('fileRegistrationCertificate')->store('public/registrationCertificate');
            $pathCompanyProfile = $request->file('fileCompanyProfile')->store('public/companyProfile');

            $companyAttachment = CompanyAttachment::create([
                'supplierId' => Auth::user()->id,
                'numberPKP' => $request->numberPKP,
                'numberNPWP' => $request->numberNPWP,
                'nameNPWP' => $request->nameNPWP,
                'addressNPWP' => $request->addressNPWP,
                'fileNPWP' => $pathNPWP,
                'filePKP' => $pathPKP,
                'fileRegistrationCertificate' => $pathRegistrationCertificate,
                'fileCompanyProfile' => $pathCompanyProfile,
            ]);

            // store iso supplier
            foreach ($request->iso as $iso) {
                $isoSupplier = IsoMaster::create([
                    'isoId' => $iso['id'],
                    'supplierId' => Auth::user()->id,
                    'applied' => $iso['applied'],
                    'certified' => $iso['certified'],
                ]);
            }

            $payment = payments::create([
                'bankId' => $request->bankId,
                'supplierId' => Auth::user()->id,
                'numberBank' => $request->numberBank,
                'termOfPayment' => $request->termOfPayment,
            ]);

            array_push($result, $suppliers, $supplierAddress, $pics, $companyAttachment, $isoSupplier, $payment);
            if ($result != NULL) {
                return ResponseFormatter::success(
                    $result,
                    'Vendor data saved successfully'
                );
            } else {
                return ResponseFormatter::error(
                    NULL,
                    'data is null',
                    404
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $supplier = Suppliers::with([
        //     'companyAttachment',
        //     'supplierAddress',
        //     'supplierPic',
        //     'supplierPayment'
        // ])
        // ->where('id', $id)->toJson();
        // ->findOrFail($id)->toJson();
        // dd($supplier);
        // $village = $supplier[0]->supplierAddress[0]->villages->name;
        
        
        $supplier = DB::table('suppliers')
        ->join('supplier_addresses', 'suppliers.id', '=', 'supplier_addresses.supplierId')
        ->join('tbl_provinsi', 'supplier_addresses.supplierProvince', '=', 'tbl_provinsi.id')
        ->join('tbl_kabkot', 'supplier_addresses.supplierCity', '=', 'tbl_kabkot.id')
        ->join('tbl_kecamatan', 'supplier_addresses.supplierDistricts', '=', 'tbl_kecamatan.id')
        ->join('tbl_kelurahan', 'supplier_addresses.supplierVillage', '=', 'tbl_kelurahan.id')
        ->join('payments', 'suppliers.id', '=', 'payments.supplierId')
        ->join('banks', 'banks.id', '=', 'payments.bankId')
        ->select('suppliers.*', 'supplier_addresses.supplierAddress', 'supplier_addresses.flagMainAddress', 'supplier_addresses.supplierPhone', 'supplier_addresses.supplierEmail', 'supplier_addresses.supplierWebsite', 'supplier_addresses.supplierFax', 'supplier_addresses.supplierPostalCode', 'supplier_addresses.supplierAddressType', 'tbl_provinsi.provinsi as province_name', 'tbl_kabkot.kabupaten_kota as regency_name', 'tbl_kecamatan.kecamatan as district_name', 'tbl_kelurahan.kelurahan as village_name', 'payments.numberBank', 'payments.termOfPayment', 'banks.nameBank')
        ->where('suppliers.id', $id)
        ->where('supplier_addresses.flagMainAddress', 1)
        ->get();

        (new MailController)->sendMail();

        return response()->json([
            'supplierDetail'=>$supplier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
