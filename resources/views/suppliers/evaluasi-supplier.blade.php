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
            font-size:10px
        }
        p.hide {display: none;}
    </style>
</head>
<body>
    <div style="margin-top:-20px">
        <p style="text-align: center">Nama Perusahaan : {{$master_header->name}}</p>
    </div>  
    <div>
        @foreach ($master_aspek as $item)
            <p><strong>{{$item->aspek_name}}</strong></p>
                @php
                $form_evaluasi = DB::table('master_form_penilaian_headers')
                                    ->join('master_form_penilaians','master_form_penilaians.form_id','=','master_form_penilaian_headers.id')
                                    ->join('master_jawabans','master_jawabans.penilaian_id','=','master_form_penilaians.id')
                                    ->join('master_departements','master_departements.id','=', 'master_form_penilaian_headers.departement_id')
                                    ->join('master_aspeks','master_aspeks.id','=','master_form_penilaians.aspek_id')
                                    ->select(DB::raw('master_departements.name as departement_name, AVG(master_jawabans.score) as score'))
                                    ->where('master_form_penilaian_headers.supplier_id',$master_header->id)
                                    ->where('master_form_penilaians.aspek_id', $item->aspekId)
                                    ->groupBy('master_form_penilaians.departement_id')
                                    ->get();
                $bobot = DB::table('log_bobots')
                            ->where('aspek_id',$item->aspekId)
                            ->where('supplier_id',$master_header->id)
                            ->sum('score');
        
                @endphp     
                <div>
                   <table>
                    <tr>
                        <td>
                            <table class="table-auto" id="customers" style="width: 100%">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-4 py-2" style="text-align: center;width:60%">Departement</th>
                                        <th class="border px-4 py-2" style="text-align: center;width:20%">Score</th>
                                        <th class="border px-4 py-2" style="text-align: center;width:20%">Persent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($form_evaluasi as $row)
                                    <tr>
                                        <td class="border px-4 py-2" style="text-align: left">Review {{ $row->departement_name }}</td>
                                        <td class="border px-4 py-2" style="text-align: center">{{number_format((float)$row->score, 2, '.', '')  }}</td>
                                        {{-- <td class="border px-4 py-2" style="text-align: center">{{number_format((float)$row->score, 2, '.', '')  }}</td> --}}
                                        <td class="border px-4 py-2" style="text-align: center"></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">No Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>  
                        </td>
                    </tr>
                   </table>
                   <table style="width:100%">
                    <tr>
                        <td style="width: 60%">
                            <p style="margin-left:20px">
                                <strong>Note : Bobot Nilai {{$bobot}}%</strong>
                            </p>
                        </td>
                        <td tyle="width: 40%">
                            <table>
                                @php
                                  $sum_score = DB::table('master_form_penilaian_headers')
                                    ->join('master_form_penilaians','master_form_penilaians.form_id','=','master_form_penilaian_headers.id')
                                    ->join('master_jawabans','master_jawabans.penilaian_id','=','master_form_penilaians.id')
                                    ->join('master_departements','master_departements.id','=', 'master_form_penilaian_headers.departement_id')
                                    ->join('master_aspeks','master_aspeks.id','=','master_form_penilaians.aspek_id')
                                    ->where('master_form_penilaian_headers.supplier_id',$master_header->id)
                                    ->where('master_form_penilaians.aspek_id', $item->aspekId)
                                    ->sum('master_jawabans.score');
                                $count = DB::table('master_form_penilaian_headers')
                                        ->join('master_form_penilaians','master_form_penilaians.form_id','=','master_form_penilaian_headers.id')
                                            ->join('master_jawabans','master_jawabans.penilaian_id','=','master_form_penilaians.id')
                                            ->join('master_departements','master_departements.id','=', 'master_form_penilaian_headers.departement_id')
                                            ->join('master_aspeks','master_aspeks.id','=','master_form_penilaians.aspek_id')
                                            ->where('master_form_penilaian_headers.supplier_id',$master_header->id)
                                            ->where('master_form_penilaians.aspek_id', $item->aspekId)
                                            ->get();
                                            // ->count('master_form_penilaian_headers.departement_id');
                                    // dd($sum_score);
                                @endphp

                                <tr>
                                    <td style="text-align: center;font-weight:bold;font-size:10px">{{$sum_score}}</td>
                                    <td style="text-align: center;font-weight:bold;font-size:10px">{{number_format((float)$sum_score/count($count), 2, '.', '')  }}</td>
                                    {{-- <td style="text-align: center;font-weight:bold;font-size:10px">{{number_format((float)$sum_score * $bobot / 100, 2, '.', '')  }}</td> --}}
                                </tr>
                            </table>
                        </td>
                    </tr>
                   </table>
                </div>
        @endforeach
    </div>
    <div style="float: right">
        <table style="width:100%;">
            <tr>
                <td style="width: 75%"></td>
                <td>
                    <p style="font-size:10px">
                        <strong>Total Score Sementara</strong>: ?<br>
                        <strong>Data yang terkumpul</strong>: 50% <br>
                    </p>
                </td>
            </tr>
        </table>
    </div>


</body>
</html>