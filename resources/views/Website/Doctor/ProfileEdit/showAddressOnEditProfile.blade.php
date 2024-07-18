@foreach ($therapistAddresses as $address)

<div class="col-12 col-md-6">
    <div class="alert alert-address alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
        <p class="mb-0"><strong><input type="hidden" name="address_title[]" value="{{$address->address_title}}">{{$address->address_title}}</strong></p>
        <p><input type="hidden" name="address_line1[]" value="{{$address->address_line1}}">{{$address->address_line1}}, <input type="hidden" name="address_line2[]" value="{{$address->address_line2}}">{{$address->address_line2}},
        <input type="hidden" name="landmark[]" value="{{$address->landmark}}">{{$address->landmark}}, <input type="hidden" name="city[]" value="{{$address->city}}">{{$address->city}}, <input type="hidden" name="postal_code[]" value="{{$address->postal_code}}">{{$address->postal_code}}, <input type="hidden" name="country_id_fk[]" value="{{$address->country_name}}">{{$address->country_name}}</p>
    </div>
</div>

@endforeach

