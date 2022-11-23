<?php

namespace App\Imports;

use App\Models\IsoMaster;
use App\Models\IsoSupplier;
use App\Models\Pic;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class SupplierISOImport implements ToCollection
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
        $supplierISO=[];
        $push_array =[];
        $data=[];
        $status =500;
      
        foreach($rows as $row){
            // Validasi SupplierName
            $validasi_pertama = Suppliers::where('supplierName', $row[0])->count();
            if($validasi_pertama == 1){
                //   Validasi master ISO, memastikan ISO sudah terdaftar di table master ISO
                $validasi_1 = IsoMaster::where('ISO', $row[1])->count();
                if($validasi_1 == 1){
                    // Get ID ISO by ISO Name
                    $isoId = IsoMaster::where('ISO',$row[1])->pluck('id');
                    // Get ID Supplier
                    $supplier_id = Suppliers::where('supplierName',$row[0])->pluck('id');
                    // Validasi berdasarkan Nama, jika ada maka akan diinser
                    $validasi_2 = Suppliers::where('supplierName', $row[0])->count();
                    if($validasi_2 == 1){
                        // Validasi jika data sudah ada, maka tidak di insert
                        $validasi_3 = IsoSupplier::where('isoId', $isoId[0])->where('supplierId', $supplier_id[0])->count();
                        if($validasi_3 == 0){
                            $supplierISO =[
                                'isoId'=>$isoId[0],
                                'supplierId'=>$supplier_id[0],
                                'applied'=>$row[2],
                                'certified'=>$row[3],
                                'created_at'=>Date::excelToDateTimeObject($row[4])
                            ];
                            array_push($push_array, $supplierISO);
                        }else{
                            array_push($message,"$row[0], ISO : $row[1] sudah terdaftar");
                        }
                    }else{
                        array_push($message,"$row[0] belum terdaftar");
                    }

                }else{
                    array_push($message,"ISO : $row[1] belum terdaftar di table master ICT, harap hubungi team ICT");
                }
            }else{
                array_push($message, "$row[0] belum terdaftar");
            }
            
        }
        
        if(count($push_array) > 0){
            $insert = IsoSupplier::insert($push_array);
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
