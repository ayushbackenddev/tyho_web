<div class="tab-content coach_detail_content" id="coachTabContent">
    <div class="tab-pane fade show active" id="coach_1">
        <div class="row row_coachDetail">
            <div class="col-12 col-md-4">
                <input type="hidden" name="id" id="id" value="{{$showTherapistData->id}}">
                <h4>About {{$showTherapistData->first_name}}</h4>
                <div class="ourFlowContent">
                    <p><i>{{ $showTherapistData->therapist_educational_qualification }}</i><br>{!! $showTherapistData->short_description !!}</p>
                </div>
                <p>
                    <strong>Languages:
                        @php
                            print_r (Helper::getMultipleLanguages_1($showTherapistData->language_id_fk));
                        @endphp
                    </strong>
                </p>
            </div>
            <div class="col-12 col-md-4">
                <h4>What {{$showTherapistData->first_name}} Can Help With:</h4>
                <div class="ourFlowContent">
                    <ul class="listMenu">
                        {!! $showTherapistData->what_therapist_can_help_with !!}
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="boxEmpathyTherapist">
                    <div class="row g-1 align-items-center">
                        <div class="col-md-9">
                            <h4>{{$showTherapistData->category_of_therapist == 1 ? 'Empathy Therapist' : 'Care Therapist'}}</h4>
                            <p class="mb-0">starting from {{Helper::getTherapistCurrency($showTherapistData->id)}} {{Helper::getStartingPrice($showTherapistData->id)}}</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="#" class="textLink">Pricing</a>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                   <a href="{{url('/coache')}}/{{$showTherapistData->id}}" class="btn btn-primary mb-3">SEE full profile</a>
                   <a type="button" onclick="openTherapistDetails({{$showTherapistData->id}})" class="btn btn-primary ms-0">Book a session</a>
                </div>
            </div>
        </div>
        @if(Helper::getAllReviewForTherapistFullDetail($showTherapistData->id) != false)
            <div class="boxTestimonials reviewBox">
                <h4>Reviews:</h4>
                <div id="carouselTestimonials" class="carousel slide" data-bs-ride="carousel">
                    @php
                        print_r (Helper::getAllReviewForTherapistFullDetail($showTherapistData->id));
                    @endphp
                </div>
            </div>
        @endif
    </div>
</div>

<script>

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

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