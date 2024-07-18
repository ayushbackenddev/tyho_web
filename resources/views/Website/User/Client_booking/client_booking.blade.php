<!-- Modal Code-->

<form id="bookSlot" name="BookSlotForm" method="POST">
    <input type="hidden" name="therapist_id_pop_up" value="{{$clientBooking->id}}" id="therapist_id_pop_up">
    <input type="hidden" name="client_id_fk" value="{{ Session::get('loggedUser')}}" id="client_id_fk">
    <div class="row row_bookingContent">
        <div class="col-md-3">
            <div class="boxfill pb-1">
                <h3 class="text-center mb-2">Other Therapists</h3>
                <div class="mainSliderBox">
                    <div class="carouselOthertherapists" id="getAllOtherTherapist">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="boxfill">
                <div class="content_whiteBox mb-3">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="content_purpleBox mb-2">
                                <h5 class="mb-2">Service</h5>
                                @php
                                    if (isset($cartTherapistData))
                                    {
                                        $selectedService = $cartTherapistData->service_id_fk;
                                    }else
                                    {
                                        $selectedService = "";
                                    }

                                    $services = "";

                                    if($clientBooking->service_id_fk != null)
                                    {
                                        $services = Helper::getServicesForTherapistBooking($clientBooking->service_id_fk, $clientBooking->id);                                        
                                    }
                                @endphp
                                <ul class='listTherapistsServices service_therapist'>
                                    @if($services != null || $services != "")
                                        @foreach ($services as $showServices)
                                            <li>
                                                <a onClick='getSlotByService({{$showServices->id}},this)' data-toggle='tooltip' data-bs-original-title='{{$showServices->service}}' class='btn btn-secondary btn-sm {{$selectedService == $showServices->id ? "active" : ""}}' id='medium_{{$showServices->id}}' data-serviceamount='{{$showServices->therapist_fees}}'>
                                                    {{$showServices->service}}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="content_purpleBox mb-2">
                                <h5 class="mb-2">Medium</h5>
                                @php
                                    if (isset($cartTherapistData))
                                    {
                                        $selectedMedium = $cartTherapistData->medium_id_fk;
                                    }else
                                    {
                                        $selectedMedium = "";
                                    }

                                    $mediums = "";

                                    if($clientBooking->medium_id_fk != null)
                                    {
                                        $mediums = Helper::getMediumsForTherapistBooking($clientBooking->medium_id_fk);                                        
                                    }
                                @endphp

                                <ul class='listTherapistsServices medium_therapist'>
                                    @if($mediums != null || $mediums != "")
                                        @foreach ($mediums as $showMedium)
                                            <li>
                                                <a onClick='getSlotByMedium({{$showMedium->id}},this)' data-toggle='tooltip' data-bs-original-title='{{$showMedium->medium}}' class='btn btn-secondary btn-sm {{$selectedMedium == $showMedium->id ? "active" : ""}}' id='medium_{{$showMedium->id}}' data-mediumamount='{{$showMedium->medium_price}}'>
                                                    {{$showMedium->medium}}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <p class="f12 m-0">Note: You will lose your selected slots below if you change the service or medium.</p>
                        </div>
                        <div class="col-md-3 box_therapists_right p-0">
                            <div class="box_therapists">
                                <div class="imageBox">
                                    @if ($clientBooking->profile_photo != "")
                                        <img src="{{Storage::disk('s3')->url('' . $clientBooking->profile_photo)}}" alt="" title="">
                                    @endif
                                </div>
                                <div class="content_therapists">
                                    <h3>{{$clientBooking->first_name." ".$clientBooking->middle_name." ".$clientBooking->last_name}}</h3>
                                    <h6>{{$clientBooking->therapist_educational_qualification}}</h6>
                                    <div class="text_therapist">
                                        <h4>{{$clientBooking->category_of_therapist == 1 ? 'Empathy Therapist' : 'Care Therapist'}}</h4>
                                        <p class="mb-0">(starting from {{Helper::getTherapistCurrency($clientBooking->id)}} {{Helper::getStartingPrice($clientBooking->id)}})</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="content_whiteBox">
                            <div data-toggle="datepicker"></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="content_whiteBox">
                            <div class="textSlots">
                                <p>Slots available for <span class="text-primary" id="selectedDate"></span> </p>
                                <ul class="listactionsButtons">
                                    <li class="dropdownTimeZone">
                                       <span class="textTimeZone"> Time Zone: <i data-toggle="tooltip" title="Please change your default time zone from client preferences" class="fas fa-info-circle"></i></span>
                                        <select class="form-control styledSelect">
                                            <option>SGT</option>
                                            <option>IST</option>
                                            <option>Aus</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                            <div class="listSlotsavailable" id="showAddedSlot">

                            </div>
                            <div class="content_purpleBox">
                                <div class="boxSelectedSlots">
                                    <h3>Selected Slots</h3>
                                    <p class="text-end m-0">You can book single or multiple appointments</p>
                                </div>
                                <div class="listSelectedSlots mb-0">
                                    <ul class="listSlots" id="showSelectedSlot">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row_wallet">
                    <div class="boxWallet">
                        <h3>Wallet <i data-toggle="tooltip" title="" class="fas fa-info-circle" data-bs-original-title="Text Tooltip"></i></h3>
                        <p>Current Balance S$ 240</p>
                    </div>
                    <div class="boxTotal">
                        <h2>Total<span id="totalAmount" class="text-primary"></span></h2>
                        <button type="submit" name="submit" id="payAndConfirm" class="btn btn-primary btn-lg btn-pay">Pay & Confirm</button>
                    </div>
                </div>
                <p class="text-center f12 mb-1">Please note our 24 hour rescheduling policy <span class="text-primary"><i data-toggle="tooltip" title="" class="fas fa-info-circle" data-bs-original-title="Text Tooltip"></i></span> </p>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" language="javascript" src="{{url('assets/js/datepicker.js')}}?t={{now()->timestamp}}"></script>

<script>

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

var therapist_id_fk = $("#therapist_id_pop_up").val();

$.ajax({
    type: "POST",
    url: "{{url('api/otherTherapist')}}",
    dataType: "json",
    data: {"therapist_id_fk":therapist_id_fk},

    success: function (response){

        if(response.otherTherapist.length > 0)
        {
            $("#getAllOtherTherapist").html("");
        }

        $("#getAllOtherTherapist").append(response.otherTherapist);

    },
    error: function (error)
    {
        toastr.error(error.message);
    }
});

var date = "";
var medium = "";
var service = "";

function getDate(viewDate){

    var getCurrentDate = new Date(viewDate);

    var selectedDate = $.datepicker.formatDate('D, dd M yy', getCurrentDate);
    $("#selectedDate").html(selectedDate);

    date = viewDate;
    setDateFilterAsPerSelection();
    setDateFilterAsPerSelectionOfInperson();
}

var mediumPrice = "";

function getSlotByMedium(selected_medium,thiss){

    mediumPrice = $(thiss).data("mediumamount");

    $("#showSelectedSlot").html("");

    $(".medium_therapist li a").removeClass("active");
    $(thiss).addClass("active");

    medium = selected_medium;

    setDateFilterAsPerSelection();
    setDateFilterAsPerSelectionOfInperson();
}

var servicePrice = "";

function getSlotByService(selected_service,thiss){

    servicePrice = $(thiss).data("serviceamount");

    $("#showSelectedSlot").html("");

    $(".service_therapist li a").removeClass("active");
    $(thiss).addClass("active");

    service = selected_service;
    setDateFilterAsPerSelection();
    setDateFilterAsPerSelectionOfInperson();
}

var totalAmount = "";
var countSlot = "";

function calculateAmount(servicePrice,mediumPrice,countSlot)
{
    countSlot = $('ul#showSelectedSlot li').length;
    totalAmount = (servicePrice + mediumPrice) * countSlot;
    $("#totalAmount").html("&nbsp"+totalAmount);
}

function setDateFilterAsPerSelection()
{
    if (therapist_id_fk && service && medium && date != "") {

        $.ajax({
            url: "{{url('api/showSlots')}}",
            type: "POST",
            dataType: 'json',
            data: {"viewDate":date, "therapist_id_fk":therapist_id_fk, "medium":medium, "service":service},

            success:function(response){

                if (response.status == true) {
                    if(response.slotsAdded.length > 0)
                    {
                        $("#showAddedSlot").html("");
                    }

                    var timeSlots = '<ul class="listSlotTime">';

                    var index = 0;

                    for (var i = 0; i < response.slotsAdded.length; i++)
                    {
                        var StartTime = response.slotsAdded[i].time_slot;
                        var EndTime = response.slotsAdded[i].end_time_slot;
                        var SlotId = response.slotsAdded[i].id;

                        if (index == 4)
                        {
                            timeSlots = timeSlots.concat('</ul>');
                            timeSlots = timeSlots.concat('<ul class="listSlotTime">');
                        }

                        timeSlots = timeSlots.concat('<li><a data-id="'+String(SlotId)+'"  data-startTime="'+String(StartTime)+'" data-endTime="'+String(EndTime)+'" class="onslotSelected" id="slot_id_'+SlotId+'">'+StartTime+' - '+EndTime+'</a></li>');
                        index  = index + 1;
                    }

                    timeSlots = timeSlots.concat('</ul>');
                    $("#showAddedSlot").append(timeSlots);
                }
                else
                {
                    $("#showAddedSlot").html("");
                }
            },
            error:function(error){
                console.log(error);
            },
        });
    }
    else{

    }
}

function removeSelectedSlot(id) {
    $("#closeSelectedSlotBox"+id).remove();

    // $("#payAndConfirm").prop('disabled', true);

    $("#slot_id_"+id).prop('disabled', false);
}

$(document).ready(function () {

    $('.styledSelect').select2();

    var ClientId = $("#client_id_fk").val();

    if (ClientId != "") {
        $.ajax({
            url: "{{url('api/editSlot')}}",
            type: "POST",
            dataType: 'json',
            contentType: false,
            processData: false,

            success:function(response){

                if (response.status == false) {

                    $("#showSelectedSlot").html("");
                }else{

                    if(response.clientBooking.length > 0)
                    {
                        $("#showSelectedSlot").html("");
                    }

                    for (var i = 0; i < response.showSelectedSlots.length; i++)
                    {
                        var id = response.showSelectedSlots[i].id;
                        var date1 = response.showSelectedSlots[i].booking_date_original;
                        service = response.showSelectedSlots[i].service_id_fk;
                        medium = response.showSelectedSlots[i].medium_id_fk;
                        var formattedDate = new Date(date1);
                        var dt_to = $.datepicker.formatDate('D, dd M yy', formattedDate);
                        var startTime = response.showSelectedSlots[i].time_slot;
                        var endTime = response.showSelectedSlots[i].end_time_slot;

                        $("#showSelectedSlot").append('<li id="closeSelectedSlotBox'+id+'"><input type="hidden" name="slot_id_fk[]" value='+id+'><input type="hidden" name="booking_date[]" value='+date1+'><input type="hidden" name="service_id_fk" value='+service+'><input type="hidden" name="medium_id_fk" value='+medium+'><div class="contentSelectedSlots"><span class="textDateSlots">'+dt_to+',</span><span class="textTimeSlots">'+startTime+' - '+endTime+'</span><a type="button" class="btnClose" onclick="removeSelectedSlot('+id+')"><i class="fas fa-times"></i></a></div></li>');

                        $("#slot_id_"+id).prop('disabled', true);
                    }
                }
            },
            error:function(error){
                console.log(error);
                toastr.error(error.message);
            },
        });
    }
    else{

    }

    $('#modelClientBooking').modal('show');
    $('.carouselOthertherapists').slick({
        slidesToScroll: 1,
        slidesToShow: 3,
        arrows: true,
        dots: false,
        centerPadding: '15px',
        vertical: true,
        verticalSwiping: true
    });
    $('#modelClientBooking').on('shown.bs.modal', function (e) {
        $('.carouselOthertherapists').slick('unslick');
        $('.carouselOthertherapists').slick({ slidesToScroll: 1, slidesToShow: 3, arrows: true, dots: false, centerPadding: '15px', vertical: true, verticalSwiping: true });
    })
    $('[data-toggle="datepicker"]').datepicker({
        inline: true,
        startDate: '-0m'
    });
});

$("#payAndConfirm").prop('disabled', true);

$(document).off().on('click', '.onslotSelected', function () {

    $("#payAndConfirm").prop('disabled', false);

    var id = $(this).data("id");
    var startTime = $(this).data("starttime");
    var endTime = $(this).data("endtime");

    var formattedDate = new Date(date);
    var dt_to = $.datepicker.formatDate('D, dd M yy', formattedDate);

    $("#showSelectedSlot").append('<li id="closeSelectedSlotBox'+id+'"><input type="hidden" name="slot_id_fk[]" value='+id+'><input type="hidden" name="booking_date[]" value='+date+'><input type="hidden" name="service_id_fk" value='+service+'><input type="hidden" name="medium_id_fk" value='+medium+'><div class="contentSelectedSlots"><span class="textDateSlots">'+dt_to+',</span><span class="textTimeSlots">'+startTime+' - '+endTime+'</span><a type="button" class="btnClose" onclick="removeSelectedSlot('+id+')"><i class="fas fa-times"></i></a></div></li>');

    $("#slot_id_"+id).prop('disabled', true);

    calculateAmount(servicePrice, mediumPrice, countSlot);
});

$("#bookSlot").on("submit", function(e){

    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "{{url('api/slotBook')}}",
        type: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
                window.location.replace("{{url('/booking')}}");
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

function openOtherTherapistDetails(id) {

    $.ajax({
        type: "POST",
        url: "{{url('api/clientBooking')}}",
        dataType: "json",
        data: {"id":id},

        success: function (response){

            $("#forBooking").html("");
            $("#forBooking").html(response.clientBooking);
            //$('#modelClientBooking').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            alert("Data loading issue");
        }
    });
}

//var inPerson = $("#medium_4");

function setDateFilterAsPerSelectionOfInperson()
{
    if (therapist_id_fk && service && medium && date != "") {

        $.ajax({
            url: "{{url('api/inpersonSlots')}}",
            type: "POST",
            dataType: 'json',
            data: {"viewDate":date, "therapist_id_fk":therapist_id_fk, "medium":medium, "service":service},

            success:function(response){

                if (response.status == true) {
                    if(response.inpersonSlotsAdded.length > 0)
                    {
                        $("#showAddedSlot").html("");
                    }


                    var index = 0;

                    var allArray = [];


                    for (var i = 0; i < response.inpersonSlotsAdded.length; i++)
                    {
                        var element = response.inpersonSlotsAdded[i];

                        var dic = {};
                        dic.location_id = "";
                        dic.location_name = "";
                        
                        dic.object = [element];


                    }

                    
                    
                    var  timeSlots = "";

                    for (var i = 0; i < response.inpersonSlotsAdded.length; i++)
                    {

                        var Address = response.inpersonSlotsAdded[i].address_title;
                        var StartTime = response.inpersonSlotsAdded[i].time_slot;
                        var EndTime = response.inpersonSlotsAdded[i].end_time_slot;
                        var SlotId = response.inpersonSlotsAdded[i].id;
                        var address_id = response.inpersonSlotsAdded[i].address_id;
                        

                        console.log(address_id);
                        if ($("#location_view_holder_"+address_id).length > 0)
                        {
                            console.log("if condition");
                            console.log($("#location_view_holder_"+address_id).filter(".listSlotsavailable"));

                            $("#listSlotTime_"+address_id).append('<li><a data-id="'+String(SlotId)+'"  data-startTime="'+String(StartTime)+'" data-endTime="'+String(EndTime)+'" class="onslotSelected" id="slot_id_'+SlotId+'">'+StartTime+' - '+EndTime+'</a></li>');
                        }else
                        {
                            console.log("else condition");
                            timeSlots = timeSlots.concat('<div id="location_view_holder_'+address_id+'"><p class="f12 fw-medium mb-1">Location: '+Address+'</p> <div class="listSlotsavailable">');
                            timeSlots = timeSlots.concat('<ul class="listSlotTime" id="listSlotTime_'+address_id+'">');

                            console.log($(".listSlotTime").length);

                            if (index == 4)
                            {
                                timeSlots = timeSlots.concat('</ul>');
                                timeSlots = timeSlots.concat('<ul class="listSlotTime" id="listSlotTime_'+address_id+'">');
                            }

                            timeSlots = timeSlots.concat('<li><a data-id="'+String(SlotId)+'"  data-startTime="'+String(StartTime)+'" data-endTime="'+String(EndTime)+'" class="onslotSelected" id="slot_id_'+SlotId+'">'+StartTime+' - '+EndTime+'</a></li>');
                            timeSlots = timeSlots.concat('</ul>');
                            timeSlots.concat('</div></div>');

                            $("#showAddedSlot").append(timeSlots);
                            timeSlots = "";
                            
                        }

                        

                        

                        index  = index + 1;
                    }

                    
                    
                }
                else
                {
                    $("#showAddedSlot").html("");
                }
            },
            error:function(error){
                console.log(error);
            },
        });
    }
    else{

    }
}

</script>