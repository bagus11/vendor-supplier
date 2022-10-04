<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Models\Product;
use App\Models\CompanyAttachment;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ResponseFormatter;
use DataTables;

class SupplierDataController extends Controller
{
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

    public function create()
    {
        $products = Product::all();
        return view('suppliers.supplier-create', ['products' => $products]);
    }

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

    public function show($id)
    {
        $supplier = Suppliers::findOrFail($id);

        return response()->json($supplier);
    }
}