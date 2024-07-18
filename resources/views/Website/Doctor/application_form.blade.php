@include('Website/Assets/headerForTherapist')

<!-- Content Code Start -->

<article>
    <div class="container">
        <div class="boxForm boxintakeForm formFullWidth">
            <h2 class="text-center">Therapist Application Form</h2>
            <p class="f15 mb-4">We would like to get to know you better. Please fill out this form as best you can.</p>
            <form id="application_form" name="FormSubmit" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">First Name*</label>
                            <input type="hidden" value="{{isset($id)?$id:''}}" id="expression_id_fk" name="expression_id_fk">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" maxlength="20" />
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="form-field">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="form-field">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Email*</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Country of Residence*</label>
                            <select class="form-control selectpicker" id="country_of_residence" name="country_of_residence">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">City of Residence*</label>
                            <input type="text" class="form-control" id="city_of_residence" name="city_of_residence" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Gender*</label>
                            <select class="form-control styledSelect" id="gender" name="gender" size="1" >
                                <option selected disabled></option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Non-binary</option>
                                <option>Prefer not to say </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Occupation*</label>
                            <select class="form-control styledSelect selectOccupation" id="occupation" name="occupation" >
                                <option selected disabled></option>
                                <option>Psychologist</option>
                                <option>Counsellor</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-field boxOccupationOther">
                            <label class="form-label">Other*</label>
                            <input type="text" class="form-control" id="occupation_other" name="occupation_other" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Languages Spoken*</label>
                            <!-- <input type="text" class="form-control" id="languages_spoken" name="languages_spoken" value="" data-role="tagsinput" placeholder="" /> -->
                            <select class="form-control" name="languages_spoken[]" id="languages_spoken" multiple>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Length of Experience (years)</label>
                            <input type="text" class="form-control" id="length_of_experience" name="length_of_experience" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Areas of Expertise / Specialisation</label>
                            <input type="text" class="form-control" id="areas_of_expertise_specialisation" name="areas_of_expertise_specialisation" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Therapeutic Approaches (eg CBT)</label>
                            <input type="text" class="form-control" id="therapeutic_approaches" name="therapeutic_approaches" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Current / Last Place of Work</label>
                            <input type="text" class="form-control" id="current_last_place_of_work" name="current_last_place_of_work" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Educational Qualifications</label>
                            <input type="text" class="form-control" id="educational_qualifications" name="educational_qualifications" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Professional Certifications</label>
                            <input type="text" class="form-control" id="professional_certifications" name="professional_certifications" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Professional Memberships</label>
                            <input type="text" class="form-control" id="professional_memberships" name="professional_memberships" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-field">
                        <label class="form-label">Do you work with any specific groups of people (eg industries, age groups etc)?</label>
                        <input type="text" class="form-control" id="work_with_any_specific_groups_of_people" name="work_with_any_specific_groups_of_people" placeholder="" />
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-field">
                        <label class="form-label">Are there are any clients that you prefer not to work with for personal reasons (eg personality disorders, sexual offenders etc)?</label>
                        <input type="text" class="form-control" id="any_clients_that_you_prefer_not_to_work_with_for_personal_reason" name="any_clients_that_you_prefer_not_to_work_with_for_personal_reason" placeholder="" />
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-field mb-3 pb-1 inline_radioBtns">
                            <label class="form-label mb-3 d-block">Are you currently under supervision? </label>
                            <div class="form-check d-inline-block me-2">
                                <input class="form-check-input" type="radio" value="1" name="currently_under_supervision" id="yes1" checked>
                                <label class="form-check-label" for="yes1"> Yes</label>
                            </div>
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="radio" value="0" name="currently_under_supervision" id="yes2">
                                <label class="form-check-label" for="yes2"> No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-field provideDetailsOne">
                            <label class="form-label">Please provide details*</label>
                            <input type="text" class="form-control" id="supervision_please_provide_details" name="supervision_please_provide_details" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-field mb-3 pb-1 inline_radioBtns">
                            <label class="form-label mb-3 d-block">Do you currently have any professional indemnity insurance?</label>
                            <div class="form-check d-inline-block me-2">
                                <input class="form-check-input" type="radio" value="1" name="currently_have_any_professional_indemnity_insurance" id="yes3" checked>
                                <label class="form-check-label" for="yes3"> Yes</label>
                            </div>
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="radio" value="0" name="currently_have_any_professional_indemnity_insurance" id="yes4">
                                <label class="form-check-label" for="yes4"> No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-field insuranceDetail">
                            <label class="form-label">Please provide details*</label>
                            <input type="text" class="form-control" id="insurance_please_provide_details" name="insurance_please_provide_details" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-field message_bottom">
                        <label class="form-label d-block mb-3">What services are you able to provide?*</label>
                        <label class="form-label text-dark f13">Counselling Services</label>
                        <div class="row">
                            @foreach (Helper::getMyService() as $showService)
                                <div class="col-md-4">
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="service_id_{{$showService->id}}" name="services_provide[]" value="{{$showService->id}}">
                                        <label class="form-check-label" for="{{$showService->service}}">{{$showService->service}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-field message_bottom">
                        <label class="form-label">What mediums are you able to use for counselling?*</label>
                        <div class="row">
                            @foreach (Helper::getMyMedium() as $showMedium)
                                <div class="col-md-4">
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="medium_id_{{$showMedium->id}}" name="for_counselling[]" value="{{$showMedium->id}}">
                                        <label class="form-check-label" for="{{$showMedium->medium}}">{{$showMedium->medium}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-field">
                        <label class="form-label">Approximate availability (hours per week)</label>
                        <input type="text" id="approximate_availability" name="approximate_availability" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-field">
                        <label class="form-label d-block mb-3">Which days & timeslots are you likely to be available? </label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label text-dark f13">Days </label>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Monday" id="mon" name="days[]">
                                            <label class="form-check-label" for="mon">Mon</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Tuesday" id="tue" name="days[]">
                                            <label class="form-check-label" for="tue">Tue</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Wednesday" id="wed" name="days[]">
                                            <label class="form-check-label" for="wed">Wed </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Thrusday" id="thu" name="days[]">
                                            <label class="form-check-label" for="thu">Thu</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Friday" id="fri" name="days[]">
                                            <label class="form-check-label" for="fri">Fri</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Saturday" id="sat" name="days[]">
                                            <label class="form-check-label" for="sat">Sat</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Sunday" id="sun" name="days[]">
                                            <label class="form-check-label" for="sun" name="days[]">Sun</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark f13">Timeslots</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Morning (7 AM - 12 PM)" id="morning" name="timeslots[]">
                                            <label class="form-check-label" for="morning">Morning (7 AM - 12 PM)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Afternoon (12 PM - 6 PM)" id="afternoon" name="timeslots[]">
                                            <label class="form-check-label" for="afternoon">Afternoon (12 PM - 6 PM)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" class="form-check-input" value="Evening (6 PM - 10 PM)" id="evening" name="timeslots[]">
                                            <label class="form-check-label" for="evening">Evening (6 PM - 10 PM) </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">What do you assist clients with (please select the ones that apply to your practice)?*</label>
                </div>
                <div class="row g-3" id="addIssues">

                </div>
                <span for="issues" generated="true" class="error" id="issuesValidation" style="color: red;">Please select at least one issue</span>
                <div class="row pt-3">
                    <div class="col-md-4">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</article>

<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

$(function(){
    $('.selectOccupation').on('change', function() {
        var data = $(".selectOccupation option:selected").text();
        if (data == "Other"){
            $(".boxOccupationOther").addClass("show");
        }
        else{
            $(".boxOccupationOther").removeClass("show");
            $(".boxOccupationOther input").val("");
        }
    })
});

$(function() {
    $("input[name='currently_under_supervision']").click(function() {
        if ($("#yes1").is(":checked")) {
            $(".provideDetailsOne").show();
        }
        else {
            $(".provideDetailsOne").hide();
        }
    });
    $("input[name='currently_have_any_professional_indemnity_insurance']").click(function() {
        if ($("#yes3").is(":checked")) {
            $(".insuranceDetail").show();
        }
        else {
            $(".insuranceDetail").hide();
        }
    });
});

$(document).ready(function () {

var id = $("#id").val();
$.ajax({
    type: "POST",
    url: "{{url('api/getallIssues')}}",
    dataType: "json",
    data: {"id":id},

    success: function (response){

        if(response.issues.length > 0)
        {
            $("#addIssues").html("");
        }

        $("#addIssues").append(response.issues);
    },
    error: function (error)
    {

    }
});


/*-------------------------email custom validation --------------*/
    jQuery.validator.addMethod("emailExt", function(value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
    },'Please enter a valid email address');

    $("#application_form").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            email: {
                required: true,
                emailExt:true,
            },
            country_of_residence:{
                required:true,
            },
            city_of_residence:{
                required:true,
            },
            gender: {
                required: true,
            },
            occupation: {
                required: true,
            },
            occupation_other:{
                required:true,
            },
            'languages_spoken[]': {
                required: true,
            },
            supervision_please_provide_details: {
                required: true,
            },
            insurance_please_provide_details: {
                required: true,
            },
            'services_provide[]': {
                required: true,
            },
            'for_counselling[]': {
                required: true,
            },
        },
        messages: {
            first_name : {
                required: "Please enter your first name",
                minlength: "Please enter at least 2 characters",
            },
            email: {
                required: "Please enter an email address",
            },
            country_of_residence:{
                required:"Please enter your country of residence",
            },
            city_of_residence:{
                required:"Please enter your city of residence",
            },
            gender: {
                required: "Please select one of the options",
            },
            occupation: {
                required: "Please select one of the options",
            },
           occupation_other:{
                required:"Please provide your occupation",
            },
            'languages_spoken[]': {
                required: "Please enter your spoken languages",
            },

            supervision_please_provide_details: {
                required: "Please provide this",
            },
            insurance_please_provide_details: {
                required: "Please provide this",
            },

            'services_provide[]': {
                required: "Please select at least one option",
            },
            'for_counselling[]': {
                required: "Please select at least one option",
            },
        },
    });

    $("#application_form").on("submit", function(e){

        $("#issuesValidation").show();

        checkValidationForCheckbox();
        var validations = $("#application_form").valid();

        if (validations == false) {

            e.preventDefault();
        }
        else{

            if (checkValidationForCheckbox() == false)
            {
                e.preventDefault();
                return;
            }
            e.preventDefault();

            var services_provide = $("input[name=services_provide]:checked").length;
            var for_counselling = $("input[name=for_counselling]:checked").length;
            var days = $("input[name=days]:checked").length;
            var timeslots = $("input[name=timeslots]:checked").length;
            var mood_regulation = $("input[name=mood_regulation]:checked").length;
            var family_and_relationships = $("input[name=family_and_relationships]:checked").length;
            var academic_or_work_related = $("input[name=academic_or_work_related]:checked").length;
            var personal = $("input[name=personal]:checked").length;
            var other = $("input[name=other]:checked").length;

            var formData = new FormData(this);

            $.ajax({
                url: "{{url('api/application')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    toastr.success(response.message);

                    if (response.status == true)
                    {
                        window.location.replace("{{url('/ApplicationSuccess')}}");
                    }
                    else
                    {
                        toastr.error(error.message);
                    }
                },
                error:function(error){
                    console.log(error);
                    toastr.error(error.message);
                },
            });
        }
    });

    var id = $("#expression_id_fk").val();

    if (id != "")
    {
        $.ajax({
            url: "{{url('api/showExpression')}}",
            type: "POST",
            data: {"id":id},
            dataType: 'json',

            success:function(response){

                $("#first_name").val(response.Expressiondata.first_name);
                $("#last_name").val(response.Expressiondata.last_name);
                $("#email").val(response.Expressiondata.expression_email);
            },
            error:function(error){
                console.log(error);
            },
        });
    }
    else{

    }

    $.ajax({
        url: "{{url('api/getlanguages')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

            $('#languages_spoken').empty();
            $('#languages_spoken').append('<option value="" disabled="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                $('#languages_spoken').append('<option value="' + data.id + '">' + data.language_name + '</option>');
            });
        }
    });

    $.ajax({
        url: "{{url('api/getCountry')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

            $('#country_of_residence').empty();
            $('#country_of_residence').append('<option value="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                $('#country_of_residence').append('<option value="' + data.id + '">' + data.name + '</option>');
            });
        }
    });

    $("#country_of_residence").select2();
});
</script>