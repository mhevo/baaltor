<x-guest-layout>
    @include('translate')
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-4">
                You searched for:
        </div>
        <div class="col-8">
            {{ $input }}
        </div>
        <div class="col-4">
                Translation:
        </div>
        <div class="col-8">
            @foreach ($resultset as $lang => $result)
            <div class="col-12 font-bold">
                Sourcelanguage {{ $lang }}
            </div>
            <div class="col-12">
                    {{ implode(' ', $result) }}
            </div>
            @endforeach
        </div>
    </div>
    
</x-guest-layout>