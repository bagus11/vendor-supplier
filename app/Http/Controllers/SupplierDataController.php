<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Regencies;
use App\Models\Districts;
use App\Models\IsoSupplier;
use App\Models\Pic;
use App\Models\Supplier;
use App\Models\SupplierAddress;
use App\Models\Villages;
use Illuminate\Support\Facades\Auth;

class SupplierDataController extends Controller
{

    public function get_regency(Request $request)
    {
        $province = $request->prov;
        $regency = Regencies::where('province_id', $province)->get();
        return response()->json(['regency'=>$regency]);
    }
    public function get_district(Request $request)
    {
        $kab = $request->regency_id;
        $district = Districts::where('regency_id', $kab)->get();
        return response()->json(['district'=>$district]);
    }
    public function get_village(Request $request)
    {
        $kec = $request->district_id;
        $village = Villages::where('district_id', $kec)->get();
        return response()->json(['village'=>$village]);
    }
    public function post_supplier(Request $request)
    {
        // initiating Array
        $arr_address = $request->arr_address;
        $arr_pic = $request->arr_pic;
        $arr_iso = $request->arr_iso;
        $push_iso=[];
        $push_pic =[];
        $push_address =[];
        
        $nama_supplier = $request->nama_supplier;
        $tahun_pendirian = $request->tahun_pendirian;
        $jenis_usaha = $request->jenis_usaha;
        $jml_karyawan = $request->jml_karyawan;
        $prov = $request->prov;
        $kab = $request->kab;
        $kec = $request->kec;
        $kel = $request->kel;
        $kode_pos = $request->kode_pos;
        $alamat_kantor = $request->alamat_kantor;
        $no_telpon = $request->no_telpon;
        $no_fax = $request->no_fax;
        $email = $request->email;
        $website = $request->website;
        $no_pengukuhan = $request->no_pengukuhan;
        $no_npwp = $request->no_npwp;
        $nama_npwp = $request->nama_npwp;
        $alamat_npwp = $request->alamat_npwp;
        // Array
                // Address
                if($arr_address){
                    foreach($arr_address as $row){
                        if($row[0]==null&& $row[1]==null && $row[2]==null && $row[3]==null && $row[4]==null && $row[5]==null){

                        }else{
                            $address_array=[
                                'supplierId'=>Auth::user()->id,
                                'supplierAddress'=>$row[0],
                                'supplierAddressType'=>$row[1],
                                'supplierPhone'=>$row[2],
                                'supplierFax'=>$row[3],
                                'supplierEmail'=>$row[4],
                                'supplierWebsite'=>$row[5],
                                'flagMainAddress'=>'0',
                            ];
                            array_push($push_address, $address_array);
                        }
                    }
                }
                SupplierAddress::insert($push_address);
                // PIC Contact
                if($arr_pic)
                {
                foreach($arr_pic as $row)
                {
                    if($row[0]==''&& $row[1]==''&& $row[2]=='' && $row[3] == '')
                    {

                    }else{
                        $pic_array =[
                            'supplierId'=>Auth::user()->id,
                            'picDepartement'=>$row[0],
                            'picName'=>$row[1],
                            'picPhone'=>$row[2],
                            'picEmail'=>$row[3],
                        ];
                        array_push($push_pic, $pic_array);
                    }
                }
                }
                Pic::insert($push_pic);
                // dd($push_pic);
                // ISO 
                if($arr_iso)
                {
                foreach($arr_iso as $row)
                {
                    // Validasi filter where iso != 0 0
                    if($row[1] == 0 && $row[2] ==0)
                    {
                    
                    }else{
                        $iso_array=[
                            'supplierId'=>Auth::user()->id,
                            'isoId'=>$row[0],
                            'applied'=>$row[1],
                            'certified'=>$row[2],
                        ];
                        array_push($push_iso, $iso_array);
                    }
                }
                // dd($push_iso);
                }
                IsoSupplier::insert($push_iso);

        // End Array

        // Supplier Table
            $arr_supplier_table =
            [
                'supplierName'=>$nama_supplier,
                // 'supplierCategory'=>$nama_supplier,
                'supplierType'=>$jenis_usaha,
                'supplierNumberOfEmployee'=>$tahun_pendirian,
                'supplierYearOfEstablishment'=>$jml_karyawan,
                'supplierCategory'=>'PKP',
            ];
            Supplier::create($arr_supplier_table);
        // End Supplier Table

        // Address Supplier
        $arr_supplier_address =[
            'supplierId'=>Auth::user()->id,
            'supplierAddress'=>$alamat_kantor,
            'flagMainAddress'=>1,
            'supplierPhone'=>$no_telpon,
            'supplierEmail'=>$email,
            'supplierWebsite'=>$website,
            'supplierFax'=>$no_fax,
            'supplierProvince'=>$prov,
            'supplierCity'=>$kab,
            'supplierDistricts'=>$kec,
            'supplierVillage'=>$kel,
            'supplierPostalCode'=>$kode_pos,
            'supplierAddressType'=>'HO',
           
        ];
        SupplierAddress::create($arr_supplier_address);
        // End Address Supplier
    }
}
