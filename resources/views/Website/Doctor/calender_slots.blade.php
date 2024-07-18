<!-- Calendar -->

<div class="boxFormModal popupModal">
    <div class="row rowSlotsDate g-2 align-items-center">
        <div class="col-md-9">
            <input type="hidden" value="{{$therapist_id_fk}}" id="therapist_id_fk" name="therapist_id_fk">
            <input type="hidden" value="{{isset($date)?$date:''}}" id="date" name="date">
            <input type="hidden" name="date" value="{{$date}}">
            <h5>{{Helper::getFormatedDateTimeForTimeSlots($date)}}</h5>
            <ul class="listSlotsDots">
                <li><span class="dots dotsAvailable" id="availableSlotCount"></span> </li>
                <li><span class="dots dotsBooked" id="bookedSlotCount"></span> </li>
            </ul>
        </div>
        <div class="col-md-3 text-end">
            <a type="button" onclick="dateSelected()" class="textLink">Edit Slots</a>
        </div>
    </div>
    <ul class="listSlotsDetail" id="showSlotsAddedOnDate">

    </ul>
</div>

<!-- Modal Code-->
<div class="modal fade" id="modelAppointmentDetails" tabindex="-1" aria-labelledby="modelAppointmentDetails" >
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
      <div class="modal-body" id="calenderPopup">

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    function dateSelected()
    {
        $.ajax({
            type: "POST",
            url: "{{url('api/addCalenderSlot')}}",
            dataType: "json",
            data : {"date":date},

            success: function (response){
                $("#calenderPopup").empty();
                $("#calenderPopup").append(response.data);
                $('#modelAppointmentDetails').modal('show');
            },
            error: function (error) {
                console.log(error);
                alert("Data loading issue");
            }
        });
    }

    var therapist_id_fk = $("#therapist_id_fk").val();
    var date = $("#date").val();

    $.ajax({
        url: "{{url('api/showDataByDate')}}",
        type: "POST",
        dataType: 'json',
        data: {"therapist_id_fk":therapist_id_fk, "date":date},

        success:function(response){

            if (response.status == true) {
                if(response.getAllDataByDate.length > 0)
                {
                    $("#showSlotsAddedOnDate").html("");
                }

                for (var i = 0; i < response.getAllDataByDate.length; i++)
                {
                    //$("#avalability_id_fk").val(response.getAllDataByDate[i].avalability_id_fk);
                    var Time = response.getAllDataByDate[i].time_slot;
                    var Audio = response.getAllDataByDate[i].audio;
                    var Video = response.getAllDataByDate[i].video;
                    var TextBased = response.getAllDataByDate[i].textbasedchat;
                    var Person = response.getAllDataByDate[i].inperson;
                    var Home = response.getAllDataByDate[i].homevisit;
                    //var id = response.getAllDataByDate[i].id;
                    var EndTime = response.getAllDataByDate[i].end_time_slot;
                    var alreadyBooked = response.getAllDataByDate[i].alreadyBooked == true ? "slotsBooked" : "slotsAvailable";

                    $("#showSlotsAddedOnDate").append('<li><div class="boxDetailSlots slotsAvailable '+alreadyBooked+'"><div class="dateSlotsDetails"><input type="hidden" name="time_slot[]" value="'+Time+'">'+Time+' - '+EndTime+'</div><div class="slotsActions"><ul class="listIconsslots"><li><a class="medium_'+Video+'" data-toggle="tooltip" title="Video"><input class="iconVideo" type="hidden" name="video[]" value="'+Video+'"><input class="iconVideo" value="'+Video+'" id="video" style="width: 15px;"></a></li><li><a class="medium_'+Audio+'" data-toggle="tooltip" title="Audio"><input class="iconAudio" type="hidden" name="audio[]" value="'+Audio+'"><input class="iconAudio" value="'+Audio+'" id="audio" style="width: 15px;"></a></li><li><a class="medium_'+TextBased+'" data-toggle="tooltip" title="Text-Based Chat"><input class="iconText" type="hidden" name="textbasedchat[]" value="'+TextBased+'"><input class="iconText" value="'+TextBased+'" id="textBased" style="width: 15px;"></a></li><li><a class="medium_'+Person+'" data-toggle="tooltip" title="In-Person"><input class="iconPerson" type="hidden" name="inperson[]" value="'+Person+'"><input class="iconPerson" value="'+Person+'" id="inPerson" style="width: 15px;"></a></li><li><a class="medium_'+Home+'" data-toggle="tooltip" title="Home Visit"><input class="iconHome" type="hidden" name="homevisit[]" value="'+Home+'"><input class="iconHome" value="'+Home+'" id="homeVisit" style="width: 15px;"></a></li></ul></div></div></li>');
                }
                $("#video").attr('readonly','readonly');
                $("#audio").attr('readonly','readonly');
                $("#textBased").attr('readonly','readonly');
                $("#inPerson").attr('readonly','readonly');
                $("#homeVisit").attr('readonly','readonly');
                $("#availableSlotCount").html(response.countAvailableSlot);
                $("#bookedSlotCount").html(response.countBookedSlot);
                //window.location.href = window.location.href;
            }
            else
            {

            }
        },
        error:function(error){
            console.log(error);
        },
    });
</script>