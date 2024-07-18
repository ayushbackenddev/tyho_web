@include('Website/Assets/headerForClient')

<!-- Content Code Start -->
<article>
    <div class="container">
        <div class="boxForm boxintakeForm boxFormBig">
            <h2 class="text-center">Intake Form (1 of 2)</h2>
            <p class="f15 mb-4">Tell us more about yourself. This will help your Therapist be prepared and effective during your sessions with them. </p>
            <form id="IntakeForm1" name="FormSubmit" method="POST">
                @csrf
                <input type="hidden" value="{{isset($id)?$id:''}}" id="id" name="id">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Age*</label>
                            <select class="form-control styledSelect" id="age" name="age">
                                <option selected disabled></option>
                                <option>18 - 24</option>
                                <option>25 - 35</option>
                                <option>36 - 50</option>
                                <option>51 - 60</option>
                                <option>61 and above</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Gender*</label>
                            <select class="form-control styledSelect" id="gender" name="gender">
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
                            <label class="form-label">Country of Residence</label>
                            <input type="text" class="form-control" placeholder="" id="country_of_residence" name="country_of_residence"/>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">City of Residence</label>
                            <input type="text" class="form-control" placeholder="" id="city_of_residence" name="city_of_residence"/>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h3>Emergency Contact*</h3>
                    <p class="f15 mb-4">Please provide contact details of someone you trust and feel safe with. The emergency contact person will be contacted only in the event that your safety is at risk. </p>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Name*</label>
                            <input type="text" class="form-control" placeholder="" id="name" name="name" maxlength="20"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Relationship*</label>
                            <input type="text" class="form-control" placeholder="" id="relationship" name="relationship"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field">
                            <label class="form-label">Mobile*</label>
                            <div class="input-group">
                                <input type="tel" class="form-control only_digits" placeholder="" id="intake1_mobile_no" name="intake1_mobile_no" maxlength="15"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h3>Issues*</h3>
                    <p class="f15 mb-4">What would you like to discuss with your Therapist? </p>
                </div>
                <div class="row g-3" id="addIssues">

                </div>
                <span for="issues" generated="true" class="error" id="issuesValidation" style="color: red;">Please select at least one issue</span>
                <h3 class="mb-3 mt-3">General Information</h3>
                <div class="form-field">
                    <label class="form-label">What is your current relationship status?</label>
                    <select class="form-control styledSelect" id="your_relationship_status" name="your_relationship_status">
                        <option selected disabled></option>
                        <option>Single</option>
                        <option>In a relationship</option>
                        <option>Live-in relationship</option>
                        <option>Married</option>
                        <option>Separated</option>
                        <option>Divorced</option>
                        <option>Widowed</option>
                    </select>
                </div>
                <div class="form-field">
                    <label class="form-label">What is your occupation?</label>
                    <input type="text" class="form-control" placeholder="" id="your_occupation" name="your_occupation"/>
                </div>
                <div class="form-field">
                    <label class="form-label">What are your highest educational qualification?</label>
                    <select class="form-control styledSelect" id="highest_qualifications" name="highest_qualifications">
                        <option selected disabled></option>
                        <option>Primary education</option>
                        <option>Secondary education</option>
                        <option>Post-secondary (non-tertiary)</option>
                        <option>Diploma & professional qualification</option>
                        <option>Undergraduate degree</option>
                        <option>Postgraduate degree</option>
                        <option>PhD</option>
                    </select>
                </div>
                <div class="row pt-3">
                    <div class="col-md-5">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="submit" name="submit">Submit and Next</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</article>
<!-- Content Code End -->

@include('Website/Assets/footer')

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

<script>

var intake1_mobile_no = document.querySelector("#intake1_mobile_no");
var telInputmobile = window.intlTelInput(intake1_mobile_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$(document).ready(function () {

var id = $("#id").val();
$.ajax({
    type: "POST",
    url: "{{url('api/allIssues')}}",
    dataType: "json",
    data: {"id":id},

    success: function (response){

        if(response.issuesMoodRegulation.length > 0)
        {
            $("#addIssues").html("");
        }

        $("#addIssues").append(response.issuesMoodRegulation);
    },
    error: function (error)
    {

    }
});

    $("#IntakeForm1").validate({

        rules: {
            age: {
                required: true,
            },
            gender: {
                required: true,
            },
            name: {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            relationship: {
                required: true,
            },
            intake1_mobile_no: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 15,
            },
        },
        messages: {
            age: {
                required: "Please select one of the options",
            },
            gender: {
                required: "Please select one of the options",
            },
            name: {
                required: "Please enter a name",
                minlength: "Please enter at least 2 characters",
            },
            relationship: {
                required: "Please enter your relationship with them",
            },
            intake1_mobile_no: {
                required: "Please enter their mobile number",
                number: "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",
            },
        },
    });

    $("#IntakeForm1").on("submit", function(e){
        checkValidationForCheckbox();

        var validations = $("#IntakeForm1").valid();

        if (validations == false) {
            e.preventDefault();
        }
        else{

            if (checkValidationForCheckbox() == false)
            {
                $("#issuesValidation").show();
                e.preventDefault();
                return;
            }

            e.preventDefault();
            var formData = new FormData(this);
            formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );

            $.ajax({
                url: "{{url('api/intake1')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success:function(response){

                    if (response.status == true)
                    {
                        window.location.replace("{{url('/intake2')}}/"+response.user_id);
                    }
                    else
                    {
                        toastr.error(response.message);
                    }
                },
                error:function(error){
                    console.log(error);
                    toastr.error(response.message);
                },
            });
        }
    });
});
</script>