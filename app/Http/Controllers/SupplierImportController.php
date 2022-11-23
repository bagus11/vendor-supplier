<?php

namespace App\Http\Controllers;

use App\Imports\SupplierAddressImport;
use App\Imports\SupplierAttachment;
use App\Imports\SupplierImport;
use App\Imports\SupplierISOImport;
use App\Imports\SupplierPICImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class SupplierImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function index()
   {
    return view('suppliers.supplier_import');
   }
   public function import_supplier(Request $request){

    $validator = Validator::make($request->all(), [
        // master supplier
        'data_supplier' => 'required|mimes:xlsx,xls',
        'alamat_supplier' => 'required|mimes:xlsx,xls',
        'pic_supplier' => 'required|mimes:xlsx,xls',
        'iso_supplier' => 'required|mimes:xlsx,xls',
        'berkas_supplier' => 'required|mimes:xlsx,xls',
     
    ],[
        'data_supplier.required'=>'Data Supplier tidak boleh kosong',
        'data_supplier.mimes'=>'Data Supplier harus berupa format xlsx',
        'alamat_supplier.required'=>'Alamat Supplier tidak boleh kosong',
        'alamat_supplier.mimes'=>'Alamat Supplier harus berupa format xlsx',
        'pic_supplier.required'=>'PIC Supplier tidak boleh kosong',
        'pic_supplier.mimes'=>'PIC Supplier harus berupa format xlsx',
        'iso_supplier.required'=>'ISO Supplier tidak boleh kosong',
        'iso_supplier.mimes'=>'ISO Supplier harus berupa format xlsx',
        'berkas_supplier.required'=>'Berkas Supplier tidak boleh kosong',
        'berkas_supplier.mimes'=>'Berkas Supplier harus berupa format xlsx',
       
    ]);

    if($validator->fails()){
        return response()->json([
            'validate'=>$validator->errors(), 
            'status'=>422
        ]);
    }else{

        $supplier= new SupplierImport;
        Excel::import($supplier, $request->data_supplier);
        $supplierAddress= new SupplierAddressImport;
        Excel::import($supplierAddress, $request->alamat_supplier);
        $SupplierPICImport= new SupplierPICImport;
        Excel::import($SupplierPICImport, $request->pic_supplier);
        $SupplierISO= new SupplierISOImport;
        Excel::import($SupplierISO, $request->iso_supplier);
        
        $SupplierAttachment= new SupplierAttachment;
        Excel::import($SupplierAttachment, $request->berkas_supplier);
    
        $data_supplier= $supplier->data;
        $data_supplier_address= $supplierAddress->data;
        $data_supplier_pic= $SupplierPICImport->data;
        $data_supplier_iso= $SupplierISO->data;
        $data_supplier_attachment= $SupplierAttachment->data;
       
        for($i = 0; $i < count($data_supplier); $i++){
            $data =[
                'message_supplier'=>$data_supplier['message'],
                'data_supplier'=>$data_supplier['data'],
                'count_supplier'=>$data_supplier['count'],
                'status_supplier'=>$data_supplier['status'],

                'message_supplier_address'=>$data_supplier_address['message'],
                'data_supplier_address'=>$data_supplier_address['data'],
                'count_supplier_address'=>$data_supplier_address['count'],
                'status_supplier_address'=>$data_supplier_address['status'],
                
                'message_supplier_pic'=>$data_supplier_pic['message'],
                'data_supplier_pic'=>$data_supplier_pic['data'],
                'count_supplier_pic'=>$data_supplier_pic['count'],
                'status_supplier_pic'=>$data_supplier_pic['status'],

                'message_supplier_iso'=>$data_supplier_iso['message'],
                'data_supplier_iso'=>$data_supplier_iso['data'],
                'count_supplier_iso'=>$data_supplier_iso['count'],
                'status_supplier_iso'=>$data_supplier_iso['status'],

                'message_supplier_attachment'=>$data_supplier_attachment['message'],
                'data_supplier_attachment'=>$data_supplier_attachment['data'],
                'count_supplier_attachment'=>$data_supplier_attachment['count'],
                'status_supplier_attachment'=>$data_supplier_attachment['status'],
    
            ];
        }

        return response()->json($data);
    }
    }
}
