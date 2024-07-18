<div class="boxFormModal">
    <h2 class="text-center mb-4 pb-3">Add Bulk Slots</h2>
    <div class="boxBulkSteps">
        <div class="row mb-2">
            <div class="col-6">
                <h4>Step 1</h4>
            </div>
            <div class="col-6 text-end">
                <div class="text-primary texttimezone">Timezone: SGT</div>
            </div>
        </div>
        <p>Please double check your time zone before confirming any slots. Your time zone can be changed from the <a href="#" class="link_underline">Edit Profile</a> page.</p>
        <form id="bulkAddForm" name="FormSubmit" method="POST">
            <div class="row mb-2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Start Time</label>
                            <div class="inputTime">
                                <input type="text" autocomplete="off" class="form-control timepicker-input" placeholder="" id="time_slot" name="time_slot">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">End Time</label>
                            <div class="inputTime">
                                <input type="text" autocomplete="off" class="form-control timepicker-input" placeholder="" id="end_time_slot" name="end_time_slot">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-field">
                            <label class="form-label">Gap Between Sessions</label>
                            <select class="form-control styledSelect" name="gap" id="gap">
                                <option selected disabled></option>
                                <option value="5">5 mins</option>
                                <option value="10">10 mins</option>
                                <option value="15">15 mins</option>
                                <option value="20">20 mins</option>
                                <option value="30">30 mins</option>
                                <option value="45">45 mins</option>
                                <option value="60">1 hour</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-4">
                        <button class="btn btn-primary" type="submit" name="submit">Bulk Add</button>
                    </div>
                </div>
            </div>
        </form>
        <h4 class="mb-3">Step 2</h4>
        <form id="addBulkSlot" method="POST" name="FormSubmit">
            <div class="tablesSteps">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Slot</th>
                            <th scope="col">Medium</th>
                            <th scope="col">Location</th>
                        </tr>
                    </thead>
                    <tbody id="showBulkSlot">

                    </tbody>
                </table>
            </div>
            <h4>Step 3</h4>
            <p>Slots can be opened up to three months in advance.</p>
            <div class="row mb-3 rowSteps3">
                <div class="col-md-4">
                    <label class="form-label mb-3">Apply selected slots on specific dates</label>
                    <div class="content_whiteBox boxDatepicker">
                        <div data-toggle="datepicker"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="textOR">
                        <span>OR</span>
                    </div>
                </div>
                <div class="col-md-7">
                    <label class="form-label mb-3">Repeat selected slots on specific days</label>
                    <div class="row rowdays">
                        <div class="col-md-9">
                            <ul class="listDays">
                                <li>
                                    <input type="checkbox" class="btn-check dayss" name="days[]" id="day1"  value="Mon">
                                    <label class="btn" for="day1">Mon</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="btn-check dayss" name="days[]" id="day2" value="Tue">
                                    <label class="btn" for="day2">Tue</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="btn-check dayss" name="days[]" id="day3"  value="Wed">
                                    <label class="btn" for="day3">Wed</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="btn-check dayss" name="days[]" id="day5"  value="Thu">
                                    <label class="btn" for="day5">Thr</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="btn-check dayss" name="days[]" id="day6" value="Fri">
                                    <label class="btn" for="day6">Fri</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="btn-check dayss" name="days[]" id="day7" value="Sat">
                                    <label class="btn" for="day7">Sat</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="btn-check dayss" name="days[]" id="day8" value="Sun">
                                    <label class="btn" for="day8">Sun</label>
                                </li>
                            </ul>
                            <div class="row rowRepeat">
                                <div class="col-6">
                                    <div class="form-field">
                                        <label class="form-label">Repeat for</label>
                                        <select class="form-control styledSelect" name="end_date" id="end_date">
                                            <option selected disabled></option>
                                            <option value="7">1 week</option>
                                            <option value="14">2 weeks</option>
                                            <option value="28">4 weeks</option>
                                            <option value="60">2 months</option>
                                            <option value="90">3 months</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-field">
                                        <label class="form-label">From</label>
                                        <input data-toggle="datepicker2" type="text" class="form-control" name="start_date" id="start_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="f13 text-red">Note: All existing available slots that overlap with the new times above will be overwritten. Any overlapping booked slots will not be affected.</p>
            <button type="submit" class="btn btn-long btn-primary btn-lg">Confirm Slots </button>
            <button type="button" class="btn btn-long btn-secondary btn-lg ms-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </form>
    </div>
</div>

<!-- jquery validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>
<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- timepicker -->
<script type="text/javascript" language="javascript" src="{{url('assets/js/timepicker.js')}}?t={{now()->timestamp}}"></script>
<script type="text/javascript" language="javascript" src="{{url('assets/js/datepicker.js')}}?t={{now()->timestamp}}"></script>

<script type="text/javascript" language="javascript">

$("select").on("select2:close", function (e) {
    $(this).valid();
    $(this).parent().find("label").removeClass("error");
});

$(function()
{
    $("#bulkAddForm").validate({
        rules: {
            time_slot: {
                required: true,
            },
            end_time_slot: {
                required: true,
            }
        },
        messages: {
            time_slot: {
                required: "Please enter start time",
            },
            end_time_slot: {
                required: "Please enter end time",
            },
            gap: {
                required: "Please select gap between slots",
            },
        },submitHandler: function (form) 
        {
            var formData = new FormData(form);

            $.ajax({
                url: "{{url('api/addSlotBulk')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    if (response.status == false) {

                    }else{
                        $("#showBulkSlot").empty();
                        $("#showBulkSlot").append(response.bulkslot);
                    }
                },
                error:function(error){
                    console.log(error);
                    toastr.error(error.message);
                },
            });
        },
    });
});

$("#addBulkSlot").on("submit", function(e){

    e.preventDefault();

    var mediums_row = $("#addBulkSlot").find(".listcheckboxButtons");


    var hasError = false;
    $('.listcheckboxButtons').each(function(i, items_list){
        var checkForEmpty = 0;

        $(items_list).find('li').each(function(j, li){
            // alert(li.text());
            $(li).find('input').each(function(j, input)
            {
                if (input.value == 0)
                {
                    checkForEmpty = checkForEmpty + 1;
                }
            });

        });

        if (checkForEmpty == 5)
        {
            $("#removeSlot_"+(i + 1)).css('background-color', 'rgb(255 0 0 / 20%)');
            hasError = true;
            // toastr.error("Error ");
            // break;
        }else{
            $("#removeSlot_"+(i + 1)).css('background-color', 'rgb(255 255 255)');
        }

    });

    if (hasError == true)
    {
        toastr.error("Please select medium");
        return;
    }
    
    var formData = new FormData();

    var checkbox = $("#addBulkSlot").find("input.medium_bulk_upload[type=checkbox]");

    $.each(checkbox, function(key, val) {
        formData.append(val.name, val.value)
    });


    var dayss = $("#addBulkSlot").find("input.dayss[type=checkbox]");

    $.each(dayss, function(key, val) {

        if(val.checked == true)
        {
            formData.append(val.name, val.value)
        }

    });

    var time = $("#addBulkSlot").find("input[type=hidden]");

    $.each(time, function(key, val) {

        formData.append(val.name, val.value)
    });

    formData.append("start_date", $("#start_date").val())
    formData.append("end_date_peroid", $("#end_date").val())

    $.ajax({
        url: "{{url('api/addBulk')}}",
        type: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success:function(response){

            if(response.status == true){
                toastr.success(response.message);
                $('#modelAppointmentDetails').modal('toggle');
            }
            else{
                toastr.error(response.message);
            }
            //window.location.href = window.location.href;
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});



// var indexId = $(this).data("indexid");

// $('#selectedLocation').prop("disabled", true);

// function forLocation(indexId){

//     $("#medium_id_4"+indexId).click(function(){

//         if ($("#medium_id_4"+indexId).prop('checked') == true) {

//             $('#selectedLocation').prop("disabled", false);

//             $.ajax({
//                 url: "{{url('api/showLocation')}}",
//                 type: "POST",
//                 dataType: 'json',
//                 success: function (response) {

//                     $('#selectedLocation').empty();
//                     $('#selectedLocation').append('<option value="" disabled="">Please Select</option>');

//                     $.each(response.address ,function(index,data)
//                     {
//                         $('#selectedLocation').append('<option value="' + data.id + '" >' + data.address_title + '</option>');
//                     });
//                 }
//             });
//         }
//         else{
//             $('#selectedLocation').prop("disabled", true);
//         }
//     });
// }

$(document).ready(function() {

    $('.styledSelect').select2();
    $('#modelAppointmentDetails').modal('show');
    $('.timepicker-input').timepicker();
});

function getDate(date)
{

}

$('[data-toggle="datepicker"]').datepicker({
    inline: true,
    startDate: '-0m',
    selectMultiple: true,

});
$('[data-toggle="datepicker2"]').datepicker({
    startDate: '-0m',
    // dateFormat: 'd, M yyyy'
});
</script>