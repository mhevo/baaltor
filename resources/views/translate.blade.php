<div class="container">
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <form name="translate" method="POST" action="/translate">
        <div class="row gy-1">
            @csrf
            <div class="col-12 col-md-3 col-lg-2">
                {{ __('msg.translate-search') }}
            </div>
            <div class="col-12 col-md-9 col-lg-10">
                <input class="form-control" type="text" name="translateFrom" placeholder="{{ __('msg.translate-your-item-name') }}" value="{{ $input  }}" />
            </div>
            <div class="col-12 col-md-3 col-lg-2">
                {{ __('msg.translate-translate-to') }}
            </div>
            <div class="col-12 col-md-9 col-lg-10">
                <select name="toLanguage">
                    @foreach ($languages as $language)
                        <option value="{{ $language }}" @selected($toLanguage == $language)>{{ $language }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3 col-lg-2">
                {{ __('msg.translate-search-group') }}
            </div>
            <div class="col-12 col-md-9 col-lg-10">
                <select name="search-category">
                    <option value="all" @selected($searchCategory == 'all')>{{ __('msg.translate-search-for-all') }}</option>
                    <option value="itemname" @selected($searchCategory == 'itemname')>{{ __('msg.translate-search-for-hard-items') }}</option>
                    <option value="magicitemname" @selected($searchCategory == 'magicitemname')>{{ __('msg.translate-search-for-generated-items') }}</option>
                    <option value="area" @selected($searchCategory == 'area')>{{ __('msg.translate-search-for-area') }}</option>
                    <option value="skill" @selected($searchCategory == 'skill')>{{ __('msg.translate-search-for-skill') }}</option>
                </select>
            </div>
            <div class="col-10 offset-lg-2">
                <button type="submit" class="btn btn-primary">{{ __('msg.translate-translate-button') }}</button>
            </div>
        </div>
    </form>

</div>
