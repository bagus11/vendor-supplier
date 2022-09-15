<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <button class="mt-2 ml-2 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="defaultModal">
                    Toggle modal
                  </button>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($product as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item->p_name }}</td>
                                <td class="border px-4 py-2">{{ $item->p_quantity }}</td>
                                <td class="border px-4 py-2">{{ $item->p_price }}</td>
                                <td class="border px-4 py-2">{{ $item->p_price }}</td>
                            </tr>    
                           @endforeach
                        </tbody>
                    </table>
                    @include('product.v_modal_add')
                </div>
            </div>
        </div>
    </div>
 
</x-app-layout>
<script>

</script>
