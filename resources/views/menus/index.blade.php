<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menus') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Menus</h3>
                        </div>
                        <div class="py-3">
                          
                            @can('add-menus')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_menus" style="float:right">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="menus_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Link</th>
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

            {{-- Sub Menus --}}
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Sub Menus</h3>
                        </div>
                        <div class="py-3">
                            @can('add-menus')
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="add_submenus" style="float:right">
                                <i class="fas fa-plus"></i>
                            </button>
                            @endcan
                         
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="submenus_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Link</th>
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
    {{-- Add Menus --}}
    
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="exampleModalLg">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Add Menus</h4>
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
                                            <input type="text" class="w-full" name="menus_name" id="menus_name">
                                            <span  style="color:red;" class="message_error text-red block menus_name_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label for="">Type</label>
                                        </div>
                                        <div class="col-span-3">
                                            <select name="menus_type_option" id="menus_type_option">
                                                <option value="">Pilih Tipe Menu</option>
                                                <option value="1">Menus</option>
                                                <option value="2">Submenus</option>
                                            </select>
                                            <input type="hidden" class="w-full" name="type_menus" id="type_menus">
                                            <span  style="color:red;" class="message_error text-red block type_menus_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label for="">Link</label>
                                        </div>
                                        <div class="col-span-3">
                                            <input type="text" class="w-full" name="menus_link" id="menus_link">
                                            <span  style="color:red;" class="message_error text-red block menus_link_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4 mb-4">
                                        <div class="col-span-1 mt-2">
                                            <label for="">Description</label>
                                        </div>
                                        <div class="col-span-3">
                                            <textarea class="shadow appearance-none border rounded w-full py-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description_menus"name="description_menus"></textarea>
                                            <span  style="color:red;" class="message_error text-red block description_menus_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_menus">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_menus">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
</div>
    {{--End Add Menus --}}

{{-- Add SubMenus --}}
    
        <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addSubmenusModal">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                            <div class="sm:flex sm:items-start">
                                <h4>Form Add Submenus</h4>
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
                                                <input type="text" class="w-full" name="submenus_name" id="submenus_name">
                                                <span  style="color:red;" class="message_error text-red block submenus_name_error"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="grid grid-cols-4">
                                            <div class="col-span-1 mt-2">
                                                <label for="">Derivative</label>
                                            </div>
                                            <div class="col-span-3">
                                                <select name="submenus_type_option" class="select2" id="submenus_type_option" style="width: 100%">
                                                </select>
                                                <input type="hidden" class="w-full" name="type_submenus" id="type_submenus">
                                                <span  style="color:red;" class="message_error text-red block type_submenus_error"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="grid grid-cols-4">
                                            <div class="col-span-1 mt-2">
                                                <label for="">Link</label>
                                            </div>
                                            <div class="col-span-3">
                                                <input type="text" class="w-full" name="submenus_link" id="submenus_link">
                                                <span  style="color:red;" class="message_error text-red block submenus_link_error"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="grid grid-cols-4 mb-4">
                                            <div class="col-span-1 mt-2">
                                                <label for="">Description</label>
                                            </div>
                                            <div class="col-span-3">
                                                <textarea class="shadow appearance-none border rounded w-full py-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description_submenus"name="description_submenus"></textarea>
                                                <span  style="color:red;" class="message_error text-red block description_submenus_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_submenus">Save</button>
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_submenus">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
{{--End Add Menus --}}

{{-- Edit Menus --}}
    
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="EditMenusModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Edit Menus</h4>
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
                                            <input type="text" class="w-full" name="menus_name_update" id="menus_name_update">
                                            <input type="hidden" class="w-full" name="id_menus_update" id="id_menus_update">
                                            <span  style="color:red;" class="message_error text-red block menus_name_update_error"></span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Status</label>
                                        </div>
                                        <div class="col-span-3 mt-3">
                                            <input type="checkbox" style="border-radius: 5px !important;" class="menus_status_update" id="menus_status_update" name="menus_status_update">
                                            <label for="cc" id="label_menus_status" style="margin-top:10px">
                                                Active                  
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4 mb-4">
                                        <div class="col-span-1 mt-2">
                                            <label for="">Description</label>
                                        </div>
                                        <div class="col-span-3">
                                            <textarea class="shadow appearance-none border rounded w-full py-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description_menus_update"name="description_menus_update"></textarea>
                                            <span  style="color:red;" class="message_error text-red block description_menus_update_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_update_menus">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_update_menus">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
</div>
{{--End Edit Menus --}}

{{-- Edit Submenus --}}
<div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="editSubmenusModal">
    <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                    <div class="sm:flex sm:items-start">
                        <h4>Form Edit Submenus</h4>
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
                                        <input type="text" class="w-full" name="submenus_name_update" id="submenus_name_update">
                                        <input type="hidden" class="w-full" name="id_submenus_update" id="id_submenus_update">
                                        <span  style="color:red;" class="message_error text-red block submenus_name_update_error"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="grid grid-cols-4">
                                    <div class="col-span-1 mt-2">
                                        <label for="">Derivative</label>
                                    </div>
                                    <div class="col-span-3">
                                        <select name="submenus_type_option_update" class="select2" id="submenus_type_option_update" style="width: 100%">
                                        </select>
                                        <input type="hidden" class="w-full" name="type_submenus_update" id="type_submenus_update">
                                        <span  style="color:red;" class="message_error text-red block type_submenus_update_error"></span>
                                    </div>
                                </div>
                               
                                <div class="grid grid-cols-4">
                                    <div class="col-span-1 mt-2">
                                        <label  for="">Status</label>
                                    </div>
                                    <div class="col-span-3 mt-3">
                                        <input type="checkbox" style="border-radius: 5px !important;" class="submenus_status_update" id="submenus_status_update" name="submenus_status_update">
                                        <label for="cc" id="label_submenus_status" style="margin-top:10px">
                                            Active                  
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="grid grid-cols-4 mb-4">
                                    <div class="col-span-1 mt-2">
                                        <label for="">Description</label>
                                    </div>
                                    <div class="col-span-3">
                                        <textarea class="shadow appearance-none border rounded w-full py-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description_submenus_update"name="description_submenus_update"></textarea>
                                        <span  style="color:red;" class="message_error text-red block description_submenus_update_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="update_submenus">Save</button>
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_update_submenus">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></button>
                </div>
            </div>
        </div>
    </div>
</div>
{{--End Edit Subenus --}}


</x-app-layout>
<script>
$('.select2').select2()
// Call Function
    get_data()
    get_data_submenus()
// End Call Function
// Operation here
    $('#add_menus').on('click', function(){
        $('#exampleModalLg').show();
    })
    $('#close_add_menus').on('click', function(){
        clear_add_menus()
        $('#exampleModalLg').hide();
    })
    $('#add_submenus').on('click', function(){
        $('#addSubmenusModal').show();
        get_menus_name()
    })
    $('#close_add_submenus').on('click', function(){
        $('#addSubmenusModal').hide();
    })
    $('#save_add_menus').on('click', function(){
        save_menus()
    })
    $('#save_add_submenus').on('click', function(){
        add_submenus()
    })
    $('#menus_type_option').on('change', function(){
        var menus_type_option = $('#menus_type_option').val();
        $('#type_menus').val(menus_type_option);
    })
    $('#submenus_type_option').on('change', function(){
        var submenus_type_option = $('#submenus_type_option').val();
        $('#type_submenus').val(submenus_type_option);
    })
    $('#submenus_type_option_update').on('change', function(){
        var submenus_type_option_update = $('#submenus_type_option_update').val();
        $('#type_submenus_update').val(submenus_type_option_update);
    })
    $('#close_update_menus').on('click', function(){
        $('#EditMenusModal').hide();
    })
    $('#close_update_submenus').on('click', function(){
        $('#editSubmenusModal').hide();
    })
    $('#update_submenus').on('click', function(){
        update_submenus()
    })
    
    $('#save_update_menus').on('click', function(){
        update_menus()
    })
// End Operation
    $('#menus_table').on('click', '.editMenus', function() {
        var id = $(this).data('id');
        $('#EditMenusModal').show();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('getDetailMenus')}}",
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
                var output = response.detail[0];
                $('#menus_name_update').val(output.name);
                $('#description_menus_update').val(output.description);
                $('#id_menus_update').val(output.id);
              if(output.status == 1){
                document.getElementById("menus_status_update").checked = true;
                $('#label_menus_status').html('Active')
            }else{
                document.getElementById("menus_status_update").checked = false;
                  $('#label_menus_status').html('Innactive')
            }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#menus_table').on('click', '.deleteMenus', function() {
        var id = $(this).data('id');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('deleteMenus')}}",
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
                toastr['success'](response.message);
                window.location = "{{route('menus')}}";
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#submenus_table').on('click', '.editSubmenus', function() {
        var id = $(this).data('id');
       $('#editSubmenusModal').show()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('getDetailSubmenus')}}",
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
                var output = response.detail[0];
                $('#id_submenus_update').val(output.id);
                $('#submenus_name_update').val(output.name);
                $('#description_submenus_update').val(output.description);
                $('#submenus_type_option_update').empty();
                $('#submenus_type_option_update').append('<option value="'+output.menus_name+'">' + output.menus_name +'</option>');
               $('#type_submenus_update').val(output.id_menus);
                $.each(response.menus_name,function(i,data){
                    $('#submenus_type_option_update').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
              if(output.status == 1){
                document.getElementById("submenus_status_update").checked = true;
                $('#label_submenus_status').html('Active')
                }else{
                    document.getElementById("submenus_status_update").checked = false;
                    $('#label_submenus_status').html('Innactive')
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#submenus_table').on('click', '.deleteSubmenus', function() {
        var id = $(this).data('id');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('deleteSubmenus')}}",
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
                toastr['success'](response.message);
                window.location = "{{route('menus')}}";
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
// Function here
    function clear_add_menus(){
        $('#menus_name').val('')
        $('#menus_link').val('')
        $('#description_menus').val('')
        $('#type_menus').val('')
        $('.message_error').html('')
    }

    function clear_add_submenus(){
        $('#submenus_name').val('')
        $('#type_submenus').val('')
        $('#submenus_link').val('')
        $('#description_submenus').val('')
        $('.message_error').html('')
    }

    function get_data(){

        var table = $('#menus_table').DataTable({
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
                    data: 'link', 
                    name: 'link'
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

    function get_data_submenus(){

        var table = $('#submenus_table').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            autoWidth:false,
            scrollX:true,
            ajax: {
                url: "{{route('get_submenus')}}",
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
                    data: 'link', 
                    name: 'link'
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
                    width: '25%',
                    className:'text-center'
                }
            ],
          
        })
    }

    function save_menus()
    {
        var menus_name = $('#menus_name').val();
        var menus_link = $('#menus_link').val();
        var type_menus = $('#type_menus').val();
        var description_menus = $('#description_menus').val();
        var data ={
            'menus_name':menus_name,
            'menus_link':menus_link,
            'type_menus':type_menus,
            'description_menus':description_menus,
        }   
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('save_menus')}}",
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
                    $('#save').prop('disabled', false);
                    return false;
                }else{
                    toastr['success'](response.message);
                    $('#exampleModalLg').hide()
                    window.location = "{{route('menus')}}";
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }

    function get_menus_name(){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('menus_name')}}",
            type: "get",
            dataType: 'json',
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#submenus_type_option').empty();
                $('#submenus_type_option').append('<option value ="">Pilih Menu</option>');
                $.each(response.menus_name,function(i,data){
                    $('#submenus_type_option').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }

    function add_submenus(){
        var submenus_name        =    $('#submenus_name').val()
        var type_submenus        =    $('#type_submenus').val()
        var submenus_link        =    $('#submenus_link').val()
        var description_submenus =    $('#description_submenus').val()
        
        var data={
            'submenus_name':submenus_name,
            'type_submenus':type_submenus,
            'submenus_link':submenus_link,
            'description_submenus':description_submenus
        }
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('save_submenus')}}",
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
                        $('#save').prop('disabled', false);
                        return false;
                    }else{
                        toastr['success'](response.message);
                        $('#addSubmenusModal').hide()
                        window.location = "{{route('menus')}}";
                      
                    }
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });

     
    }

    function update_menus(){
        var menus_name_update = $('#menus_name_update').val()
        var description_menus_update = $('#description_menus_update').val()
        var id_menus_update = $('#id_menus_update').val()
        var is_active = '';
        var status = document.getElementById("menus_status_update");
        status.checked==true?is_active='1':is_active='0'
        var data ={
            'menus_name_update':menus_name_update,
            'id_menus_update':id_menus_update,
            'menus_status_update':is_active,
            'description_menus_update':description_menus_update
        };
       
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('update_menus')}}",
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
                        $('#save').prop('disabled', false);
                        return false;
                    }else{
                        toastr['success'](response.message);
                        $('#addSubmenusModal').hide()
                        window.location = "{{route('menus')}}";
                    }
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });

    }

    function update_submenus(){ 
        var submenus_name_update = $('#submenus_name_update').val()
        var description_submenus_update = $('#description_submenus_update').val()
        var type_submenus_update = $('#type_submenus_update').val()
        var id_submenus_update = $('#id_submenus_update').val()
        var is_active = '';
        var status = document.getElementById("submenus_status_update");
        status.checked==true?is_active='1':is_active='0'
        var data ={
            'submenus_name_update':submenus_name_update,
            'type_submenus_update':type_submenus_update,
            'id_submenus_update':id_submenus_update,
            'status':is_active,
            'description_submenus_update':description_submenus_update
        };
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('update_submenus')}}",
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
                        $('#save').prop('disabled', false);
                        return false;
                    }else{
                        toastr['success'](response.message);
                        $('#addSubmenusModal').hide()
                        window.location = "{{route('menus')}}";
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

