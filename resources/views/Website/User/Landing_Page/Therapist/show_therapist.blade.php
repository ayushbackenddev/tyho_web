@foreach ($therapistData as $details)
    <div class="item"  data-id="{{$details->id}}">
        <!-- onclick="showTherapistData('{{$details->id}}')" -->
        <input type="hidden" value="{{$details->id}}" id="id">
        <div class="box_therapists" data-bs-toggle="tab" data-bs-target="coach_1">
            <div class="imageBox">
                @if ($details->profile_photo != "")
                    <!-- <a href="{{url('/coache')}}/{{$details->id}}"> -->
                        <img src="{{Storage::disk('s3')->url('' . $details->profile_photo)}}" alt="" title="">
                    <!-- </a> -->
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
                <!-- <a href="{{url('/coache')}}/{{$details->id}}"> -->
                <h3>{{$details->first_name." ".$details->middle_name." ".$details->last_name}}</h3>
            <!-- </a> -->
                <h6>{{$details->therapist_occupation}}</h6>
                <ul class="list_individuals">
                    @if($details->service_id_fk != null)
                        {{ Helper::getMultipleServices($details->service_id_fk) }}
                    @endif
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
            </div>
        </div>
    </div>
@endforeach