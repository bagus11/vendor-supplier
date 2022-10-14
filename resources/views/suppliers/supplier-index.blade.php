<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 mb-4 rounded">
                        <a href="{{ route('suppliers.create') }}">
                            Add Supplier
                        </a>
                    </button>
                    <table class="table-auto w-full bg-blue-500 supplier-datatable">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Fax</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="dataModalSupplierDetail">
        <!--x`
        Background backdrop, show/hide based on modal state.
    
        Entering: "ease-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
        Leaving: "ease-in duration-200"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
    
        <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!--
            Modal panel, show/hide based on modal state.
    
            Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
            Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:max-w-2xl">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h2 class="text-xl font-medium leading-6 text-gray-900" id="modal-title"></h2>
                        <div class="mt-2">
                        <!--body-->
                        <div class="relative p-6 flex-auto">
                            <div class="grid grid-cols-3">
                                {{-- <div class="grid grid-flow-col auto-cols-max"> --}}
                                <div class="text-left mr-4">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Name : <span id="supplierName"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Email : <span id="supplierEmail"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Fax : <span id="supplierFax"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Website : <span id="supplierWebsite"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Category : <span id="supplierCategory"></span></p>
                                </div>
                                <div class="text-left mr-4">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Province : <span id="supplierProvince"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">City : <span id="supplierCity"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">District : <span id="supplierDistricts"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Village : <span id="supplierVillage"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Address : <span id="supplierAddress"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Code : <span id="supplierPostalCode"></span></p>
                                </div>
                                <div class="text-left mr-4">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Number Bank : <span id="numberBank"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Term Of Payment : <span id="termOfPayment"></span> Hari</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <table class="table-auto w-full border-collapse border border-blue-300">
                                    <thead>
                                        <tr class="border">
                                            <th>PIC Name</th>
                                            <th>PIC Departement</th>
                                            <th>PIC Phone</th>
                                            <th>PIC Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border">
                                            <td>
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picName"></span></p>
                                            </td>
                                            <td>
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picDepartement"></span></p>
                                            </td>
                                            <td>
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picPhone"></span></p>
                                            </td>
                                            <td>
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"><span id="picEmail"></span></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" id="closeSupplierDetail">Close</button>
            </div>
            </div>
        </div>
        </div>
    </div>

</x-app-layout>

<script type="text/javascript">
    $(function() {
        var table = $('.supplier-datatable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: {
                url: '{!! url()->current() !!}',
                // type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'supplier.supplierName', 
                    name: 'supplier.supplierName'
                },
                {
                    data: 'supplierPhone', 
                    name: 'supplierPhone'
                },
                {
                    data: 'supplierEmail', 
                    name: 'supplierEmail'
                },
                {
                    data: 'supplierFax', 
                    name: 'supplierFax'
                },
                // {data: 'supplierName',name: 'supplierName'},
                // {data: 'supplierType',name: 'supplierType'},
                // {data: 'supplierCategory',name: 'supplierCategory'},
                // {data: 'supplierYearOfEstablishment',name: 'supplierYearOfEstablishment'},
                // {data: 'supplierNumberOfEmployee',name: 'supplierNumberOfEmployee'},

                // {data: 'supplier_address.supplierPhone',name: 'supplier_address'},
                // {data: 'supplier_address.supplierFax',name: 'supplier_address'},
                // {data: 'supplier_address.supplierEmail',name: 'supplier_address'},
                // {data: 'supplier_address.supplierPhone',name: 'supplierPhone'},
                // {data: 'supplier_address.supplierFax',name: 'supplierFax'},
                // {data: 'supplier_address.supplierEmail',name: 'supplierEmail'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    // width: '25%'
                }
            ]
        })
    });

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    $('body').on('click', '.editPost', function () {
        let userURL = $(this).data('url');
        $.get(userURL, function (data) {
            console.log(data);
            $('#dataModalSupplierDetail').show();
            $('#modal-title').html('Supplier Details');
            $('#id').text(data.id);
            $('#supplierName').text(data[0].supplierName);
            $('#supplierEmail').text(data[0].supplierEmail);
            $('#supplierWebsite').text(data[0].supplierWebsite);
            $('#supplierFax').text(data[0].supplierFax);
            $('#supplierProvince').text(data[0].province_name);
            $('#supplierCity').text(data[0].regency_name);
            $('#supplierDistricts').text(data[0].district_name);
            $('#supplierVillage').text(data[0].village_name);
            $('#supplierAddress').text(data[0].supplierAddress);
            $('#supplierPostalCode').text(data[0].supplierPostalCode);
            $('#supplierCategory').text(data[0].supplierCategory);
            $('#numberBank').text(data[0].numberBank);
            $('#termOfPayment').text(data[0].termOfPayment);
            $('#picName').text(data[0].picName);
            $('#picDepartement').text(data[0].picDepartement);
            $('#picPhone').text(data[0].picPhone);
            $('#picEmail').text(data[0].picEmail);
        });
    });

    $('#closeSupplierDetail').click(function() {
        $('#dataModalSupplierDetail').hide();
    })
    
</script>