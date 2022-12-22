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
        <div class="col-4">
                {{ __('msg.translate-result-translation') }}
        </div>
        <div class="col-8">
            @foreach ($resultset as $lang => $result)
                <div class="col-12 font-bold">
                    {{ __('msg.translate-result-sourcelanguage') }} {{ $lang }}
                </div>
                @foreach($result as $name)
                <div class="col-12">
                    {{ $name }}
                </div>
                @endforeach
                <div class="col-12">&nbsp;</div>
            @endforeach
        </div>
    </div>

</x-guest-layout>
