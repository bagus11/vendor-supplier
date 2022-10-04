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

    <button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
        Open regular modal
    </button>
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="ajaxModelexa">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
            <h3 class="text-3xl font-semibold">
                Modal Title
            </h3>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
                </span>
            </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-2">
                    <div>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Name : <span  id="supplierName"></span></p>
                    </div>
                    <div>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">Email : <span  id="supplierEmail"></span></p>
                    </div>
                </div>
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                Close
            </button>
            <button class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                Save Changes
            </button>
            </div>
        </div>
        </div>
    </div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
    {{-- <script type="text/javascript">
        function toggleModal(modalID){
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");

        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
        // $.get("{{ route('suppliers.index') }}" +'/' + id, function (data) {
            $('#ajaxModelexa').show();
            $('#id').text(data.id);
            $('#supplierName').text(data.supplierName);
            $('#supplierEmail').text(data.supplierEmail);
        });
        }
    </script> --}}

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
        // var id = $(this).data('id');
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
        // $.get("{{ route('suppliers.index') }}" +'/' + id, function (data) {
            $('#ajaxModelexa').show();
            $('#id').text(data.id);
            $('#supplierName').text(data.supplierName);
            $('#supplierEmail').text(data.supplierEmail);
        });
    });

    $('#close-modal-supplier-detail').click(function() {
        $('$ajaxModelexa').modal('hide');
    })
    
</script>