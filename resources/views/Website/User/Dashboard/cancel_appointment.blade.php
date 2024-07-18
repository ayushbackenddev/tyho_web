<div class="boxFormModal">
    <h2 class="text-center mb-3">Appointment Cancellation</h2>
    <p class="pb-2 f14">Please confirm that you would like to cancel the below appointment.</p>
    <form>
        <div class="box-cancelDetail mb-4">
            <div class="row rowDetailOne g-1 mb-0">
                <div class="col-md-8">
                    <h3>{{$cancelAppointment->first_name ." ". $cancelAppointment->middle_name ." ". $cancelAppointment->last_name}} (#{{$cancelAppointment->user_id}})</h3>
                    <ul class="listSession mb-1">
                        <li>{{ $cancelAppointment->service_name }}</li>
                        <li><img src="{{Storage::disk('s3')->url('' . $cancelAppointment->medium_img)}}" alt="" title=""> {{ $cancelAppointment->medium_name }}</li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <div class="textSession">Session ID #{{$cancelAppointment->id}}</div>
                </div>
            </div>
            <p class="mb-0">{{ Helper::getFormatedDateForTherapistDashboard($cancelAppointment->booking_date) }},  {{ $cancelAppointment->start_time }} - {{ $cancelAppointment->end_time }} (SGT)</p>
        </div>
        <p class="text-center mb-4">
            <button type="button" class="btn btn-primary btn-md confirmCancel" data-order_session_id="{{$cancelAppointment->id}}" data-slot_id="{{$cancelAppointment->slot_id}}" data-order_id="{{$cancelAppointment->order_id}}" data-client_id_fk="{{ Session::get('loggedUser') }}">Confirm</button>
        </p>
        <p class="mb-0 f12">Note: The payment made for this session will be refunded to your TYHO wallet as credits.</p>
    </form>
</div>

<script type="text/javascript">
    
$(".confirmCancel").on('click', function(event){

    event.stopPropagation();
    event.stopImmediatePropagation();
    
    var client_id_fk = $(this).data("client_id_fk");
    var order_session_id = $(this).data("order_session_id");
    var slot_id = $(this).data("slot_id");
    var order_id = $(this).data("order_id");

    $.ajax({
        type: "POST",
        url: "{{url('api/orderCancelClient')}}",
        data: {"order_session_id":order_session_id, "slot_id":slot_id, "order_id":order_id, "client_id_fk":client_id_fk},
        dataType: 'json',
        
        success:function(response){
            if(response.status == true)
            {
                var session_count = $("#client_session_count").html();
                $("#client_session_count").html(session_count - 1);
                //$("#order_session_card_"+order_session_id).remove();

                $('#modelCancelAppointment1').modal('toggle');
            }else
            {
                
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});

</script>