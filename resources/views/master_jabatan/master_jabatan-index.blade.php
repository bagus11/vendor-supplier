<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jabatan & Kantor') }}
        </h2>
    </x-slot>
    <div class="py-2">
            <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
              @include('master_jabatan.master_jabatan-list')
              @include('master_jabatan.master_kantor-list')
            </div>
        </div>
    @include('master_jabatan.add-kantor_modal')
    @include('master_jabatan.edit-kantor_modal')
    @include('master_jabatan.add-jabatan_modal')
    @include('master_jabatan.edit-jabatan_modal')
</x-app-layout>
@include('master_jabatan.master_jabatan-js')
