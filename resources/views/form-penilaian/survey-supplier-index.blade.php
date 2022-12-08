<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Survey Supplier') }}
        </h2>
    </x-slot>
    <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto">
        <div class="py-2 rounded-lg shadow-lg bg-white">
            <div class="px-6 border-b border-gray-300">
                <div class="grid grid-cols-2 gap-6">
                    <div class="py-3">
                        <h3 style="margin-top:5px">Form Survey (Evaluasi Supplier)</h3>
                    </div>
                 
                </div>
            </div>
         
            <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                <div class="container">
                  <div class="block grid grid-cols-6 gap-4">
                        <div class="col-span-1 mt-2">
                            <label for="">Nama Perusahaan</label>
                        </div>
                        <div class="col-span-3">
                            <input type="text" class="w-full" value="{{$survey_header[0]->supplier_name}}" readonly>
                            <input type="hidden" class="w-full" id="survey_id" value="{{$survey_header[0]->id}}" readonly>
                        </div>
                  </div>
                
                  <div class="block grid grid-cols-6 gap-4 mt-2">
                        <div class="col-span-1 mt-2">
                            <label for="">Departement</label>
                        </div>
                        <div class="col-span-3">
                            <input type="text" class="w-full" value="{{$survey_header[0]->departement_name}}" readonly>
                            <input type="hidden" class="w-full" id="departement_id" value="{{$survey_header[0]->departement_id}}" readonly>
                        </div>
                  </div>

                  <div class="mt-4 pl-8">
                   
                      @foreach ($aspek as $item)
                      <div class="block">
                            <strong>{{$item->name}}</strong>
                            @php
                                 $pertanyaan = DB::table('master_form_penilaians')
                                ->join('master_pertanyaans', 'master_pertanyaans.id','=','master_form_penilaians.pertanyaan_id')
                                ->join('master_aspeks','master_aspeks.id','=','master_pertanyaans.aspek_id')
                                ->join('master_departements','master_departements.id','=','master_pertanyaans.departement_id')
                                ->select('master_pertanyaans.name as pertanyaan_name','master_pertanyaans.id','master_aspeks.name as aspek_name')
                                ->where('master_form_penilaians.form_id',$survey_header[0]->id)
                                ->where('master_form_penilaians.aspek_id',$item->id)
                                ->get();
                            @endphp
                            @foreach ($pertanyaan as $item)
                            <div class="grid  grid-cols-7 mt-2 pl-8">
                                <div class="col-span-3">
                                    <span>{{$item->pertanyaan_name}}</span>
                                    <input type="hidden" class="pertanyaan_id" value="{{$item->id}}">
                                </div>
                                <div class="col-span-3">
                                    <label for="cc" style="font-size: 12px">
                                        <input type="checkbox" class="buruk" name="jawaban_{{$item->id}}[]">
                                        Buruk                  
                                    </label>
                                    <label for="cc" class="ml-3" style="font-size: 12px">
                                        <input type="checkbox" class="biasa" name="jawaban_{{$item->id}}[]">
                                        Biasa                  
                                    </label>
                                    <label for="cc" class="ml-3" style="font-size: 12px">
                                        <input type="checkbox" class="bagus" name="jawaban_{{$item->id}}[]">
                                        Bagus                  
                                    </label>
                                    <label for="cc" class="ml-3" style="font-size: 12px">
                                        <input type="checkbox" class="sangat_bagus" name="jawaban_{{$item->id}}[]">
                                        Sangat Bagus                  
                                    </label>
                                    <label for="cc" class="ml-3" style="font-size: 12px">
                                        <input type="checkbox" class="sangat_bagus_sekali" name="jawaban_{{$item->id}}[]">
                                        Sangat Bagus Sekali                 
                                    </label>
                                </div>
                           
                            </div>
                            
                            @endforeach
                            <br>
                      </div>
                      @endforeach
                  </div>
                  <div class="mt-4 border-b border-gray-300">
                        <div class="block grid grid-cols-6 gap-4">
                            <div class="col-span-3 mt-2">
                                <label for="">Apakah ada kritik dan saran untuk pengembangan kinerja supplier</label>
                            </div>
                            <div class="col-span-1 mt-1">
                                <select name="" id="kritik">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="block grid grid-cols-6 gap-4" id="keterangan_container">
                            <div class="col-span-1 mt-2">
                                <label for="">Keterangan</label>
                            </div>
                            <div class="col-span-3">
                                <textarea cols="1" rows="2" id="keterangan" style="border-radius: 5px !important;width:100%"></textarea>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                 
                  <div class="px-4 sm:flex sm:flex-row-reverse sm:px-6">
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_survey">Save</button>
                  
                </div>
                </div>
            </div>
        </div>
</x-app-layout>
<script>
    $('#keterangan_container').hide()
    $('#kritik').on('change', function(){
        var kritik = $('#kritik').val()
        if(kritik == 1)
        {
            $('#keterangan_container').show()
        }else{
            $('#keterangan_container').hide()
        }
    })
    $('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });
    function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
    }
    var pertanyaan_id = document.getElementsByClassName('pertanyaan_id');
    var buruk = document.getElementsByClassName('buruk');
    var biasa = document.getElementsByClassName('biasa');
    var bagus = document.getElementsByClassName('bagus');
    var sangat_bagus = document.getElementsByClassName('sangat_bagus');
    var sangat_bagus_sekali = document.getElementsByClassName('sangat_bagus_sekali');
    var select_data_2 =[]
    var arr_jawaban =[]

    $('#save_survey').on('click', function(){
        for (let i = 0; i < pertanyaan_id.length; i++) 
            {
                    var arr_id = pertanyaan_id[i].value;
                    var arr_buruk = buruk[i].checked == true?1:0;
                    var arr_biasa = biasa[i].checked == true?1:0;
                    var arr_bagus = bagus[i].checked == true?1:0
                    var arr_sangat_bagus = sangat_bagus[i].checked == true?1:0
                    var arr_sangat_bagus_sekali = sangat_bagus_sekali[i].checked == true?1:0

                    if(arr_buruk == 0 && arr_biasa == 0 && arr_bagus == 0 && arr_sangat_bagus == 0 && arr_sangat_bagus_sekali == 0){
                        toastr['error']('Ada Pertanyaan yang belum dijawab');
                        return false
                    }else{
                        select_data_2 =[
                            arr_id,
                            arr_buruk,
                            arr_biasa,
                            arr_bagus,
                            arr_sangat_bagus,
                            arr_sangat_bagus_sekali,
                        ]
                    arr_jawaban.push(select_data_2)
                    var select_data = arr_jawaban.filter(onlyUnique)
                    }
            }
           var data ={
            'survey_id':$('#survey_id').val(),
            'arr_jawaban':arr_jawaban,
            'departement_id':$('#departement_id').val(),
            'keterangan':$('#keterangan').val(),
           }
           save_survey(data)
    })
    function save_survey(data)
    {
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('save_survey')}}",
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
</script>
