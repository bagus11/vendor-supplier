<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Supplier</title>

    <style>
        * {
        box-sizing: border-box;
        }

        table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px;
        }

        th, td {
        text-align: left;
        padding: 16px;
        }

        tr:nth-child(even) {
        background-color: #f2f2f2;
        }

        /* card */
        .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
        }

        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container {
        padding: 2px 16px;
        }


    </style>
</head>
<body>
    <div>
        <h3>Other Address</h3>
        @forelse ($otherAddresses as $otherAddress)
            <div class="card">
                <div class="container">
                    <h4><b>{{ $otherAddress->supplierAddress }}</b></h4> 
                    <p>{{ $otherAddress->supplierPhone }}</p> 
                    <p>{{ $otherAddress->supplierFax }}</p> 
                    <p>{{ $otherAddress->supplierEmail }}</p> 
                    <p>{{ $otherAddress->supplierWebsite }}</p> 
                </div>
            </div>
        @empty
            <p>-</p>
        @endforelse
        
        {{-- <h1 class="text-3xl font-bold underline">Other Address</h1> --}}
        {{-- <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Address</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Fax</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Website</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($otherAddresses as $otherAddress)
                <tr>
                    <td class="border px-4 py-2">{{ $otherAddress->supplierAddress }}</td>
                    <td class="border px-4 py-2">{{ $otherAddress->supplierPhone }}</td>
                    <td class="border px-4 py-2">{{ $otherAddress->supplierFax }}</td>
                    <td class="border px-4 py-2">{{ $otherAddress->supplierEmail }}</td>
                    <td class="border px-4 py-2">{{ $otherAddress->supplierWebsite }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table> --}}
    </div>
    <div>
        <h3>PIC</h3>
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Department</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pics as $pic)
                    <tr>
                        <td class="border px-4 py-2">{{ $pic->picDepartement }}</td>
                        <td class="border px-4 py-2">{{ $pic->picName }}</td>
                        <td class="border px-4 py-2">{{ $pic->picPhone }}</td>
                        <td class="border px-4 py-2">{{ $pic->picEmail }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="3">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>
        <h3>ISO</h3>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="bg-gray-100">ISO</th>
                    <th class="bg-gray-100">Diterapkan</th>
                    <th class="bg-gray-100">Terverifikasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($isoes as $iso)
                <tr>
                    <td class="border px-4 py-2">{{ $iso->iso }}</td>
                    <td class="border px-4 py-2">{{ $iso->applied = 1 ? 'Ya' : 'Tidak'  }}</td>
                    <td class="border px-4 py-2">{{ $iso->certified = 1 ? 'Ya' : 'Tidak' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>