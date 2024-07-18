@foreach ($therapist_sessions as $sessions)

<div class="col-md-6">
    <div class="content_session   session_content_{{$sessions->id}}">
        <input type="hidden" value="{{$sessions->user_id_fk}}" id="client_id_fk" name="client_id_fk">
        <input type="hidden" name="therapist_id_fk" id="therapist_id_fk" value="{{ Session::get('loggedTherapist') }}">
        <input type="hidden" value="{{$sessions->slot_id}}" id="slot_id" name="slot_id">
        <input type="hidden" value="{{$sessions->oreder_id}}" id="oreder_id" name="oreder_id">
        <div class="top_session_part">
            <div class="row rowDetailOne g-1">
                <div class="col-md-8">
                    <h3>{{ $sessions->first_name." ".$sessions->middle_name." ".$sessions->last_name }} ({{ $sessions->user_id }})</h3>
                    <ul class="listSession">
                        <li>{{ $sessions->service_name }}</li>
                        <li><img src="{{Storage::disk('s3')->url('' . $sessions->medium_img)}}" alt="" title=""> {{ $sessions->medium_name }}</li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <div class="textSession">Session ID #{{ $sessions->id }}</div>
                </div>
            </div>
            <div class="rowDetailTwo">
                <div class="sessionDate">
                    @if($sessions->cancel_by_both == 1)
                        <div class="textCondition"><span class="text-red">Cancelled by Therapist</span></div>
                    @elseif($sessions->cancel_by_both == 2)
                    <div class="textCondition"><span class="text-red">Cancelled by Client</span></div>
                    @elseif( $sessions->request_reschedule_status == 1 )
                        <div class="textCondition"><span class="text-green">Reschedule Request Accepted</span></div>
                    @elseif($sessions->no_show_by_therapist == 1)
                        <div class="textCondition text-red">No Show by Therapist <i class="fas fa-info-circle"></i></a></div>
                    @elseif($sessions->no_show_by_client == 1)
                        <div class="textCondition text-red">No Show by Client <i class="fas fa-info-circle"></i></a></div>
                    @endif
                    
                    <p>{{ Helper::getFormatedDateForTherapistDashboard($sessions->booking_date) }},  {{ $sessions->start_time }} - {{ $sessions->end_time }} (SGT)</p>

                    @if( $sessions->medium_id == 4 )
                        <p class="textAddress">
                            {{ $sessions->address }}, {{ $sessions->address_line1 }}, {{ $sessions->address_line2 }}, {{ $sessions->landmark }}, {{ $sessions->City }}, {{ $sessions->postal_code }}
                        </p>
                    
                    @elseif($sessions->medium_id == 5)
                        <p class="textAddress">
                            {{ $sessions->homevisit_address }}, {{ $sessions->zip_code }}, {{ $sessions->phone_no }}, {{ $sessions->country }}, {{ $sessions->city }}, {{ $sessions->state }}
                        </p>
                    @endif
                    
                    @if($sessions->cancel_by_both == 1 )
                        <br>
                        <p>You have cancelled this session and the client has been refunded.</p>
                    @elseif($sessions->no_show_by_therapist == 1)
                        <br>
                        <p>The session was not attended by the Therapist, and the client has been refunded.</p>
                    @elseif($sessions->cancel_by_both == 2)
                        <br>
                        <p>This session has been cancelled by the client more than {{$sessions->hourCount}} hours before the appointment time.
                            The client has been refunded.</p>
                    @elseif($sessions->no_show_by_client == 1)
                        <br>
                        <p>The session was not attended by the client, and is non-refundable.</p>
                    @elseif($sessions->request_reschedule_status == 1)
                        <br>
                        <p>You have accepted the client's request to reschedule this session, and as such this session has been cancelled.
                            <br><br>
                        The client has been refunded the credits and will be prompted to book another session.</p>
                    @endif
                    
                </div>
                <div class="boxCalendar">
                    <div class="dropdown d-inline ms-1">
                        <button class="btn btn-primary btn-calendar dropdown-toggle" data-toggle="tooltip" title="Add To Calendar" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/img/icon_calendar.svg" alt="" title=""/>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-calender dropdown-menu-end" aria-labelledby="dropdownMenu2">
                           <li><a href="#">iCal</a></li>
                           <li><a href="#">Google</a></li>
                           <li><a href="#">Outlook</a></li>
                           <li><a href="#">Yahoo</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row align-items-center rowSessionAction">
                <div class="col-md-5">

                </div>
                <div class="col-md-7 text-end">
                    
                    <a type="button" onclick="showintekform()" class="textLink">View Intake form</a>
                    @if( $sessions->request_reschedule_status == 1 || $sessions->request_reschedule_status == 2) 
                    
                    @elseif($sessions->cancel_by_both == 0 AND $sessions->no_show_by_therapist == 0 AND $sessions->no_show_by_client == 0 )
                        <a type="button" class="textLink ms-2 cancelByTherapist" data-slot_id_fk="{{$sessions->slot_id_fk}}">cancel</a>
                    @endif
                </div>
            </div>
            <p class="mb-0">
                <a href="javascript:;" id="running_late_button_{{$sessions->id}}" onclick="poponen({{$sessions->id}})" class="btn-running running_late_button_{{$sessions->id}}" data-keyid="{{$sessions->id}}">Running Late? <i class="fas fa-chevron-circle-down"></i></a>
            </p>
        </div>
        <div class="bottom_session_part">
            @if( $sessions->delay_time != NULL )
                <p>Running late by {{ $sessions->delay_time . " " . $sessions->delay_reason }}</p>
            @endif

            @if( $sessions->request_reschedule_reason != NULL && $sessions->request_reschedule_status == 0 )
                <div class="textCondition text-red">Reschedule Request Received <a class="text-red" data-toggle="tooltip" title="The client has sent a reschedule request within 24 hours of the appointment time. You may wish to accept this request if you find the reason to be reasonable." href="#"><i class="fas fa-info-circle"></i></a></div>
                <p>Reason: {{ $sessions->request_reschedule_reason }}. </p>
                <p class="mt-2">
                    <a type="button" class="textLink AcceptRequest" data-slot_id_fk="{{$sessions->slot_id_fk}}">Accept</a>
                    <a type="button" class="textLink ms-2 RejectRequest" data-slot_id_fk="{{$sessions->slot_id_fk}}">Reject</a>
                </p>
            @endif
        </div>
        <form id="delay_session_{{$sessions->id}}" name="BookSlotForm" method="POST">
            <input type="hidden" name="slot_id" value="{{$sessions->slot_id_fk}}" id="slot_id"> 
            <input type="hidden" name="id" id="id" data-id_slot="{{$sessions->id}}" value="{{$sessions->id}}">
            <div class="popupDelay" id="running_late">
                <div class="boxInnerPopup">
                    <a href="javascript:;" class="btnCloseSm" id="running_late_close" onclick="running_late({{$sessions->id}})"><i class="fas fa-times"></i></a>
                    <div class="form-field mb-3 inline_radioBtns">
                        <div class="form-check d-inline-block me-2">
                            <input class="form-check-input" type="radio" name="delay_session_time" value="5min"  id="5min" checked="">
                            <label class="form-check-label" for="5min"> 5 mins</label>
                        </div>
                        <div class="form-check d-inline-block">
                            <input class="form-check-input" type="radio" name="delay_session_time" value="10min" id="10min">
                            <label class="form-check-label" for="10min"> 10 mins</label>
                        </div>  
                        <div class="form-check d-inline-block">
                            <input class="form-check-input" type="radio" name="delay_session_time" value="15min" id="15min">
                            <label class="form-check-label" for="15min"> 15 mins</label>
                        </div>
                        <div class="form-check d-inline-block">
                            <input class="form-check-input" type="radio" name="delay_session_time" value="20min" id="20min">
                            <label class="form-check-label" for="20min"> 20 mins</label>
                        </div>
                    </div>
                    <div class="form-field mb-4">
                        <label class="form-label">Reason for Delay</label>
                        <textarea name= "reason" class="form-control "></textarea>
                    </div>
                    <p class="mb-0"><button type="submit" onclick="delaySubmit({{$sessions->id}})" name="submit" class="btn btn-sm btn-primary">Submit</button></p>
                    <!-- <button type="submit" name="submit" id="resecheduleBooking" class="btn btn-primary btn-lg btn-pay">Reschedule Now</button> -->
                </div>
            </div>
        </form>
        
        <form id="reschedule_request_form" name="BookSlotForm" method="POST">
            <input type="hidden" name="slot_id" value="{{$sessions->id}}"> 
            
            <div class="popupDelay" id="reschedule_request">
                <div class="boxInnerPopup">

                    <a href="javascript:;" class="btnCloseSm"  id="reschedule_request_close" onclick="request_close({{$sessions->id}})"><i class="fas fa-times"></i></a>
                    <div class="form-field mb-4">
                        <label class="form-label">Reason for reschedule request</label>
                        <textarea name= "reason" class="form-control "></textarea>
                    </div>
                    <p class="mb-0"><button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button></p>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Code-->
<div class="modal fade" id="modelCancelAppointment2" tabindex="-1" aria-labelledby="modelCancelAppointment2" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
            <div class="modal-body" id="cancelAppointmentTherapist">

            </div>
        </div>
    </div>
</div>
<!-- Modal Code-->

@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>

var therapist_id_fk = $("#therapist_id_fk").val();

$(".cancelByTherapist").on('click', function(event){

    var slot_id_fk = $(this).data("slot_id_fk");

    $.ajax({
        type: "POST",
        url: "{{url('api/cancelFormDataTherapist')}}",
        data: {'therapist_id_fk':therapist_id_fk, "slot_id_fk":slot_id_fk},
        dataType: "json",

        success: function (response){

            $("#cancelAppointmentTherapist").empty();
            $("#cancelAppointmentTherapist").append(response.cancelAppointmentTherapist);
            $('#modelCancelAppointment2').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            toastr.error(response.message);
        }
    });
});

$('.AcceptRequest').click(function(){

    var slot_id_fk = $(this).data("slot_id_fk");
    var oreder_id = $("#oreder_id").val();
    var client_id_fk = $("#client_id_fk").val();
    var slot_id = $("#slot_id").val();
   
    $.ajax({
        url: "{{url('api/acceptRequest')}}",
        type: "POST",
        data: {'slot_id_fk':slot_id_fk,"slot_id ":slot_id,"client_id_fk":client_id_fk,"oreder_id":oreder_id},
        dataType: 'json',

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
            }
            else
            {
                toastr.error(error.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});

function request_close(id){
    $(".session_content_"+id).removeClass('showPopupReschedule');
}
function running_late(id){
    $(".session_content_"+id).removeClass('showPopupRunningLate');
}
function poponen(id){
   $(".session_content_"+id).addClass('showPopupRunningLate');
}
function delaySubmit(id){
    $("#delay_session_"+id).on("submit", function(e){

    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "{{url('api/delaySessionClient')}}",
        type: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
                // window.location.replace("{{url('/booking')}}");
            }
            else
            {
                toastr.error(response.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});

}

$("#reschedule_request_form").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "{{url('api/RequestRescheduleClient')}}",
        type: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
                // window.location.replace("{{url('/booking')}}");
            }
            else
            {
                toastr.error(response.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});


$('.RejectRequest').click(function(){

    var slot_id_fk = $(this).data("slot_id_fk");

    $.ajax({
        url: "{{url('api/rejectRequest')}}",
        type: "POST",
        data: {'slot_id_fk':slot_id_fk},
        dataType: 'json',

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
            }
            else
            {
                toastr.error(error.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});

</script>