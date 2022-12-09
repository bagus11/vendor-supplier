<style>
    .add_supplier:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #59CE8F;
    }
    .editPost:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #5DA7DB;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-8 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="grid grid-cols-2 mb-4">
                            <div class="col-span-1">
                                <button class="add_supplier h-10 px-5  m-2 text-green-100 transition-colors duration-150 bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-500 text-white">
                                    <a href="{{ route('suppliers.create') }}">
                                        <i class="fas fa-solid fa-plus"></i> Supplier
                                    </a>
                                </button>
                            </div>
                            <div class="col-span-1">
                                <button class="h-10 px-5 py-2 m-2 text-blue-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800 import_file" style="float:right">
                                    <a href="{{ route('supplier_import') }}">
                                    <i class="fas fa-solid fa-file-import"></i>
                                    Import
                                    </a>
                                </button>
                            </div>
                    </div>
                    <table class="table-auto w-full bg-blue-500 supplier-datatable datatable-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Fax</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="dataModalSupplierDetail">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative w-full max-w-4xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h2 class="text-xl font-medium leading-6 text-gray-900" id="modal-title"></h2>
                                    <div class="mt-2">
                                </div>
                                
                            </div>
                        </div>
                        <div class="mt-4"id="other_address">
                            <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                                <details class="bg-gray-200 open:bg-red-600 duration-300" open>
                                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Profil</summary>
                                    <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                                        <div class="grid grid-cols-2 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-3 ">
                                            <div class="input-group col-span-3">
                                                <label for="supplier_siup">Nama</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplierName" name="supplierName" readOnly>
                                            </div>
                                            
                                            <div class="input-group col-span-1">
                                                <label for="supplier_siup">Tahun Berdiri</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="text-align:center" id="supplierYearOfEstablishment" name="supplierYearOfEstablishment" readOnly>
                                            </div>

                                            <div class="input-group col-span-1">
                                                <label for="supplier_siup">Jml Karyawan</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="text-align:center" id="supplierNumberOfEmployee" name="supplierNumberOfEmployee" readOnly>
                                            </div>
                                        </div>   
                                        <div class="grid xs:grid-cols-1 sm:grid-cols-6 gap-3 ">
                                            <div class="input-group col-span-3">
                                                <label for="supplier_siup">Jenis</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplierType" name="supplierType" readOnly>
                                            </div>
                                            <div class="input-group col-span-1">
                                                <label for="supplier_siup">Kategori</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="text-align:center" id="supplierCategory" name="supplierCategory" readOnly>
                                            </div>
                                        
                                        </div>   
                                        <div class="grid xs:grid-cols-1 sm:grid-cols-6 gap-3 ">
                                            <div class="input-group col-span-3">
                                                <label for="supplier_siup">No Rekening</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="numberBank" name="numberBank" readOnly>
                                            </div>
                                            <div class="input-group col-span-1">
                                                <label for="supplier_siup">Nama Bank</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="text-align:center" id="nameBank" name="nameBank" readOnly>
                                            </div>
                                        </div>   
                                        <div class="grid grid-cols-1 lg:grid-cols-6 md:grid-cols-6 xl:grid-cols-6 gap-3 mt-2">
                                            <div class="input-group col-span-2">
                                                <label for="supplier_siup">Jangka Waktu Pembayaran</label><br>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="max-width:70px;text-align:center" id="termOfPayment" name="termOfPayment" readOnly>
                                                <label class="ml-3">Hari</label>
                                            </div>
                                        </div>   
                                    </div>
                                </details>
                                <details class="bg-gray-200 open:bg-red-600 duration-300" id="other_address">
                                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Alamat</summary>
                                    <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                                        <p>
                                    
                                            <div class="flex justify-start">
                                                <div class="relative w-full p-6 rounded-lg shadow-lg bg-white max-w-4xl">
                                                    <strong class="text-green-500">
                                                        Alamat Utama
                                                    </strong>
                                                    <p class="ml-4 mt-2">
                                                            Alamat : <span id="supplierAddress"></span><br>
                                                            No Hp / No Fax: <span id="supplierPhoneNumber"></span> / <span id="supplierFax"></span>
                                                        <br>
                                                            Email : <span id="supplierEmail"></span>
                                                        <br>
                                                            Website : <span id="supplierWebsite"></span>
                                                        <br>
                                                    </p>
                                                </div>
                                            </div>                             
                                            <p id="alamat_lain"></p>
                                        </p>
                                    </div>
                                </details>
                                <details class="bg-gray-200 open:bg-red-600 duration-300 border border-white-500">
                                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">PIC</summary>
                                    <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                                        <table class="table-auto w-full border-collapse" id="supplierPICDetail">
                                            <thead>
                                                <tr class="border">
                                                    <th>PIC Name</th>
                                                    <th>PIC Departement</th>
                                                    <th>PIC Phone</th>
                                                    <th>PIC Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border">
                                                    <td>
                                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picName"></span></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picDepartement"></span></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picPhone"></span></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picEmail"></span></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </details>
                                <details class="bg-gray-200 open:bg-red-600 duration-300">
                                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Attachment</summary>
                                    <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                                        <div class="container" id="attachement_id">

                                        </div>
                                    </div>
                                </details>
                                <details class="bg-gray-200 open:bg-red-600 duration-300">
                                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">ISO</summary>
                                    <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                                        <p id="supplier_iso"></p>
                                    </div>
                                </details>
                            </div>
                        </div>
                        <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="closeSupplierDetail">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</x-app-layout>

<script type="text/javascript">
    $(function() {
        var table = $('.supplier-datatable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            autoWidth:false,
            scrollX:true,
            ajax: {
                url: '{!! url()->current() !!}',
                // type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'supplier.supplierName', 
                    name: 'supplier.supplierName'
                },
                {
                    data: 'supplierPhone', 
                    name: 'supplierPhone'
                },
                {
                    data: 'supplierEmail', 
                    name: 'supplierEmail'
                },
                {
                    data: 'supplierFax', 
                    name: 'supplierFax'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    // width: '25%'
                }
            ],
          
        })
    });
    $('.supplier-datatable').on('click', '.editPost', function () {
        $('#supplierPICDetail').DataTable().clear();
        $('#supplierPICDetail').DataTable().destroy();
        var id = $(this).data('id');
        $('#dataModalSupplierDetail').show();
        $('#modal-title').html('Supplier Details');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('supplierDetail')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data: {'id':id},
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                var res = response.supplierDetail[0]
                var res_pic = response.pic
                var res_address = response.otherAdress
                var res_iso = response.iso
                var res_attachment = response.attachment
                mapping_iso(res_iso)
                mapping_detail_supplier(res)
                mapping_pic(res_pic)
                mapping_address(res_address)
                mapping_attachment(res_attachment)
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    });

    $('#closeSupplierDetail').click(function() {
        $('#dataModalSupplierDetail').hide();
    })
    function mapping_detail_supplier(res)
    {
        $('#supplierName').val(res.supplierName)
        $('#supplierType').val(res.supplierType)
        $('#supplierYearOfEstablishment').val(res.supplierYearOfEstablishment)
        $('#supplierNumberOfEmployee').val(res.supplierNumberOfEmployee)
        $('#supplierEmail').html(res.supplierEmail)
        $('#supplierFax').html(res.supplierFax)
        $('#supplierPhoneNumber').html(res.supplierPhone)
        $('#supplierWebsite').html(res.supplierWebsite)
        $('#supplierCategory').val(res.supplierCategory)
        $('#supplierProvince').html(res.province_name)
        $('#supplierCity').html(res.regency_name)
        $('#supplierDistricts').html(res.district_name)
        $('#supplierVillage').html(res.village_name)
        $('#supplierAddress').html(res.supplierAddress)
        $('#supplierPostalCode').html(res.supplierPostalCode)
        $('#numberBank').val(res.numberBank)
        $('#nameBank').val(res.nameBank)
        $('#termOfPayment').val(res.termOfPayment)
    }
    function mapping_pic(res_pic){
        var data=''
 
    for(i = 0; i < res_pic.length; i++ )
    {
        data += `<tr style="text-align: center;">

                    <td style="text-align: left;">${res_pic[i]['picName']==null?'':res_pic[i]['picName']}</td>
                    <td style="text-align: left;">${res_pic[i]['picDepartement']==null?'':res_pic[i]['picDepartement']}</td>
                    <td style="text-align: left;">${res_pic[i]['picPhone']==null?'':res_pic[i]['picPhone']}</td>
                    <td style="text-align: left;">${res_pic[i]['picEmail']==null?'':res_pic[i]['picEmail']}</td>
                    </tr>
                `;
    }
        $('#supplierPICDetail > tbody:first').html(data);
            $(document).ready(function() 
            {
                $('#supplierPICDetail').DataTable( {
                    "destroy": true,
                    "scrollX": true,
                    "autoWidth" : false,
                    "searching": false,
                    "aaSorting" : false
            });


     } );
    }
    function mapping_address(res)
    {
        $('#alamat_lain').empty();
        $.each(res,function(i,data){
                    $('#alamat_lain').append(`

                    <div class="flex justify-start mt-4">
                                    <div class="relative w-full p-6 rounded-lg shadow-lg bg-white max-w-4xl">
                                        <strong class="text-blue-500 mt-3">
                                            Alamat ${data.supplierAddressType}
                                        </strong>
                                        <p class="ml-4 mt-2 mb-4">
                                            Alamat : ${data.supplierAddress}<br>
                                            No Hp / No Fax: ${data.supplierPhone} / ${data.supplierFax}<br>
                                            Email : ${data.supplierEmail}<br>
                                            Website : ${data.supplierWebsite}<br>
                                        </p>
                                    </div>
                                </div>
                              
                    `);
                });
    }
    function mapping_iso(res){
        $('#supplier_iso').empty();
        $.each(res,function(i,data){
                    $('#supplier_iso').append(`

                    <div class="grid grid-cols-3 lg:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-3 ">
                        <div class="col-span-1">
                            <label for="">${data.iso}</label>
                        </div>
                        <div class="col-span-1">
                            <label for="cc" style="font-size: 12px">
                                <input type="checkbox" style="border-radius: 5px !important;" class="diterapkan" name="diterapkan" ${data.applied =='1'?'checked':''} onclick="return false;" onkeydown="return false;">
                                Diterapkan                  
                            </label>
                        </div>
                        <div class="col-span-1">
                            <label for="cc" style="font-size: 12px">
                                <input type="checkbox" style="border-radius: 5px !important;" class="tersertifikasi" name="tersertifikasi"${data.certified =='1'?'checked':''} onclick="return false;" onkeydown="return false;">
                              Tersertifikasi                  
                            </label>
                        </div>
                    </div>
                              
                    `);
                });
    }
    function mapping_attachment(res_attachment)
    {
        $('#attachement_id').empty();
      
        $('#attachement_id').append(`

        <div class="grid xs:grid-cols-1 sm:grid-cols-6 gap-3 ">
            <div class="col-span-2">
                <p>
                    <label for="">File Pengukuhan</label>
                    <br>
                    <a target="_blank" href="{{URL::asset('storage/siup/${res_attachment[0].filePKP}')}}" class="ml-3" style="color:blue">
                        <i class="far fa-file-pdf" style="color: red;font-size: 20px;"></i>
                        Klik untuk lihat file</a>
                </p>
            </div>
            <div class="col-span-2">
                <p>
                    <label for="">File NPWP</label>
                    <br>
                    <a target="_blank" href="{{URL::asset('storage/npwp/${res_attachment[0].fileNPWP}')}}" class="ml-3" style="color:blue">
                            <i class="far fa-file-pdf" style="color: red;font-size: 20px;"></i>
                            Klik untuk lihat file</a>
                </p>
            </div>
            <div class="col-span-2">
                <p>
                    <label for="">File Company Profile</label>
                    <br>
                    <a target="_blank" href="{{URL::asset('storage/companyProfile/${res_attachment[0].fileCompanyProfile}')}}" class="ml-3" style="color:blue">
                        <i class="far fa-file-pdf" style="color: red;font-size: 20px;"></i>
                        Klik untuk lihat file</a>
                </p>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-3 mt-2">
            <div class="col-span-2">
                <p>
                    <label for="">File Surat Keterangan Terdaftar</label>
                    <br>
                    <a target="_blank" href="{{URL::asset('storage/registrationCertificate/${res_attachment[0].fileRegistrationCertificate}')}}" class="ml-3" style="color:blue">
                        <i class="far fa-file-pdf" style="color: red;font-size: 20px;"></i>
                        Klik untuk lihat file</a>
                </p>
            </div>
         
        </div>
                    
        `);
    }
    
</script>
