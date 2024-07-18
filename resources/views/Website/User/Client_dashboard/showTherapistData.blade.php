@foreach ($therapistData as $details)
<div class="owl-carousel owl-theme carouselCoachSessions">
    <div class="item">
        <div class="box_therapists">
            <a href="javascript:;" data-toggle="tooltip" title="Remove Therapist from your Dashboard" class="btnCloseSm"><i class="fas fa-times"></i></a>
            <div class="imageBox">
                @if ($details->profile_photo != "")
                    <img src="{{Storage::disk('s3')->url('' . $details->profile_photo)}}" alt="" title=""/>
                @endif
                <div class="videobutton">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_video"><img src="assets/img/icon_play.svg" alt="" title=""/></a>
                </div>
            </div>
            <div class="content_therapists">
                <h3>{{$details->first_name." ".$details->middle_name." ".$details->last_name}}</h3>
                <h6>{{$details->therapist_educational_qualification}}</h6>
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
                    <h4>{{$details->category_of_therapist == 1 ? 'Empathy Therapist' : 'Care Therapist'}}</h4>
                    <p class="mb-0">(starting from {{Helper::getTherapistCurrency($details->id)}} {{Helper::getStartingPrice($details->id)}})</p>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Book Session</button>
                </div>
                <p class="text-center m-0"><a href="#" class="textLink">Book With Another Therapist</a></p>
            </div>
        </div>
    </div>
</div>
@endforeach