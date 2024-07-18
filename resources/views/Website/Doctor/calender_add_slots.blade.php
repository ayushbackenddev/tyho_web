<div class="boxFormModal">
    <form id="addSlotForm" name="FormSubmit" method="POST">
        <input type="hidden" value="{{$therapist_id_fk}}" id="therapist_id_fk" name="therapist_id_fk">
        <input type="hidden" value="{{isset($date)?$date:''}}" id="date" name="date">
        <input type="hidden" value="{{isset($avalability_id_fk)?$avalability_id_fk:''}}" id="avalability_id_fk" name="avalability_id_fk">
        <h2 class="text-center mb-4 pb-3">Edit Slots</h2>
        <div class="row rowSlotsDateInner">
            <div class="col-6">
                {{Helper::getFormatedDateTimeForTimeSlots($date)}}
            </div>
            <div class="col-6 text-end">
                Timezone: SGT
            </div>
        </div>
        <div class="innerSlotsArea">
            <div class="row innerSlotsType">
                <div class="col-6">
                    <ul class="listSlotsDots">
                        <li><span class="dots dotsAvailable" id="availableSlot"></span> </li>
                        <li><span class="dots dotsBooked" id="bookedSlot"></span> </li>
                    </ul>
                </div>
                <div class="col-6 text-end">
                    <ul class="listSlotsDots">
                        <li><span class="dots dotsAvailable"></span> Available Slots </li>
                        <li><span class="dots dotsBooked"></span> Booked Slots </li>
                    </ul>
                </div>
            </div>
            <ul class="listSlotsDetail" id="showAddedSlots">

            </ul>
            <div id="deletedSlots">

            </div>
        </div>
        <div class="box-whiteAddSlots">
            <h3>Add New Slots</h3>
            <div class="row g-3">
                <div class="col-4">
                    <div class="form-field">
                        <label class="form-label">Slot Time</label>
                        <div class="inputTime">
                            <input type="text" class="form-control timepicker-input" placeholder="" id="slottime" name="slottime" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-field">
                        <label class="form-label">Medium</label>
                        <div class="inline-checkbox f14">
                            @foreach (Helper::getMyMedium() as $showMedium)
                                <div class="form-check">
                                    @php
                                        $disableMedium = Helper::getCheckMyMedium($showMedium->id,$therapist_id_fk) == true ? "" : "disabled";
                                    @endphp
                                    <input type="checkbox" class="form-check-input" id="medium_id_{{$showMedium->id}}" name="{{$showMedium->medium}}" value="{{$showMedium->id}}" {{$disableMedium}}>
                                    <label class="form-check-label" for="{{$showMedium->medium}}">{{$showMedium->medium}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-field">
                        <label class="form-label">Location <a href="#" class="iconTooltip" data-toggle="tooltip" title="Tooltip Text"><i class="fas fa-info-circle"></i></a></label>
                        <select class="form-control styledSelect selectOccupation" id="selectedLocationSingleSlot">

                        </select>
                    </div>
                </div>
            </div>
            <a type="button" class="btn btn-sm btn-long btn-primary" id="addSlot">Add Slot</a>
        </div>
        <button type="submit" class="btn btn-long btn-primary btn-lg" name="addSlotSubmit">Confirm Changes </button>
        <a class="btn btn-long btn-secondary btn-lg ms-3" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
    </form>
</div>
<!-- jquery validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>
<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- timepicker -->
<script type="text/javascript" language="javascript" src="{{url('assets/js/timepicker.js')}}?t={{now()->timestamp}}"></script>

<script>

// $(function()
// {
//     $("#addSlotForm").validate({
//         rules: {
//             slottime: {
//                 required: true,
//                 number: true,
//             },
//         },
//         messages: {
//             slottime: {
//                 required: "Please enter a slot time",
//                 number: "Only digits are allowed",
//             },
//         },

//         submitHandler: function(form){

//         var formData = new FormData(form);
//         formData.append('date', date);

//             $.ajax({
//                 url: "{{url('api/addSlots')}}",
//                 type: "POST",
//                 data: formData,
//                 dataType: 'json',
//                 contentType: false,
//                 processData: false,
//                 success:function(response){

//                     if (response.status == true)
//                     {
//                         toastr.success(response.message);
//                         //window.location.href = window.location.href;
//                     }
//                     else
//                     {
//                         toastr.error(response.message);
//                     }
//                 },
//                 error:function(error){
//                     console.log(error);
//                     toastr.error(error.message);
//                 },
//             });
//         },avalability_id_fk
//     });
// });

$('#selectedLocationSingleSlot').prop("disabled", true);

$("#medium_id_4").click(function(){

    if ($("#medium_id_4").prop('checked') == true) {

        $('#selectedLocationSingleSlot').prop("disabled", false);

        $.ajax({
            url: "{{url('api/showLocation')}}",
            type: "POST",
            dataType: 'json',
            success: function (response) {

                $('#selectedLocationSingleSlot').empty();
                $('#selectedLocationSingleSlot').append('<option value="" disabled="">Please Select</option>');

                $.each(response.address ,function(index,data)
                {
                    $('#selectedLocationSingleSlot').append('<option value="' + data.id + '" >' + data.address_title + '</option>');
                });
            }
        });
    }
    else{
        $('#selectedLocationSingleSlot').empty();
        $('#selectedLocationSingleSlot').prop("disabled", true);
    }
});


$(document).ready(function() {

    $('.styledSelect').select2();
    $('#modelAppointmentDetails').modal('show');
    $('.timepicker-input').timepicker();
});
$('[data-toggle="datepicker"]').datepicker({
    inline: true
});

function removeTimeSlot(indexs,serverSlots,ids) {
  $("#closeSlotBox"+indexs).remove();
  if (serverSlots == 1)
  {
    $("#deletedSlots").append('<input type="hidden" name="deleted_time_slot[]" value="'+ids+'" readonly>');
  }

}

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

var existingTimeslots = [];

var isNewSlotValid = (newSlot) => {
  let isValid = true;

  for(let i = 0; i < existingTimeslots.length; i++) {
    console.log("--------isNewSlotValid-------");

    console.log("newSlot.start  " + newSlot.start);
    console.log("newSlot.end  " + newSlot.end);
    console.log("---------------");
    console.log("existingTimeslots[i].start  " + existingTimeslots[i].start);
    console.log("existingTimeslots[i].end  " + existingTimeslots[i].end);
    console.log("-------isNewSlotValid--------");

    if(((newSlot.start > existingTimeslots[i].start ) && (newSlot.start < existingTimeslots[i].end) )|| ((newSlot.end > existingTimeslots[i].start ) && (newSlot.end <= existingTimeslots[i].end))) {
      isValid = false;

      var ids = $("#"+existingTimeslots[i].start).data("ids");

      if (ids !== undefined)
      {
        $("#deletedSlots").append('<input type="hidden" name="deleted_time_slot[]" value="'+ids+'" readonly>');
      }
      

      $("#"+existingTimeslots[i].start).parent().parent().parent().remove();

      

    //   break;
    }
  }

  return isValid;
}

var checkAudio = "";
var checkVideo = "";
var checkTextBased = "";
var checkHomeVisit = "";
var checkInHome = "";
var buttonCloseIndex = 1;


function calculateTimeSlots()
{
    existingTimeslots = [];

    $(".unixTimestamp_StartTime").get().forEach(function(entry, index, array) {
        var obj = new Object();
        obj.start = BigInt($(entry).val());
        obj.end  = 32;
        existingTimeslots.push(obj);
    });


    $(".unixTimestamp_EndTime").get().forEach(function(entry, index, array) {
        // Here, array.length is the total number of items

        var obj = existingTimeslots[index];
        obj.end  = BigInt($(entry).val());
        existingTimeslots[index] = obj;
    });
}
$(function () {

    $("#addSlot").click(function () {

        calculateTimeSlots();

        var getLocation = $("#selectedLocationSingleSlot").val();

        if ($.trim($("#slottime").val()) == "") {
            toastr.error("Please enter slot time!");
        }
        else{
            if ($("#medium_id_2").is(':checked')) {
                checkAudio = "1";
            }else{
                checkAudio = "0";
            }

            if ($("#medium_id_1").is(':checked')) {
                checkVideo = "1";
            }else{
                checkVideo = "0";
            }

            if ($("#medium_id_3").is(':checked')) {
                checkTextBased = "1";
            }else{
                checkTextBased = "0";
            }

            if ($("#medium_id_5").is(':checked')) {
                checkHomeVisit = "1";
            }else{
                checkHomeVisit = "0";
            }

            if ($("#medium_id_4").is(':checked')) {
                checkInPerson = "1";
            }else{
                checkInPerson = "0";
            }

            if (checkInPerson == "0" && checkHomeVisit == "0" && checkTextBased == "0" && checkVideo == "0" && checkAudio == "0")
            {
                toastr.error("Please select atleast one medium");
                return;
            }

            var slotTime = $("#slottime").val();

            slotTime = moment(slotTime, 'hh:mm A').format('hh:mm A');


            var endTime = moment(slotTime, 'hh:mm A').add(60, 'minutes').format('hh:mm A');

            var unixTimestamp_StartTime = moment(slotTime, 'hh:mm a').unix();
            var unixTimestamp_EndTime = moment(endTime, 'hh:mm a').unix();

            if (isNewSlotValid({start: unixTimestamp_StartTime, end: unixTimestamp_EndTime}) == false)
            {
                // toastr.error("Please select different time slot its conflicting with your previous time slot");
                // return;
            }

            $("#showAddedSlots").append('<li id="closeSlotBox'+buttonCloseIndex+'"><div class="boxDetailSlots slotsAvailable"><div class="dateSlotsDetails"><input type="hidden" class="unixTimestamp_StartTime" id="'+unixTimestamp_StartTime+'" value="'+unixTimestamp_StartTime+'"><input type="hidden" class="unixTimestamp_EndTime" value="'+unixTimestamp_EndTime+'"><input type="hidden" name="time_slot[]" value="'+slotTime+'" readonly>'+slotTime +' - '+ endTime+' </div><div class="slotsActions"><ul class="listIconsslots"><li><a class="medium_'+checkVideo+'" href="#" data-toggle="tooltip" title="Video"><input class="iconVideo" type="hidden" name="video[]" value="'+checkVideo+'" readonly><input class="iconVideo" value="'+checkVideo+'" style="width: 15px;" readonly></a></li><li><a class="medium_'+checkAudio+'" href="#" data-toggle="tooltip" title="Audio"><input class="iconAudio" type="hidden" name="audio[]" value="'+checkAudio+'" readonly><input class="iconAudio" value="'+checkAudio+'" style="width: 15px;" readonly></a></li><li><a class="medium_'+checkTextBased+'" href="#" data-toggle="tooltip" title="Text-Based Chat"><input class="iconText" type="hidden" name="textbasedchat[]" value="'+checkTextBased+'" readonly><input class="iconText" value="'+checkTextBased+'" style="width: 15px;" readonly></a></li><li><a class="medium_'+checkInPerson+'" href="#" data-toggle="tooltip" title="In-Person"><input class="iconPerson" type="hidden" name="inperson[]" value="'+checkInPerson+'" readonly><input class="iconPerson" value="'+checkInPerson+'" style="width: 15px;" readonly></a></li><li><a class="medium_'+checkHomeVisit+'" href="#" data-toggle="tooltip" title="Home Visit"><input class="iconHome" type="hidden" name="homevisit[]" value="'+checkHomeVisit+'" readonly><input class="iconHome" value="'+checkHomeVisit+'" style="width: 15px;" readonly></a><input type="hidden" name="location[]" value="'+getLocation+'"></li></ul></div></div><a type="button" class="close_button" onclick="removeTimeSlot('+buttonCloseIndex+',0,0)"><i class="fas fa-times-circle"></i></a></li>');

            buttonCloseIndex = buttonCloseIndex + 1;

            $('#selectedLocationSingleSlot').prop("disabled", true);
            $('#selectedLocationSingleSlot').empty();
            $("#slottime").val("");
            $("input[type='checkbox']:checked").prop("checked", false)
        }
    });
});

$(document).ready(function () {
    $("#addSlotForm").on("submit", function(e){

        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "{{url('api/addSlots')}}",
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success:function(response){

                if (response.status == true)
                {
                    toastr.success(response.message);
                    $('#modelAppointmentDetails').modal('toggle');
                    showSelectedSlots(date);
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

    var therapist_id_fk = $("#therapist_id_fk").val();
    var date = $("#date").val();

    $.ajax({
        url: "{{url('api/getSlotData')}}",
        type: "POST",
        dataType: 'json',
        data: {"therapist_id_fk":therapist_id_fk, "date":date},

        success:function(response){

            if (response.status == true) {
                if(response.getAllDataByDateAndId.length > 0)
                {
                    $("#showAddedSlots").html("");
                }

                for (var i = 0; i < response.getAllDataByDateAndId.length; i++)
                {
                    $("#avalability_id_fk").val(response.getAllDataByDateAndId[i].avalability_id_fk);
                    var StartTime = response.getAllDataByDateAndId[i].time_slot;
                    var EndTime = response.getAllDataByDateAndId[i].end_time_slot;
                    var Audio = response.getAllDataByDateAndId[i].audio;
                    var Video = response.getAllDataByDateAndId[i].video;
                    var TextBased = response.getAllDataByDateAndId[i].textbasedchat;
                    var Person = response.getAllDataByDateAndId[i].inperson;
                    var Home = response.getAllDataByDateAndId[i].homevisit;
                    var id = response.getAllDataByDateAndId[i].id;
                    var alreadyBooked = response.getAllDataByDateAndId[i].alreadyBooked == true ? "slotsBooked" : "slotsAvailable";


                    var unixTimestamp_StartTime = moment(StartTime, 'hh:mm a').unix();
                    var unixTimestamp_EndTime = moment(EndTime, 'hh:mm a').unix();


                    $("#showAddedSlots").append('<li id="closeSlotBox'+id+'"><div class="boxDetailSlots '+alreadyBooked+'"><div class="dateSlotsDetails"><input type="hidden" class="unixTimestamp_StartTime" data-ids = "'+id+'" id="'+unixTimestamp_StartTime+'" value="'+unixTimestamp_StartTime+'"><input type="hidden" class="unixTimestamp_EndTime" value="'+unixTimestamp_EndTime+'"><input type="hidden" value="'+StartTime+'">'+StartTime+' - '+EndTime+'</div><div class="slotsActions"><ul class="listIconsslots"><li><a class="medium_'+Video+'" href="#" data-toggle="tooltip" title="Video"><input class="iconVideo" type="hidden" value="'+Video+'"><input class="iconVideo" value="'+Video+'" style="width: 15px;"></a></li><li><a class="medium_'+Audio+'" href="#" data-toggle="tooltip" title="Audio"><input class="iconAudio" type="hidden" value="'+Audio+'"><input class="iconAudio" value="'+Audio+'" style="width: 15px;"></a></li><li><a class="medium_'+TextBased+'" href="#" data-toggle="tooltip" title="Text-Based Chat"><input class="iconText" type="hidden" value="'+TextBased+'"><input class="iconText" value="'+TextBased+'" style="width: 15px;"></a></li><li><a class="medium_'+Person+'" href="#" data-toggle="tooltip" title="In-Person"><input class="iconPerson" type="hidden" value="'+Person+'"><input class="iconPerson" value="'+Person+'" style="width: 15px;"></a></li><li><a class="medium_'+Home+'" href="#" data-toggle="tooltip" title="Home Visit"><input class="iconHome" type="hidden" value="'+Home+'"><input class="iconHome" value="'+Home+'" style="width: 15px;"></a></li></ul></div></div><a type="button" class="close_button" onclick="removeTimeSlot('+id+',1,'+id+')"><i class="fas fa-times-circle"></i></a></li>');
                }
                $("#availableSlot").html(response.countAvailableSlot);
                $("#bookedSlot").html(response.countBookedSlot);
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
});
</script>