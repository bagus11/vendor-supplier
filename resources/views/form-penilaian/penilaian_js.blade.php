<script>
    $('.select2').select2()
    // Call Function
    get_departement();
    // End Call Function
    // Operation
     $('#add_penilaian').on('click', function(){
        $('#addPenilaianModal').show()
        $('#table_pertanyaan').DataTable().clear();
        $('#table_pertanyaan').DataTable().destroy();
        $('#table_pertanyaan').hide()
        get_supplier_name()
        get_username()
        
     })
     $('#close_add_pertanyaan').on('click', function(){
        $('#addPenilaianModal').hide()
     })
     $('#supplier_name').on('change', function(){
        var supplier_name = $('#supplier_name').val();
        $('#supplier_id').val(supplier_name);
     })
     $('#departement_name').on('change', function(){
        var departement_name = $('#departement_name').val();
        $('#departement_id').val(departement_name);
        get_pertanyaan()
     })
     $('#user_name').on('change', function(){
        var user_name = $('#user_name').val();
        $('#user_id').val(user_name);
     })
     $('#tgl_from').on('change', function(){
        get_penilaian_headers()
     })
     $('#tgl_to').on('change', function(){
        get_penilaian_headers()
     })
     $('#table_pertanyaan').hide()
     $('#check_all').on('click', function(){
          // Get all rows with search applied
            var table_pertanyaan = $('#table_pertanyaan').DataTable( {
                    "destroy": true,
                    "scrollX": true,
                    "autoWidth" : false,
                    "searching": false,
                    "aaSorting" : [],
                  
                } );
    
          var rows = table_pertanyaan.rows({ 'search': 'applied' }).nodes();
          // Check/uncheck checkboxes for all rows in the table
          $('input[type="checkbox"]', rows).prop('checked', this.checked);
       });
    
     $('#save_add_pertanyaan').on('click', function(){
        var checkArray = [];
        var lengthParsed = 0;
        var pertanyaan = $('#table_pertanyaan').dataTable();
        var rowcollection =  pertanyaan.$("input:checkbox[name=check]:checked",{"page": "all"});
        rowcollection.each(function(){
            checkArray.push([$(this).val(),$(this).data("aspek_id")]);
        });
    
        lengthParsed = checkArray.length;
        if(lengthParsed == 0)
        {
            toastr['error']('Belum memilih pertanyaan sama sekali !');
            return false;
        }
    
        var data ={
            'pertanyaan_array':checkArray,
            'departement_id':$('#departement_id').val(),
            'supplier_id':$('#supplier_id').val(),
            'user_id':$('#user_id').val(),
    
        }
        save_form_penilaian(data)
     })
     $('#penilaian_headers_table').on('change', '.is_checked', function(e) {
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
                url: "{{route('update_status_penilaian_header')}}",
                type: "post",
                dataType: 'json',
                async: true,
                data: data,
               
                success: function(response) {
                    $('.is_checked').prop('disabled',false)
                    toastr['success'](response.message);
                    get_penilaian_headers()
                },
                error: function(xhr, status, error) {
                   
                    toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
                }
            });
          
           
        });
       // EndOperation
    // Function here
        function get_penilaian_headers(){
            $('#penilaian_headers_table').DataTable().clear();
            $('#penilaian_headers_table').DataTable().destroy();
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get_penilaian_headers')}}",
                type: "get",
                dataType: 'json',
                async: true,
                data:{
                    'tgl_from':$('#tgl_from').val(),
                    'tgl_to':$('#tgl_to').val()
                },
                beforeSend: function() {
                    SwalLoading('Please wait ...');
                },
                success: function(response) {
                    swal.close();
                    mapping_data(response)
                    
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
        }
        function mapping_data(response){
            var data=''
                    for(i = 0; i < response.data.length; i++ )
                    {
    
                        data += `<tr style="text-align: center;">
                                    <td class='details-control'></td>
                                    <td style="text-align: left;">${response.data[i]['supplier_name']==null?'':response.data[i]['supplier_name']}</td>
                                    <td class="supplier_id" style="text-align: center;">${response.data[i]['supplier_id']==null?'':response.data[i]['supplier_id']}</td>
                                    <td style="width:20%;text-align:center">
                                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded"href="report_evaluasi_supplier/${response.data[i]['supplier_id']}" target="_blank" title="Print Survey">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                    </td>
                                </tr>
                                `;
                    }
                        $('#penilaian_headers_table > tbody:first').html(data);
                      
                        let table = $('#penilaian_headers_table').DataTable
                        ({
                            "destroy": true,
                            "scrollX": true,
                            "autoWidth" : false,
                            "searching": false,
                            "aaSorting" : [],
                        });
                        $('#penilaian_headers_table tbody').on('click', 'td.details-control', function () {
                        var tr = $(this).closest("tr");
                        var row =   table.row( tr );
                        if ( row.child.isShown() ) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass( 'shown' );
                        }
                        else {
                            // Open this row
                            detail_log(row.child,$(this).parents("tr").find('td.supplier_id').text()) ;
                            tr.addClass( 'shown' );
                        }
                    } );   
        }
        function detail_log( callback, supplier_id){
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get_penilaian_log')}}",
                type: "get",
                dataType: 'json',
                data: {
                    'supplier_id': supplier_id
                },
                beforeSend: function () {
                  $('#loading').show();
                },
                success : function(response) {
                    // alert(response.length);
                    $('#loading').hide();
                    if(response){
                        let row = '';
                        for(let i = 0; i < response.data.length; i++){
                        var isi_survey =``;
                        var report_survey =``;
                        var akeses =``;
                            if(response.data[i]['status'] != 'DONE'&& response.data[i]['flg_aktif']==1 ){
                            isi_survey =`<a class="bg-green-300 hover:bg-green-500 text-white font-bold py-1 px-3 rounded"href="survey_supplier/${response.data[i]['id']}/${response.data[i]['user_id']}" target="_blank" title="Isi Survey">
                                                <i class="fas fa-arrow-right"></i>
                                            </a>`;
                            }
                            if(response.data[i]['status']=='DONE'&& response.data[i]['flg_aktif']==1 ){
                                report_survey =`<a class="bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-1 px-3 rounded"href="report_survey_supplier/${response.data[i]['id']}" target="_blank" title="Print Survey">
                                                    <i class="fas fa-print"></i>
                                                </a>`;
                            }
                            if(isi_survey == '' && report_survey ==''){
                                akeses =` <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Status Innactive</span>`
                            }else{
                                akeses =``;
                            }
                            $('.table_detail tbody').append(``);
                                row+= `<tr class="table-light">
                                            <td style="text-align: center;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response.data[i].id}"  data-flg_aktif="${response.data[i].flg_aktif}" data-id="${response.data[i].id}" ${response.data[i].flg_aktif == 1 ?'checked':'' }></td>
                                            <td>${response.data[i].flg_aktif==1?'Active':'Innactive'}</td>
                                            <td>${response.data[i].rating_code}</td>
                                            <td style="text-align:left">${response.data[i].departement_name}</td>
                                            <td>${response.data[i].status}</td>
                                            <td>${response.data[i].created_at}</td>
                                            <td>${response.data[i].updated_at}</td>
                                            <td style="text-align:left">${response.data[i].user_name}</td>
                                            <td>
                                                @can('print-form_penilaian')       
                                                    ${report_survey}
                                                    @else
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">No Access</span>      
                                                    @endcan
                                                    @can('update-form_penilaian')
                                                    ${isi_survey}
                                                    @endcan
                                                ${akeses}
                                            </td>
                                        </tr>`;
    
                        }
                        callback($(`
                          <table class="table_detail" style="width:100%;text-align:center;float:right;background:#404258">
                            <div style="color: darkblue; font-weight: 600;"><i class="fas fa-history"></i> Detail </div>
                            <thead>
                                <tr>
                                    <th style="text-align:center"></th>
                                    <th style="text-align:center">Status</th>
                                    <th style="text-align:center">Form Code</th>
                                    <th style="text-align:center">Departement</th>
                                    <th style="text-align:center">Proses</th>
                                    <th style="text-align:center">Tanggal Buat</th>
                                    <th style="text-align:center">Tanggal Update</th>
                                    <th style="text-align:center">User</th>
                                    <th style="text-align:center">Action</th>
                                </tr>
                            </thead>
                          <tbody class="table-bordered">${row}</tbody>
                        </table>`)).show();
                    }else{
                        toastr["error"]('Data tidak ada')
                        $('#loading').hide();
                    }
                },
                error : function(response) {
                    console.log('failed :' + response);
                    alert('Gagal Get Data, Tidak Ada Data / Mohon Coba Kembali Beberapa Saat Lagi');
                    $('#loading').hide();
                }
            });
        }
     
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
                                    <td style="text-align: center;">${response.data_pertanyaan[i]['flg_aktif']==1?'Active':'Innactive'}</td>
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
    
        function get_supplier_name(){
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get_supplier_name')}}",
                type: "get",
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    SwalLoading('Please wait ...');
                },
                success: function(response) {
                    swal.close();
                    $('#supplier_name').empty();
                    $('#supplier_name').append('<option value ="">Pilih Supplier</option>');
                    $.each(response.supplier_name,function(i,data){
                        $('#supplier_name').append('<option value="'+data.id+'">' + data.supplierName +'</option>');
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
                    $('#user_name').empty();
                    $('#user_name').append('<option value ="">Pilih User</option>');
                    $.each(response.data,function(i,data){
                        $('#user_name').append('<option value="'+data.id+'">' + data.name +'</option>');
                    }); 
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
        }
    
        function get_pertanyaan(){
            $('#table_pertanyaan').show()
            $('#table_pertanyaan').DataTable().clear();
            $('#table_pertanyaan').DataTable().destroy();
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get_pertanyaan')}}",
                type: "get",
                dataType: 'json',
                async: true,
                data:{
                    'departement_id':$('#departement_id').val()
                },
                beforeSend: function() {
                    SwalLoading('Please wait ...');
                },
                success: function(response) {
                    swal.close();
                    var data=''
                    for(i = 0; i < response.master_aspeks.length; i++ )
                    {
                        data += `<tr style="text-align: center;">
                                    <td style="text-align: left;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response.master_aspeks[i]['id']}"  data-aspek_id="${response.master_aspeks[i]['aspek_id']}"></td>
                                    <td style="text-align: left;">${response.master_aspeks[i]['aspek_name']==null?'':response.master_aspeks[i]['aspek_name']}</td>
                                    <td style="text-align: left;">${response.master_aspeks[i]['name']==null?'':response.master_aspeks[i]['name']}</td>
                                </tr>
                                `;
                    }
                        $('#table_pertanyaan > tbody:first').html(data);
                            $(document).ready(function() 
                            {
                                $('#table_pertanyaan').DataTable( {
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
        function save_form_penilaian(data)
        {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('save_form_penilaian')}}",
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
                        window.location = "{{route('form_penilaian')}}";
                    }
                    
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
        }
        function get_departement(){
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get_supplier_name')}}",
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
    
                    get_penilaian_headers()
                },
                error: function(xhr, status, error) {
                    swal.close();
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
        }
    // End Function
    </script>
    