<style>
    .message_error{
        font-size: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role & Permission') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto md:grid-cols-2">
            {{-- Roles --}}
                @include('roles.roles_list')
            {{-- End Roles --}}
        
            {{-- Permission --}}
                @include('roles.permission_list')
            {{-- End Permission --}}

            {{-- Modal Add Roles --}}
                @include('roles.add-role_modal')
            {{-- End Modal Add Roles --}}

            {{-- Add Permission --}}
                @include('roles.add-permission_modal')
            {{-- End Add Permission --}}

            {{-- Modal Edit Roles --}}
                @include('roles.edit-role_modal')
            {{-- End Modal Edit Roles --}}

            {{-- Js --}}
                @include('roles.roles_js')
            {{-- End Js --}}
        </div>
    </div>
</x-app-layout>


