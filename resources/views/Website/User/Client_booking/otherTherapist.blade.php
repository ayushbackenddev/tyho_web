@foreach ($otherTherapist as $details)
    <div>
        <input type="hidden" value="{{$details->id}}" id="otherTherapistID" name="otherTherapistID">
        <div class="box_therapists" onclick="openOtherTherapistDetails({{$details->id}})">
            <div class="imageBox">
                @if ($details->profile_photo != "")
                    <img src="{{Storage::disk('s3')->url('' . $details->profile_photo)}}" alt="" title="">
                @endif
            </div>
            <div class="content_therapists">
                <h3>{{$details->first_name." ".$details->middle_name." ".$details->last_name}}</h3>
                <h6>{{$details->therapist_educational_qualification}}</h6>

                <div class="text_therapist">
                    <h4>{{$details->category_of_therapist == 1 ? 'Empathy Therapist' : 'Care Therapist'}}</h4>
                    <p class="mb-0">(starting from {{Helper::getTherapistCurrency($details->id)}} {{Helper::getStartingPrice($details->id)}})</p>
                </div>
            </div>
        </div>
    </div>
@endforeach