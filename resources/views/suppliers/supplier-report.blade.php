<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Supplier</title>

    <style>
        * {
        box-sizing: border-box;
        }

        table {
        /* border-collapse: collapse; */
        border-spacing: 0;
        width: 100%;
        border: 1px;
        font-size: 12px;
        }
        td.table-cell-edit{
            background-color: lightgoldenrodyellow !important;
        }
        th, td {
        text-align: left;
        padding: 5px;
        }
        .container {
        padding: 2px 16px;
        }
        p{
            font-size: 12px;
        }
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #E0144C;
        color: white;
        }

    </style>
</head>
<body>
    <div>
        <table style="width:100%;">
            <tr>
                <td style="width:20%">Nama Perusahaan</td>
                <td style="width:1%">:</td>
                <td style="width:29%">{{$getSupplier[0]->supplierName}}</td>
                
                <td style="width:20%">Tahun Pendirian</td>
                <td style="width:1%">:</td>
                <td style="width:29%">{{$getSupplier[0]->supplierYearOfEstablishment}}</td>
            </tr>
            <tr>
                <td style="width:20%">Jenis Usaha</td>
                <td style="width: 1%">:</td>
                <td style="width: 29%">{{$getSupplier[0]->supplierType}}</td>
               
                <td style="width: 20%">Jumlah Karyawan</td>
                <td style="width: 1%">:</td>
                <td style="width: 29%">{{$getSupplier[0]->supplierNumberOfEmployee}}</td>
            </tr>
        </table>
        {{-- <h4>BIO</h4>
            <p style="margin-left:10px">
                Nama Perusahaan : {{$getSupplier[0]->supplierName}} <br>
                Tahun Pendirian : {{$getSupplier[0]->supplierYearOfEstablishment}} <br>
                Jenis Usaha     : {{$getSupplier[0]->supplierType}} <br>
                Jumlah Karyawan : {{$getSupplier[0]->supplierNumberOfEmployee}} <br>
            </p> --}}
         <table style="width:100%">
            <tr>
                <td style="width: 20%">Alamat Kantor</td>
                <td style="width: 1%">:</td>
                <td style="width: 79%"> {{$getSupplier[0]->supplierAddress}}</td>
            </tr>
         </table>
   
        <table style="width:100%;text-align:start;">
           
            <tr>
                <td style="width:20%">Kota</td>
                <td style="width:1%">:</td>
                <td style="width:29%">{{$getSupplier[0]->regency_name}}</td>
               
                <td style="width:20%">Kode Pos</td>
                <td style="width:1%">:</td>
                <td style="width:29%">{{$getSupplier[0]->postal_code}}</td>
              
            </tr>
            <tr>
                <td style="width:20%"> No Telp</td>
                <td style="width: 1%">:</td>
                <td style="width: 29%">{{$getSupplier[0]->supplierPhone}}</td>
                <td style="width: 20%">Fax</td>
                <td style="width: 1%">:</td>
                <td style="width: 9%">{{$getSupplier[0]->supplierFax}}</td>
            </tr>
            <tr>
                <td style="width:20%"> Email</td>
                <td style="width: 1%">:</td>
                <td style="width: 29%">{{$getSupplier[0]->supplierEmail}}</td>
                <td style="width: 20%">Website</td>
                <td style="width: 1%">:</td>
                <td style="width: 9%">{{$getSupplier[0]->supplierWebsite}}</td>
            </tr>
            
        </table>
        @forelse($otherAddresses as $a)
        <table style="width:100%;margin-top:10px;">
            <tr>
                <td style="width: 20%">Alamat {{$a->supplierAddressType}}</td>
                <td style="width: 1%">:</td>
                <td style="width: 79%"> {{$a->supplierAddress}}</td>
            </tr>
            <tr>
                <td style="width: 20%">No Telp / Fax </td>
                <td style="width: 1%">:</td>
                <td style="width: 79%"> {{$a->supplierPhone}} / {{$a->supplierFax}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Email / Web </td>
                <td style="width: 1%">:</td>
                <td style="width: 79%"> {{$a->supplierEmail}} / {{$a->supplierWebsite}}</td>
            </tr>
         </table>
        @empty
      
        @endforelse
    </div>
    <div>
        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width: 20%"><p> Contact Person / PIC</p></td>
                <td style="width: 1%">:</td>
                <td style="width: 79%"></td>
            </tr>
        </table>

        <table class="table-auto w-full" id="customers">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2" style="text-align: center">Department</th>
                    <th class="border px-4 py-2" style="text-align: center">Nama</th>
                    <th class="border px-4 py-2" style="text-align: center">No Telp</th>
                    <th class="border px-4 py-2" style="text-align: center">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pics as $pic)
                    <tr>
                        <td class="border px-4 py-2" style="text-align: center">{{ $pic->picDepartement }}</td>
                        <td class="border px-4 py-2">{{ $pic->picName }}</td>
                        <td class="border px-4 py-2" style="text-align: center">{{ $pic->picPhone }}</td>
                        <td class="border px-4 py-2">{{ $pic->picEmail }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="3">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>
        <table style="width:100%" style="margin-top:20px">
            <tr>
                <td style="width:21%"> Data Perusahaan</td>
                <td style="width: 1%">:</td>
                <td style="width: 28%"></td>
                <td style="width: 30%">Copy dok, yang harus dilampirkan</td>
                <td style="width: 1%">:</td>
                <td style="width: 1%"></td>
                <td style="width: 18%"></td>
            </tr>
        </table>
        <table style="width:100%;text-align:start;">
           
            <tr>
                <td style="width:21%">No Pengukuhan PKP</td>
                <td style="width:1%">:</td>
                <td style="width:29%">{{$companyAttachment[0]->numberPKP}}</td>
                <td style="width: 22%">NPWP</td>
                <td style="width: 1%">:</td>
                <td style="width: 1%">
                    <input type="checkbox" style="border-radius: 5px !important;" class="diterapkan" name="diterapkan" {{$companyAttachment[0]->fileNPWP != null ?  'checked="checked"':''}}>            
                </td>
                <td style="width: 26%"></td>
              
            </tr>
            <tr>
                <td style="width:21%"> No NPWP</td>
                <td style="width: 1%">:</td>
                <td style="width: 29%">{{$companyAttachment[0]->numberNPWP}}</td>
                <td style="width: 22%">Surat Pengukuhan PKP</td>
                <td style="width: 1%">:</td>
                <td style="width: 1%">
                    <input type="checkbox" style="border-radius: 5px !important;" class="diterapkan" name="diterapkan" {{$companyAttachment[0]->filePKP != null ?  'checked="checked"':''}}>            
                </td>
                <td style="width: 26%"></td>
            </tr>
            <tr>
                <td style="width:20%"> Nama NPWP</td>
                <td style="width: 1%">:</td>
                <td style="width: 29%">{{$companyAttachment[0]->nameNPWP}}</td>
                <td style="width: 22%">Surat Keterangan Terdaftar</td>
                <td style="width: 1%">:</td>
                <td style="width: 1%">
                    <input type="checkbox" style="border-radius: 5px !important;" class="diterapkan" name="diterapkan" {{$companyAttachment[0]->fileRegistrationCertificate != null ?  'checked="checked"':''}}>            
                </td>
                <td style="width: 26%"></td>
            </tr>
            <tr>
                <td style="width:20%"> Alamat NPWP</td>
                <td style="width: 1%">:</td>
                <td style="width: 29%">{{$companyAttachment[0]->addressNPWP}}</td>
                <td style="width: 22%">Company Profile</td>
                <td style="width: 1%">:</td>
                <td style="width: 1%">
                    <input type="checkbox" style="border-radius: 5px !important;" class="diterapkan" name="diterapkan" {{$companyAttachment[0]->fileCompanyProfile != null ?  'checked="checked"':''}}>            
                </td>
                <td style="width: 26%"></td>
            </tr>
            
        </table>
    </div>
    <div>
        <table style="width:100%">
            <tr>
                <td style="width: 20%"><p> Kelengkapan Iso</p></td>
                <td style="width: 1%"></td>
                <td style="width: 79%"></td>
            </tr>
        </table>
      <table style="width: 100%">
        @forelse($isoes as $iso)
        <tr>
            <td style="width: 20%">{{$iso->iso}}</td>
            <td style="width: 1%">:</td>
            <td style="width: 15%">
                <label for="cc" style="font-size: 12px">
                    <input type="checkbox" style="border-radius: 5px !important;" class="diterapkan" name="diterapkan" {{$iso->applied == 1 ?  'checked="checked"':''}}>
                    Diterapkan                  
                </label>
            </td>
            <td style="width: 15%">
                <label for="cc" style="font-size: 12px">
                    <input type="checkbox" style="border-radius: 5px !important;" class="tersertifikasi" name="tersertifikasi" {{$iso->certified == 1? 'checked="checked"':''}}>
                  Tersertifikasi                  
                </label>
            </td>
            <td style="width:49%"></td>
          
        </tr>
        @empty
        <td>-</td>
        @endforelse
      </table>
    </div>
    <div>
        <table style="width:100%" style="margin-top:10px">
            <tr>
                <td style="width: 20%"><p> Payment</p></td>
                <td style="width: 1%">:</td>
                <td style="width: 79%"></td>
            </tr>
        </table>
        <table style="width:100%">
            <tr>
                <td style="width: 21%">Bank Account</td>
                <td style="width: 1%">:</td>
                <td style="width: 79%">{{$payment[0]->nameBank.' ('.$payment[0]->numberBank.')'}}</td>
            </tr>
            <tr>
                <td style="width: 21%">Jangka Waktu Pembayaran</td>
                <td style="width: 1%">:</td>
                <td style="width: 79%">{{$payment[0]->termOfPayment.' Hari'}}</td>
            </tr>
        </table>

    </div>
    <div>
        <p style="margin-left: 10px; width:90%">
            Dengan ini saya menyatakan bahwa informasi yang saya berikan di atas adalah benar, apabila dikemudian hari ditemukan dan terjadi penyimpangan dalam penggunaannya, maka saya bersedia menyelesaikan sesuai dengan hukum yang berlaku.
            <br>
            Dan saya sebagai Penyedia Eksternal menyatakan kesediaan mengikuti aturan administrasi yang telah ditentukan dan berlaku di PT. Pralon.
            <br>
            Demikian surat pernyataan ini saya buat dengan sadar dan tanpa paksaan untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>
    <div style="margin-left:10px">
        <p>Serpong, {{$tgl}} <br>
        {{$getSupplier[0]->supplierName}}</p>
        <br>
        <br>
        <p>{{$pics[0]->picName}}</p>
    </div>
    
</body>
</html>