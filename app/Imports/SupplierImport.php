<?php

namespace App\Imports;

use App\Models\Bank;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class SupplierImport implements ToCollection
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
            // Validasi pertama, system akan mengecek db terlebih dahulu. Jika data sudah tercantum, maka data tidak akan di simpan dan sebaliknya. Jika data belum ada, maka akan diinsert.
            $validation_1 = Suppliers::where('supplierName', $row[0])->count();
            if($validation_1 == 0){
                $supplier =[
                    'userId'=>Auth::user()->id,
                    'supplierName'=>$row[0],
                    'supplierType'=>$row[1],
                    'supplierCategory'=>$row[2],
                    'supplieryearOfEstablishment'=>$row[3],
                    'supplierNumberOfEmployee'=>$row[4],
                    'penanggungJawab'=>$row[5],
                    'created_at'=>Date::excelToDateTimeObject($row[6])
                ];
            
                array_push($push_array, $supplier);
            }else{
                array_push($message, $row[0]);
            }
        }
        if(count($push_array) > 0){
            $insert = Suppliers::insert($push_array);
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
