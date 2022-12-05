<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Access') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">Role User</h3>
                        </div>
                        <div class="py-3">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_roles_user" style="float:right">
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
                                    <th class="px-4 py-2">Role</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Role Permission --}}
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">Role Permission</h3>
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="role_permission_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Role Permission --}}         
        </div>
    </div>
    {{-- Add Role User --}}
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addRoleUSerModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Add Role User</h4>
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
                                           <select name="username" id="username" class="select2" style="width:100%"></select>
                                            <input type="hidden" class="w-full" name="user_id" id="user_id">
                                            <span  style="color:red;" class="message_error text-red block user_id_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Role</label>
                                        </div>
                                        <div class="col-span-3">
                                           <select name="roles" id="roles" class="select2" style="width:100%"></select>
                                            <input type="hidden" class="w-full" name="role_id" id="role_id">
                                            <span  style="color:red;" class="message_error text-red block role_id_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_roles_user">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_roles_user">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Role User --}}
    {{-- Add Role Permission --}}
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addRolePermissionModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Role Permission</h4>
                        </div>
                       
                    </div>
                    <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                        <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="container px-6">
                                    <input type="hidden" id="role_id_permission">
                                    <table class="table-auto w-full border-collapse" id="table_pemission_innactive">
                                        <thead>
                                            <tr class="border">
                                                <th style="text-align: left"><input type="checkbox" id="check_all" name="check_all" class="check_all" style="border-radius: 5px !important;"></th>
                                                <th style="text-align: left">Permission Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <br>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_role_permission">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="delete_role_permission">Delete
                        </button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_role_permission">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Role Permission --}}

    {{-- Edit Role User --}}
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="editRoleUSerModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Edit Role User</h4>
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
                                            <input type="text" class="w-full" name="user_name_update" id="user_name_update" disabled>
                                            <input type="hidden" class="w-full" name="user_id_update" id="user_id_update">
                                            <span  style="color:red;" class="message_error text-red block user_id_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Role</label>
                                        </div>
                                        <div class="col-span-3">
                                           <select name="roles_update" id="roles_update" class="select2" style="width:100%"></select>
                                            <input type="hidden" class="w-full" name="role_id_update" id="role_id_update">
                                            <span  style="color:red;" class="message_error text-red block role_id_update_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_edit_roles_user">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_edit_roles_user">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Edit Role User --}}
</x-app-layout>
<script>
     $('.select2').select2()
    //  Call Function
    get_data()
    get_data_role_user()
    // End Coll Function
    // Operation
    $('#add_roles_user').on('click', function(){
        $('#addRoleUSerModal').show()
        get_username()
    })
    $('#close_add_roles_user').on('click', function(){
        $('#addRoleUSerModal').hide()
    })
    $('#close_edit_roles_user').on('click', function(){
        $('#editRoleUSerModal').hide()
    })

    $('#save_add_roles_user').on('click', function(){
        add_roles()
    })
    $('#save_edit_roles_user').on('click', function(){
        update_role_user()
    })
    $('#username').on('change', function(){
        var username = $('#username').val();
        $('#user_id').val(username);
    })
    $('#roles').on('change', function(){
        var roles = $('#roles').val();
        $('#role_id').val(roles);
    })
    $('#roles_update').on('change', function(){
        var roles_update = $('#roles_update').val();
        $('#role_id_update').val(roles_update);
    })
    $('#role_permission_table').on('click', '.addPermission', function() {
        var id = $(this).data('id');
        $('#addRolePermissionModal').show()
        $('#delete_role_permission').hide()
        $('#save_add_role_permission').show()
        $('#table_pemission_innactive').DataTable().clear();
        $('#table_pemission_innactive').DataTable().destroy();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_permisssion')}}",
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
                $('#role_id_permission').val(id);
                var data=''
                for(i = 0; i < response.permission_innactive.length; i++ )
                {
                    data += `<tr style="text-align: center;">
                                <td style="text-align: left;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response.permission_innactive[i]['id']}"  data-name="${response.permission_innactive[i]['name']}"></td>
                                <td style="text-align: left;">${response.permission_innactive[i]['name']==null?'':response.permission_innactive[i]['name']}</td>
                            </tr>
                            `;
                }
                    $('#table_pemission_innactive > tbody:first').html(data);
                        $(document).ready(function() 
                        {
                            $('#table_pemission_innactive').DataTable( {
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

    });
    $('#roles_table').on('click', '.editRole', function() {
        var id = $(this).data('id');
        $('#editRoleUSerModal').show();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('detail_role_user')}}",
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
                $('#user_name_update').val(response.detail[0].user_name)
                $('#user_id_update').val(response.detail[0].model_id)
                $('#role_id_update').val(response.detail[0].role_id)
                $('#roles_update').empty();
                $('#roles_update').append('<option value ="'+response.detail[0].role_id+'">'+response.detail[0].roles_name+'</option>');
                $.each(response.role,function(i,data){
                    $('#roles_update').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#role_permission_table').on('click', '.listPermission', function() {
        var id = $(this).data('id');
        $('#addRolePermissionModal').show()
        $('#delete_role_permission').show()
        $('#save_add_role_permission').hide()
        $('#table_pemission_innactive').DataTable().clear();
        $('#table_pemission_innactive').DataTable().destroy();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_permisssion')}}",
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
                $('#role_id_permission').val(id);
                var data=''
                for(i = 0; i < response.permission_active.length; i++ )
                {
                    data += `<tr style="text-align: center;">
                                <td style="text-align: left;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response.permission_active[i]['id']}"  data-name="${response.permission_active[i]['name']}"></td>
                                <td style="text-align: left;">${response.permission_active[i]['name']==null?'':response.permission_active[i]['name']}</td>
                            </tr>
                            `;
                }
                    $('#table_pemission_innactive > tbody:first').html(data);
                        $(document).ready(function() 
                        {
                            $('#table_pemission_innactive').DataTable( {
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

    });
    $('#check_all').on('click', function(){
      // Get all rows with search applied
        var table = $('#table_pemission_innactive').DataTable( {
                "destroy": true,
                "scrollX": true,
                "autoWidth" : false,
                "searching": false,
                "aaSorting" : [],
              
            } );

      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });
    $('#close_add_role_permission').on('click', function(){
        $('#addRolePermissionModal').hide()
    })
    $('#save_add_role_permission').click(function () {
                    var checkArray = [];
                    var lengthParsed = 0;
                    var role_permission_table = $('#table_pemission_innactive').dataTable();
                    var rowcollection =  role_permission_table.$("input:checkbox[name=check]:checked",{"page": "all"});
                    rowcollection.each(function(){
                        checkArray.push($(this).data("name"));
                    });

                    lengthParsed = checkArray.length;
                    if(lengthParsed == 0)
                    {
                        toastr['error']('Belum memilih permission sama sekali !');
                        return false;
                    }

                    var data ={
                        'checkArray':checkArray,
                        'role_id_permission':$('#role_id_permission').val(),

                    }
                    add_role_permission(data)
                   
        }); 
        $('#delete_role_permission').click(function () {
                    var checkArray = [];
                    var lengthParsed = 0;
                    var role_permission_table = $('#table_pemission_innactive').dataTable();
                    var rowcollection =  role_permission_table.$("input:checkbox[name=check]:checked",{"page": "all"});
                    rowcollection.each(function(){
                        checkArray.push($(this).val());
                    });

                    lengthParsed = checkArray.length;
                    if(lengthParsed == 0)
                    {
                        toastr['error']('Belum memilih permission sama sekali !');
                        return false;
                    }

                    var data ={
                        'checkArray':checkArray,
                        'role_id_permission':$('#role_id_permission').val(),

                    }
                    delete_role_permission(data)
                   
        }); 
   
        // End Operation
    // Function
    function get_data()
    {
        var table = $('#role_permission_table').DataTable({
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
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    width: '25%'
                }
            ],
          
        })
    }
    function get_data_role_user()
    {
        var table = $('#roles_table').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        autoWidth:false,
        scrollX:true,
        ajax: {
            url: "{{route('get_data_role_user')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            },
            columns: [
                {
                    data: 'user_name', 
                    name: 'user_name'
                },
                {
                    data: 'roles_name', 
                    name: 'roles_name',
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
    function get_username(){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_username')}}",
            type: "get",
            dataType: 'json',
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#username').empty();
                $('#username').append('<option value ="">Pilih User</option>');
                $.each(response.data,function(i,data){
                    $('#username').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                $('#roles').empty();
                $('#roles').append('<option value ="">Pilih Role</option>');
                $.each(response.role,function(i,data){
                    $('#roles').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function add_roles(){
        var user_id = $('#user_id').val()
        var role_id = $('#role_id').val()

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('add_roles_user')}}",
            type: "post",
            dataType: 'json',
            data:{
                'user_id':user_id,
                'role_id':role_id,
            },
            async: true,
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
                    window.location = "{{route('user_access')}}";
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    }
    function add_role_permission(data){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('add_role_permission')}}",
            type: "post",
            dataType: 'json',
            data:data,
            async: true,
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
                    window.location = "{{route('user_access')}}";
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function delete_role_permission(data){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('delete_role_permission')}}",
            type: "get",
            dataType: 'json',
            data:data,
            async: true,
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
                    window.location = "{{route('user_access')}}";
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function update_role_user(){
        var role_id_update = $('#role_id_update').val()
        var user_id_update = $('#user_id_update').val()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('update_roles_user')}}",
            type: "post",
            dataType: 'json',
            data:{
                'user_id':user_id_update,
                'role_id':role_id_update,
            },
            async: true,
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
                    window.location = "{{route('user_access')}}";
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    //End Function


</script>

