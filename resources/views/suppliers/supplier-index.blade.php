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
                    <table class="table-auto w-full supplier-datatable">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Fax</th>
                                <th class="px-4 py-2">Email</th>
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
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:max-w-xl">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title"></h3>
                        <div class="mt-2">
                        <!--body-->
                        <div class="relative p-6 flex-auto">
                            <div class="grid grid-cols-2">
                                <div class="text-left mr-4">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Name : <span id="supplierName"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Email : <span id="supplierEmail"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Fax : <span id="supplierFax"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Website : <span id="supplierWebsite"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Category : <span id="supplierCategory"></span></p>
                                </div>
                                <div class="text-left ml-4">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Province : <span id="supplierProvince"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">City : <span id="supplierCity"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">District : <span id="supplierDistricts"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Village/Ward : <span id="supplierWard"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Address : <span id="supplierMainAddress"></span></p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Code : <span id="supplierPostalCode"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" id="closeSupplierDetail">Close</button>
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
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                {
                    data: 'supplierName',
                    name: 'supplierName'
                },
                {
                    data: 'supplierPhone',
                    name: 'supplierPhone'
                },
                {
                    data: 'supplierFax',
                    name: 'supplierFax'
                },
                {
                    data: 'supplierEmail',
                    name: 'supplierEmail'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    // width: '25%'
                }
            ]
        })
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editPost', function () {
        // let id = $(this).data('id');
        let userURL = $(this).data('url');
        $.get(userURL, function (data) {
        // $.get("{{ route('suppliers.index') }}" +'/' + id, function (data) {
            $('#dataModalSupplierDetail').show();
            $('#modal-title').html('Supplier Details');
            $('#id').text(data.id);
            $('#supplierName').text(data.supplierName);
            $('#supplierEmail').text(data.supplierEmail);
            $('#supplierWebsite').text(data.supplierWebsite);
            $('#supplierFax').text(data.supplierFax);
            $('#supplierProvince').text(data.supplierProvince);
            $('#supplierCity').text(data.supplierCity);
            $('#supplierDistricts').text(data.supplierDistricts);
            $('#supplierWard').text(data.supplierWard);
            $('#supplierMainAddress').text(data.supplierMainAddress);
            $('#supplierPostalCode').text(data.supplierPostalCode);
            $('#supplierCategory').text(data.supplierCategory);
        });
    });

    $('#closeSupplierDetail').click(function() {
        $('#dataModalSupplierDetail').hide();
    })
    
</script>