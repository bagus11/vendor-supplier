<style>
    .add_supplier:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #59CE8F;
    }
    .editPost:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #5DA7DB;
    }
    .message_error{
        font-size: 12px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-2 sm:px-8 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif        
                  
                </div>
                <form class="form" id="form_serialize" enctype="multipart/form-data">
                <div class="py-4 pl-3 px-3">
                      <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                    <label for="supplier_siup">Data Supplier</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="data_supplier" placeholder="Enter Supplier NPWP" name="data_supplier">
                                    <span  style="color:red;" class="message_error text-red block data_supplier_error"></span>
                            </div>
                            <div class="col-span-1">
                                    <label for="supplier_siup">Alamat Supplier</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat_supplier" placeholder="Enter Supplier NPWP" name="alamat_supplier">
                                    <span  style="color:red;" class="message_error text-red block alamat_supplier_error"></span>
                            </div>
                      </div>
                      <div class="grid grid-cols-2 gap-4 ">
                            <div class="col-span-1">
                                    <label for="supplier_siup">PIC</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pic_supplier" placeholder="Enter Supplier NPWP" name="pic_supplier">
                                    <span  style="color:red;" class="message_error text-red block pic_supplier_error"></span>
                            </div>
                            <div class="col-span-1">
                                    <label for="supplier_siup">ISO</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="iso_supplier" placeholder="Enter Supplier NPWP" name="iso_supplier">
                                    <span  style="color:red;" class="message_error text-red block iso_supplier_error"></span>
                            </div>
                      </div>
                      <div class="grid grid-cols-2 gap-4 py-4">
                            <div class="col-span-1">
                                    <label for="supplier_siup">Berkas Supplier</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="berkas_supplier" placeholder="Enter Supplier Attachment" name="berkas_supplier">
                                    <span  style="color:red;" class="message_error text-red block berkas_supplier_error"></span>
                            </div>
                        
                      </div>
                      <button class="h-10 px-5 py-2 m-2 text-green-100 transition-colors duration-150 bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-800 import_file" style="float:right">
                        <i class="fas fa-solid fa-file-import"></i>
                        Import
                    </button>          
                </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $('.import_file').on('click', function(e){
        e.preventDefault()
        data_import();
    })

    function data_import()
    {
        var formData = new FormData();    
        var data_supplier = $('#data_supplier')[0].files[0]
        var alamat_supplier = $('#alamat_supplier')[0].files[0]
        var pic_supplier = $('#pic_supplier')[0].files[0]
        var iso_supplier = $('#iso_supplier')[0].files[0]
        var berkas_supplier = $('#berkas_supplier')[0].files[0]


        formData.append('data_supplier', data_supplier);
        formData.append('alamat_supplier', alamat_supplier);
        formData.append('pic_supplier', pic_supplier);
        formData.append('iso_supplier', iso_supplier);
        formData.append('berkas_supplier', berkas_supplier);

        // Ajax
         
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('import_supplier')}}",
                type: "post",
                dataType: 'json',
                async: true,
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    SwalLoading('Inserting progress, please wait .');
                },
                success: function(response) {
                    swal.close();
                    $('.message_error').html('')
                   if(response.status == 422)
                   {
                    $.each(response.validate, (key, val) => 
                    {
                       $('span.'+key+'_error').text(val[0])
                    });
                    return false;
                   }
                    var modal_info  = [];
                    if(response.message_supplier)
                    {
                    var supplier_info = '<ul>';
                        supplier_info += '<li style="text-align:left;">';
                        supplier_info += 'Data Masuk : ' +response.count_supplier;
                        supplier_info += '</li>';
                        supplier_info += '<li style="text-align:left;">';
                            if(response.message_supplier == [] || response.message_supplier ==''|| response.message_supplier.length == 0)
                            {
                                supplier_info += 'Data successfully imported';
                                
                            }else{
                                supplier_info += 'Keterangan supplier yang sudah terdaftar:';
                                supplier_info += '</li>';
                                for(index in response.message_supplier) {
                                    supplier_info += '<li style="text-align:left;margin-left:10px;font-size:12px">';
                                    supplier_info += '- '+response.message_supplier[index];
                                    supplier_info += '</li>';
                                }
                            }
                        supplier_info += '</ul>';
                       
                    }
                    if(response.message_supplier_address)
                    {
                    var supplier_address = '<ul>';
                        supplier_address += '<li style="text-align:left;">';
                        supplier_address += 'Data Masuk : ' +response.count_supplier_address;
                        supplier_address += '</li>';
                        supplier_address += '<li style="text-align:left;">';
                            if(response.message_supplier_address == [] || response.message_supplier_address ==''|| response.message_supplier_address.length == 0)
                            {
                                supplier_address += 'Data successfully imported';

                            }else{
                                supplier_address += 'Keterangan alamat supplier yang sudah terdaftar:';
                                supplier_address += '</li>';
                                for(index in response.message_supplier_address) {
                                    supplier_address += '<li style="text-align:left;margin-left:10px;font-size:12px">';
                                    supplier_address += '- '+response.message_supplier_address[index];
                                    supplier_address += '</li>';
                                }
                                supplier_address += '</ul>';

                            }
                       
                    }
                    if(response.message_supplier_pic)
                    {
                    var supplier_pic = '<ul>';
                        supplier_pic += '<li style="text-align:left;">';
                        supplier_pic += 'Data Masuk : ' +response.count_supplier_pic;
                        supplier_pic += '</li>';
                        supplier_pic += '<li style="text-align:left;">';
                            if(response.message_supplier_pic == [] || response.message_supplier_pic ==''|| response.message_supplier_pic.length == 0)
                            {
                                supplier_pic += 'Data successfully imported';
                            }else{         
                                supplier_pic += 'Keterangan PIC yang sudah terdaftar:';
                                supplier_pic += '</li>';
                                for(index in response.message_supplier_pic) {
                                    supplier_pic += '<li style="text-align:left;margin-left:10px;font-size:12px">';
                                    supplier_pic += '- '+response.message_supplier_pic[index];
                                    supplier_pic += '</li>';
                                }
                            }
                        supplier_pic += '</ul>';
                       
                    }
                    if(response.message_supplier_iso)
                    {
                    var supplier_iso = '<ul>';
                        supplier_iso += '<li style="text-align:left;">';
                        supplier_iso += 'Data Masuk : ' +response.count_supplier_iso;
                        supplier_iso += '</li>';
                        supplier_iso += '<li style="text-align:left;">';
                            if(response.message_supplier_iso == [] || response.message_supplier_iso ==''|| response.message_supplier_iso.length == 0)
                            {
                                supplier_iso += 'Data successfully imported';
                            }else{
                                supplier_iso += 'Keterangan ISO:';
                                supplier_iso += '</li>';
                                for(index in response.message_supplier_iso) {
                                    supplier_iso += '<li style="text-align:left;margin-left:10px;font-size:12px">';
                                    supplier_iso += '- '+response.message_supplier_iso[index];
                                    supplier_iso += '</li>';
                                }
                            }
                        supplier_iso += '</ul>';
                       
                    }
                    if(response.message_supplier_attachment)
                    {
                    var supplier_attachemnt = '<ul>';
                        supplier_attachemnt += '<li style="text-align:left;">';
                        supplier_attachemnt += 'Data Masuk : ' +response.count_supplier_attachment;
                        supplier_attachemnt += '</li>';
                        supplier_attachemnt += '<li style="text-align:left;">';
                            if(response.message_supplier_attachment == [] || response.message_supplier_attachment ==''|| response.message_supplier_attachment.length == 0)
                            {
                                supplier_attachemnt += 'Data successfully imported';
                            }else{
                                supplier_attachemnt += 'Keterangan Attachment:';
                                supplier_attachemnt += '</li>';
                                for(index in response.message_supplier_attachment) {
                                    supplier_attachemnt += '<li style="text-align:left;margin-left:10px;font-size:12px">';
                                    supplier_attachemnt += '- '+response.message_supplier_attachment[index];
                                    supplier_attachemnt += '</li>';
                                }
                            }
                        supplier_attachemnt += '</ul>';
                       
                    }
                    Swal.fire({
                        title: "Import Supplier",
                        html: supplier_info,
                        icon: "info",
                        showCancelButton: false,
                        confirmButtonText: "Next"
                    }).then(function(result) {
                        if (result.value) {
                            Swal.fire({
                                title: "Import Supplier Address",
                                html: supplier_address,
                                icon: "info",
                                showCancelButton: false,
                                confirmButtonText: "Next"
                            }).then(function(result) {
                                if (result.value) {
                                    Swal.fire({
                                        title: "Import Supplier PIC",
                                        html: supplier_pic,
                                        icon: "info",
                                        showCancelButton: false,
                                        confirmButtonText: "Next"
                                    }).then(function(result) {
                                        if (result.value) {
                                            Swal.fire({
                                            title: "Import Supplier ISO",
                                            html: supplier_iso,
                                            icon: "info",
                                            showCancelButton: false,
                                            confirmButtonText: "Next"
                                        }).then(function(result) {
                                        if (result.value) {
                                            Swal.fire({
                                        title: "Import Supplier Attachment",
                                        html: supplier_attachemnt,
                                        icon: "info",
                                        showCancelButton: false,
                                        confirmButtonText: "Ok"
                                   
                                    })
                                        }
                                    })
                                        }
                                    })
                                }
                            })
                        }
                    });
                    toastr['success']('Success,Data saved successfully');

                },
                error: function(xhr, status, error) {
                    swal.close();
                   
                    toastr['error']('Error system, please contact ICT Developer');
                }
            });
        // End Ajax


      


    }

</script>

