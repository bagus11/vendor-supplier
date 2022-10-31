<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
            <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">Statistik Supplier Terdaftar</h3>
                        </div>
                        <div class="py-3">
                            <input style="float: right;" id="supplierDate" type="month" value="{{date('Y-m')}}">
                        </div>
                    </div>

                </div>
                <div class="p-3">
                    <div class="container" id="chart_container">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <select name="bar_type" id="bar_type" style="float:right">
                        <option value="bar">Bar</option>
                        <option value="line">Line</option>
                    </select>
                </div>
            </div>
            {{-- <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                <div class="px-6 border-b border-gray-300">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-3">
                            <h3 style="margin-top:5px">Statistik Supplier Terdaftar</h3>
                        </div>
                        <div class="py-3">
                            <input style="float: right;" type="date" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
                <div class="p-3">
                <canvas id="chart_2"></canvas>
                </div>
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                </div>
            </div> --}}

        </div>
    </div>
</x-app-layout>
<script>
    getData()
    var type = $('#bar_type').val()
    $('#bar_type').on('change', function(){
        if(type){
            getData()
        }else{
            toastr['warning']('Pilih tipe bar terlebih dahulu');
        }
    })
    $('#supplierDate').on('change', function(){
        getData()
    })
    
    // Function Here
    function getData()
    {
        var type = $('#bar_type').val()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('dashboard')}}",
            type: "get",
            dataType: 'json',
            data:{
                'supplierDate':$('#supplierDate').val()
            },
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                var bulan =[]
                var data  =[]
                for(var i =0; i< response.supplier.length;i++){
                    bulan.push(response.supplier[i]['month']);
                    data.push(response.supplier[i]['sumOfSupplier']);
                }
               
              $('canvas#chart').remove()
               $('canvas#chart_container').remove();
                $('#chart_container').append('<canvas id="chart"></canvas>')
                var chart = document.getElementById("chart").getContext('2d');
                master_chart('Supplier',bulan,type,chart,data)
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function master_chart(title,labels,type,id,data_a){
        const data = {
            labels: labels,
            datasets: [{
            label: title,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: data_a,
            }]
        }
        const config = {
            type:type,
            data: data,
            options: {}
        };
       
        var myChart = new Chart(
            id,
            config
        );
    }
</script>
