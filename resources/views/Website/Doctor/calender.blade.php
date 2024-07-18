@include('Website/Assets/headerForTherapist')

<!-- Calendar -->
<article>
  <div class="container">
    <p>Add bulk slots, edit your slots and create booking links for your clients from here. <br>
      Please ensure your opened slots are always up to date. Email us at <a class="link_underline" href="mailto:contact@talkyourheartout.com" title="contact@talkyourheartout.com">contact@talkyourheartout.com</a> if you have any queries.</p>
    <div class="button-cal">
      <button type="button" class="btn btn-secondary">Create booking link</button>
      <button type="button" class="btn btn-primary" id="bulkAddSlot" onclick="bulkSlots()">Add bulk slots</button>
    </div>

    <div class="mainCalendar">
      <div id="showSlots">

      </div>
      <div id="calendar"></div>
        <ul class="listSlotsDots">
            <li><span class="dots dotsAvailable"></span> Available Slots </li>
            <li><span class="dots dotsBooked"></span> Booked Slots </li>
        </ul>
    </div>
  </div>
</article>

<!-- Bulk Slot Add Modal Code-->
<div class="modal fade" id="modelAppointmentDetails" tabindex="-1" aria-labelledby="modelAppointmentDetails" >
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
            <div class="modal-body" id="addBulkSlotModal">

            </div>
        </div>
    </div>
</div>

@include('Website/Assets/footer')

<script>

// $("#bulkAddSlot").click(function(){


// });

$("#showSlots").hide();

function bulkSlots()
{
   $.ajax({
    type: "POST",
    url: "{{url('api/bulkAdd')}}",
    dataType: "json",

    success: function (data){
      $("#addBulkSlotModal").empty();
      $("#addBulkSlotModal").append(data.bulkSlot);
      $('#modelAppointmentDetails').modal('show');
    },
    error: function (error) {
      console.log(error);
      alert("Data loading issue");
    }
  });
}


var selectedTag ;
function showSelectedSlots(date,thiss)
{
  if (thiss !== undefined)
  {
    selectedTag = thiss;
  }
  
  $.ajax({
    type: "POST",
    url: "{{url('api/showCalenderSlot')}}",
    dataType: "json",
    data: {"date":date},

    success: function (data){
      $("#showSlots").show();
      $("#showSlots").empty();
      $("#showSlots").append(data.data);

      var slot_height = $("#showSlots").height();
      console.log(slot_height);

      
      var x = $(selectedTag).position();
      var height = $(selectedTag).height();
      var width = $(selectedTag).width();
      console.log(height);
      console.log(width);

      $(".boxFormModal").css({top: x.top + height + 30, left: x.left + width});
    },
    error: function (error) {
      console.log(error);
      alert("Data loading issue");
    }
  });
}


// $(document).mouseup(function (e) {
//     // rest code here
//     if ($(e.target).closest(".boxFormModal").length === 0) {
//         $("#showSlots").hide();
//     }
// });

</script>