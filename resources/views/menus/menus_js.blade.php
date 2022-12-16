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
    