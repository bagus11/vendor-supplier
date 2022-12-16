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