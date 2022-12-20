<style>
    .message_error{
        font-size: 10px;
    }
    .table_detail{
        background: #404258
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Penilaian') }}
        </h2>
    </x-slot>
    <div class=" px-6 pt-2 float-right">
        <div class="max-w-lg py-2 rounded-lg shadow-lg bg-white">
            <details class="duration-300">
                <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">Filter</summary>
                <div class="bg-white px-5 py-3 border border-gray-300 text-sm ">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            @php
                                $time = strtotime(date('Y-m-d'));
                                $final = date("Y-m-d", strtotime("-1 month", $time));
                            @endphp
                            <span>From :</span>
                            <input type="date" name="tgl_from" id="tgl_from" value="{{$final}}">
                        </div>
                        <div class="col-span-1">
                            <span>To :</span>
                            <input type="date" name="tgl_to" id="tgl_to" value="{{date('Y-m-d')}}">
                        </div>

                    </div>
                </div>
            </details>
        </div>
    </div>

    <div class="block grid grid-cols-1 gap-6 px-6 py-6 m-auto">
        {{-- List Penilaian --}}
        @include('form-penilaian.penilaian_list')
        {{-- End List Penilaian --}}
    </div>
     {{-- Add Penilaian --}}
     @include('form-penilaian.add-penilaian_modal')
    {{--End Add Penilaian --}}
    {{-- Print Evaluasi --}}
    @include('form-penilaian.print-evaluasi_modal')
    {{--End Print Evaluasi --}}
</x-app-layout>
{{-- js --}}
@include('form-penilaian.penilaian_js')
{{-- End js --}}
