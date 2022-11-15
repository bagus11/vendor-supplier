<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body >
    <p style="font-size:12px">
        Dear Procurement Departement,<br>
        Berikut kami lampirkan data supplier baru sebagai berikut 
    </p>
    <p style="font-size:12px;margin-left:10px;margin-top:10px">
        Nama Supplier   : {{$supplier['supplierName']}} <br>
        Jenis Usaha     : {{$supplier['supplierType']}}<br>
        Kategori        : {{$supplier['supplierCategory']}}<br>
        Tahun Berdiri   : {{$supplier['supplierYearOfEstablishment']}}<br>
        Jumlah Karyawan : {{$supplier['supplierNumberOfEmployee']}}<br>
        Alamat          : {{$supplier_address['supplierAddress']}}<br>
        Kode Pos        : {{$supplier_address['supplierPostalCode']}}<br>
        No Telepone     : {{$supplier_address['supplierPhone']}}<br>
        Fax             : {{$supplier_address['supplierFax']}}<br>
        Email           : {{$supplier_address['supplierEmail']}}<br>
        Website         : {{$supplier_address['supplierWebsite']}}<br>
    </p>
    <p style="font-size:12px">
        Untuk cetak report, silahkan klik link <a href="{{ url('report_supplier/'.$supplier_address['supplierId'])}}">disini</a> <br>
        Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya 
    </p>
</body>
</html>