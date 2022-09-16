<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('suppliers.store') }}">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                <div class="mb-4">
                                    <label for="supplierName"
                                        class="block text-gray-700 text-sm font-bold mb-2">Supplier Name</label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierName" placeholder="Enter Supplier Name" name="supplierName" value="{{ old('supplierName') }}">
                                    @error('supplierName') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="supplierPhone"
                                        class="block text-gray-700 text-sm font-bold mb-2">Supplier Phone</label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierPhone" placeholder="Enter Supplier Phone" name="supplierPhone" value="{{ old('supplierPhone') }}">
                                    @error('supplierPhone') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email"
                                        class="block text-gray-700 text-sm font-bold mb-2">Supplier E-Mail</label>
                                    <input type="email"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="email" placeholder="Enter Supplier E-Mail" name="email" value="{{ old('email') }}">
                                    @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="supplierDescription"
                                        class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('dessupplierDescriptioncription') }}"
                                        id="supplierDescription" placeholder="Enter Description" name="supplierDescription"></textarea>
                                    @error('supplierDescription') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="supplierNPWP"
                                        class="block text-gray-700 text-sm font-bold mb-2">Supplier NPWP</label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierNPWP" placeholder="Enter Supplier NPWP" name="supplierNPWP" value="{{ old('supplierNPWP') }}">
                                    @error('supplierNPWP') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="supplierNPWPFile"
                                        class="block text-gray-700 text-sm font-bold mb-2">Supplier NPWP</label>
                                    <input type="file"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierNPWPFile" placeholder="Enter Supplier NPWP" name="supplierNPWPFile">
                                    @error('supplierNPWPFile') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="supplierSIUP"
                                        class="block text-gray-700 text-sm font-bold mb-2">Supplier SIUP</label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierSIUP" placeholder="Enter Supplier SIUP" name="supplierSIUP" value="{{ old('supplierSIUP') }}">
                                    @error('supplierSIUP') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="supplierSIUPFile"
                                        class="block text-gray-700 text-sm font-bold mb-2">Supplier SIUP</label>
                                    <input type="file"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierSIUPFile" placeholder="Enter Supplier SIUP" name="supplierSIUPFile">
                                    @error('supplierSIUPFile') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="ProductId"
                                        class="block text-gray-700 text-sm font-bold mb-2">Categories</label>
                                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="ProductId" id="ProductId" value="{{ old('ProductId') }}">
                                            <option value="hidden">Select Category</option>
                                            @forelse ($products as $item)
                                                <option value="{{ $item->id }}">{{ $item->p_name }}</option>
                                            @empty
                                                <option value="0">No Data</option>
                                            @endforelse
                                        </select>
                                    @error('ProductId') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button type="submit"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-sky-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-sky-800 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    {{-- <svg wire:loading.delay wire:target="storeProduct" class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg> --}}
                                    Save
                                </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                <button type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    <a href="{{ route('suppliers.index') }}">
                                        Cancel
                                    </a>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>