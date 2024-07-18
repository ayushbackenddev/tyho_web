@include('Website/Assets/headerForTherapist')

<!-- Content Code Start -->
	<article>
        <div class="container">
            <div class="boxForm">
                <h2 class="text-center">Sign In</h2>
                <p class="text-center f15 mb-4">Email us at contact@talkyourheartout.com if you face any issues.</p>
                <form id="docLogin" name="formSubmit" method="POST">
                    @csrf
                    <div class="form-field">
                        <label class="form-label">Mobile</label>

                        <div class="input-group input-withButton">
                            <input type="tel" id="doc_signIn_mobile_no" name="doc_signIn_mobile_no" class="form-control only_digits" maxlength="15"/>
                            <button class="btn btn-primary" type="button" id="sendOtp">Send otp</button>
                        </div>
                    </div>
                    <div class="form-field">
                        <label class="form-label">OTP</label>
                        <div class="input-group errorInline">
                            <input type="text" id="doc_signIn_otp" name="doc_signIn_otp" class="form-control only_digits" placeholder="" />
                            <button class="btn btn-primary therapistLogin_Verify" type="button" id="verifyOtp">Verify</button>
                        </div>
                    </div>
                    <div class="form-field mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-password">
                            <input type="password" id="therapistLogin_password" name="therapistLogin_password" class="form-control" placeholder="" maxlength="20" />
                            <a id="toggle-pass" class="iconEye"><i id="toggle-pass-image" class="far fa-eye-slash"  toggle="#therapistLogin_password"></i></a>
                        </div>
                    </div>
                    <div class="form-field mb-4 pb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberme1">
                                    <label class="form-check-label" for="rememberme1">Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="Dreset" class="textLink">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" id="therapistLogin_submit" name="therapistLogin_submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </article>
<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

var doc_signIn_mobile_no = document.querySelector("#doc_signIn_mobile_no");
var telInputmobile = window.intlTelInput(doc_signIn_mobile_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$(document).ready(function(){

    $("#docLogin").validate({

        rules: {
            doc_signIn_mobile_no: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 15,
            },
            doc_signIn_otp: {
                required: true,
                number: true,
            },
            therapistLogin_password: {
                required: true,
                minlength: 8,
                maxlength: 20,
            },
        },

        messages: {

            doc_signIn_mobile_no: {
                required: "Please enter your mobile number",
                number: "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",

            },
            doc_signIn_otp: {
                required: "Please enter your 4 digit OTP",
                number: "Enter digits only",
            },
            therapistLogin_password : {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters",
            },
        },

        submitHandler: function(form){
            var formData = new FormData(form);
            $.ajax({
                url: "{{url('api/dLogin')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    if (response.status == true)
                    {
                        toastr.success(response.message);
                        window.location.href = "therapistDashboard";
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

    $("#toggle-pass").click(function() {
        $("#toggle-pass-image").toggleClass("fa-eye fa-eye-slash");
        var input = $("#therapistLogin_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    var button = $('#therapistLogin_submit');
    $(button).attr('disabled', 'disabled');

    $("#sendOtp").click(function(){

        var isValid = $('#doc_signIn_mobile_no').valid();

        if (isValid == true)
        {
            var doc_signIn_mobile_no = $("#doc_signIn_mobile_no").val();
            var dial_code = telInputmobile.getSelectedCountryData().dialCode;

            var UserMob = {"doc_signIn_mobile_no":doc_signIn_mobile_no, "dial_code":dial_code};

            $.ajax({
                url: "{{url('api/send')}}",
                type: "POST",
                data: UserMob,
                dataType: 'json',

                success:function(response){

                    if (response.status == true)
                    {
                        $("#doc_signIn_otp").val(response.otp);
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

    $("#verifyOtp").click(function(){

        var mobile = $('#doc_signIn_mobile_no').valid();
        var otp = $('#doc_signIn_otp').valid();

        if (mobile == true && otp == true)
        {
            var doc_signIn_mobile_no = $("#doc_signIn_mobile_no").val();
            var doc_signIn_otp = $("#doc_signIn_otp").val();
            var UserData = {"doc_signIn_mobile_no":doc_signIn_mobile_no,"doc_signIn_otp":doc_signIn_otp};

            $.ajax({
                url: "{{url('api/verify')}}",
                type: "POST",
                data: UserData,
                dataType: 'json',

                success:function(response){

                    if (response.status == true)
                    {
                        var button = $('#therapistLogin_submit');
                        $(button).removeAttr('disabled');
                        toastr.success(response.message);
                        $("#doc_signIn_mobile_no").attr('readonly','readonly');
                    }
                    else
                    {
                        var button = $('#therapistLogin_submit');
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