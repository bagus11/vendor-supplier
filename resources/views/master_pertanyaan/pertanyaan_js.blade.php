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
                                    <td style="text-align: center;">${response.data_pertanyaan[i]['flg_aktif']==1?'Active':'inactive'}</td>
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
    
    