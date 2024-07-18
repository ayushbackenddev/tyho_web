<div class="boxFormModal">
    <h2 class="text-center">Reset Password</h2>
    <p class="text-center f15 mb-4">Email us at contact@talkyourheartout.com if you face any issues.</p>
    <form id="resetForm" name="formSubmit" method="POST">
    @csrf
        <div class="form-field">
            <label class="form-label">Mobile</label>
            <div class="input-group input-withButton">
                <input type="tel" id="client_reset_mobile_no" name="client_reset_mobile_no" class="form-control only_digits" placeholder="" maxlength="15" />
                <button class="btn btn-primary" type="button" id="sendResetOtp">Send otp</button>
            </div>
        </div>
        <div class="form-field">
            <label class="form-label">OTP</label>
            <div class="input-group errorInline">
                <input type="text" id="client_reset_otp" name="client_reset_otp" class="form-control only_digits" placeholder="" />
                <button class="btn btn-primary clientReset_Verify" type="button" id="verifyResetOtp">Verify</button>
            </div>
        </div>
        <div class="form-field mb-4">
            <label class="form-label">New Password</label>
            <div class="input-password">
                <input type="password" id="clientReset_password" name="clientReset_password" class="form-control" placeholder="" maxlength="20" />
                <a class="iconEye" id="toggle-pas"><i id="toggle-pas-image" class="far fa-eye-slash" toggle="#clientReset_password"></i></a>
            </div>
        </div>
        <div class="form-field mb-4">
            <label class="form-label">Confirm New Password</label>
            <div class="input-password">
                <input type="password" id="cnf_clientReset_password" name="cnf_clientReset_password" class="form-control" placeholder="" />
                <a class="iconEye" id="toggle-pas1"><i id="toggle-pas1-image" class="far fa-eye-slash" toggle="#cnf_clientReset_password"></i></a>
            </div>
        </div>
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary btn-lg" name="clientReset" id="clientReset">RESET</button>
        </div>
        <p class="text-center m-0">If you are not an existing user, sign up <a href="#" class="textLink" id="register">here</a>.</p>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/additional-methods.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script>

var client_reset_mobile_no = document.querySelector("#client_reset_mobile_no");
var telInputmobile = window.intlTelInput(client_reset_mobile_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$(function()
{
    $("#resetForm").validate({
        rules: {
            client_reset_mobile_no: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 15,
            },
            client_reset_otp: {
                required: true,
                number: true,
            },
            clientReset_password: {
                required: true,
                minlength: 8,
                maxlength: 20,
            },
            cnf_clientReset_password: {
                equalTo: "#clientReset_password",
            }
        },
        messages: {
            client_reset_mobile_no: {
                required: "Please enter your mobile number",
                number: "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",
            },
            client_reset_otp: {
                required: "Please enter your 4 digit OTP",
                number: "Enter digits only",
            },
            clientReset_password: {
                required: "Please enter a new password",
                minlength: "Password must be at least 8 characters",
            },
            cnf_clientReset_password: {
                equalTo: "Passwords do not match",
            },
        },

        submitHandler: function(form){
            var formData = new FormData(form);
            formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );
            $.ajax({
                url: "{{url('api/resetUserPassword')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    if (response.status == true)
                    {
                        $('#modelResetPass').modal('toggle');
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
        },
    });
});

$(document).ready(function(){

    // $(".only_digits").bind("keypress", function (e) {

    //     var keyCode = e.which ? e.which : e.keyCode

    //     if (!(keyCode >= 48 && keyCode <= 57)) {

    //         $(".error").css("display", "inline");

    //         return false;

    //         }
    //         else{

    //             $(".error").css("display", "inline");
    //         }

    // });

    $("#toggle-pas").click(function() {
        $("#toggle-pas-image").toggleClass("fa-eye fa-eye-slash");
        var input = $("#clientReset_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    $("#toggle-pas1").click(function() {
        $("#toggle-pas1-image").toggleClass("fa-eye fa-eye-slash");
        var input = $("#cnf_clientReset_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    var button = $('#clientReset');
    $(button).attr('disabled', 'disabled');

    $("#sendResetOtp").click(function(){

        var isvalid = $('#client_reset_mobile_no').valid();

        if (isvalid == true)
        {
            var client_reset_mobile_no = $("#client_reset_mobile_no").val();
            var dial_code = telInputmobile.getSelectedCountryData().dialCode;

            var UserMob = {"client_reset_mobile_no":client_reset_mobile_no, "dial_code":dial_code};

            $.ajax({
                url: "{{url('api/userSendOtp')}}",
                type: "POST",
                data: UserMob,
                dataType: 'json',

                success:function(response){

                    if (response.status == true)
                    {
                        $("#client_reset_otp").val(response.otp);
                        toastr.success(response.message);
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

    $("#verifyResetOtp").click(function(){

        var mobile = $('#client_reset_mobile_no').valid();
        var otp = $('#client_reset_otp').valid();

        if (mobile == true && otp == true)
        {
            var client_reset_mobile_no = $("#client_reset_mobile_no").val();
            var client_reset_otp = $("#client_reset_otp").val();

            var UserData = {"client_reset_mobile_no":client_reset_mobile_no,"client_reset_otp":client_reset_otp};

            $.ajax({
                url: "{{url('api/userVerifyOtp')}}",
                type: "POST",
                data: UserData,
                dataType: 'json',

                success:function(response){

                    if (response.status == true)
                    {
                        var button = $('#clientReset');
                        $(button).removeAttr('disabled');

                        // $('#client_reset_mobile_no').keypress(function(e) {
                        //     return false
                        // });

                        // $('#client_reset_otp').keypress(function(e) {
                        //     return false
                        // });
                        $("#client_reset_mobile_no").attr('readonly','readonly');
                        toastr.success(response.message);
                    }
                    else
                    {
                        var button = $('#clientReset');
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

    $("#register").click(function(){
        $.ajax({
            type: "POST",
            url: "{{url('api/RegForm')}}",
            dataType: "json",

            success: function (data){
                $('#modelResetPass').modal('hide')

                setTimeout(function(){
                    $("#regFormBody").empty();
                    $("#regFormBody").append(data.data);
                    $('#modelSignUp').modal('show');
                },800);
            },
            error: function (error) {
                console.log(error);
                toastr.error(error.message);
            }
        });
    });
});
</script>