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