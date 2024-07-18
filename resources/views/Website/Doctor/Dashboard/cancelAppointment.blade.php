<div class="boxFormModal">
    <h2 class="text-center mb-4 pb-3">Appointment Cancellation</h2>
    <form>
        <input type="hidden" value="{{$cancelAppointmentTherapist->id}}" id="order_session_id" name="order_session_id">
        <input type="hidden" value="{{$cancelAppointmentTherapist->slot_id}}" id="slot_id" name="slot_id">
        <input type="hidden" name="therapist_id_fk" id="therapist_id_fk" value="{{ Session::get('loggedTherapist') }}">
        <input type="text" name="order_id" id="order_id" value="{{$cancelAppointmentTherapist->order_id}}">
        <input type="hidden" name="client_id_fk" id="client_id_fk" value="{{$cancelAppointmentTherapist->client_id_fk}}">
        <div class="box-cancelDetail">
            <div class="row rowDetailOne g-1 mb-0">
                <div class="col-md-8">
                    <h3>{{$cancelAppointmentTherapist->first_name ." ". $cancelAppointmentTherapist->middle_name ." ". $cancelAppointmentTherapist->last_name}} (#{{$cancelAppointmentTherapist->user_id}})</h3>
                    <ul class="listSession mb-1">
                        <li>{{ $cancelAppointmentTherapist->service_name }}</li>
                        <li><img src="{{Storage::disk('s3')->url('' . $cancelAppointmentTherapist->medium_img)}}" alt="" title=""> {{ $cancelAppointmentTherapist->medium_name }}</li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <div class="textSession">Session ID #{{ $cancelAppointmentTherapist->id }}</div>
                </div>
            </div>
            <p class="mb-0">{{ Helper::getFormatedDateForTherapistDashboard($cancelAppointmentTherapist->booking_date) }},  {{ $cancelAppointmentTherapist->start_time }} - {{ $cancelAppointmentTherapist->end_time }} (SGT)</p>
        </div>
        <div class="form-group">
            <label class="form-label">Reason for Cancellation</label>
            <select id="reason_for_cancellation" name="reason_for_cancellation">
                <option>I have a personal emergency. Please reschedule this session.</option>
                <option>I am unwell. Please reschedule this session.</option>
                <option> This is too close to your last session. Please book a session for a later date.</option>
                <option> I am not taking new clients at the moment. Please book with another suitable Therapist.</option>
                <option>I am no longer able to see you. Please book with another suitable Therapist.</option>
            </select>
        </div>
        <div class="box_cancel_appointment mb-3">
            <p class="mb-0"><a type="button" class="btn btn-primary" id="cancelClose">CANCEL SESSION AND CLOSE SLOT</a> </p>
        </div>
        <div class="box_cancel_appointment">
            <p class="mb-0"><a type="button" class="btn btn-primary" id="cancelKeep">CANCEL SESSION AND KEEP SLOT</a> </p>
        </div>
    </form>
</div>

<script type="text/javascript" language="javascript" src="{{url('assets/js/custom.js')}}?t={{now()->timestamp}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">

var order_session_id = $("#order_session_id").val();
var order_id = $("#order_id").val();
var slot_id = $("#slot_id").val();
var reason_for_cancellation = $("#reason_for_cancellation").val();
var therapist_id_fk = $("#therapist_id_fk").val();
var client_id_fk = $("#client_id_fk").val();

$('#cancelClose').click(function(){
    alert(reason_for_cancellation);
    // $.ajax({
    //     url: "{{url('api/orderCancel')}}",
    //     type: "POST",
    //     data: {"order_session_id":order_session_id, "slot_id":slot_id, "reason_for_cancellation":reason_for_cancellation, "therapist_id_fk":therapist_id_fk,"order_id":order_id,"client_id_fk":client_id_fk},
    //     dataType: 'json',

    //     success:function(response){

    //         if (response.status == true)
    //         {
    //             toastr.success(response.message);
    //             $('#modelCancelAppointment2').modal('toggle');
    //             window.location.href = window.location.href;
    //         }
    //         else
    //         {
    //             toastr.error(error.message);
    //         }
    //     },
    //     error:function(error){
    //         console.log(error);
    //         toastr.error(error.message);
    //     },
    // });
});

$('#cancelKeep').click(function(){
    $.ajax({
        url: "{{url('api/orderCancelKeep')}}",
        type: "POST",
        data: {"order_session_id":order_session_id, "slot_id":slot_id, "order_id":order_id, "client_id_fk":client_id_fk},
        dataType: 'json',

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
                $('#modelCancelAppointment2').modal('toggle');
                window.location.href = window.location.href;
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