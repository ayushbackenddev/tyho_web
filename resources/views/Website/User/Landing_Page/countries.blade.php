@foreach ($countries as $showCountry)
    <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input checkByUser onCheckedCountries" data-countryid="{{$showCountry->id}}" id="country_id_{{$showCountry->id}}" name="country[]" data-countryname="{{$showCountry->country}}">
        <label class="form-check-label">{{$showCountry->country}}</label>
    </div>
@endforeach