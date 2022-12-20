<div class="container">
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <form method="POST" action="/translate">
        <div class="row gy-1">
            @csrf
            <div class="col-md-8 col-lg-3">
                <input class="form-control" type="text" name="translateFrom" placeholder="your item name" />
            </div>
            <div class="col-md-4 col-lg-4">
                <select name="toLanguage">
                    @foreach ($languages as $language)
                    <option value="{{ $language }}">{{ $language }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 col-lg-9">
                <button type="submit" class="btn btn-primary">Translate</button>
            </div>
        </div>
    </form>

</div>
