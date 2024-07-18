@foreach ($therapistData as $details)
	<div class="col-3" >
		<input type="hidden" name="therapist_id_fk" id="therapist_id_fk" value="{{$details->id}}">
		<div class="box_therapists">
			<div class="imageBox">
				@if ($details->profile_photo != "")
					<a href="{{url('/coache')}}/{{$details->id}}"><img src="{{Storage::disk('s3')->url('' . $details->profile_photo)}}" alt="" title=""/></a>
				@endif
				@if ($details->video != "")
					<div class="videobutton">
						<a href="#" onclick="openVideo('{{Storage::disk('s3')->url('' . $details->video)}}')">
							<img src="{{url('assets/img/icon_play.svg')}}" alt="" title=""/>
						</a>
					</div>
				@endif
			</div>
			<div class="content_therapists">
				<a href="{{url('/coache')}}/{{$details->id}}"><h3>{{$details->first_name." ".$details->middle_name." ".$details->last_name}}</h3></a>
				<h6>{{$details->therapist_occupation}}</h6>
				<ul class="list_individuals">
					{{ Helper::getMultipleServices($details->service_id_fk == null ? "" : $details->service_id_fk) }}
				</ul>
	            <ul class='listIcons listIconsBig'>
	            	@foreach (Helper::getMyMedium() as $showMedium)
	            		@php
                            $disableMedium = Helper::getCheckMyMedium($showMedium->id,$details->id) == true ? "" : "disabled";
                        @endphp
						<li class="{{$disableMedium}}">
							<a data-toggle='tooltip' title='' data-bs-original-title='{{$showMedium->medium}}' aria-label='{{$showMedium->medium}}'>
								<img src="{{Storage::disk('s3')->url('' . $showMedium->medium_img)}}" alt='' title=''>
							</a>
						</li>
					@endforeach
				</ul>
	            <div class="boxShortDescription">
					<p class="mb-2">{!! $details->short_description_1 !!}</p>
				</div>
				<div class="row mb-3 g-3">
					<div class="col-9">
						<div class="d-grid">
							<a href="{{url('/coache')}}/{{$details->id}}" class="btn btn-primary">See Full Profile</a>
						</div>
					</div>
					<div class="col-3">
						<div class="d-grid">
							<button type="button" class="btn btn-outline btn-icon" onclick="openTherapistDetails({{$details->id}})">
								<i class="far fa-calendar-alt"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="text_therapist">
					<h4>{{$details->category_of_therapist == 1 ? 'Empathy Therapist' : 'Care Therapist'}}</h4>
					<p class="mb-0">(starting from {{Helper::getTherapistCurrency($details->id)}} {{Helper::getStartingPrice($details->id)}})</p>
					
				</div>
			</div>
		</div>
	</div>
@endforeach

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-3 mb-3">
        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
    </ul>
</nav>

<script type="text/javascript">

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

function closeIntroVideo() {

	var video = document.getElementById('therapist_video_modal_video');
  	video.pause();
	$('#modal_video').modal('hide');
}

function openVideo(video_url) {

	var video = document.getElementById('therapist_video_modal_video');
   	video.src = video_url;
  	video.play();
    $('#modal_video').modal('show');
}

function openTherapistDetails(id) {

  	$.ajax({
	    type: "POST",
	    url: "{{url('api/clientBooking')}}",
	    dataType: "json",
	    data: {"id":id},

	    success: function (response){

	    	$("#forBooking").html("");
            $("#forBooking").html(response.clientBooking);
            $('#modelClientBooking').modal('show');
	    },
	    error: function (error)
	    {
	    	console.log(error);
	    	alert("Data loading issue");
	    }
	});
}

</script>