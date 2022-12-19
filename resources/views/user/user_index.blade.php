<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Setting User') }}
        </h2>
    </x-slot>
        {{-- <div class=" px-6 pt-2 float-right">
            <div class="max-w-lg py-2 rounded-lg shadow-lg bg-white">
                <details class="duration-300">
                    <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Filter</summary>
                    <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                        <div class="grid grid-cols-2 gap-4">
                            <label class="mt-2">Departement</label>
                            <select name="select_departement" class="select2" id="select_departement"></select>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            <label class="mt-2">Aspek</label>
                            <select name="select_aspek" class="select2" id="select_aspek"></select>
                        </div>
                    </div>
                </details>
            </div>
        </div> --}}

        @include('user.user_list')
        @include('user.edit-user_modal')
    </x-app-layout>
    @include('user.user_js')
 