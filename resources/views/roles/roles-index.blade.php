<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role & Permission') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Roles</h3>
                        </div>
                        <div class="py-3">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_roles" style="float:right">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="roles_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Guard Name</th>
                                    <th class="px-4 py-2">Action</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Permission --}}
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Permission</h3>
                        </div>
                        <div class="py-3">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="add_permission" style="float:right">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="permission_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Guard Name</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Permission --}}

            {{-- Modal Add Roles --}}
            <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addRolesModal">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                                <div class="sm:flex sm:items-start">
                                    <h4>Form Add Roles</h4>
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
                                                    <input type="text" class="w-full" name="roles_name" id="roles_name">
                                                    <span  style="color:red;" class="message_error text-red block roles_name_error"></span>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                                <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_roles">Save</button>
                                <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_roles">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal Add Roles --}}

            {{-- Add Permission --}}
            <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addPermissionModal">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                                <div class="sm:flex sm:items-start">
                                    <h4>Form Add Permission</h4>
                                </div>
                               
                            </div>
                            <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                                <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                                    <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                        <div class="container px-6">
                                            <div class="grid grid-cols-4">
                                                <div class="col-span-2 mt-2">
                                                    <label  for="">Permission Option</label>
                                                </div>
                                                <div class="col-span-2">
                                                  <select name="" id="permission_option">
                                                    <option value="view">View</option>
                                                    <option value="add">Add</option>
                                                    <option value="update">Update</option>
                                                    <option value="delete">Delete</option>
                                                  </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="grid grid-cols-4">
                                                <div class="col-span-2 mt-2">
                                                    <label  for="">Permission Menus</label>
                                                </div>
                                                <div class="col-span-2">
                                                  <select name="menus_name"class="select2" style="width:100%" id="menus_name">
                                                  </select>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                                <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_permission">Save</button>
                                <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_permission">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Add Permission --}}

            {{-- Modal Edit Roles --}}
            <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="editRolesModal">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                            <div class="sm:flex sm:items-start">
                                <h4>Form Edit Roles</h4>
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
                                                <input type="text" class="w-full" name="roles_name_update" id="roles_name_update">
                                                <input type="hidden" class="w-full" name="roles_id" id="roles_id">
                                                <span  style="color:red;" class="message_error text-red block roles_name_update_error"></span>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="update_roles">Save</button>
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_edit_roles">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        {{-- End Modal Edit Roles --}}
        </div>
    </div>
</x-app-layout>
<script>
     $('.select2').select2()
    //  Call Function
    get_data()
    get_data_permission()
    //  End Call Function
    $('#add_roles').on('click', function(){
        $('#addRolesModal').show()
    })
    $('#close_add_roles').on('click', function(){
        $('#addRolesModal').hide()
    })
    $('#add_permission').on('click', function(){
        permission_menus_name()
        $('#addPermissionModal').show()
    })
    $('#close_add_permission').on('click', function(){
        $('#addPermissionModal').hide()
    })
    $('#close_edit_roles').on('click', function(){
        $('#editRolesModal').hide()
    })
    $('#save_add_roles').on('click', function(){
        save_role()
    })
    $('#save_add_permission').on('click', function(){
        save_permission()
    })
    $('#update_roles').on('click', function(){
        update_roles()
    })
    $('#roles_table').on('click', '.editRoles', function() {
        var id = $(this).data('id');
        $('#editRolesModal').show()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('detail_roles')}}",
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
                $('#roles_name_update').val(response.detail[0].name);
                $('#roles_id').val(response.detail[0].id);
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#roles_table').on('click', '.deleteRoles', function() {
        var id = $(this).data('id');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('delete_roles')}}",
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
                if(response.status==422)
                {
                    toastr['error'](response.message);
                    return false
                }else{
                    toastr['success'](response.message);
                    window.location = "{{route('role')}}";
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#permission_table').on('click', '.deletePermission', function() {
        var id = $(this).data('id');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('delete_permission')}}",
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
                if(response.status==422)
                {
                    toastr['error'](response.message);
                    return false
                }else{
                    toastr['success'](response.message);
                    window.location = "{{route('role')}}";
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    function get_data(){

        var table = $('#roles_table').DataTable({
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
                    data: 'guard_name', 
                    name: 'guard_name',
                    className:'text-center',
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
    function get_data_permission(){

        var table = $('#permission_table').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            autoWidth:false,
            scrollX:true,
            ajax: {
                url: "{{route('get_premission')}}",
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
                    data: 'guard_name', 
                    className:'text-center',
                    name: 'guard_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    className:'text-center',
                    width: '25%'

                }
            ],
          
        })
    }
    function save_role(){
        var roles_name = $('#roles_name').val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('save_roles')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: {
                'roles_name':roles_name
            },
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
                    window.location = "{{route('role')}}";
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function save_permission(){
        var menus_name = $('#menus_name').val();
        var permission_option = $('#permission_option').val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('save_permission')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: {
                'menus_name':menus_name,
                'permission_option':permission_option,
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('')
                if(response.status==422)
                {
                    toastr['error'](response.message);
                    return false
                }else{
                    toastr['success'](response.message);
                    window.location = "{{route('role')}}";
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function permission_menus_name()
    {
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('permission_menus_name')}}",
            type: "get",
            dataType: 'json',
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#menus_name').empty();
                $('#menus_name').append('<option value ="">Pilih Menu</option>');
                $.each(response.menus_name,function(i,data){
                    $('#menus_name').append('<option value="'+data.link+'">' + data.name +'</option>');
                });
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function update_roles(){
        var roles_name_update = $('#roles_name_update').val();
        var roles_id = $('#roles_id').val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('update_roles')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: {
                'roles_name_update':roles_name_update,
                'roles_id':roles_id,
            },
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
                    window.location = "{{route('role')}}";
                }
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    }



</script>

