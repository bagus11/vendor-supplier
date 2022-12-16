<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Evaluasi Supplier</title>

    <style>
        * {
        box-sizing: border-box;
        }

        table {
        /* border-collapse: collapse; */
        border-spacing: 0;
        width: 100%;
        border: 1px;
        font-size: 12px;
        }
        td.table-cell-edit{
            background-color: lightgoldenrodyellow !important;
        }
        th, td {
        text-align: left;
        padding: 5px;
        }
        .container {
        padding: 2px 16px;
        }
        p{
            font-size: 12px;
        }
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #E0144C;
        color: white;
        }
        #score {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #score td, #score th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #score tr:nth-child(even){background-color: #f2f2f2;}

        #score tr:hover {background-color: #ddd;}

        #score th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #121212;
        color: white;
        }
        strong{
            font-size:12px
        }
        p.hide {display: none;}
    </style>
</head>
<body>
    <div style="margin-top:-30px">
        <p style="text-align: center">Nama Perusahaan : {{$master_header->supplier_name}}</p>
    </div>  
    <div style="margin-top:-20px">
        @php
            $avg_array=[];
        @endphp
        @foreach ($master_aspek as $item)
            <p><strong>{{$item->name}}</strong></p>
        
                @php
                    $form_penilaian = DB::table('master_form_penilaians')
                                        ->select('master_pertanyaans.name as pertanyaan_name','master_jawabans.a', 'master_jawabans.b','master_jawabans.c','master_jawabans.d','master_jawabans.e','master_aspeks.name as aspek_name','master_form_penilaians.id as penilaian_id','master_jawabans.score')
                                        ->join('master_aspeks','master_aspeks.id','=','master_form_penilaians.aspek_id')
                                        ->join('master_pertanyaans','master_pertanyaans.id','=','master_form_penilaians.pertanyaan_id')
                                        ->join('master_jawabans','master_jawabans.penilaian_id','=','master_form_penilaians.id')
                                        ->where('master_form_penilaians.aspek_id',$item->aspek_id)
                                        ->where('master_form_penilaians.departement_id',$master_header->departement_id)
                                        ->where('master_form_penilaians.form_id',$master_header->id)
                                        ->groupBy('master_form_penilaians.id')
                                        ->get();
                    $data =        DB::table('master_jawabans')
                                        ->where('master_jawabans.form_id',$master_header->id)
                                        ->where('master_form_penilaians.aspek_id',$item->aspek_id)
                                        ->where('master_form_penilaians.departement_id',$master_header->departement_id)
                                        ->join('master_form_penilaians','master_jawabans.penilaian_id','=','master_form_penilaians.id');
                                        // ->groupBy('master_form_penilaians.id');
                    $count = $data->get();              
                    $total_score = $data->sum('score');
                    $avg_per_aspek = $total_score / count($count);
                    $bobot = DB::table('log_bobots')
                                ->select('log_bobots.*')
                                ->where('log_bobots.aspek_id',$item->aspek_id)
                                ->where('log_bobots.form_id',$master_header->id)->get();
                    $percent_avg = $avg_per_aspek/100*$bobot[0]->score;
                    array_push($avg_array,['avg'=>$percent_avg,'bobot'=>$bobot[0]->score]); 
                @endphp     
                <div>
                   <table style="margin-top:-10px">
                    <tr>
                        <td>
                            <table class="table-auto" id="customers" style="width: 100%">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-4 py-2" style="text-align: center;width:50px%">Keterangan</th>
                                        <th class="border px-4 py-2" style="text-align: center ;width:6px">Buruk</th>
                                        <th class="border px-4 py-2" style="text-align: center ;width:6px">Biasa</th>
                                        <th class="border px-4 py-2" style="text-align: center ;width:6px">Bagus</th>
                                        <th class="border px-4 py-2" style="text-align: center ;width:6px">Sangat Bagus</th>
                                        <th class="border px-4 py-2" style="text-align: center ;width:6px">Sangat Bagus Sekali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($form_penilaian as $row)
                                    <tr>
                                        <td class="border px-4 py-2" style="text-align: left">{{ $row->pertanyaan_name }}</td>
                                        <td class="border px-4 py-2" style="text-align: center">{{ $row->a == 0 ?'': 'v' }}</td>
                                        <td class="border px-4 py-2" style="text-align: center">{{ $row->b == 0 ?'': 'v' }}</td>
                                        <td class="border px-4 py-2" style="text-align: center">{{ $row->c == 0 ?'': 'v' }}</td>
                                        <td class="border px-4 py-2" style="text-align: center">{{ $row->d == 0 ?'': 'v' }}</td>
                                        <td class="border px-4 py-2" style="text-align: center">{{ $row->e == 0 ?'': 'v' }}</td>
                                      
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">No Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>  
                        </td>
                        <td>
                            <table class="table-auto" id="score">
                                <thead>
                                    <tr>
                                        <th>Score</th>
                                        <th>Persent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($form_penilaian as $item)
                                    <tr>
                                        <td class="border px-4 py-2" style="text-align: center">{{$item->score}}</td>
                                        <td class="border px-4 py-2" style="text-align: center"></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2">No Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                           </table>
                           <p style="font-size:12px">
                            <table >
                                <tr>
                                    <td style="text-align:center">{{ number_format((float)$avg_per_aspek, 2, '.', '')}}</td>
                                    <td style="text-align:center">{{number_format((float)$avg_per_aspek/100*$bobot[0]->score, 2, '.', '')}}</td>
                                </tr>
                            </table>
                        </p>
                        </td>
                    </tr>
                   </table>
                </div>
                <p style="margin-left: 20px;margin-top:-5px">
                    <strong>Note : Bobot Nilai {{$bobot[0]->score}}% </strong>
                </p>
        @endforeach
    </div>
    <div style="float: right">
        <table style="width:100%;">
            <tr>
                <td style="width: 75%"></td>
                <td>
                    <p style="font-size:10px">
                    
                         @php
                            $total_avg =0;
                            $total_percent =0;
                            for($i =0 ; $i < count($avg_array); $i++ ) {
                                    $total_avg += $avg_array[$i]['avg'];
                                    $total_percent += $avg_array[$i]['bobot'];

                                }
                           
                         @endphp
                        <strong>Total Score Sementara</strong> {{ number_format((float)$total_avg, 2, '.', '')}} <br>
                        <strong>Data yang terkumpul</strong>: {{$total_percent}}% <br>
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <p><strong>Apakah ada kritik dan saran untuk pengembangan kinerja supplier ?</strong></p>
        <table style="width: 30%; font-size:12px;margin-top:-10px">
            <tr>
                <td>
                    <label for="cc">
                        <input type="checkbox" style="border-radius: 5px !important;" class="diterapkan" name="diterapkan" {{$master_header->keterangan != '' ?  'checked="checked"':''}}>
                        Ya                  
                    </label>
                </td>
                <td>
                    <label for="cc">
                        <input type="checkbox" style="border-radius: 5px !important;" class="tidak" name="tidak" {{$master_header->keterangan == '' ?  'checked="checked"':''}}>
                        Tidak                  
                    </label>
                </td>
            </tr>
        </table>
        <p class="{{$master_header->keterangan ==''?'hide':''}}">
            Kritik & Saran : <br>
            <p style="margin-left:10px ">
                {{$master_header->keterangan}}
            </p>
        </p>
    </div>
   
</body>
</html>