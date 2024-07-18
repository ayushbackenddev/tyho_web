<div class="boxFormModal">
    <h2 class="text-center mb-3">Reschedule Request</h2>
    <p class="pb-2 f14">Please confirm that you would like to request to reschedule the below appointment.</p>
    <form id="request_reschedule_form" name="BookSlotForm" method="POST">
        <input type="hidden" name="slot_id" value="{{$ReqRescheduleData->id}}">
        <div class="box-cancelDetail mb-4">
            <div class="row rowDetailOne g-1 mb-0">
                <div class="col-md-8">
                    <h3>{{$ReqRescheduleData->first_name ." ". $ReqRescheduleData->middle_name ." ". $ReqRescheduleData->last_name}} (#{{$ReqRescheduleData->user_id}})</h3>
                    <ul class="listSession mb-1">
                        <li>{{ $ReqRescheduleData->service_name }}</li>
                        <li><img src="{{Storage::disk('s3')->url('' . $ReqRescheduleData->medium_img)}}" alt="" title=""> {{ $ReqRescheduleData->medium_name }}</li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <div class="textSession">Session ID #{{$ReqRescheduleData->id}}</div>
                </div>
            </div>
            <p class="mb-0">{{ Helper::getFormatedDateForTherapistDashboard($ReqRescheduleData->booking_date) }},  {{ $ReqRescheduleData->start_time }} - {{ $ReqRescheduleData->end_time }} (SGT)</p>
        </div>
        <div class="form-field">
            <label class="form-label">Reason for request (200 characters)</label>
            <textarea class="form-control textarea-lg" name="reason"></textarea>
        </div>
        <p class="text-center mb-4">
            <button type="submit" name="submit" class="btn btn-primary btn-md">Confirm</button>
        </p>
        <div class="f12">
            <p>Note: Your Therapist may not be able to accomodate your request. They may also not respond to your request till your original appointment time. 
            </p>
            <p>If your Therapist rejects or does not see this request before the scheduled appointment time, the session will go ahead as originally arranged.
            </p>
        </div>
    </form>
</div>

<script type="text/javascript">
    
$("#request_reschedule_form").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "{{url('api/requestReschedule')}}",
        type: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
                $('#modelCancelAppointment').modal('toggle');
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

</script>