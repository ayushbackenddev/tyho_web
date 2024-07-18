@foreach ($client_session as $clientSessions)

<div class="col-md-6" id="order_session_card_{{$clientSessions->id}}">
    <input type="hidden" name="client_id_fk" id="client_id_fk" value="{{ Session::get('loggedUser') }}">
    <div class="content_session session_content_{{$clientSessions->id}}">
        <div class="top_session_part">
            <div class="row rowDetailOne g-1">
                <div class="col-md-8">
                    <h3>{{ $clientSessions->first_name." ".$clientSessions->middle_name." ".$clientSessions->last_name }}</h3>
                    <ul class="listSession">
                        <li>{{ $clientSessions->service_name }}</li>
                        <li><img src="{{Storage::disk('s3')->url('' . $clientSessions->medium_img)}}" alt="" title=""> {{ $clientSessions->medium_name }}</li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <div class="textSession">Session ID #{{$clientSessions->id}}</div>
                </div>
            </div>
            <div class="rowDetailTwo">
                <div class="sessionDate">
                    <p>{{ Helper::getFormatedDateForTherapistDashboard($clientSessions->booking_date) }},  {{ $clientSessions->start_time }} - {{ $clientSessions->end_time }} (SGT)</p>

                    @if( $clientSessions->medium_id == 4 )
                        <p class="textAddress">
                            {{ $clientSessions->address }}, {{ $clientSessions->address_line1 }}, {{ $clientSessions->address_line2 }}, {{ $clientSessions->landmark }}, {{ $clientSessions->City }}, {{ $clientSessions->postal_code }}
                        </p>
                    @endif

                    @if( $clientSessions->medium_id == 5 )
                        <p class="textAddress">
                            {{ $clientSessions->homevisit_address }}, {{ $clientSessions->zip_code }}, {{ $clientSessions->phone_no }}, {{ $clientSessions->country }}, {{ $clientSessions->city }}, {{ $clientSessions->state }}
                        </p>
                    @endif

                    @if($clientSessions->no_show_by_therapist == 1)
                        <div class="textCondition text-red">No Show by Therapist<i class="fas fa-info-circle"></i></a></div>
                    @elseif($clientSessions->no_show_by_client == 1)
                        <div class="textCondition text-red">No Show by Client <i class="fas fa-info-circle"></i></a></div>
                    @elseif( $clientSessions->cancel_by_both == 1 )
                        <div class="textCondition forTherapist"><span class="text-red">Cancelled by Therapist</span></div>
                        <div class="textCancelled">
                            <p>Unfortunately, your Therapist has had to cancel this session.</p>
                            <p>Reason for cancellation: [insert]</p>
                            <p>We have refunded the fees for the session to your wallet. Please book another session using your wallet credits.</p>
                        </div>
                    @elseif( $clientSessions->cancel_by_both == 2 )
                        <div class="textCondition forClient"><span class="text-red">Cancelled by Client</span></div>
                        <div class="textCancelled">
                           <p>This session has been cancelled.</p> 
                           <p>We have refunded the fees for the session to your wallet. Please book another session using your wallet credits.</p>
                        </div>
                    @elseif($clientSessions->request_reschedule_status == 1)
                        <div class="textCondition">
                            <span class="text-green">Reschedule Request Accepted</span>
                        </div>
                        <div class="textCancelled">
                            <p>Your Therapist has accepted your reschedule request, and as such this session has been cancelled. </p>
                            <p>Please see your email for a discount code of equivalent value to book a new session.</p>
                        </div>
                    @endif
                </div>
                <div class="boxCalendar" id="Calendar">
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
                <div class="col-md-2">
                
                </div>
                <div class="col-md-10 text-end">
                    @if( $clientSessions->request_reschedule_status == 0 )
                        <p>RESCHEDULE REQUEST SENT</p> 
                    @elseif( $clientSessions->request_reschedule_status == 2 )
                        <p>RESCHEDULE REQUEST DECLINED</p>
                    @elseif( $clientSessions->request_reschedule_status == 3 )
                        <a type="button" class="textLink req_reschudule" data-slot_id_fk="{{$clientSessions->slot_id_fk}}" >Request Reschedule</a>
                    @endif
                    <a type="button" class="textLink reschedule_order_dashboard" data-order_session_id="{{$clientSessions->id}}" data-slot_id="{{$clientSessions->slot_id}}" data-therapist_id="{{$clientSessions->therapist_id}}" data-order_id="{{$clientSessions->order_id}}" style="margin-left: 6px;">Reschedule</a>
                    @if( $clientSessions->cancel_by_both == 0 )
                        <a type="button" class="textLink ms-2 cancel_order" data-slot_id_fk="{{$clientSessions->slot_id_fk}}">cancel</a>
                    @endif
                </div>
                <!-- <div class="col-md-7 text-end">
                    <a href="#" class="textLink">Request Reschedule <i data-toggle="tooltip" title="Your Session Is Less Than 24 Hours Away, and Cannot Be Rescheduled via the Platform. If You Are Unable to Attend the Session Due to an Emergency, You May Request Your Therapist to Allow You to Reschedule. Please Note, However, That the Therapist May Not Be Able to Accommodate to Your Request. They May Also Not Respond to the Request Till Your Original Appointment Time." class="fas fa-info-circle"></i></a>
                </div> -->
            </div>
            <p class="mb-0">
                <a href="javascript:;" id="running_late_button_{{$clientSessions->id}}" class="btn-running running_late_button_{{$clientSessions->id}}" onclick="poponen({{$clientSessions->id}})" data-keyid="{{$clientSessions->id}}">Running Late? <i class="fas fa-chevron-circle-down"></i></a>
            </p>
        </div>
        <div class="bottom_session_part">
            <p>Session starts in 15 mins and other info</p>
        </div>

        <form id="delay_session_{{$clientSessions->id}}" name="BookSlotForm" method="POST">
            <input type="hidden" name="slot_id" value="{{$clientSessions->id}}" id="slot_id">
            <input type="hidden" name="id" id="id" data-id_slot="{{$clientSessions->id}}" value="{{$clientSessions->id}}"> 
            <div class="popupDelay" id="running_late">
                <div class="boxInnerPopup">
                    <a href="javascript:;" class="btnCloseSm" id="running_late_close" onclick="running_late({{$clientSessions->id}})"><i class="fas fa-times"></i></a>
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
                    <p class="mb-0"><button type="submit" name="submit" onclick="delaySubmit({{$clientSessions->id}})" class="btn btn-sm btn-primary">Submit</button></p>
                    <!-- <button type="submit" name="submit" id="resecheduleBooking" class="btn btn-primary btn-lg btn-pay">Reschedule Now</button> -->
                </div>
            </div>
        </form>
        
        <form id="reschedule_request_form" name="BookSlotForm" method="POST">
            <input type="hidden" name="slot_id" value="{{$clientSessions->id}}"> 
            <div class="popupDelay" id="reschedule_request">
                <div class="boxInnerPopup">
                    <a href="javascript:;" class="btnCloseSm" id="reschedule_request_close" onclick="request_close({{$clientSessions->id}})"><i class="fas fa-times"></i></a>
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
    <div class="modal fade" id="modelCancelAppointment" tabindex="-1" aria-labelledby="modelCancelAppointment" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                <div class="modal-body" id="requestReschedule">
                    
                </div>
            </div>
        </div>
    </div>
<!-- Modal Code-->

<!-- Modal Code-->
    <div class="modal fade" id="modelCancelAppointment1" tabindex="-1" aria-labelledby="modelCancelAppointment1" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                <div class="modal-body" id="appointmentCancel">

                </div>
            </div>
        </div>
    </div>
<!-- Modal Code-->

@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>

function running_late(id){
    $(".session_content_"+id).removeClass('showPopupRunningLate');
}
function request_close(id){
    $(".session_content_"+id).removeClass('showPopupReschedule');
}
function poponen(id){
   $(".session_content_"+id).addClass('showPopupRunningLate');
}

var client_id_fk = $("#client_id_fk").val();

$(".cancel_order").on('click', function(event){

    var slot_id_fk = $(this).data("slot_id_fk");

    $.ajax({
        type: "POST",
        url: "{{url('api/cancelFormData')}}",
        data: {'client_id_fk':client_id_fk, "slot_id_fk":slot_id_fk},
        dataType: "json",

        success: function (response){

            $("#appointmentCancel").empty();
            $("#appointmentCancel").append(response.cancelAppointment);
            $('#modelCancelAppointment1').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            alert("Data loading issue");
        }
    });
});

$(".req_reschudule").on('click', function(event){

    var slot_id_fk = $(this).data("slot_id_fk");

    $.ajax({
        type: "POST",
        url: "{{url('api/ReqRescheduleData')}}",
        dataType: "json",
        data: {"slot_id_fk":slot_id_fk, "client_id_fk":client_id_fk},

        success: function (response){

            $("#requestReschedule").empty();
            $("#requestReschedule").append(response.ReqRescheduleData);
            $('#modelCancelAppointment').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            alert("Data loading issue");
        }
    });
});

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

//$(document).ready(function() {
   
//     $('#running_late_close').click(function() {
//         $(".content_session").removeClass('showPopupRunningLate');
//     });

//     $('#reschedule_request_close').click(function() {
//         $(".content_session").removeClass('showPopupReschedule');
//     });
// }); 

// $("#running_late_button").on('click', function(event){
//     $(".content_session").addClass('showPopupRunningLate');
// });

$(".reschedule_order_dashboard").on('click', function(event){

    //$(".content_session").addClass('showPopupReschedule');

    var id = $(this).data("therapist_id");
    var order_session_id = $(this).data("order_session_id");
    var slot_id = $(this).data("slot_id");
    var order_id = $(this).data("order_id");

    $.ajax({
        type: "POST",
        url: "{{url('api/rescheduleBooking')}}",
        dataType: "json",
        data: {"id":id, "order_session_id":order_session_id, "slot_id":slot_id, "order_id":order_id},

        success: function (response){

            // $("#forBookingReshedule").html("1");
            $("#forBookingReshedule").html(response.clientBooking);
            $('#modelClientBookingReshedule').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            alert("Data loading issue");
        }
    });
});

// $(".content_session").addClass('showPopupReschedule');
// $(".content_session").addClass('showPopupRunningLate');

</script>