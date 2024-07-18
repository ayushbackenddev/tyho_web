@foreach ($services as $showServices)
    <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input checkByUser onCheckedServices" data-serviceid="{{$showServices->id}}" id="service_{{$showServices->id}}" data-service="{{$showServices->service}}" name="service[]">
        <label class="form-check-label">{{$showServices->service}}</label>
    </div>
@endforeach