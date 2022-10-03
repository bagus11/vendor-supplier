<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Models\Product;
use App\Models\CompanyAttachment;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ResponseFormatter;
use DataTables;

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
                $btn = '<a href="javascript:void(0)" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 mb-4 rounded">View</a>';
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
        return view('suppliers.supplier-create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplierName' => 'required',
            'supplierPhone' => 'numeric',
            'supplierEmail' => 'email|unique:suppliers',
            'supplierWebsite' => 'required',
            'supplierFax' => 'required',
            'supplierType' => 'required',
            'supplierProvince' => 'required',
            'supplierCity' => 'required',
            'supplierDistricts' => 'required',
            'supplierWard' => 'required',
            'supplierMainAddress' => 'required',
            'supplierCategory' => 'required',
            'supplierCategory' => 'required',
            // company attachment
            'numberPKP' => 'required',
            'numberNPWP' => 'required',
            'nameNPWP' => 'required',
            'nameNPWP' => 'required',
            'addressNPWP' => 'required',
            'fileNPWP' => 'required|pdf|max:4096',
            'filePKP' => 'required|pdf|max:4096',
            'fileRegistrationCertificate' => 'required|pdf|max:10000',
        ]);
        if($validated) {
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

            $pathNPWP = $request->file('fileNPWP')->store('public/files');
            $pathPKP = $request->file('filePKP')->store('public/files');
            $pathFileRegistrationCertificate = $request->file('fileRegistrationCertificate')->store('public/files');

            $companyAttachment = CompanyAttachment::create([
                'supplierId' => $suppliers->id,
                'numberPKP' => $request->numberPKP,
                'numberNPWP' => $request->numberNPWP,
                'nameNPWP' => $request->nameNPWP,
                'addressNPWP' => $request->addressNPWP,
                'fileNPWP' => $pathNPWP,
                'filePKP' => $pathPKP,
                'fileRegistrationCertificate' => $pathFileRegistrationCertificate,
            ]);
            array_push($result, $suppliers, $companyAttachment);
            if ($result != NULL) {
                # code...
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
        //
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
