<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Models\Product;
use App\Models\Provinces;
use App\Models\IsoMaster;
use App\Models\CompanyAttachment;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ResponseFormatter;
use DataTables;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Suppliers::all();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="show text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 editPost">Edit</a>';
                
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-url="'.route('suppliers.show', $row->id).'" data-original-title="Edit" class="show text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 editPost">Edit</a>';

                return $btn;
            })->rawColumns(['action'])->make(true);
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
        return view('suppliers.supplier-create', 
        [
            'products' => $products,
            'provinces' => $provinces,
            'master_iso' => $master_iso,
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
        $data = $request->validate([
            'supplierName' => 'required',
            'supplierType' => 'required',
            'supplierCategory' => 'required',
            'supplierYearOfEstablishment' => 'required',
            'supplierNumberOfEmployee' => 'required',

            'supplierPhone' => 'numeric',
            'supplierEmail' => 'email|unique:suppliers',
            'supplierWebsite' => 'required',
            'supplierFax' => 'required',
            'supplierProvince' => 'required',
            'supplierCity' => 'required',
            'supplierDistricts' => 'required',
            'supplierWard' => 'required',
            'supplierMainAddress' => 'required',
            'supplierCategory' => 'required',
            
            // company attachment
            'numberPKP' => 'required',
            'numberNPWP' => 'required',
            'nameNPWP' => 'required',
            'addressNPWP' => 'required',
            'fileNPWP' => 'required|mimes:pdf|max:10000',
            'filePKP' => 'required|mimes:pdf|max:10000',
            'fileRegistrationCertificate' => 'required|mimes:pdf|max:10000',
            'fileCompanyProfile' => 'required|pdf|max:10000',
        ]);

        if($data) {
            $result = [];
            $suppliers = Suppliers::create([
                'supplierName' => $request->supplierName,
                'supplierPhone' => $request->supplierPhone,
                'supplierEmail' => $request->supplierEmail,
                'supplierWebsite' => $request->supplierWebsite,
                'supplierFax' => $request->supplierFax,
                'supplierType' => $request->supplierType,
                'supplierProvince' => $request->supplierProvince,
                'supplierCity' => $request->supplierCity,
                'supplierDistricts' => $request->supplierDistricts,
                'supplierWard' => $request->supplierWard,
                'supplierMainAddress' => $request->supplierMainAddress,
                'supplierOtherAddress' => $request->supplierOtherAddress,
                'supplierPostalCode' => $request->supplierPostalCode,
                'supplierCategory' => $request->supplierCategory,
            ]);

            $fileNPWP = $request->file('fileNPWP')->getClientOriginalName();
            $filePKP = $request->file('filePKP')->getClientOriginalName();
            $fileRegistrationCertificate = $request->file('fileRegistrationCertificate')->getClientOriginalName();
            $fileCompanyProfile = $request->file('fileCompanyProfile')->getClientOriginalName();

            $pathNPWP = $request->file('fileNPWP')->store('public/npwp');
            $pathSIUP = $request->file('filePKP')->store('public/siup');
            $pathRegistrationCertificate = $request->file('fileRegistrationCertificate')->store('public/registrationCertificate');
            $pathCompanyProfile = $request->file('fileCompanyProfile')->store('public/companyProfile');

            $companyAttachment = CompanyAttachment::create([
                'supplierId' => $suppliers->id,
                'numberPKP' => $request->numberPKP,
                'numberNPWP' => $request->numberNPWP,
                'nameNPWP' => $request->nameNPWP,
                'addressNPWP' => $request->addressNPWP,
                'fileNPWP' => $pathNPWP,
                'filePKP' => $pathPKP,
                'fileRegistrationCertificate' => $pathRegistrationCertificate,
                'fileCompanyProfile' => $pathCompanyProfile,
            ]);

            array_push($result, $suppliers, $companyAttachment);
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
        $supplier = Suppliers::with([
            'CompanyAttachment'
        ])
        // ->where('id', $id)->get();
        ->findOrFail($id);
        // dd($supplier);
        return response()->json($supplier);
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
