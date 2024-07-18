@foreach ($rightSide as $details)
<li id="closeSelectedSlotBox{{$details->slot_id_fk}}">
	<input type="hidden" value="{{$details->slot_id_fk}}">
	<a type="button" data-slot_id_fk="{{$details->slot_id_fk}}" class="btnCloseSlots removeSlotFromCart">
		<i class="fas fa-times-circle"></i>
	</a>
	<span class="slots_dates">{{ Helper::getFormatedDateTimeForSelectedSlots($details->booking_date) }},
	</span>{{$details->time_slot}} - {{$details->end_time_slot}}
	@if($details->address_title != null)
	<span class="slots_address">Address: {{$details->address_title}}
		<a data-toggle="tooltip" href="#" title="Title Text" >
			<i class="fas fa-info-circle"></i>
		</a>
	</span>
	@endif
</li>
@endforeach