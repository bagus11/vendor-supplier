<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Bobot') }}
        </h2>
    </x-slot>

        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto">
            <div class="py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">List Bobot Nilai</h3>
                        </div>
                        <div class="py-3">
                          
                            @can('add-master_pertanyaan')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_bobot" style="float:right">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 supplier-datatable" id="bobot_table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Aspek</th>
                                    <th class="px-4 py-2">Departement</th>
                                    <th class="px-4 py-2">Nilai</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
     {{-- Add Bobot --}}
    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addBobotModal">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                        <div class="sm:flex sm:items-start">
                            <h4>Form Add Bobot Nilai</h4>
                        </div>
                       
                    </div>
                    <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                        <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="container px-6">
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Departement</label>
                                        </div>
                                        <div class="col-span-3">
                                            <select name="departement_name" id="departement_name" class="select2" style="width: 100%"></select>
                                          <input type="hidden" id="departement_id" class="w-full" name="departement_id">
                                            <span  style="color:red;" class="message_error text-red block departement_id_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Aspek</label>
                                        </div>
                                        <div class="col-span-3">
                                            <select name="aspek_name" id="aspek_name" class="select2" style="width: 100%"></select>
                                          <input type="hidden" id="aspek_id" class="w-full" name="aspek_id">
                                            <span  style="color:red;" class="message_error text-red block aspek_id_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-4">
                                        <div class="col-span-1 mt-2">
                                            <label  for="">Pertanyaan</label>
                                        </div>
                                        <div class="col-span-3">
                                            <input type="number" id="score" class="w-full" name="score">
                                            <span  style="color:red;" class="message_error text-red block score_error"></span>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_bobot">Save</button>
                        <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_bobot">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Add Bobot --}}
    {{-- Edit Bobot --}}
        <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="editBobotModal">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                            <div class="sm:flex sm:items-start">
                                <h4>Form Edit Bobot Nilai</h4>
                            </div>
                        
                        </div>
                        <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                            <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                    <div class="container px-6">
                                        <div class="grid grid-cols-4">
                                            <div class="col-span-1 mt-2">
                                                <label  for="">Departement</label>
                                            </div>
                                            <div class="col-span-3">
                                            <input type="hidden" id="bobot_id" class="w-full" name="bobot_id" readonly>
                                            <input type="text" id="departement_name_update" class="w-full" name="departement_name_update" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="grid grid-cols-4">
                                            <div class="col-span-1 mt-2">
                                                <label  for="">Aspek</label>
                                            </div>
                                            <div class="col-span-3">
                                            <input type="text" id="aspek_name_update" class="w-full" name="aspek_name_update" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="grid grid-cols-4">
                                            <div class="col-span-1 mt-2">
                                                <label  for="">Pertanyaan</label>
                                            </div>
                                            <div class="col-span-3">
                                                <input type="number" id="score_update" class="w-full" name="score_update">
                                                <span  style="color:red;" class="message_error text-red block score_update_error"></span>
                                            </div>
                                        </div>  
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_update_bobot">Save</button>
                            <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_update_bobot">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{--End Edit Bobot --}}

</x-app-layout>
<script>
$('.select2').select2()
// Call Function
    get_bobot()
// End Call Function
// Operation
    $('#add_bobot').on('click', function(){
        $('#addBobotModal').show();
        get_aspek_name()
        get_departement_name()
    })
    $('#close_add_bobot').on('click', function(){
        $('#addBobotModal').hide();
        $('#score').val('')
        $('.message_error').html('')
    })
    $('#close_update_bobot').on('click', function(){
        $('#editBobotModal').hide();
        $('#score_update').val('')
        $('.message_error').html('')
    })
    $('#departement_name').on('change', function(){
        var departement_name = $('#departement_name').val()
        $('#departement_id').val(departement_name)
    })
    $('#aspek_name').on('change', function(){
        var aspek_name = $('#aspek_name').val()
        $('#aspek_id').val(aspek_name)
    })
    $('#save_add_bobot').on('click', function(){
        save()
    })
    $('#save_update_bobot').on('click', function(){
        update()
    })
    $('#bobot_table').on('click', '.editBobot', function() {
        var id = $(this).data('id');
       $('#editBobotModal').show()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_detail_bobot')}}",
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
                $('#departement_name_update').val(response.data[0].departement_name);
                $('#aspek_name_update').val(response.data[0].aspek_name);
                $('#score_update').val(response.data[0].score);
                $('#bobot_id').val(response.data[0].id);
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });

    });
    $('#bobot_table').on('click', '.deleteBobot', function() {
        var id = $(this).data('id');
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('delete_bobot')}}",
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
                    window.location = "{{route('master_bobot')}}";
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
// EndOperation
// Function here
    function get_bobot(){
        $('#bobot_table').DataTable().clear();
        $('#bobot_table').DataTable().destroy();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_bobot')}}",
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
                for(i = 0; i < response.data.length; i++ )
                {
                    data += `<tr style="text-align: center;">
                                <td style="text-align: left;">${response.data[i]['aspek_name']==null?'':response.data[i]['aspek_name']}</td>
                                <td style="text-align: left;">${response.data[i]['departement_name']==null?'':response.data[i]['departement_name']}</td>
                                <td style="text-align: center;">${response.data[i]['score']==null?'':response.data[i]['score']}</td>
                                <td style="width:12%;text-align:center">
                                        @can('update-master_bobot')       
                                        <button title="Detail" class="editBobot bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"data-id="${response.data[i]['id']}">
                                            <i class="fas fa-solid fa-eye"></i>
                                        </button>
                                        @endcan
                                        @can('delete-master_bobot')
                                        <button title="Delete" class="deleteBobot bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"data-id="${response.data[i]['id']}">
                                        <i class="fas fa-solid fa-trash"></i>
                                        </button>   
                                        @endcan
                                </td>
                            </tr>
                            `;
                }
                    $('#bobot_table > tbody:first').html(data);
                        $(document).ready(function() 
                        {
                            $('#bobot_table').DataTable( {
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
              
                $('#departement_name').empty();
                $('#departement_name').append('<option value ="">Semua Departement</option>');
                $.each(response.departement_name,function(i,data){
                    $('#departement_name').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                $('#aspek_name').empty();
                $('#aspek_name').append('<option value ="">Semua Aspek</option>');
                $.each(response.aspek_name,function(i,data){
                    $('#aspek_name').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
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
    function save(){
        var data ={
        'departement_id':$('#departement_id').val(),
        'aspek_id':$('#aspek_id').val(),
        'score':$('#score').val(),
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('save_bobot')}}",
            type: "post",
            dataType: 'json',
            data:data,
            async: true,
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
                }else if(response.status==500){
                    toastr['error'](response.message);
                } else{
                    toastr['success'](response.message);
                    window.location = "{{route('master_bobot')}}";
                }
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function update(){
        var data ={
        'score_update':$('#score_update').val(),
        'bobot_id':$('#bobot_id').val(),
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('udpate_bobot')}}",
            type: "post",
            dataType: 'json',
            data:data,
            async: true,
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
                }else if(response.status==500){
                    toastr['error'](response.message);
                } else{
                    toastr['success'](response.message);
                    window.location = "{{route('master_bobot')}}";
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

