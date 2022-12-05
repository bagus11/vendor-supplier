<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Pertanyaan') }}
        </h2>
    </x-slot>
  
        <div class=" px-6 pt-2 float-right">
            <div class="max-w-lg py-2 rounded-lg shadow-lg bg-white">
                <details class="duration-300">
                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Filter</summary>
                    <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                        <div class="grid grid-cols-2 gap-4">
                            <label class="mt-2">Departement</label>
                            <select name="select_departement" class="select2" id="select_departement"></select>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            <label class="mt-2">Aspek</label>
                            <select name="select_aspek" class="select2" id="select_aspek"></select>
                        </div>
                    </div>
                </details>
            </div>
        </div>
  
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto">
            <div class="py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Pertanyaan</h3>
                        </div>
                        <div class="py-3">
                          
                            @can('add-master_pertanyaan')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_pertanyaan" style="float:right">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="pertanyaan_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2"></th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Departement</th>
                                    <th class="px-4 py-2">Aspek</th>
                                    <th class="px-4 py-2">Pertanyaan</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
     {{-- Add Aspek --}}
    
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addPertanyaanModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Add Pertanyaan</h4>
                        </div>
                       
                    </div>
                    <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                        <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="container px-6">
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Departement</label>
                                        </div>
                                        <div class="col-span-3">
                                            <select name="departement_name" id="departement_name" class="select2" style="width: 100%"></select>
                                          <input type="hidden" id="departement_id" class="w-full" name="departement_id">
                                            <span  style="color:red;" class="message_error text-red block departement_id_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Aspek</label>
                                        </div>
                                        <div class="col-span-3">
                                            <select name="aspek_name" id="aspek_name" class="select2" style="width: 100%"></select>
                                          <input type="hidden" id="aspek_id" class="w-full" name="aspek_id">
                                            <span  style="color:red;" class="message_error text-red block aspek_id_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Pertanyaan</label>
                                        </div>
                                        <div class="col-span-3">
                                            <textarea cols="1" rows="2" id="pertanyaan_name" class="w-full" style="border-radius: 5px !important;"></textarea>
                                            <span  style="color:red;" class="message_error text-red block pertanyaan_name_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_pertanyaan">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_pertanyaan">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Add Aspek --}}
     {{-- Edit Aspek --}}
     <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="editPertanyaanModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Edit Pertanyaan</h4>
                        </div>
                       
                    </div>
                    <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                        <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="container px-6">
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Departement</label>
                                        </div>
                                        <div class="col-span-3">
                                            <select name="departement_name_update" id="departement_name_update" class="select2" style="width: 100%"></select>
                                          <input type="hidden" id="pertanyaan_id" class="w-full" name="pertanyaan_id">
                                          <input type="hidden" id="departement_id_update" class="w-full" name="departement_id_update">
                                            <span  style="color:red;" class="message_error text-red block departement_name_update_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Aspek</label>
                                        </div>
                                        <div class="col-span-3">
                                            <select name="aspek_name_update" id="aspek_name_update" class="select2" style="width: 100%"></select>
                                          <input type="hidden" id="aspek_id_update" class="w-full" name="aspek_id_update">
                                            <span  style="color:red;" class="message_error text-red block aspek_id_update_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Pertanyaan</label>
                                        </div>
                                        <div class="col-span-3">
                                            <textarea cols="1" rows="2" id="pertanyaan_name_update" class="w-full" style="border-radius: 5px !important;"></textarea>
                                            <span  style="color:red;" class="message_error text-red block pertanyaan_name_update_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_update_pertanyaan">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_update_pertanyaan">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Edit Aspek --}}
</x-app-layout>
<script>
$('.select2').select2()
// Call Function
get_departement_name()
// End Call Function
// Operation
    $('#add_pertanyaan').on('click', function(){
        $('#addPertanyaanModal').show()
        get_aspek_name()
    })
    $('#close_add_pertanyaan').on('click', function(){
        $('#addPertanyaanModal').hide()
        $('#pertanyaan_name').val('')
    })
    $('#aspek_name').on('change', function(){
        var aspek_name = $('#aspek_name').val()
        $('#aspek_id').val(aspek_name);
    })
    $('#departement_name').on('change', function(){
        var departement_name = $('#departement_name').val()
        $('#departement_id').val(departement_name);
    })
    $('#save_add_pertanyaan').on('click', function(){
        save_add_pertanyaan()
    })
    $('#select_aspek').on('change',function(){
        get_data_pertanyaan()
    })
    $('#select_departement').on('change',function(){
        get_data_pertanyaan()
    })
    $('#pertanyaan_table').on('change', '.is_checked', function(e) {
        $('.is_checked').prop('disabled',true)
        e.preventDefault();
        var status = $(this).data('status')
        var data ={
                'id': $(this).data('id'),     
                'flg_aktif': $(this).data('flg_aktif'),     
        }
        
            $.ajax({
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('update_status_pertanyaan')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
           
            success: function(response) {
                $('.is_checked').prop('disabled',false)
                toastr['success'](response.message);
                get_data_pertanyaan()
            },
            error: function(xhr, status, error) {
               
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
      
       
    });
    $('#pertanyaan_table').on('click', '.editPertanyaan', function(e) {
        $('#editPertanyaanModal').show();
        var id =$(this).data('id')
        e.preventDefault()       
            $.ajax({
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('detail_pertanyaan')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data: {
                'id': id
            },
           
            success: function(response) {
                $('#pertanyaan_id').val(id)
                $('#aspek_id_update').val(response.detail_pertanyaan[0].aspek_id)
                $('#departement_id_update').val(response.detail_pertanyaan[0].departement_id)
                $('#pertanyaan_name_update').val(response.detail_pertanyaan[0].name)
                $('#aspek_name_update').empty();
                $('#aspek_name_update').append('<option value="'+response.detail_pertanyaan[0].aspek_id+'">' + response.detail_pertanyaan[0].aspek_name +'</option>');
                $.each(response.aspek_name,function(i,data){
                    $('#aspek_name_update').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                $('#departement_name_update').empty();
                $('#departement_name_update').append('<option value="'+response.detail_pertanyaan[0].departement_id+'">' + response.detail_pertanyaan[0].departement_name +'</option>');
                $.each(response.departement_name,function(i,data){
                    $('#departement_name_update').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
              
            },
            error: function(xhr, status, error) {
               
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
      
       
    });
    $('#aspek_name_update').on('change', function(){
        var aspek_name_update = $('#aspek_name_update').val()
        $('#aspek_id_update').val(aspek_name_update);
    })
    $('#departement_name_update').on('change', function(){
        var departement_name_update = $('#departement_name_update').val()
        $('#departement_id_update').val(departement_name_update);
    })
    $('#save_update_pertanyaan').on('click', function(){
        update()
    })
    $('#close_update_pertanyaan').on('click', function(){
        $('#editPertanyaanModal').hide()
        $('#pertanyaan_name_update').val('')
    })
    $('#pertanyaan_table').on('click', '.deletePertanyaan', function(e) {
        var id =$(this).data('id')
        e.preventDefault()       
            $.ajax({
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('delete_pertanyaan')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data: {
                'id': id
            },
           
            success: function(response) {
                if(response.status ==500)
                {
                    toastr['error'](response.message);
                }else{
                    toastr['success'](response.message);
                    get_data_pertanyaan()
                }
            },
            error: function(xhr, status, error) {
               
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
      
       
    });
// EndOperation
// Function here
 
    function get_data_pertanyaan(){
        $('#pertanyaan_table').DataTable().clear();
        $('#pertanyaan_table').DataTable().destroy();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_data_pertanyaan')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data:{
                'select_aspek':$('#select_aspek').val(),
                'select_departement':$('#select_departement').val(),
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                var data=''
                for(i = 0; i < response.data_pertanyaan.length; i++ )
                {
                    data += `<tr style="text-align: center;">
                                <td style="text-align: center;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response.data_pertanyaan[i]['id']}"  data-flg_aktif="${response.data_pertanyaan[i]['flg_aktif']}" data-id="${response.data_pertanyaan[i]['id']}" ${response.data_pertanyaan[i]['flg_aktif'] == 1 ?'checked':'' }></td>
                                <td style="text-align: center;">${response.data_pertanyaan[i]['flg_aktif']==1?'Active':'Innactive'}</td>
                                <td style="text-align: left;">${response.data_pertanyaan[i]['departement_name']==null?'':response.data_pertanyaan[i]['departement_name']}</td>
                                <td style="text-align: left;">${response.data_pertanyaan[i]['aspek_name']==null?'':response.data_pertanyaan[i]['aspek_name']}</td>
                                <td style="text-align: left;">${response.data_pertanyaan[i]['name']==null?'':response.data_pertanyaan[i]['name']}</td>
                                <td style="width:12%;text-align:center">
                                        @can('update-master_pertanyaan')       
                                        <button title="Detail" class="editPertanyaan bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="${response.data_pertanyaan[i]['id']}">
                                            <i class="fas fa-solid fa-eye"></i>
                                        </button>
                                        @endcan
                                        @can('delete-master_pertanyaan')
                                        <button title="Delete" class="deletePertanyaan bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="${response.data_pertanyaan[i]['id']}">
                                        <i class="fas fa-solid fa-trash"></i>
                                        </button>
                                        @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>      
                                        @endcan
                                    </td>
                            </tr>
                            `;
                }
                    $('#pertanyaan_table > tbody:first').html(data);
                        $(document).ready(function() 
                        {
                            $('#pertanyaan_table').DataTable( {
                                "destroy": true,
                                "scrollX": true,
                                "autoWidth" : false,
                                "searching": true,
                                "aaSorting" : false
                        });


                } );
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function get_departement_name(){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_aspek_name')}}",
            type: "get",
            dataType: 'json',
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#select_departement').empty();
                $('#select_departement').append('<option value ="">Semua Departement</option>');
                $.each(response.departement_name,function(i,data){
                    $('#select_departement').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                $('#select_aspek').empty();
                $('#select_aspek').append('<option value ="">Semua Aspek</option>');
                $.each(response.aspek_name,function(i,data){
                    $('#select_aspek').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                get_data_pertanyaan()
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function get_aspek_name(){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_aspek_name')}}",
            type: "get",
            dataType: 'json',
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#aspek_name').empty();
                $('#aspek_name').append('<option value ="">Pilih Aspek</option>');
                $.each(response.aspek_name,function(i,data){
                    $('#aspek_name').append('<option value="'+data.id+'">' + data.name +'</option>');
                });

                $('#departement_name').empty();
                $('#departement_name').append('<option value ="">Pilih Departement</option>');
                $.each(response.departement_name,function(i,data){
                    $('#departement_name').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function save_add_pertanyaan()
    {
        var pertanyaan_name = $('#pertanyaan_name').val();
        var aspek_id = $('#aspek_id').val();
        var departement_id = $('#departement_id').val();
      
        var data ={
            'pertanyaan_name':pertanyaan_name,
            'aspek_id':aspek_id,
            'departement_id':departement_id,
        }   
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('save_pertanyaan')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('')
                if(response.status==422)
                {
                    $.each(response.message, (key, val) => 
                    {
                       $('span.'+key+'_error').text(val[0])
                    });
                    return false;
                }else{
                    toastr['success'](response.message);
                    window.location = "{{route('master_pertanyaan')}}";
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function update(){
        var pertanyaan_id = $('#pertanyaan_id').val()
        var departement_id_update = $('#departement_id_update').val()
        var aspek_id_update = $('#aspek_id_update').val()
        var pertanyaan_name_update = $('#pertanyaan_name_update').val()
        var data ={
            'pertanyaan_id':pertanyaan_id,
            'departement_id_update':departement_id_update,
            'aspek_id_update':aspek_id_update,
            'pertanyaan_name_update':pertanyaan_name_update,
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('update_pertanyaan')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('')
                if(response.status==422)
                {
                    $.each(response.message, (key, val) => 
                    {
                       $('span.'+key+'_error').text(val[0])
                    });
                    return false;
                }else{
                    toastr['success'](response.message);
                    window.location = "{{route('master_pertanyaan')}}";
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    }
// End Function
</script>

