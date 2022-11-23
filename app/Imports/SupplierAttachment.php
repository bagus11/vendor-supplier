<?php

namespace App\Imports;

use App\Models\Bank;
use App\Models\CompanyAttachment;
use App\Models\Payment;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class SupplierAttachment implements ToCollection
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
        $supplier_payment=[];
        $push_array_payment=[];
       
        foreach($rows as $row){
          if($row[0] !=''){
            // Validasi pertama, memastikan SupplierName sudah terdaftar di table supplier
            $validasi_1 = Suppliers::where('supplierName', $row[0])->count();
            if($validasi_1 == 1){
                // Get ID Supplier berdasarkan SupplierName
                $supplier_id = Suppliers::where('supplierName', $row[0])->pluck('id');
                // Validasi kedua, memastikan supplier Id belum tercantum di table attachment
                $validasi_2 = CompanyAttachment::where('supplierId', $supplier_id[0])->count();
                if($validasi_2 == 0){
                    $supplier=[
                        'supplierId'=>$supplier_id[0],
                        'numberPKP'=>$row[1],
                        'numberNPWP'=>$row[2],
                        'nameNPWP'=>$row[3],
                        'addressNPWP'=>$row[4],
                        'fileNPWP'=>$row[5],
                        'filePKP'=>$row[6],
                        'fileRegistrationCertificate'=>$row[7],
                        'fileCompanyProfile'=>$row[8],
                        'created_at'=>Date::excelToDateTimeObject($row[9])
                    ];
                    //    Jika Tipe pembayaran == 2 
                        if($row[10] == 2){
                            $bank_id = Bank::where('nameBank', $row[11])->pluck('id');
                            $supplier_payment=[
                                'bankId'=>$bank_id[0],
                                'supplierId'=>$supplier_id[0],
                                'numberBank'=>$row[12],
                                'termOfPayment'=>$row[13],
                                'payment_status'=>$row[14],
                                'payment_type'=>$row[10],
                                'created_at'=>Date::excelToDateTimeObject($row[9])
                            ];
                        }else{
                            //    Jika Tipe pembayaran == 1 
                            $supplier_payment=[
                                'bankId'=>0,
                                'supplierId'=>$supplier_id[0],
                                'numberBank'=>'',
                                'termOfPayment'=>$row[13]==''?0:$row[13],
                                'payment_status'=>$row[14],
                                'payment_type'=>$row[10],
                                'created_at'=>Date::excelToDateTimeObject($row[9])
                            ];
                        }
                    array_push($push_array_payment, $supplier_payment);
                    array_push($push_array, $supplier);
                }else{
                    array_push($message, "Supplier sudah dicantumkan sebelumnya");
                }
            }else{
                array_push($message, "$row[0] belum terdaftar");
            }
          }
        }
     
        if(count($push_array) > 0){
            $insert = CompanyAttachment::insert($push_array);
            if($insert){
                $insert_payment = Payment::insert($push_array_payment);
                if($insert_payment){
                    $status=200;
                }
            }
        }
        $data =[
            'message'=>$message,
            'data'=>$push_array,
            'data_payment'=>$push_array_payment,
            'count'=>count($push_array),
            'status'=>$status
        ];
        $this->data = $data;
    }
}
