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
                   // window.location = "{{route('user_access')}}";
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