<?php

namespace App\Imports;

use App\Models\Pic;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class SupplierPICImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public $data;
    public function collection(Collection $rows)
    {
        unset($rows[0]);
        $message =[];
        $supplier=[];
        $push_array =[];
        $data=[];
        $status =500;
      
        foreach($rows as $row){
            // Validasi pertama, memastikan SupplierName sudah terdaftar di table utama
            $validasi_pertama = Suppliers::where('supplierName', $row[0])->count();
            if($validasi_pertama == 1)
            {
                // validasi berdasarkan Nama dan Departement
                $validasi_1 = Pic::where('picName', $row[2])->where('picDepartement', $row[1])->where('picPhone', $row[4])->count();
                if($validasi_1 == 0){
                    // Get SupplierID by Supplier Name
                    $supplier_id = Suppliers::where('supplierName', $row[0])->pluck('id');
                    $supplier=[
                        'supplierId'=>$supplier_id[0],
                        'picName'=>$row[2],
                        'picDepartement'=>$row[1],
                        'picPhone'=>$row[4],
                        'picEmail'=>$row[3],
                        'created_at'=>Date::excelToDateTimeObject($row[5])
                    ];
                    array_push($push_array, $supplier);
                }else{
                    array_push($message, "$row[0] : $row[2]");
                }
            }else{
                array_push($message, "Supplier dengan nama $row[0] tidak terdaftar");
            }  
        }
       
        if(count($push_array) > 0){
            $insert = Pic::insert($push_array);
            if($insert){
                $status=200;
            }
        }
        $data =[
            'message'=>$message,
            'data'=>$push_array,
            'count'=>count($push_array),
            'status'=>$status
        ];

        $this->data = $data;
    }
}
