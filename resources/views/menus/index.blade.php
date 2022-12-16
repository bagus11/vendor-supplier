<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menus') }}
        </h2>
    </x-slot>
    <div class="py-2">
            <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
                <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                    <div class="px-6 border-b border-gray-300">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="py-3">
                                <h3 style="margin-top:5px">List Menus</h3>
                            </div>
                            <div class="py-3">
                            
                                @can('add-menus')
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"id="add_menus" style="float:right">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>
                
                    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                        <div class="container">
                            <table class="table-auto w-full bg-blue-500 supplier-datatable" id="menus_table">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Link</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Action</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Sub Menus --}}
                <div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
                    <div class="px-6 border-b border-gray-300">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="py-3">
                                <h3 style="margin-top:5px">List Sub Menus</h3>
                            </div>
                            <div class="py-3">
                                @can('add-menus')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="add_submenus" style="float:right">
                                    <i class="fas fa-plus"></i>
                                </button>
                                @endcan
                            
                            </div>
                        </div>
                    </div>
                
                    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                        <div class="container">
                            <table class="table-auto w-full bg-blue-500 supplier-datatable" id="submenus_table">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Link</th>
                                        <th class="px-4 py-2">Status</th>
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
        </div>
   
{{-- Add Menus --}}
    @include('menus.add-menus_modal')
    {{-- End Add Menus --}}
{{-- Add SubMenus --}}
    @include('menus.add-submenus_modal')
{{--End Add SubMenus --}}

{{-- Edit Menus --}}
    @include('menus.edit-menus_modal')
{{--End Edit Menus --}}

{{-- Edit Submenus --}}
    @include('menus.edit-submenus_modal')
{{--End Edit Subenus --}}
    
{{-- Js --}}    
    @include('menus.menus_js')
{{-- Js --}}
</x-app-layout>

