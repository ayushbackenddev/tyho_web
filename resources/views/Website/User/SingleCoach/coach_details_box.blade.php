<div class="boxfill p-3">
    <input type="hidden" name="id" id="id" value="{{$singleTherapistData->id}}">
    <div class="content_innerBox pb-0">
        <div class="row rowInnerProfileDetail">
            <div class="col-md-3 innerProfileDetailLeft">
                <div class="imageBox">
                    <!-- <span class="textNewClients">Not taking new clients</span> -->
                    @if ($singleTherapistData->profile_photo != "")
                        <img src="{{Storage::disk('s3')->url('' . $singleTherapistData->profile_photo)}}" alt="" title="">
                    @endif
                    @if ($singleTherapistData->video != "")
                        <div class="videobutton">
                            <a href="#" onclick="openVideo('{{Storage::disk('s3')->url('' . $singleTherapistData->video)}}')">
                                <img src="{{url('assets/img/icon_play.svg')}}" alt="" title="">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8 innerProfileDetailRight">
                <div class="row mb-4">
                    <div class="col-5">
                        <h2 class="heading-md mb-1">{{$singleTherapistData->first_name." ".$singleTherapistData->middle_name." ".$singleTherapistData->last_name}}</h2>
                        <h6>{{$singleTherapistData->therapist_occupation}}</h6>
                        <ul class='listIcons listIconsBig'>
                            @foreach (Helper::getMyMedium() as $showMedium)
                                @php
                                    $disableMedium = Helper::getCheckMyMedium($showMedium->id,$singleTherapistData->id) == true ? "" : "disabled";
                                @endphp
                                <li class="{{$disableMedium}}">
                                    <a data-toggle='tooltip' title='' data-bs-original-title='{{$showMedium->medium}}' aria-label='{{$showMedium->medium}}'>
                                        <img src="{{Storage::disk('s3')->url('' . $showMedium->medium_img)}}" alt='' title=''>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="d-grid mt-5">
                            <button type="button" class="btn btn-primary btn-sm" onclick="openTherapistDetails({{$singleTherapistData->id}})">Book a session</button>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-6">
                                <h3>Services</h3>
                                @php
                                    print_r (Helper::getMultipleServices1($singleTherapistData->service_id_fk));
                                @endphp
                            </div>
                            <div class="col-6">
                                <h3>Languages</h3>
                                @php
                                    print_r (Helper::getMultipleLanguages($singleTherapistData->language_id_fk));
                                @endphp
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="boxEmpathy">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h5>{{$singleTherapistData->category_of_therapist == 1 ? 'Empathy Therapist' : 'Care Therapist'}}</h5>
                                            <p>Starting from {{Helper::getTherapistCurrency($singleTherapistData->id)}} {{Helper::getStartingPrice($singleTherapistData->id)}}</p>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <a href="#"><u>Pricing</u></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content_innerBox f14 mb-0 content_height">
        <div>{!! $singleTherapistData->therapist_profile_description !!}</div>
        @if(Helper::getAllReviewForTherapistFullDetail($singleTherapistData->id) != "")
            <div class="boxTestimonials reviewBox">
                <h3>Reviews:</h3>
                <div id="carouselTestimonials" class="carousel slide" data-bs-ride="carousel">
                    @php
                        print_r (Helper::getAllReviewForTherapistFullDetail($singleTherapistData->id));
                    @endphp
                </div>
            </div>
        @endif
        <h3>Contact Us:</h3>
        <p class="mb-0">If you have any questions, feel free to reach us via email at <a href="mailto:contact@talkyourheartout.com">contact@talkyourheartout.com.</a></p>
    </div>
</div>

<script type="text/javascript">
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

function closeIntroVideo() {

    var video = document.getElementById('therapist_video_modal_video');
    video.pause();
    $('#modal_video').modal('hide');
}

function openVideo(video_url) {

    var video = document.getElementById('therapist_video_modal_video');
    video.src = video_url;
    video.play();
    $('#modal_video').modal('show');
}

function openTherapistDetails(id) {

    $.ajax({
        type: "POST",
        url: "{{url('api/clientBooking')}}",
        dataType: "json",
        data: {"id":id},

        success: function (response){

            $("#forBooking").html("");
            $("#forBooking").html(response.clientBooking);
            $('#modelClientBooking').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            alert("Data loading issue");
        }
    });
}
</script>