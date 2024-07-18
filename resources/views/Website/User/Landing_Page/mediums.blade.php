@foreach ($mediums as $showMedium)
    <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input checkByUser onCheckedMediums" data-mediumid="{{$showMedium->id}}" id="medium_{{$showMedium->id}}" data-medium="{{$showMedium->medium}}" name="medium[]">
        <label class="form-check-label">{{$showMedium->medium}}</label>
    </div>
@endforeach