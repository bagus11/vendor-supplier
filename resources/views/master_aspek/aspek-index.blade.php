<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Aspek & Departement') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
            {{-- Aspek --}}
            @include('master_aspek.aspek_list')
            {{-- End Aspek --}}

            {{-- Departement --}}
            @include('master_aspek.departement_list')
            {{-- End Departement --}}
          
        </div>
    </div>

    {{-- Add Aspek --}}
        @include('master_aspek.add-aspek_modal')
    {{--End Add Aspek --}}
    {{-- Edit Aspek --}}
        @include('master_aspek.edit-aspek_modal')
    {{--End Edit Aspek --}}
    {{-- Add Departement --}}
        @include('master_aspek.add-departement_modal')
    {{--End Add Departement --}}
    {{-- Edit Departement --}}
        @include('master_aspek.edit-departement_modal')
    {{--End Edit Departement --}}
    {{-- js --}}
        @include('master_aspek.master_aspek_js')
    {{-- End js --}}
</x-app-layout>


