@include('Website/Assets/headerForTherapist')

<!-- Content Code Start -->

<article>
    <div class="container">
        <div class="boxForm boxintakeForm formFullWidth mb-4 onboardingAccordion">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <input type="hidden" value="{{isset($id)?$id:''}}" id="id" name="id">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="submit" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="getApplication" name="getApplication">
                            <h2 class="text-center mb-0">Information submitted by you via Application Form</h2>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div id="addApplicationView">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="boxForm boxintakeForm formFullWidth mt-0">
            <h2 class="text-center">Onboarding Form</h2>
            <p class="f15 mb-4">Welcome to TYHO! Please fill out the form below to allow us to create your account with us.</p>
            <form id="onBoardingForm" name="FormSubmit" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="mb-3 heading-md">Contact Details</h2>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="hidden" value="{{isset($id)?$id:''}}" id="expression_id_fk" name="expression_id_fk">
                        <div class="form-field input-withButton">
                            <label class="form-label">Mobile *</label>
                            <div class="input-group">
                                <input type="tel" id="mobile" name="mobile" class="form-control only_digits" placeholder="" maxlength="15" />
                                <button class="btn btn-primary" type="button" id="OnboardingSend" name="OnboardingSend">Send otp</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label">OTP *<a class="iconTooltip" data-toggle="tooltip" title="A One Time Password (OTP) will be sent to your mobile number via SMS. This two-step verification (password & OTP) allows us to better protect your Talk Your Heart Out account."><i class="fas fa-info-circle"></i></a></label>
                            <div class="input-group errorInline">
                                <input type="text" id="otp" name="otp" class="form-control only_digits" placeholder="" />
                                <button class="btn btn-primary" type="button" id="OnboardingVerify" name="OnboardingVerify">Verify</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-field mb-0" id="Add">
                        <label class="form-label">Address(es) for in-person sessions (if applicable)</label>
                        <div class="row">

                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label text-dark f13">Address Title <a class="iconTooltip" data-toggle="tooltip" title="Address Title"><i class="fas fa-info-circle"></i></a></label>
                            <input type="text" id="address_title" class="form-control" placeholder="" />
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label text-dark f13">Address Line 1</label>
                            <input type="text" id="address_line1" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label text-dark f13">Address Line 2</label>
                            <input type="text" id="address_line2" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label text-dark f13">Landmark</label>
                            <input type="text" id="landmark" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label text-dark f13">City</label>
                            <input type="text" id="city" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label text-dark f13">Postal Code</label>
                            <input type="text" id="postal_code" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label text-dark f13">Country</label>
                            <select class="form-control styledSelect selectpicker" id="country_id_fk" data-live-search="true" data-style="select-with-transition" data-size="7">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4">
                        <div class="d-grid">
                            <button type="button" id="addAddress" name="addAddress" class="btn btn-primary btn-lg">Add address</button>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-md-3">
                        <h2 class="mb-3 heading-md">Profile Details</h2>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="form-field filestyleButton">
                            <label class="form-label">Photo(s)*(Please ensure white background, with upper arms included.)</label>
                            <div class="input-group">
                                <div id="dZUpload" class="dropzone-custom">
                                    <div class="dz-default dz-message">
                                        <input type="hidden" name="" class="dz-default dz-message">
                                        <span class="btn btn-sm"><i class='fas fa-file-upload'></i> Upload Photo(s)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-field filestyleButton">
                            <label class="form-label">Video* (max 60 seconds)<br></label>
                            <div class="input-group">
                                <div id="dZUpload2" class="dropzone-custom">
                                    <div class="dz-default dz-message">
                                        <span class="btn btn-sm"><i class='fas fa-file-upload'></i> Upload Video</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-field">
                        <label class="form-label">Profile Description *</label>
                        <div class="input-group">
                            <textarea class="form-control textarea-lg" placeholder="" id="profile_description" name="profile_description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-3">
                        <h2 class="mb-3 heading-md">Preferences *</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label">Please select your preferred notice period for a new booking</label>
                            <select class="form-control styledSelect" id="select_preferred_notice_period_for_new_booking" name="select_preferred_notice_period_for_new_booking">
                                <option selected disabled></option>
                                <option>2 hr</option>
                                <option>4 hr</option>
                                <option>8 hr</option>
                                <option>12 hr </option>
                                <option>24 hr</option>
                                <option>48 hr</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-field">
                        <label class="form-label">Please check the events for which you would like an email notification:</label>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_financial_stress" checked name="email_notifications[]" value="1">
                            <label class="form-check-label" for="issue_financial_stress">New appointment scheduled </label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_addictions" checked name="email_notifications[]" value="2">
                            <label class="form-check-label" for="issue_addictions">24 hour reminder for sessions</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_habit_change" checked name="email_notifications[]" value="3">
                            <label class="form-check-label" for="issue_habit_change">10 min reminder for sessions</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_cultural_adjustment" checked name="email_notifications[]" value="4">
                            <label class="form-check-label" for="issue_cultural_adjustment">Appointment rescheduled by client</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_cultural_adjustment" checked name="email_notifications[]" value="5">
                            <label class="form-check-label" for="issue_cultural_adjustment">Appointment cancelled by client</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_trauma_or_ptsd " checked name="email_notifications[]" value="6">
                            <label class="form-check-label" for="issue_trauma_or_ptsd">Appointment cancelled by Therapist </label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_ocd" checked name="email_notifications[]" value="7">
                            <label class="form-check-label" for="issue_ocd">Intake form completed or updated by client (only if there are upcoming appointments)
                            </label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_adhd" checked name="email_notifications[]" value="8">
                            <label class="form-check-label" for="issue_adhd">Reschedule request sent by client (ie within 24 hours of appointment)</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_adhd" checked name="email_notifications[]" value="9">
                            <label class="form-check-label" for="issue_adhd">ORS form completed by client</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_adhd" checked name="email_notifications[]" value="10">
                            <label class="form-check-label" for="issue_adhd">SRS form completed by client</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_adhd" checked name="email_notifications[]" value="11">
                            <label class="form-check-label" for="issue_adhd">Feedback provided by client</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_adhd" checked name="email_notifications[]" value="12">
                            <label class="form-check-label" for="issue_adhd">Monthly payment note generated</label>
                        </div>
                        <div class="form-check mb-1">
                            <input type="checkbox"  class="form-check-input" id="issue_adhd" checked name="email_notifications[]" value="13">
                            <label class="form-check-label" for="issue_adhd">Change of status for Therapist</label>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="OnboardingSubmit" name="OnboardingSubmit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</article>

<!-- Content Code End -->

@include('Website/Assets/footer')

<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<script>

var mobile = document.querySelector("#mobile");
var telInputmobile = window.intlTelInput(mobile, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});


$( "#address_title" ).keyup(function() {

    if ($(this).val().length > 0)
    {
        $("#address_line1").prop('required',true);
        $("#address_line2").prop('required',true);
        $("#landmark").prop('required',true);
        $("#city").prop('required',true);
        $("#postal_code").prop('required',true);
        $("#country_id_fk").prop('required',true);

    }else
    {
        $("#address_line1").prop('required',false);
        $("#address_line2").prop('required',false);
        $("#landmark").prop('required',false);
        $("#city").prop('required',false);
        $("#postal_code").prop('required',false);
        $("#country_id_fk").prop('required',false);
    }
});

$(document).ready(function () {

    Dropzone.autoDiscover = false;

    var images = [];

    var dropzoneImages = new Dropzone ("#dZUpload", {
        url: "hn_SimpeFileUploader.ashx",
        maxFilesize: 256, // Set the maximum file size to 256 MB
        paramName: "document[attachment]", // Rails expects the file upload to be something like model[field_name]
        autoProcessQueue: false,
        acceptedFiles: ".jpg,.png",
        addRemoveLinks: true // Don't show remove links on dropzone itself.
      });

      dropzoneImages.on("removedfile", function(file){
        for (var i = images.length - 1; i >= 0; i--) {
         if (images[i] === file) {
          images.splice(i, 1);
         }
        }
      });

      dropzoneImages.on("addedfile", function(file){
        images.push( file);
      });


      var videos = new Array();


      var dropzoneImages = new Dropzone ("#dZUpload2", {
        url: "hn_SimpeFileUploader.ashx",
        maxFilesize: 256, // Set the maximum file size to 256 MB
        paramName: "document[attachment]", // Rails expects the file upload to be something like model[field_name]
        autoProcessQueue: false,
        acceptedFiles: ".mp4",
        addRemoveLinks: true // Don't show remove links on dropzone itself.
      });

      dropzoneImages.on("removedfile", function(file){

        for (var i = videos.length - 1; i >= 0; i--) {
         if (videos[i] === file) {
          videos.splice(i, 1);
         }
        }
        console.log(videos);
      });

      dropzoneImages.on("addedfile", function(file){
        videos.push( file);
        console.log(videos);
      });


    $("#addAddress").click(function () {

        $('#address_line1').valid();
        $('#address_line2').valid();
        $('#landmark').valid();
        $('#city').valid();
        $('#postal_code').valid();
        $('#country_id_fk').valid();

        var AddressTitle = $("#address_title").val();

        if ($('#address_line1').valid() == true && $('#address_line2').valid() == true && $('#landmark').valid() == true && $('#city').valid() == true && $('#postal_code').valid() == true && $('#country_id_fk').valid() == true && AddressTitle != "")
        {
            //var AddressTitle = $(this).attr("#address_title");
            //var AddressTitle = $("address_title").html();
            //var AddressTitle = $( "#address_title" ).show();
            var Address1 = $("#address_line1").val();
            var Address2 = $("#address_line2").val();
            var Landmark = $("#landmark").val();
            var City = $("#city").val();
            var PostalCode = $("#postal_code").val();
            var Country = $("#country_id_fk option:selected").text();
            var Country_val = $("#country_id_fk").val();

            $("#Add").append('<div class="col-12 col-md-6"><div class="alert alert-address alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button><div class="row"><div class="col-6"><p><label>Address Title</label><input readonly type="text" name="address_title[]" value="'+AddressTitle+'"></p></div> <div class="col-6"><p><label>Address Line 1</label><textarea readonly name="address_line1[]" >'+Address1+'</textarea></p></div></div><div class="row"><div class="col-6"><p><label>Address Line 2</label><textarea name="address_line2[]">'+Address2+'</textarea></p></div><div class="col-6"><p><label>Landmark</label><input readonly type="text" name="landmark[]" value="'+Landmark+'"></p></div></div> <div class="row"><div class="col-6"><p><label>City</label><input readonly type="text" name="city[]" value="'+City+'"></p></div><div class="col-6"> <p><label>Postal Code</label><input readonly type="text" name="postal_code[]" value="'+PostalCode+'"></p></div></div><div class="row"><div class="col-6"><p><label>Country</label><input type="hidden" name="country_id_fk[]" value="'+Country_val+'"><input readonly type="text" value="'+Country+'"></p></div></div></div></div>');

        $("#address_title").val("");
        $("#address_line1").val("");
        $("#address_line2").val("");
        $("#landmark").val("");
        $("#city").val("");
        $("#postal_code").val("");
        $("#country_id_fk").val("");

        $("#address_line1").prop('required',false);
        $("#address_line2").prop('required',false);
        $("#landmark").prop('required',false);
        $("#city").prop('required',false);
        $("#postal_code").prop('required',false);
        $("#country_id_fk").prop('required',false);
    }
    });

    $("#onBoardingForm").validate({

        rules:{

            mobile:{
                required:true,
                number:true,
                minlength:6,
                maxlength:15,
            },

            otp: {
                required: true,
            },

            /*photos:{
                required:true,
                extension: "jpg|png|gif|jpeg",
            },

            video:{
                required:true,
                extension: "mp4|MPEG-2",
            },*/

            profile_description:{
                required:true,
            },

            select_preferred_notice_period_for_new_booking:{
                required:true,
            },
        },
        messages:{

            mobile:{
                required: "Please enter your mobile number",
                number:  "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",
            },

            otp: {
                required: "Please enter your 4 digit OTP",
            },

            /*photos:{
                required:"Please upload an image",
                extension:"Please upload only .jpg, .png .gif or .jpeg files",
            },

            video:{
                required:"Please upload a video",
                extension:"Please upload only .mp4 or .MPEG-2 files",
            },*/

            profile_description:{
                required:"Please enter a description",
            },

            select_preferred_notice_period_for_new_booking:{
                required:"Please select one of the options",
            },
        },
    });

    var id = $("#id").val();

    if (id != "")
    {
        $.ajax({
            url: "{{url('api/viewApplication')}}",
            type: "POST",
            data: {"id":id},
            dataType: 'json',

            success:function(response){

                $("#addApplicationView").append(response.applicationData);
            },
            error:function(error){
                console.log(error);
                toastr.error(error.message);
            },
        });
    }
    else{

    }

    //for dissable enable button
    var button = $('#OnboardingSubmit');
    $(button).attr('disabled', 'disabled');

    $("#OnboardingSend").click(function(){

        var isValid = $('#mobile').valid();

        if (isValid == true)
        {
            var mobile = $("#mobile").val();
            var dial_code = telInputmobile.getSelectedCountryData().dialCode;

            var OnboardingMob = {"mobile":mobile, "dial_code":dial_code};

            $.ajax({
                url: "{{url('api/sendOTPOnboarding')}}",
                type: "POST",
                data: OnboardingMob,
                dataType: 'json',

                success:function(response){

                    if (response.status == true)
                    {
                        $("#otp").val(response.otp);
                        toastr.success(response.message);
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
        }
    });

    $("#OnboardingVerify").click(function(){

        var mobileNo = $('#mobile').valid();
        var Otp = $('#otp').valid();

        if (mobileNo == true && Otp == true)
        {
            var mobile = $("#mobile").val();
            var otp = $("#otp").val();
            var OnboardingData = {"mobile":mobile,"otp":otp};

            $.ajax({
                url: "{{url('api/otpVerify')}}",
                type: "POST",
                data: OnboardingData,
                dataType: 'json',

                success:function(response){

                   if (response.status == true)
                    {
                        var button = $('#OnboardingSubmit');
                        $(button).removeAttr('disabled');

                        $('#mobile').keypress(function(e) {
                            return false
                        });

                        $('#otp').keypress(function(e) {
                            return false
                        });
                        toastr.success(response.message);
                    }
                    else
                    {
                        var button = $('#OnboardingSubmit');
                        $(button).attr('disabled', 'disabled');

                        $('#mobile').keypress(function(e) {
                            return true
                        });

                        $('#otp').keypress(function(e) {
                            return true
                        });
                        toastr.error(response.message);
                    }
                },
                error:function(error){
                    console.log(error);
                    toastr.error(error.message);
                },
            });
        }
    });

    $("#onBoardingForm").on("submit", function(e){

        var validations = $("#onBoardingForm").valid();

        if (validations == false) {

            e.preventDefault();
        }
        else{

            e.preventDefault();

            var email_notifications = $("input[name=email_notifications]:checked").length;

            var formData = new FormData(this);

            for (var i = images.length - 1; i >= 0; i--) {
                formData.append("image[]", images[i]);
            }

            for (var i = videos.length - 1; i >= 0; i--) {
                formData.append("videos[]", videos[i]);
            }

            formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );

            $.ajax({
                url: "{{url('api/onboarding')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success:function(response){

                    if (response.status == true)
                    {
                        toastr.success(response.message);
                        window.location.replace("{{url('/boardingSuccess')}}");
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
        }
    });

    $.ajax({
        url: "{{url('api/getCountry')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

            $('#country_id_fk').empty();
            $('#country_id_fk').append('<option value="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                $('#country_id_fk').append('<option value="' + data.id + '">' + data.name + '</option>');
            });
        }
    });

    $("#country_id_fk").select2();
});

</script>