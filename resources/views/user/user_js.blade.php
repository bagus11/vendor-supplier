<script>
 $('.select2').select2()
//  Call Function
    get_user()
//  End Call Function
// Operation
    $('#user_table').on('change', '.is_checked', function(e) {
        $('.is_checked').prop('disabled',true)
        e.preventDefault();
        var data ={
                'id': $(this).data('id'),     
                'flg_aktif': $(this).data('flg_aktif'),     
        }
      
            $.ajax({
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('update_status_user')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
            
            success: function(response) {
                $('.is_checked').prop('disabled',false)
                toastr['success'](response.message);
                get_user()
            },
            error: function(xhr, status, error) {
                
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
        
        
    });
    $('#select_kantor').on('change', function(){
        var select_kantor = $('#select_kantor').val()
        $('#kode_kantor').val(select_kantor)
    })
    $('#select_jabatan').on('change', function(){
        var select_jabatan = $('#select_jabatan').val()
        $('#jabatan_id').val(select_jabatan)
    })
    $('#close_update_user').on('click', function(){
        $('#editUserModal').hide();
    })
    $('#save_update_user').on('click', function(){
        update_user()
    })
    $('#user_table').on('click', '.editPertanyaan', function(e) {
            $('#editUserModal').show();
            var id =$(this).data('id')
            e.preventDefault()       
                $.ajax({
                    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('detail_user')}}",
                type: "get",
                dataType: 'json',
                async: true,
                data: {
                    'id': id
                },
                beforeSend: function() {
                    SwalLoading('Please wait ...');
                },
                success: function(response) { 
                    swal.close()                  
                   $('#user_id').val(id);
                   $('#user_name').val(response.data.name)
                   $('#user_email').val(response.data.email)
                   $('#select_kantor').empty();
                   $('#select_jabatan').empty();
                   var kode_kantor = response.data.kode_kantor == 0?'':response.data.kode_kantor
                   var jabatan_id =  response.data.jabatan_id == 0 ?'':response.data.jabatan_id
                   var jabatan = response.data.jabatan_name == null ? "Belum memilih jabatan":response.data.jabatan_name
                   var kantor = response.data.kantor_name == null ? "Belum memilih jabatan":response.data.kantor_name
                   $('#kode_kantor').val(kode_kantor)
                   $('#jabatan_id').val(jabatan_id)
                    $('#select_kantor').append('<option value="'+kode_kantor+'">'+kantor+'</option>')
                    $('#select_jabatan').append('<option value="'+jabatan_id+'">'+jabatan+'</option>')
                   $.each(response.master_jabatans,function(i,data){
                        $('#select_jabatan').append('<option value="'+data.id+'">' + data.name +'</option>');
                    });
                   $.each(response.master_kantor,function(i,data){
                        $('#select_kantor').append('<option value="'+data.id+'">' + data.name +'</option>');
                    });

                },
                error: function(xhr, status, error) {
                   
                    toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
                }
            });
        });
// End Operation
//  Function
    function get_user()
    {
            $('#user_table').DataTable().clear();
            $('#user_table').DataTable().destroy();
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get_user')}}",
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
                                    <td style="text-align: left;">${response.data[i]['email']==null?'':response.data[i]['email']}</td>
                                    <td style="text-align: left;">${response.data[i]['jabatan_name']==null?'<span class="bg-red-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Belum set Jabatan</span>':response.data[i]['jabatan_name']}</td>
                                    <td style="text-align: left;">${response.data[i]['kantor_name']==null?' <span class="bg-red-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Kode Kantor Belum di set</span>':response.data[i]['kantor_name']}</td>
                                    <td style="width:12%;text-align:center">
                                            @can('update-setting_user')       
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
                        $('#user_table > tbody:first').html(data);
                            $(document).ready(function() 
                            {
                                $('#user_table').DataTable( {
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
    function update_user()
    {
       var data ={
            'jabatan_id':$('#jabatan_id').val(),
            'kode_kantor':$('#kode_kantor').val(),
            'user_id':$('#user_id').val(),
            'user_name':$('#user_name').val(),
       }
       $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('update_user')}}",
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
                        window.location = "{{route('setting_user')}}";
                    }
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            }); 
    }
//  End Function
</script>