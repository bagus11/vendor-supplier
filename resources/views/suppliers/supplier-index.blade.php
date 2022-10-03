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
    })
</script>