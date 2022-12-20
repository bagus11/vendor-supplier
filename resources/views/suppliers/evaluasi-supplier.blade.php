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
        body{
            font-family: Arial, Helvetica, sans-serif;
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
        padding: 2px;
        }
       
        .container {
        padding: 2px 16px;
        }
       
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 5px;
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
        #total_akhir {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #total_akhir td, #total_akhir th {
        border: 1px solid #ddd;
        padding: 4px;
        }

        #total_akhir tr:nth-child(even){background-color: #f2f2f2;}

        #total_akhir tr:hover {background-color: #ddd;}

        #total_akhir th {
      
        text-align: left;
        background-color: white;
        color: black;
        }
        #category {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #category td, #category th {
        border: 1px solid #ddd;
        padding: 4px;
        }

        #category tr:nth-child(even){background-color: #f2f2f2;}

        #category tr:hover {background-color: #ddd;}

        #category th {
      
        text-align: left;
        background-color: #E0144C;
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
        <p style="text-align: center">Nama Perusahaan : {{$master_header->supplierName}}</p>
    </div>  
    <div style="margin-top:-20px">
        @php
            $b=[];
            
        @endphp
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
                                    ->whereBetween(DB::raw('DATE(master_form_penilaian_headers.created_at)'), [$tgl_laporan.'-01-01', $tgl_laporan.'-12-31'])
                                    ->groupBy('master_form_penilaians.departement_id')
                                    ->get();
                $bobot = DB::table('log_bobots')
                            ->where('aspek_id',$item->aspekId)
                            ->where('supplier_id',$master_header->id)
                            ->sum('score');
        
                @endphp     
                <div>
                   <table style="margin-top:-15px">
                    <tr>
                        <td>
                            <table class="table-auto" id="customers" style="width: 100%">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-4 py-2" style="text-align: center;width:60%">Review</th>
                                        <th class="border px-4 py-2" style="text-align: center;width:20%">Score</th>
                                        <th class="border px-4 py-2" style="text-align: center;width:20%">Percent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @php
                                   $a =0;
                                       for($i=0; $i < count($form_evaluasi);$i++ ){
                                           $a += number_format((float)$form_evaluasi[$i]->score, 2, '.', '');
                                            echo '<tr>';
                                                echo '<td class="border px-4 py-2" style="text-align: left">'.$form_evaluasi[$i]->departement_name.'</td>';
                                                echo '<td class="border px-4 py-2" style="text-align: center">'.number_format((float)$form_evaluasi[$i]->score, 2, '.', '').'</td>';
                                                echo '<td class="border px-4 py-2" style="text-align: center"></td> ';
                                            echo '</tr>';
                                        }
                                        $count = DB::table('master_form_penilaian_headers')
                                        ->join('master_form_penilaians','master_form_penilaians.form_id','=','master_form_penilaian_headers.id')
                                            ->join('master_jawabans','master_jawabans.penilaian_id','=','master_form_penilaians.id')
                                            ->join('master_departements','master_departements.id','=', 'master_form_penilaian_headers.departement_id')
                                            ->join('master_aspeks','master_aspeks.id','=','master_form_penilaians.aspek_id')
                                            ->where('master_form_penilaian_headers.supplier_id',$master_header->id)
                                            ->where('master_form_penilaians.aspek_id', $item->aspekId)
                                            ->whereBetween(DB::raw('DATE(master_form_penilaian_headers.created_at)'), [$tgl_laporan.'-01-01', $tgl_laporan.'-12-31'])
                                            ->groupBy('master_form_penilaian_headers.departement_id')
                                            ->get();
                                            $avg_score = $a / count($count);
                                            $percent = $avg_score /100 * $bobot;
                                            array_push($b, ['score'=>$avg_score,'percent'=>number_format((float)$percent, 2, '.', '')]);
                                   @endphp
                                  <tr>
                                    <td class="border px-4 py-2" style="text-align: center;">
                                        <strong style="margin-left: 20px">Bobot Nilai {{$bobot}}%</strong>
                                    </td>
                                    <td class="border px-4 py-2" style="text-align: center;"><strong>{{number_format((float)$avg_score, 2, '.', '')}}</strong></td>
                                    <td class="border px-4 py-2" style="text-align: center;"><strong>{{number_format((float)$percent, 2, '.', '')}}</strong></td>
                                  </tr>
                                
                                </tbody>
                            </table>  
                        </td>
                    </tr>
                   </table>
                </div>
        @endforeach
        @php
            $c=0;
            $keterangan ='';
            for($j=0; $j < count($b);$j++ ){
                $c += $b[$j]['percent'];
            }
            $d = $c/count($b)*100;
            if($d <= 30){
                $keterangan ="Buruk";
            }else if($d >30 && $d <=60 ){
                $keterangan ="Biasa";
            }else if($d >60 && $d <=85 ){
                $keterangan ="Bagus";
            }else if($d >85 && $d <=95 ){
                $keterangan ="Sangat Bagus";
            }else if($d >95 && $d <=100 ){
                $keterangan ="Sangat Bagus Sekali";
            }
        @endphp
            <div style="width: 300px;float:right;margin-top:10px">
               <table>
                    <tr>
                        <td style="text-align:right"><strong>Total Score :</strong></td>
                        <td>
                            <table id="total_akhir" style="width:100%;">
                                <thead>
                                    <tr>
                                    
                                        <th style="text-align:center" colspan="1">{{$c}}</th>
                                        <th style="text-align:center" rowspan="2">{{$d}}%</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center">{{ $keterangan}}</th>
                                    
                                    </tr>
                                </thead>
                            </table>
                        </td>
                    </tr>
               </table>
            </div>
            <div style="width:250px">
                <table id="category" style="width:100%">
                    <thead>
                    <tr>
                            <th style="text-align: center" colspan="2">Kategori</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sangat Bagus Sekali</td>
                            <td style="text-align: right">(96% - 100%)</td>
                        </tr>
                        <tr>
                            <td>Sangat Bagus</td>
                            <td style="text-align: right">(86% - 95%)</td>
                        </tr>
                        <tr>
                            <td>Bagus</td>
                            <td style="text-align: right">(61% - 85%)</td>
                        </tr>
                        <tr>
                            <td>Biasa</td>
                            <td style="text-align: right">(31% - 60%)</td>
                        </tr>
                        <tr>
                            <td>Buruk</td>
                            <td style="text-align: right">(0 - 30%)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
    <div style="margin-top: 10px;width:100%">
        <table style="width:100%">
            <tr>
                <td style="width: 33%">
                    <p>Disetujui oleh, 
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                     Nama : Tryvena P <br>
                     Jabatan :  Act. Manager Purchasing   
                    </p>
                </td>
                <td style="width: 47%"></td>
                <td style="width: 20%">
                    <p>
                        {{$tempat->city}}, {{$tgl}}
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                         Nama : {{auth()->user()->name}} <br>
                         Jabatan : {{$tempat->jabatan_name}}  
                    </p>
                </td>
            </tr>
        </table>
    </div>
      
    
</body>
</html>