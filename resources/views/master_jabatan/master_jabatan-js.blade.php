<script>
    $('.select2').select2()
    //  Call Function
       get_kantor()
       get_jabatan()
    //  End Call Function
    // Operation
        $('#add_kantor').on('click', function(){1
            $('#addKantorModal').show()
        })   
        $('#close_add_kantor').on('click', function(){
            $('#addKantorModal').hide()
        })
        $('#add_jabatan').on('click', function(){
            $('#addJabatanModal').show()
            get_departement_name()
        })
        $('#close_add_jabatan').on('click', function(){
            $('#addJabatanModal').hide()
        })
        $('#close_edit_jabatan').on('click', function(){
            $('#editJabatanModal').hide()
        })
        $('#save_edit_jabatan').on('click', function(){
            update_jabatan()
        })
        
        $('#save_add_kantor').on('click', function(){
            save_kantor()
        })
        $('#save_add_jabatan').on('click', function(){
            save_jabatan()
        })
        $('#save_update_kantor').on('click', function(){
            update_kantor()
        })
        $('#select_kantor_type').on('change',function(){
            var select_kantor_type = $('#select_kantor_type').val()
            $('#kantor_type').val(select_kantor_type)
        })
        $('#kantor_table').on('change', '.is_checked', function(e) {
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
                url: "{{route('update_status_kantor')}}",
                type: "post",
                dataType: 'json',
                async: true,
                data: data,
               
                success: function(response) {
                    $('.is_checked').prop('disabled',false)
                    toastr['success'](response.message);
                    get_kantor()
                },
                error: function(xhr, status, error) {
                   
                    toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
                }
            });
          
           
        });
        $('#close_update_kantor').on('click', function(){
            $('#editKantorModal').hide()
        })
        $('#kantor_table').on('click', '.editPertanyaan', function(e) {
            $('#editKantorModal').show();
            var id =$(this).data('id')
            e.preventDefault()       
                $.ajax({
                    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('detail_kantor')}}",
                type: "get",
                dataType: 'json',
                async: true,
                data: {
                    'id': id
                },
                success: function(response) {                   
                    $('#kantor_id').val(id)
                    $('#kantor_name_update').val(response.data.name)
                    $('#kantor_city_update').val(response.data.city)
                    $('#kantor_type_update').val(response.data.type)
                    $('#kantor_address_update').val(response.data.address)
                    $('#select_kantor_type_update').empty()
                    $('#select_kantor_type_update').append('<option value="'+response.data.type+'">'+response.data.type+'</option>')
                    $('#select_kantor_type_update').append('<option value="Pusat">Pusat</option>')
                    $('#select_kantor_type_update').append('<option value="Pusat">Cabang</option>')

                },
                error: function(xhr, status, error) {
                   
                    toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
                }
            });
          
           
        });
        $('#select_departement').on('change', function(){
            var select_departement = $('#select_departement').val()
            $('#jabatan_departement_id').val(select_departement)
        })
        $('#select_kantor_type_update').on('change', function(){
            var select_kantor_type_update = $('#select_kantor_type_update').val()
            $('#kantor_type_update').val(select_kantor_type_update)
        })
        $('#jabatan_table').on('change', '.is_checked', function(e) {
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
                url: "{{route('update_status_jabatan')}}",
                type: "post",
                dataType: 'json',
                async: true,
                data: data,
               
                success: function(response) {
                    $('.is_checked').prop('disabled',false)
                    toastr['success'](response.message);
                    get_jabatan()
                },
                error: function(xhr, status, error) {
                   
                    toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
                }
            });
          
           
        });
        $('#select_departement_update').on('change', function(){
            var select_departement_update = $('#select_departement_update').val()
            $('#jabatan_departement_id_update').val(select_departement_update)
        })

        $('#jabatan_table').on('click', '.editJabatan', function(e) {
            $('#editJabatanModal').show();
            var id =$(this).data('id')
            e.preventDefault()       
                $.ajax({
                    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('detail_jabatan')}}",
                type: "get",
                dataType: 'json',
                async: true,
                data: {
                    'id': id
                },
                success: function(response) {     
              $('#jabatan_id').val(id)              
              $('#jabatan_name_update').val(response.data.name)
              $('#jabatan_departement_id_update').val(response.data.departement_id)
              $('#select_departement_update').empty();
              $('#select_departement_update').append('<option value="'+response.data.departement_id+'">'+response.data.departement_name+'</option>');
              $.each(response.departement,function(i,data){
                        $('#select_departement_update').append('<option value="'+data.id+'">' + data.name +'</option>');
                    });

                },
                error: function(xhr, status, error) {
                   
                    toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
                }
            });
        });

    // End Operation   
    // Function
        function get_kantor()
        {
                    $('#kantor_table').DataTable().clear();
                    $('#kantor_table').DataTable().destroy();
                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{route('get_kantor')}}",
                        type: "get",
                        dataType: 'json',
                        async: true,
                        beforeSend: function() {
                            SwalLoading('Please wait ...');
                        },
                        success: function(response) {
                            swal.close();
                            var data=''
                            for(i = 0; i < response.data.length; i++ )
                            {
                                data += `<tr style="text-align: center;">
                                            <td style="text-align: center;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response.data[i]['id']}"  data-flg_aktif="${response.data[i]['flg_aktif']}" data-id="${response.data[i]['id']}" ${response.data[i]['flg_aktif'] == 1 ?'checked':'' }></td>

                                            <td style="text-align: center;">${response.data[i]['flg_aktif']==1?'Active':'inactive'}</td>

                                            <td style="text-align: left;">${response.data[i]['name']==null?'':response.data[i]['name']}</td>

                                            <td style="text-align: left;">${response.data[i]['city']==null?'':response.data[i]['city']}</td>
                                            <td style="width:12%;text-align:center">
                                                    @can('update-master_pertanyaan')       
                                                    <button title="Detail" class="editPertanyaan bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="${response.data[i]['id']}">
                                                        <i class="fas fa-solid fa-eye"></i>
                                                    </button>
                                                    @else
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>      
                                                    @endcan
                                                </td>
                                        </tr>
                                        `;
                            }
                                $('#kantor_table > tbody:first').html(data);
                                    $(document).ready(function() 
                                    {
                                        $('#kantor_table').DataTable( {
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
        function save_kantor()
        {
            var data ={
                'kantor_name':$('#kantor_name').val(),
                'kantor_address':$('#kantor_address').val(),
                'kantor_city':$('#kantor_city').val(),
                'kantor_type':$('#kantor_type').val(),
            }
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('save_kantor')}}",
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
                        $('#exampleModalLg').hide()
                        window.location = "{{route('master_jabatan')}}";
                    }
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
        }
        function get_jabatan()
        {
                    $('#jabatan_table').DataTable().clear();
                    $('#jabatan_table').DataTable().destroy();
                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{route('get_jabatan')}}",
                        type: "get",
                        dataType: 'json',
                        async: true,
                        beforeSend: function() {
                            SwalLoading('Please wait ...');
                        },
                        success: function(response) {
                            swal.close();
                            var data=''
                            for(i = 0; i < response.data.length; i++ )
                            {
                                data += `<tr style="text-align: center;">
                                            <td style="text-align: center;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response.data[i]['id']}"  data-flg_aktif="${response.data[i]['flg_aktif']}" data-id="${response.data[i]['id']}" ${response.data[i]['flg_aktif'] == 1 ?'checked':'' }></td>

                                            <td style="text-align: center;">${response.data[i]['flg_aktif']==1?'Active':'inactive'}</td>

                                            <td style="text-align: left;">${response.data[i]['name']==null?'':response.data[i]['name']}</td>

                                            <td style="text-align: left;">${response.data[i]['departement_name']==null?'':response.data[i]['departement_name']}</td>
                                            <td style="width:12%;text-align:center">
                                                    @can('update-master_pertanyaan')       
                                                    <button title="Detail" class="editJabatan bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="${response.data[i]['id']}">
                                                        <i class="fas fa-solid fa-eye"></i>
                                                    </button>
                                                    @else
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>      
                                                    @endcan
                                                </td>
                                        </tr>
                                        `;
                            }
                                $('#jabatan_table > tbody:first').html(data);
                                    $(document).ready(function() 
                                    {
                                        $('#jabatan_table').DataTable( {
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
                    $('#select_departement').append('<option value ="">Pilih Departement</option>');
                    $.each(response.departement_name,function(i,data){
                        $('#select_departement').append('<option value="'+data.id+'">' + data.name +'</option>');
                    });
                    
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
        }
        function save_jabatan()
        {
            var data ={
                'jabatan_departement_id':$('#jabatan_departement_id').val(),
                'jabatan_name':$('#jabatan_name').val()
            }
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('save_jabatan')}}",
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
                        $('#exampleModalLg').hide()
                        window.location = "{{route('master_jabatan')}}";
                    }
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
        }
        function update_kantor(){
            var data ={
                'kantor_id':  $('#kantor_id').val(),
                'kantor_name_update':  $('#kantor_name_update').val(),
                'kantor_city_update':  $('#kantor_city_update').val(),
                'kantor_type_update':  $('#kantor_type_update').val(),
                'kantor_address_update':  $('#kantor_address_update').val(),
            }
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('update_kantor')}}",
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
                        window.location = "{{route('master_jabatan')}}";
                    }
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            }); 
                  
        }
        function update_jabatan(){
            var data ={
                'jabatan_id':$('#jabatan_id').val(),
                'jabatan_name_update':$('#jabatan_name_update').val(),
                'jabatan_departement_id_update':$('#jabatan_departement_id_update').val(),
            }
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('update_jabatan')}}",
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
                        window.location = "{{route('master_jabatan')}}";
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