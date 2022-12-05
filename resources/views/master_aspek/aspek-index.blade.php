<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Aspek & Departement') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Aspek</h3>
                        </div>
                        <div class="py-3">
                          
                            @can('add-master_aspek')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_aspek" style="float:right">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="aspek_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Action</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Departement --}}
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Departement</h3>
                        </div>
                        <div class="py-3">
                            @can('add-departement')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="add_departement" style="float:right">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endcan
                         
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="departement_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Status</th>
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
    </div>

     {{-- Add Aspek --}}
    
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addAspekModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Add Aspek</h4>
                        </div>
                       
                    </div>
                    <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                        <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="container px-6">
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Name</label>
                                        </div>
                                        <div class="col-span-3">
                                            <input type="text" class="w-full" name="aspek_name" id="aspek_name">
                                            <span  style="color:red;" class="message_error text-red block aspek_name_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_aspek">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_aspek">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Add Aspek --}}
     {{-- Edit Aspek --}}
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="editAspekModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Edit Aspek</h4>
                        </div>
                       
                    </div>
                    <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                        <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="container px-6">
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Name</label>
                                        </div>
                                        <div class="col-span-3">
                                            <input type="text" class="w-full" name="aspek_name_update" id="aspek_name_update">
                                            <input type="hidden" class="w-full" name="id_aspek_update" id="id_aspek_update">
                                            <span  style="color:red;" class="message_error text-red block aspek_name_update_error"></span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Status</label>
                                        </div>
                                        <div class="col-span-3 mt-3">
                                            <input type="checkbox" style="border-radius: 5px !important;" class="flg_aktif_aspek" id="flg_aktif_aspek" name="flg_aktif_aspek">
                                            <label for="cc" id="label_aspek" style="margin-top:10px">
                                                Active                  
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_edit_aspek">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_edit_aspek">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Edit Aspek --}}

     {{-- Add Departement --}}
    
     <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addDepeartementModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Add Departement</h4>
                        </div>
                       
                    </div>
                    <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                        <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="container px-6">
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Name</label>
                                        </div>
                                        <div class="col-span-3">
                                            <input type="text" class="w-full" name="departement_name" id="departement_name">
                                            <span  style="color:red;" class="message_error text-red block departement_name_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_departement">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_departement">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--End Add Departement --}}
    {{-- Edit Aspek --}}
         <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="editDepartementModal">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                            <div class="sm:flex sm:items-start">
                                <h4>Form Edit Departement</h4>
                            </div>
                           
                        </div>
                        <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                            <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                    <div class="container px-6">
                                        <div class="grid grid-cols-4">
                                            <div class="col-span-1 mt-2">
                                                <label  for="">Name</label>
                                            </div>
                                            <div class="col-span-3">
                                                <input type="text" class="w-full" name="departement_name_update" id="departement_name_update">
                                                <input type="hidden" class="w-full" name="id_departement_update" id="id_departement_update">
                                                <span  style="color:red;" class="message_error text-red block departement_name_update_error"></span>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-4">
                                            <div class="col-span-1 mt-2">
                                                <label  for="">Status</label>
                                            </div>
                                            <div class="col-span-3 mt-3">
                                                <input type="checkbox" style="border-radius: 5px !important;" class="flg_aktif_departement" id="flg_aktif_departement" name="flg_aktif_departement">
                                                <label for="cc" id="label_departement" style="margin-top:10px">
                                                    Active                  
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_edit_departement">Save</button>
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_edit_departement">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
get_data();
get_data_departement();
// End Call Function
// Operation here
    // Apek
    $('#add_aspek').on('click', function(){
        $('#addAspekModal').show();
        $('.message_error').html('')
    })
    $('#close_add_aspek').on('click', function(){
        $('#addAspekModal').hide();
    })
    $('#close_edit_aspek').on('click', function(){
        $('#editAspekModal').hide();
    })
    $('#save_add_aspek').on('click', function(){
        save_aspek()
    })
    $('#save_edit_aspek').on('click', function(){
        update_aspek()
    })
    $('#aspek_table').on('click', '.editAspek', function() {
        var id = $(this).data('id');
       $('#editAspekModal').show()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_aspek')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data:{
                'id':id
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
               $('#id_aspek_update').val(response.detail.id)
               $('#aspek_name_update').val(response.detail.name)
                if(response.detail.flg_aktif == 1){
                document.getElementById("flg_aktif_aspek").checked = true;
                $('#label_aspek').html('Active')
                }else{
                    document.getElementById("flg_aktif_aspek").checked = false;
                    $('#label_aspek').html('Innactive')
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#aspek_table').on('click', '.deleteAspek ', function() {
        var id = $(this).data('id');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('delete_aspek')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data:{
                'id':id
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                if(response.status == 200)
                {
                    toastr['success'](response.message);
                    window.location = "{{route('master_aspek')}}";
                }else{
                    toastr['error'](response.message);

                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    // End Aspek
    // Departement
    $('#add_departement').on('click', function(){
        $('#addDepeartementModal').show()
    })
    $('#close_add_departement').on('click', function(){
        $('#addDepeartementModal').hide()
    })
    $('#save_add_departement').on('click', function(){
        save_departement()
    })
    $('#departement_table').on('click', '.editDepartement', function() {
        var id = $(this).data('id');
        $('#editDepartementModal').show()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('detail_departement')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data:{
                'id':id
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#id_departement_update').val(response.detail.id)
               $('#departement_name_update').val(response.detail.name)
                if(response.detail.flg_aktif == 1){
                document.getElementById("flg_aktif_departement").checked = true;
                $('#label_departement').html('Active')
                }else{
                    document.getElementById("flg_aktif_departement").checked = false;
                    $('#label_departement').html('Innactive')
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#departement_table').on('click', '.deleteDepartement ', function() {
        var id = $(this).data('id');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('delete_departement')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data:{
                'id':id
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                if(response.status == 200)
                {
                    toastr['success'](response.message);
                    window.location = "{{route('master_aspek')}}";
                }else{
                    toastr['error'](response.message);

                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#save_edit_departement').on('click', function(){
        update_departement()
    })
    $('#close_edit_departement').on('click', function(){
        $('#editDepartementModal').hide();
    })
    // End Departement

// End Operation here
// Function here
    function get_data(){
        var table = $('#aspek_table').DataTable({
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
                    data: 'name', 
                    name: 'name'
                },
                {
                    data: 'status', 
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    width: '25%'
                }
            ],
          
        })
    }
    function get_data_departement(){
        var table = $('#departement_table').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            autoWidth:false,
            scrollX:true,
            ajax: {
                url: "{{route('get_departement')}}",
                // type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'name', 
                    name: 'name'
                },
                {
                    data: 'status', 
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    width: '25%'
                }
            ],
          
        })
    }
    function save_aspek(){
        var aspek_name = $('#aspek_name').val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('add_aspek')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: {'aspek_name':aspek_name},
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('');
                if(response.status==422)
                    {
                        $.each(response.message, (key, val) => 
                        {
                        $('span.'+key+'_error').text(val[0])
                        });
                        return false;
                    }else{
                        toastr['success'](response.message);
                        window.location = "{{route('master_aspek')}}";
                      
                    }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function update_aspek(){
        var aspek_name_update = $('#aspek_name_update').val();
        var id_aspek_update = $('#id_aspek_update').val();
        var is_active = '';
        var status = document.getElementById("flg_aktif_aspek");
        status.checked==true?is_active='1':is_active='0'
        var data ={
            'aspek_name_update':aspek_name_update,
            'id_aspek_update':id_aspek_update,
            'is_active':is_active,
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('update_aspek')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('');
                if(response.status==422)
                    {
                        $.each(response.message, (key, val) => 
                        {
                        $('span.'+key+'_error').text(val[0])
                        });
                        return false;
                    }else{
                        toastr['success'](response.message);
                        window.location = "{{route('master_aspek')}}";
                      
                    }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    
    // Departement
    function save_departement(){
        var departement_name = $('#departement_name').val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('add_departement')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: {'departement_name':departement_name},
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('');
                if(response.status==422)
                    {
                        $.each(response.message, (key, val) => 
                        {
                        $('span.'+key+'_error').text(val[0])
                        });
                        return false;
                    }else{
                        toastr['success'](response.message);
                        window.location = "{{route('master_aspek')}}";
                      
                    }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function update_departement(){
        var departement_name_update = $('#departement_name_update').val();
        var id_departement_update = $('#id_departement_update').val();
        var is_active = '';
        var status = document.getElementById("flg_aktif_departement");
        status.checked==true?is_active='1':is_active='0'
        var data ={
            'departement_name_update':departement_name_update,
            'id_departement_update':id_departement_update,
            'is_active':is_active,
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('update_departement')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('');
                if(response.status==422)
                    {
                        $.each(response.message, (key, val) => 
                        {
                        $('span.'+key+'_error').text(val[0])
                        });
                        return false;
                    }else{
                        toastr['success'](response.message);
                        window.location = "{{route('master_aspek')}}";
                      
                    }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    // End Departement
// End Function
</script>

