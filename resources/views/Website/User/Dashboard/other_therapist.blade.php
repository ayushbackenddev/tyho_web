@foreach ($OtherBookedTherapist as $details)

    <div class="item">
        <div class="box_therapists">
            <input type="hidden" value="{{$details->id}}" id="id">
            <a href="javascript:;" data-toggle="tooltip" title="Remove Therapist from your Dashboard" class="btnCloseSm"><i class="fas fa-times"></i></a>
            <div class="imageBox">
                @if ($details->profile_photo != "")
                    <a href="{{url('/coache')}}/{{$details->id}}"><img src="{{Storage::disk('s3')->url('' . $details->profile_photo)}}" alt="" title=""></a>
                @endif
                @if ($details->video != "")
                <div class="videobutton">
                    <a href="#" onclick="openVideo('{{Storage::disk('s3')->url('' . $details->video)}}')">
                        <img src="{{url('assets/img/icon_play.svg')}}" alt="" title="">
                    </a>
                </div>
                @endif
            </div>
            <div class="content_therapists">
                <h3>{{$details->first_name." ".$details->middle_name." ".$details->last_name}}</h3>
                <h6>{{$details->therapist_occupation}}</h6>
                <ul class="list_individuals">
                    {{ Helper::getMultipleServices($details->service_id_fk) }}
                </ul>
                <ul class='listIcons listIconsBig'>
                    @foreach (Helper::getMyMedium() as $showMedium)
                        @php
                            $disableMedium = Helper::getCheckMyMedium($showMedium->id,$details->id) == true ? "" : "disabled";
                        @endphp
                        <li class="{{$disableMedium}}">
                            <a data-toggle='tooltip' title='' data-bs-original-title='{{$showMedium->medium}}' aria-label='{{$showMedium->medium}}'>
                                <img src="{{Storage::disk('s3')->url('' . $showMedium->medium_img)}}" alt='' title=''>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="text_therapist mb-3">
                    <h4>Empathy Therapist</h4>
                    <p class="mb-0">(starting from {{Helper::getTherapistCurrency($details->id)}} {{Helper::getStartingPrice($details->id)}})</p>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary" onclick="openOtherTherapistDetails({{$details->id}})">Book Session</button>
                </div>
                <p class="text-center m-0"><a href="/allCoaches" class="textLink">Book With Another Therapist</a> </p>
            </div>
        </div>
    </div>

@endforeach

<script>

function openOtherTherapistDetails(id) {
    $.ajax({
        type: "POST",
        url: "{{url('api/clientBooking')}}",
        dataType: "json",
        data: {"id":id},

        success: function (response){

            $("#forBooking").html("");
            $("#forBooking").html(response.clientBooking);
            //$('#modelClientBooking').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            alert("Data loading issue");
        }
    });
}

</script>