@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <div class="container">
        <div class="boxFull">
            <p class="mb-2">Talk Your Heart Out brings together exceptional professionals who are well-placed to assist you, wherever you may be in life.</p>
            <p class="mb-5">If you need further assistance with selecting a Therapist, please feel free to email us at contact@talkyourheartout.com, or WhatsApp us on +65 9831 0005.
            </p>
        </div>
    </div>
    <div class="box_landing_tabs">
        <div class="tab_landing">
            <div class="container">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-issues-tab" data-bs-toggle="pill" data-bs-target="#issues-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><span class="icon_tab"><i class="fas fa-cloud-sun-rain"></i></span> Issues</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-Gender-tab" data-bs-toggle="pill" data-bs-target="#pills-Gender" type="button" role="tab" aria-controls="pills-Gender" aria-selected="false"><span class="icon_tab"><i class="far fa-circle"></i></span> Gender</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-Language-tab" data-bs-toggle="pill" data-bs-target="#pills-Language" type="button" role="tab" aria-controls="pills-Language" aria-selected="false"><span class="icon_tab"><i class="fas fa-language"></i></span> Language</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-Service-tab" data-bs-toggle="pill" data-bs-target="#pills-Service" type="button" role="tab" aria-controls="pills-Service" aria-selected="false"><span class="icon_tab"><i class="fas fa-concierge-bell"></i></span> Service Type </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-Medium-tab" data-bs-toggle="pill" data-bs-target="#pills-Medium" type="button" role="tab" aria-controls="pills-Medium" aria-selected="false"><span class="icon_tab"><i class="fas fa-laptop"></i></span> Medium</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-Country-tab" data-bs-toggle="pill" data-bs-target="#pills-Country" type="button" role="tab" aria-controls="pills-Country" aria-selected="false"><span class="icon_tab"><i class="fas fa-globe-americas"></i></span> Country</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="issues-home" role="tabpanel" aria-labelledby="pills-issues-tab">
        			<div class="row g-3 row_filters" id="Issues">

        			</div>
        		</div>
        		<div class="tab-pane fade" id="pills-Gender" role="tabpanel" aria-labelledby="pills-Gender-tab">
        			<div class="form-field checkbox_box checkbox_gender">
					    <div class="form-check mb-1">
					        <input type="checkbox" class="form-check-input checkByUser onCheckedGender" name="Male" id="gender_1" data-gendername="Male" data-genderid="1">
					        <label class="form-check-label" for="male">Male</label>
					    </div>
					    <div class="form-check mb-1">
					        <input type="checkbox" class="form-check-input checkByUser onCheckedGender" name="Female" id="gender_2" data-gendername="Female" data-genderid="2">
					        <label class="form-check-label" for="female">Female</label>
					    </div>
					    <div class="form-check mb-1">
					        <input type="checkbox" class="form-check-input checkByUser onCheckedGender" name="All" id="gender_3" data-gendername="All" data-genderid="3">
					        <label class="form-check-label" for="all">All</label>
					    </div>
					</div>
        		</div>
        		<div class="tab-pane fade" id="pills-Language" role="tabpanel" aria-labelledby="pills-Language-tab">
        			<div class="form-fiel checkbox_box checkbox_language" id="Languages">

					</div>
        		</div>
        		<div class="tab-pane fade" id="pills-Service" role="tabpanel" aria-labelledby="pills-Service-tab">
        			<div class="form-field checkbox_box checkbox_service" id="Services">

        			</div>
        		</div>
        		<div class="tab-pane fade" id="pills-Medium" role="tabpanel" aria-labelledby="pills-Medium-tab">
        			<div class="form-field checkbox_box checkbox_medium" id="Mediums">

        			</div>
        		</div>
        		<div class="tab-pane fade" id="pills-Country" role="tabpanel" aria-labelledby="pills-Country-tab">
        			<div class="form-field checkbox_box checkbox_country" id="Country">

        			</div>
        		</div>
        	</div>
        </div>
    </div>
    <form id="filterForm" name="formSubmit" method="POST">
        <div class="box_filter">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7" >
                        <ul class="listFilterBtns" id="addCheckBox">

                        </ul>
                    </div>
                    <div class="col-md-5 text-end">
                        <div class="checkbox_therapist">
                            <div class="form-check form-check-white" data-toggle="tooltip" title="" data-bs-original-title="Care Therapist">
                                <input type="checkbox" name="category_of_therapist[]" class="form-check-input onCheckedCategoryOfTherapist" id="care_therapist" value="Care Therapist">
                                <label class="form-check-label" for="care_therapist">Care Therapist</label>
                            </div>
                            <div class="form-check form-check-white" data-toggle="tooltip" title="" data-bs-original-title="Empathy Therapist">
                                <input type="checkbox" name="category_of_therapist[]" class="form-check-input onCheckedCategoryOfTherapist" id="empathy-therapist" value="Empathy Therapist">
                                <label class="form-check-label" for="empathy-therapist">Empathy Therapist</label>
                            </div>
                        </div>
                        <div class="dropdown dropdown-sort d-inline ms-1">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort by
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox"  class="form-check-input" id="issue_financial_stress ">
                                        <label class="form-check-label" for="issue_financial_stress">Earliest available</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox"  class="form-check-input" id="issue_addictions">
                                        <label class="form-check-label" for="issue_addictions">After work hours & weekends</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox"  class="form-check-input" id="issue_habit_change">
                                        <label class="form-check-label" for="issue_habit_change">Near me (in-person sessions)</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox"  class="form-check-input" id="issue_cultural_adjustment">
                                        <label class="form-check-label" for="issue_cultural_adjustment">Psychologists</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox"  class="form-check-input" id="issue_trauma_or_ptsd ">
                                        <label class="form-check-label" for="issue_trauma_or_ptsd">Professional Counsellor</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="section_CoachDetail">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="boxfill">
                        <div class="boxfill noTherapist">
                            <p style="text-align: center;"> No therapist for your filter</p>
                        </div>
                        <ul class="nav" id="coachDataTabContent">
                            <div class="owl-carousel owl-theme carouselCoach" id="fetch">

                            </div>
                        </ul>
                        <div id="fetchTherapistData">

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- <div class="boxLeftMenu">
                        <ul class="menuLeft">
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-gift"></i></span> Buy Gift Cards</a> </li>
                        </ul>
                        <hr/>
                        <h3>Mental Health Screening Tools</h3>
                        <ul class="menuLeft">
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-heartbeat"></i></span> General Health </a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-brain"></i></span> Anxiety</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-bed"></i></span> Insomnia </a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-frown"></i></span> Depression</a> </li>
                        </ul>
                        <hr class="mb-2"/>
                        <ul class="menuLeft">
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-cogs"></i></span> Resources </a> </li>
                        </ul>
                        <hr class="mb-3"/>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
   <!--  <div class="section_Events">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-6 align-items-center">
                    <h2>Events</h2>
                </div>
                <div class="col-md-6 text-end">
                    <ul class="listOptions">
                        <li class="active"><a href="#">Upcoming</a></li>
                        <li><a href="#">Passed</a></li>
                    </ul>
                </div>
            </div>
            <div class="outerSliderBox">
                <div class="owl-carousel owl-carousel-events owl-theme">
                    <div class="item">
                        <div class="boxEvents">
                            <h4>Lorem Ipsum is simply dummy </h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.  industry. Lorem Ipsum has been.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <div class="eventsInner">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="userBox">
                                            <div class="boxUserImg">
                                                <img src="assets/img/coach-1.png" alt="" title=""/>
                                            </div>
                                            <h5>Alicia Prescott</h5>
                                            <p>Life Coach & Counsellor</p>
                                        </div>
                                        <ul class="listTimeTables">
                                            <li>
                                                <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                                12 Dec 2020, 2:00 PM to 4:00 PM (SGT)
                                            </li>
                                            <li>
                                                <span class="icon"><i class="fas fa-globe-americas"></i></span>
                                                Online webinar (Zoom)
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p><a href="#" class="btn btn-primary d-block">Book Now </a></p>
                                        <div class="textEventPrice">
                                            <h3>S$120</h3>
                                            <p>per person</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="boxEvents">
                            <h4>Lorem Ipsum is simply dummy </h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.  industry. Lorem Ipsum has been.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <div class="eventsInner">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="userBox">
                                            <div class="boxUserImg">
                                                <img src="assets/img/coach-1.png" alt="" title=""/>
                                            </div>
                                            <h5>Alicia Prescott</h5>
                                            <p>Life Coach & Counsellor</p>
                                        </div>
                                        <ul class="listTimeTables">
                                            <li>
                                                <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                                12 Dec 2020, 2:00 PM to 4:00 PM (SGT)
                                            </li>
                                            <li>
                                                <span class="icon"><i class="fas fa-globe-americas"></i></span>
                                                Online webinar (Zoom)
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p><a href="#" class="btn btn-primary d-block">Book Now </a></p>
                                        <div class="textEventPrice">
                                            <h3>S$120</h3>
                                            <p>per person</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="boxEvents">
                            <h4>Lorem Ipsum is simply dummy </h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.  industry. Lorem Ipsum has been.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <div class="eventsInner">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="userBox">
                                            <div class="boxUserImg">
                                                <img src="assets/img/coach-1.png" alt="" title=""/>
                                            </div>
                                            <h5>Alicia Prescott</h5>
                                            <p>Life Coach & Counsellor</p>
                                        </div>
                                        <ul class="listTimeTables">
                                            <li>
                                                <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                                12 Dec 2020, 2:00 PM to 4:00 PM (SGT)
                                            </li>
                                            <li>
                                                <span class="icon"><i class="fas fa-globe-americas"></i></span>
                                                Online webinar (Zoom)
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p><a href="#" class="btn btn-primary d-block">Book Now </a></p>
                                        <div class="textEventPrice">
                                            <h3>S$120</h3>
                                            <p>per person</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</article>

<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

function removeSelectedCountries(CountryId) {

    $("#country_id_"+CountryId).prop("checked", false);

    $("#closeSelectedCountries"+CountryId).remove();
    getTherapist(2);
}

$(document).on('click', '.onCheckedCountries', function () {

    var CountryId = $(this).data("countryid");
    var CountryName = $(this).data("countryname");

    if($(this).is(":checked")){

        $("#addCheckBox").append('<li id="closeSelectedCountries'+CountryId+'"><input type="hidden" name="countries[]" value='+CountryId+'><a type="button" onclick="removeSelectedCountries('+CountryId+')">'+CountryName+'<i class="fas fa-times"></i></a></li>');
    }
    else{
        $("#closeSelectedCountries"+CountryId).remove();
    }
    getTherapist(2);
});

function removeSelectedIssues(Id) {

    $("#issue_checkbox_"+Id).prop("checked", false);

    $("#closeSelectedIssues"+Id).remove();
    getTherapist(2);
}

$(document).on('click', '.onCheckedIssues', function () {

    var Id = $(this).data("id");
    var Name = $(this).data("catname");
    var IssueCategoryName = $(this).data("categoryname");

    if($(this).is(":checked")){

        $("#addCheckBox").append('<li id="closeSelectedIssues'+Id+'"><input type="hidden" name="'+IssueCategoryName+'[]" value='+Id+'><a type="button" onclick="removeSelectedIssues('+Id+')">'+Name+'<i class="fas fa-times"></i></a></li>');
    }
    else{
        $("#closeSelectedIssues"+Id).remove();
    }
    getTherapist(2);
});
    getTherapist(1);

function getTherapist(value) {
    // body...
    var formData = new FormData(document.getElementById("filterForm"));
    $("#fetchTherapistData").html("");

    $.ajax({
        type: "POST",
        url: "{{url('api/Coaches')}}",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success:function(response){
            if(response.status == false)
            {
                $("#fetch").html("");
                $(".noTherapist").show();
            }else
            {
                if(response.therapistData.length > 0)
                {
                    $("#fetch").html("");
                }

                $(".noTherapist").hide();
                $("#fetch").html(response.therapistData);

                if (value == 2)
                {
                    $('.carouselCoach').owlCarousel('destroy');
                }

                $('.carouselCoach').owlCarousel({
                    loop:true,
                    margin:20,
                    nav:true,
                    dots: false,
                    center:true,
                    navText: [
                        "<i class='fas fa-chevron-left'></i>",
                        "<i class='fas fa-chevron-right'></i>"
                    ],
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:3
                        },
                        1000:{
                            items:3
                        }
                    },
                    onTranslated : counter,
                    onInitialized : counter
                });



            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
}

function counter(event) {

    if($(".center .item").data() === undefined)
    {
        $("#fetchTherapistData").html("");
        return
    }
    var id = $(".center .item").data().id;
    showTherapistData(id);
}

function removeSelectedGender(GenderId) {

    $("#gender_"+GenderId).prop("checked", false);

    $("#closeSelectedGender"+GenderId).remove();
    getTherapist(2);
}

$(document).on('click', '.onCheckedGender', function () {

    var GenderId = $(this).data("genderid");
    var GenderName = $(this).data("gendername");

    if($(this).is(":checked")){

        $("#addCheckBox").append('<li id="closeSelectedGender'+GenderId+'"><input type="hidden" name="gender[]" value='+GenderName+'><a type="button" onclick="removeSelectedGender('+GenderId+')">'+GenderName+'<i class="fas fa-times"></i></a></li>');
    }
    else{
        $("#closeSelectedGender"+GenderId).remove();
    }
    getTherapist(2);
});

$(document).on('click', '.onCheckedCategoryOfTherapist', function () {

    getTherapist(2);
});

function removeSelectedLanguage(languageId) {

    $("#language_"+languageId).prop("checked", false);

    $("#closeSelectedLanguage"+languageId).remove();
    getTherapist(2);
}

$(document).on('click', '.onCheckedLanguages', function () {

    var languageId = $(this).data("langid");
    var languageName = $(this).data("language");

    if($(this).is(":checked")){

        $("#addCheckBox").append('<li id="closeSelectedLanguage'+languageId+'"><input type="hidden" name="language[]" value='+languageId+'><a type="button" onclick="removeSelectedLanguage('+languageId+')">'+languageName+'<i class="fas fa-times"></i></a></li>');
    }
    else{
        $("#closeSelectedLanguage"+languageId).remove();
    }
    getTherapist(2);
});

function removeSelectedMedium(mediumId) {

    $("#medium_"+mediumId).prop("checked", false);

    $("#closeSelectedMedium"+mediumId).remove();
    getTherapist(2);
}

$(document).on('click', '.onCheckedMediums', function () {

    var mediumId = $(this).data("mediumid");
    var mediumName = $(this).data("medium");

    if($(this).is(":checked")){

        $("#addCheckBox").append('<li id="closeSelectedMedium'+mediumId+'"><input type="hidden" name="medium[]" value='+mediumId+'><a type="button" onclick="removeSelectedMedium('+mediumId+')">'+mediumName+'<i class="fas fa-times"></i></a></li>');
    }
    else{
        $("#closeSelectedMedium"+mediumId).remove();
    }
    getTherapist(2);
});

function removeSelectedService(serviceId) {

    $("#service_"+serviceId).prop("checked", false);

    $("#closeSelectedService"+serviceId).remove();
    getTherapist(2);
}

$(document).on('click', '.onCheckedServices', function () {

    var serviceId = $(this).data("serviceid");
    var serviceName = $(this).data("service");

    if($(this).is(":checked")){

        $("#addCheckBox").append('<li id="closeSelectedService'+serviceId+'"><input type="hidden" name="service[]" value='+serviceId+'><a type="button" onclick="removeSelectedService('+serviceId+')">'+serviceName+'<i class="fas fa-times"></i></a></li>');
    }
    else{
        $("#closeSelectedService"+serviceId).remove();
    }
    getTherapist(2);
});

function showTherapistData(id){

    $.ajax({
        type: "POST",
        url: "{{url('api/coachesData')}}",
        dataType: "json",
        data: {"id":id},

        success: function (response){

            if(response.showTherapistData.length > 0)
            {
                $("#fetchTherapistData").html("");
            }

            $("#fetchTherapistData").append(response.showTherapistData);
        },
        error: function (error)
        {

        }
    });
}

$(document) .ready(function(){

	// $("#pills-Language-tab").click(function(){

		$.ajax({
		    type: "POST",
		    url: "{{url('api/language')}}",
		    dataType: "json",

		    success: function (response){

		        if(response.languages.length > 0)
		        {
		            $("#Languages").html("");
		        }

		        $("#Languages").append(response.languages);
		    },
		    error: function (error)
		    {

		    }
		});
	// });

	// $("#pills-Service-tab").click(function(){

		$.ajax({
		    type: "POST",
		    url: "{{url('api/service')}}",
		    dataType: "json",

		    success: function (response){

		        if(response.services.length > 0)
		        {
		            $("#Services").html("");
		        }

		        $("#Services").append(response.services);
		    },
		    error: function (error)
		    {

		    }
		});
	// });

	// $("#pills-Country-tab").click(function(){

		$.ajax({
		    type: "POST",
		    url: "{{url('api/country')}}",
		    dataType: "json",
		    data: {},

		    success: function (response){

		        if(response.countries.length > 0)
		        {
		            $("#Country").html("");
		        }

		        $("#Country").append(response.countries);
		    },
		    error: function (error)
		    {

		    }
		});
	// });

	// $("#pills-Medium-tab").click(function(){

		$.ajax({
		    type: "POST",
		    url: "{{url('api/medium')}}",
		    dataType: "json",

		    success: function (response){

		        if(response.mediums.length > 0)
		        {
		            $("#Mediums").html("");
		        }

		        $("#Mediums").append(response.mediums);
		    },
		    error: function (error)
		    {

		    }
		});
	// });

 //    function refreshIssues(){

        $.ajax({
            type: "POST",
            url: "{{url('api/issues')}}",
            dataType: "json",

            success: function (response){

                if(response.allIssues.length > 0)
                {
                    $("#Issues").html("");
                }

                $("#Issues").append(response.allIssues);
            },
            error: function (error)
            {

            }
        });
    // }

    // $('#pills-issues-tab').on('click', refreshIssues);
    // refreshIssues();
});

// $(document) .ready(function(){
//     var div =  $(".owl-item .box_therapists");
//     $(".owl-item .box_therapists").click(function(){
//     div.removeClass('active');
//     });
// });

// $('.carouselCoach').on('changed.owl.carousel',function(property){
//     var current = property.item.index;
//     var src = $(property.target).find(".owl-item").eq(current).find(".box_therapists").attr('data-bs-target');
//     $(property.target).find(".owl-item").eq(current).find(".box_therapists").click();
//     //console.log('Image current is ' + src);
// });
</script>

<script type="text/javascript">
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
</script>