@component('mail::layout')
    {{-- Header --}}
    @slot ('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header -->
            {{ $data['title'] }}
        @endcomponent
    @endslot

    {{-- Content here --}}

    {{-- Subcopy --}}
    {{-- @component('mail::subcopy')
    <!-- subcopy -->
    {{ $data['subject'] }}
    @endcomponent --}}
    @component('mail::panel')
        {{ $data['subject'] }}
    @endcomponent
    {{-- @slot('subcopy')
    @endslot --}}
        
    {{-- Footer --}}
    @slot ('footer')
        @component('mail::footer')
        <!-- footer -->
        Thanks,
        {{-- {{ config('app.name') }} --}}
        {{ $data['footer'] }}
        @endcomponent
    @endslot
@endcomponent