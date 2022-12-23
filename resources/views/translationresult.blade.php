<x-guest-layout>
    @include('translate')
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-4">
                {{ __('msg.translate-result-searchword') }}
        </div>
        <div class="col-8 fw-bold">
            {{ $input }}
        </div>
        @foreach ($resultset as $results)
            @if(empty($results) === false)
                @include('resultset')
            @endif
        @endforeach
    </div>

</x-guest-layout>
