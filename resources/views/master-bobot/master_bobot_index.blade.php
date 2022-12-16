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
                            {{-- @php
                               dd(auth()->user()->getAllPermissions()->pluck('name')); 
                            @endphp --}}
                            @can('add-master_bobot')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_bobot" style="float:right">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
             
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <div class="container">
                        <table class="table-auto w-full bg-blue-500 datatable-collapse" id="bobot_table">
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
         @include('master-bobot.add-master_bobot_modal')
    {{--End Add Bobot --}}
    {{-- Edit Bobot --}}
        @include('master-bobot.edit-master_bobot_modal')
    {{--End Edit Bobot --}}

    {{-- js --}}
      @include('master-bobot.master_bobot_js')
    {{-- Endjs --}}
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

