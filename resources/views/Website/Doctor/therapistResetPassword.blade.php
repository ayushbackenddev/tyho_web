@include('Website/Assets/headerForTherapist')

<!-- Content Code Start -->
    <article>
        <div class="container">
            <div class="boxForm">
                <h2 class="text-center">Reset Password</h2>
                <p class="text-center f15 mb-4">Email us at contact@talkyourheartout.com if you face any issues.</p>
                <form id="docResetForm" name="formSubmit" method="POST">
                @csrf
                    <div class="form-field input-withButton">
                        <label class="form-label">Mobile</label>
                        <div class="input-group">
                            <input type="tel" id="doc_reset_mobile_no" name="doc_reset_mobile_no" class="form-control only_digits" placeholder="" maxlength="15"/>
                            <button class="btn btn-primary" type="button" id="docResetOtp" name="docResetOtp">Send otp</button>
                        </div>
                    </div>
                    <div class="form-field">
                        <label class="form-label">OTP</label>
                        <div class="input-group errorInline">
                            <input type="text" id="doc_reset_otp" name="doc_reset_otp" class="form-control only_digits" placeholder="" />
                            <button class="btn btn-primary" type="button" id="docVerifyResetOtp" name="docVerifyResetOtp">Verify</button>
                        </div>
                    </div>
                    <div class="form-field mb-4">
                        <label class="form-label">New Password</label>
                        <div class="input-password">
                            <input type="password" id="tharapistReset_password" name="tharapistReset_password" class="form-control pr-password" placeholder="" maxlength="20"/>
                            <a class="iconEye" id="toggle-pswd"><i id="toggle-pass-image" class="far fa-eye-slash" toggle="#tharapistReset_password"></i></a>
                        </div>
                    </div>
                    <div class="form-field mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-password">
                            <input type="password" id="cnf_tharapistReset_password" name="cnf_tharapistReset_password" class="form-control" placeholder="" />
                            <a class="iconEye" id="toggle-pswd1"><i id="toggle-pass-image1" class="far fa-eye-slash" toggle="#cnf_tharapistReset_password"></i></a>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" id="therapistReset_submit" name="therapistReset_submit">RESET</button>
                    </div>
                </form>
            </div>
        </div>
    </article>
<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

var doc_reset_mobile_no = document.querySelector("#doc_reset_mobile_no");
var telInputmobile = window.intlTelInput(doc_reset_mobile_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

/*-------------------------password custom validation --------------*/
    jQuery.validator.addMethod("pass", function(value, element, param) {
        return value.match(/^(?=.*\d)(?=.*[A-Z])(?=.*\W).*$/);
    },'Please enter atleast one UpperCase, one LowerCase, one Number,one SpecialChar and min 8 Chars');

$(document).ready(function(){

    $("#docResetForm").validate({

        rules: {
            doc_reset_mobile_no: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 15,
            },
            doc_reset_otp: {
                required: true,
                number: true,
            },
            tharapistReset_password: {
                required: true,
                pass:true,
                minlength: 8,
                maxlength: 20,
            },
            cnf_tharapistReset_password: {
                equalTo: "#tharapistReset_password",
            },
        },
        messages: {
            doc_reset_mobile_no : {
                required: "Please enter your mobile number",
                number: "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",

            },
            doc_reset_otp : {
                required: "Please enter your 4 digit OTP",
                number: "Enter digits only",
            },
            tharapistReset_password : {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters",
            },
            cnf_clientReset_password: {
                equalTo: "Passwords do not match",
            }
        },

        submitHandler: function(form){
            var formData = new FormData(form);
            $.ajax({
                url: "{{url('api/resetDocPassword')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    if (response.status == true)
                    {
                        toastr.success(response.message);
                        window.location.href = "/Dlogin";
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
        },
    });

    $("#toggle-pswd").click(function() {
        $("#toggle-pass-image").toggleClass("fa-eye fa-eye-slash");
        var input = $("#tharapistReset_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    $("#toggle-pswd1").click(function() {
        $("#toggle-pass-image1").toggleClass("fa-eye fa-eye-slash");
        var input = $("#cnf_tharapistReset_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    var button = $('#therapistReset_submit');
    $(button).attr('disabled', 'disabled');

    $("#docResetOtp").click(function(){

        var isvalid = $('#doc_reset_mobile_no').valid();

        if (isvalid == true)
        {
            var doc_reset_mobile_no = $("#doc_reset_mobile_no").val();
            var dial_code = telInputmobile.getSelectedCountryData().dialCode;

            var DoctorMob = {"doc_reset_mobile_no":doc_reset_mobile_no, "dial_code":dial_code};

            $.ajax({
                url: "{{url('api/docSendOtp')}}",
                type: "POST",
                data: DoctorMob,
                dataType: 'json',

                success:function(response){

                    if (response.status == true)
                    {
                        $("#doc_reset_otp").val(response.otp);
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

    $("#docVerifyResetOtp").click(function(){

        var mobile = $('#doc_reset_mobile_no').valid();
        var otp = $('#doc_reset_otp').valid();

        if (mobile == true && otp == true)
        {
            var doc_reset_mobile_no = $("#doc_reset_mobile_no").val();
            var doc_reset_otp = $("#doc_reset_otp").val();
            var DoctorData = {"doc_reset_mobile_no":doc_reset_mobile_no,"doc_reset_otp":doc_reset_otp};

            $.ajax({
                url: "{{url('api/docVerifyOtp')}}",
                type: "POST",
                data: DoctorData,
                dataType: 'json',

                success:function(response){

                   if (response.status == true)
                    {
                        var button = $('#therapistReset_submit');
                        $(button).removeAttr('disabled');
                        $("#doc_reset_mobile_no").attr('readonly','readonly');
                        toastr.success(response.message);
                    }
                    else
                    {
                        var button = $('#therapistReset_submit');
                        $(button).attr('disabled', 'disabled');
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
});
</script>