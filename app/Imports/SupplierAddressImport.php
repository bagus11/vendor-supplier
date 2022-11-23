<?php

namespace App\Imports;

use App\Models\Districts;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\SupplierAddress;
use App\Models\Suppliers;
use App\Models\Villages;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class SupplierAddressImport implements ToCollection
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
        $supplierAddress=[];
        $push_array =[];
        $data=[];
        $status =500;
    
        foreach($rows as $row){

          if($row[0] !=''){
              // Validasi Pertama, memastikan bahwa supplier Name sudah terdaftar di table utama
              $validasi_pertama = Suppliers::where('supplierName', $row[0])->count();
              if($validasi_pertama == 1){
                  // Validasi pertama, memastikan semua unique berdasarkan alamat
                  $validasi_1 = SupplierAddress::where('supplierAddress', $row[7])->count();
                  if($validasi_1 == 0){
                      // Grouping Berdasarkan flg,
                      if($row[1] == 1){
                          // Validasi Provinsi berdasarkan Nama, Jika tidak sama. Maka tidak akan dimasukkan
                          $validasi_2 = Provinces::where('provinsi', $row[2])->count();
                          if($validasi_2 == 1){
                              // Validasi Kabupaten berdasarkan Nama, Jika tidak sama Maka data tidak akan dimasukkan
                              $validasi_3 = Regencies::where('kabupaten_kota', $row[3])->count();
                              if($validasi_3 == 1){
                                  // Validasi Kecamatan berdasarkan Nama, Jika nama tidak sama, Maka data tidak akan dimasukkan
                                  $validasi_4 = Districts::where('kecamatan', $row[4])->count();
                                  if($validasi_4 == 1){
                                      // Validasi Kelurahan berdasarkan Nama, Jika data tidak sama, Maka data tidak akan dimasukkan
                                      $validasi_5 = Villages::where('kelurahan', $row[5])->count();
                                      if($validasi_5 == 1){
                                          // Validasi jika kode pos tidak sama, maka data tidak akan dimasukkan
                                          $validasi_6 = Villages::where('kd_pos', $row[6])->count();
                                          if($validasi_6 == 0){
                                              array_push($message, "Supplier dengan nama $row[0], untuk alamat utama. Kode Pos tidak ditemukan");
                                          }else{
                                              // Get ID Supplier by SupplierName
                                              $supplier_id = Suppliers::where('supplierName',$row[0])->pluck('id');
                                              // Get ID Provinsi berdasarkan Nama
                                              $provinsi_id =Provinces::where('provinsi', $row[2])->pluck('id');
                                              // Get ID Kabupaten berdasarkan Nama
                                              $kabupaten_id =Regencies::where('kabupaten_kota', $row[3])->pluck('id');
                                              // Get ID Kecamataan berdasarkan Nama
                                              $kecamatan_id =Districts::where('kecamatan', $row[4])->pluck('id');
                                              // Get ID Kelurahan berdasarkan Nama
                                              $kelurahan_id =Villages::where('kelurahan', $row[5])->pluck('id');   
                                              $supplierAddress =[
                                                  'supplierId'=>$supplier_id[0],
                                                  'supplierAddress'=>$row[7],
                                                  'flagMainAddress'=>$row[1],
                                                  'supplierPhone'=>$row[8],
                                                  'supplierEmail'=>$row[10],
                                                  'supplierWebsite'=>$row[11],
                                                  'supplierFax'=>$row[9],
                                                  'supplierProvince'=>$provinsi_id[0],
                                                  'supplierCity'=>$kabupaten_id[0],
                                                  'supplierDistricts'=>$kecamatan_id[0],
                                                  'supplierVillage'=>$kelurahan_id[0],
                                                  'supplierPostalCode'=>$row[6],
                                                  'supplierAddressType'=>$row[12],
                                                  'created_at'=>Date::excelToDateTimeObject($row[13])
                                              ];
                                              array_push($push_array, $supplierAddress);
                                              
                                          }
                                      }else{
                                          array_push($message, "Supplier dengan nama $row[0], untuk alamat utama. Nama Kelurahan tidak ditemukan");
                                      }
                                  }else{
                                      array_push($message, "Supplier dengan nama $row[0], untuk alamat utama. Nama Kecamatan tidak ditemukan");
                                  }
                              }else{
                                  array_push($message, "Supplier dengan nama $row[0], untuk alamat utama. Nama Kabupaten tidak ditemukan");
                              }
                          }else{
                              array_push($message, "Supplier dengan nama $row[0], untuk alamat utama. Nama Provinsi tidak ditemukan");
                          }
                      }else if($row[1]==2){
                          $supplier_id = Suppliers::where('supplierName',$row[0])->pluck('id');
                          $supplierAddress =[
                              'supplierId'=>$supplier_id[0],
                                                  'supplierAddress'=>$row[7],
                                                  'flagMainAddress'=>$row[1],
                                                  'supplierPhone'=>$row[8],
                                                  'supplierEmail'=>$row[10],
                                                  'supplierWebsite'=>$row[11],
                                                  'supplierFax'=>$row[9],
                                                  'supplierProvince'=>'',
                                                  'supplierCity'=>'',
                                                  'supplierDistricts'=>'',
                                                  'supplierVillage'=>'',
                                                  'supplierPostalCode'=>$row[6],
                                                  'supplierAddressType'=>$row[12],
                                                  'created_at'=>Date::excelToDateTimeObject($row[13])
                          ];
                          array_push($push_array, $supplierAddress);
                      }
                  }else{
                      array_push($message, $row[1]==1 ?$row[0].', Alamat Utama sudah terdaftar':$row[0].', Alamat '.$row[12].' sudah terdaftar');
                  }
              }else{
                  array_push($message, "Supplier dengan nama $row[0] tidak terdaftar");
              }
          }
         
        }
        if(count($push_array) > 0){
            $insert = SupplierAddress::insert($push_array);
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
        // dd($data);
        $this->data = $data;
    }
}
