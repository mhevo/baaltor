<div class="container">
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <form method="POST" action="/translate">
        <div class="row gy-1">
            @csrf
            <div class="col-12 col-md-3 col-lg-2">
                {{ __('msg.translate-search') }}
            </div>
            <div class="col-12 col-md-9 col-lg-10">
                <input class="form-control" type="text" name="translateFrom" placeholder="{{ __('msg.translate-your-item-name') }}" />
            </div>
            <div class="col-12 col-md-3 col-lg-2">
                {{ __('msg.translate-translate-to') }}
            </div>
            <div class="col-12 col-md-9 col-lg-10">
                <select name="toLanguage">
                    @foreach ($languages as $language)
                        <option value="{{ $language }}">{{ $language }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3 col-lg-2">
                {{ __('msg.translate-search-group') }}
            </div>
            <div class="col-12 col-md-9 col-lg-10">
                <select name="search-category">
                    <option value="all">{{ __('msg.translate-search-for-all') }}</option>
                    <option value="itemname">{{ __('msg.translate-search-for-hard-items') }}</option>
                    <option value="magicitemname">{{ __('msg.translate-search-for-generated-items') }}</option>
                    <option value="area">{{ __('msg.translate-search-for-area') }}</option>
                    <option value="skill">{{ __('msg.translate-search-for-skill') }}</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{ __('msg.translate-translate-button') }}</button>
            </div>
        </div>
    </form>

</div>
