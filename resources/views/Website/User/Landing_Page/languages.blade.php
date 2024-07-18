@foreach ($languages as $showLanguage)
    <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input checkByUser onCheckedLanguages" data-langid="{{$showLanguage->id}}" id="language_{{$showLanguage->id}}" data-name="language[]" data-language="{{$showLanguage->language_name}}">
        <label class="form-check-label">{{$showLanguage->language_name}}</label>
    </div>
@endforeach