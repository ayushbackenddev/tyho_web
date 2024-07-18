@php
	$index = 1;
@endphp
@foreach ($arrayOfSlot as $bulkSlot)
<tr id="removeSlot_{{$index}}" class="mediums_row">
	<td>
		<a class="close_button" onclick="removeSelectedSlot({{$index}})">
			<i class="fas fa-times-circle"></i>
		</a>
	</td>
	<input type="hidden" name="time_slot[]" value='{{$bulkSlot["start"]}}'>
	<input type="hidden" name="end_time_slot[]" value='{{$bulkSlot["end"]}}'>
	<td>{{$bulkSlot["start"]}} - {{$bulkSlot["end"]}}</td>
	<td>
		@php
            $mediums = Helper::getMyMedium();
        @endphp
		<ul class="listcheckboxButtons">
			@foreach ($mediums as $showMedium)
				@php
					$disableMedium = Helper::getCheckMyMedium($showMedium->id,$therapist_id_fk) == true ? "" : "disabled";
				@endphp
				<li>
					<input type="checkbox" class="medium_bulk_upload btn-check forLocation" id="medium_id_{{$showMedium->id}}_{{$index}}" name="{{preg_replace('/[\s-]/', '', strtolower($showMedium->medium))}}[]"
					value="0" data-indexid="{{$index}}" data-medium="{{$showMedium->id}}" {{$disableMedium}}>
					<label class="btn" for="medium_id_{{$showMedium->id}}_{{$index}}">{{$showMedium->medium}}</label>
				</li>
			@endforeach
		</ul>
	</td>
	<td>
		<select class="form-control styledSelect selectNormal" id="selectedLocation_4_{{$index}}">

		</select>
	</td>
	@php
		$index = $index + 1;
	@endphp
</tr>
@endforeach

<script>

$(".medium_bulk_upload").on('change',function(){
    if($(this).is(':checked'))
        $(this).val(1);
    else{
         $(this).val(0);
    }
});

function removeSelectedSlot(index) {

    $("#removeSlot_"+index).remove();
}

// $('#selectedLocation').prop("disabled", true);

$(".forLocation").click(function(){

	if ($(this).data("medium") != 4)
	{
		return;
	}

	var index = $(this).data("indexid");

	var id = "#selectedLocation_"+$(this).data("medium")+"_"+index;

    if ($("#medium_id_4_"+index).prop('checked') == true) {

        $(id).prop("disabled", false);

        $.ajax({
            url: "{{url('api/showLocation')}}",
            type: "POST",
            dataType: 'json',
            success: function (response) {

                $(id).empty();
                $(id).append('<option value="" disabled="">Please Select</option>');

                $.each(response.address ,function(index,data)
                {
                    $(id).append('<option value="' + data.id + '" >' + data.address_title + '</option>');
                });
            }
        });
    }
    else{
		$(id).empty();
        $(id).prop("disabled", true);
    }
});

</script>