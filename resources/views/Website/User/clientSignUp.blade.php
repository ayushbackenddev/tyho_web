<div class="boxFormModal">
    <h2 class="text-center">Get Started</h2>
    <p class="text-center f15 mb-4 pb-2">Sign up with Talk Your Heart Out to book a session with our Therapists.<br/> After hours and weekend time slots available.</p>
    <form id="regForm" name="formSubmit" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-6 col-md-4">
                <div class="form-field">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="" maxlength="20"/>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="form-field">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="" maxlength="20"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-field">
                   <label class="form-label">Email <a class="iconTooltip" data-toggle="tooltip" title="Please use your company email address if you are an EAP client."><i class="fas fa-info-circle"></i></a> </label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="form-field">
                    <label class="form-label">Mobile</label>
                    <div class="input-group input-withButton">
                        <input type="tel" name="signUp_mobile_no" id="signUp_mobile_no" class="form-control only_digits" placeholder="" maxlength="15"/>
                        <button class="btn btn-primary" type="button" id="SendOTP">Send otp</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-field">
                    <label class="form-label">OTP <a class="iconTooltip" data-toggle="tooltip" title="A One Time Password (OTP) will be sent to your mobile number via SMS. This two-step verification (password & OTP) allows us to better protect your Talk Your Heart Out account."><i class="fas fa-info-circle"></i></a></label>
                    <div class="input-group">
                        <input type="text" id="signUp_otp" name="signUp_otp" class="form-control only_digits" placeholder="" />
                        <button class="btn btn-primary signUp_Verify" type="button" id="VerifyOTP">Verify</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-field">
                    <label class="form-label">How did you find us?</label>
                    <select class="form-control styledSelect selectFindus" name="how_did_you_find_us" id="how_did_you_find_us">
                        <option selected disabled></option>
                        <option>Google </option>
                        <option>Instagram</option>
                        <option>Facebook</option>
                        <option>YouTube </option>
                        <option>LinkedIn</option>
                        <option>Friend / family</option>
                        <option>Work</option>
                        <option>Digital media</option>
                        <option>Print</option>
                        <option>TV</option>
                        <option>Podcast / radio</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-field formcontrolOther">
                    <label class="form-label">Other</label>
                    <input type="text" class="form-control" placeholder="" id="find_us_other" name="find_us_other" />
                </div>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="form-field">
                    <label class="form-label">Set Password</label>
                    <div class="input-password">
                        <input type="password" name="signUp_password" id="signUp_password" class="form-control pr-password" placeholder="" maxlength="20"/>
                        <a class="iconEye" id="toggle-password"><i id="toggle-passwordImage" class="far fa-eye-slash" toggle="#signUp_password"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-field">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-password">
                        <input type="password" id="cnf_password" name="cnf_password" class="form-control" placeholder="" >
                        <a class="iconEye" id="toggle-password1"><i id="toggle-passwordImage1" class="far fa-eye-slash" toggle="#cnf_password"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-5 col-5">
                        <div class="form-field">
                            <label class="form-label">EAP Client? <a class="iconTooltip" data-toggle="tooltip" title="Please check this box if you are accessing employer-subsidised counselling services and mental health support through your company's Employee Assistance Programme (EAP) with Talk Your Heart Out."><i class="fas fa-info-circle"></i></a></label>
                            <div class="form-check pt-2 mt-1">
                                <input type="checkbox" name="EAP_client" id="EAP_client" class="form-check-input" value="1" onchange="valueChanged()">
                                <label class="form-check-label" for="EAP_client">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-7">
                        <div class="form-field" id="company_div">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3 mb-4 pb-2">
            <div class="col-md-4">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" id="signUp_submit" name="signUp_submit">Sign Up</button>
                </div>
            </div>
        </div>
        <div class="form-check mb-4 pb-2 message_bottom">
            <input type="checkbox" class="form-check-input" id="privacyPolicy" name="privacyPolicy">
            <label class="form-check-label f15" for="privacyPolicy" id="terms_conditions">I agree to the <a href="#" class="textLink">Terms of Use</a> and  <a href="#" class="textLink">Privacy Policy</a>.</label>
        </div>
        <p class="text-center m-0">If you are not an existing user, sign in <a href="#" class="textLink" id="signin">here</a>.</p>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/additional-methods.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script>

$("select").on("select2:close", function (e) {
    $(this).valid();
    $(this).parent().find("label").removeClass("error");
});

$(function(){
    $('.selectFindus').on('change', function() {
        var data = $(".selectFindus option:selected").text();
        if (data == "Other"){
            $(".formcontrolOther").addClass("show");
        }
        else{
            $(".formcontrolOther").removeClass("show");
            $(".formcontrolOther input").val("");
        }
    });
});

$("#company_div").hide();
//for show hide on checkbox
function valueChanged()
{
    if($('#EAP_client').is(":checked"))
        $("#company_div").show();
    else
        $("#company_div").hide();
}

var signUp_mobile_no = document.querySelector("#signUp_mobile_no");
var telInputmobile = window.intlTelInput(signUp_mobile_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$(function () {
    /*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    */

    $('[data-toggle="tooltip"]').tooltip();
})

$(function()
{

/*-------------------------password custom validation --------------*/
    // jQuery.validator.addMethod("pass", function(value, element, param) {
    //     return value.match(/^(?=.*\d)(?=.*[A-Z])(?=.*\W).*$/);
    // },'Please enter atleast one UpperCase, one LowerCase, one Number,one SpecialChar and min 8 Chars');


    $("#regForm").validate({
        rules: {
            first_name: {
                required: true,
                maxlength:20,
            },
            last_name: {
                required: true,
                maxlength:20,
            },
            email: {
                required: true,
                email:true,
            },
            signUp_mobile_no: {
                required: true,
                number: true,
                minlength: 6,
                maxlength:15,
            },
            signUp_otp: {
                required: true,
                number: true,
            },
            how_did_you_find_us: {
                required: true,
            },
            find_us_other: {
                required: true,
            },
            signUp_password: {
                required: true,
                //pass:true,
                minlength: 8,
                maxlength:20,
            },
            cnf_password: {
                equalTo: "#signUp_password",
            },
            company_name: {
                required: true,
            },
            privacyPolicy: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "Please enter a first name",
            },
            last_name: {
                required: "Please enter a last name",
            },
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address",
            },
            signUp_mobile_no: {
                required: "Please enter a mobile number",
                number: "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",
            },
            signUp_otp: {
                required: "Please enter your 4 digit OTP",
                number: "Enter digits only",
            },
            how_did_you_find_us: {
                required: "Please select one of the options",
            },
            find_us_other: {
                required: "Please provide details",
            },
            signUp_password: {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters",
            },
            cnf_password: {
                equalTo: "Passwords do not match",
            },
            company_name: {
                required: "Please provide the name of your employer",
            },
            privacyPolicy: {
                required: "Please review and accept our Terms of Use and Privacy Policy",
            },
        },

        submitHandler: function(form){
            var formData = new FormData(form);
            formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );
            $.ajax({
                url: "{{url('api/signUp')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    if (response.status == true)
                    {
                        $('#modelSignUp').modal('toggle');
                        window.location.href = "intake1/"+response.user_id;
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
        },
    });
});

$(document).ready(function(){

    /*$("#signUp_password").passwordRequirements({

    });*/

    // $(".only_digits").bind("keypress", function (e) {

    //     var keyCode = e.which ? e.which : e.keyCode

    //     if (!(keyCode >= 48 && keyCode <= 57)) {

    //         $(".error").css("display", "inline");

    //             return false;
    //         }
    //         else{

    //             $(".error").css("display", "inline");
    //         }
    //     }
    // });

    $('.styledSelect').select2();
    $("how_did_you_find_us").select2({minimumResultsForSearch: -1});

    //for show and hide password
    $("#toggle-password").click(function() {
        $("#toggle-passwordImage").toggleClass("fa-eye fa-eye-slash");
        var input = $("#signUp_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    $("#toggle-password1").click(function() {
        $("#toggle-passwordImage1").toggleClass("fa-eye fa-eye-slash");
        var input = $("#cnf_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    //for dissable enable button
    var button = $('#signUp_submit');
    $(button).attr('disabled', 'disabled');

    $("#signin").click(function(){
        $.ajax({
            type: "POST",
            url: "{{url('api/LoginForm')}}",
            dataType: "json",

            success: function (data){

                $('#modelSignUp').modal('hide');

                setTimeout(function(){
                    $("#loginFormBody").empty();
                    $("#loginFormBody").append(data.data);
                    $('#modelSignIn').modal('show');
                },800);
            },
            error: function (error) {
                console.log(error);
                toastr.error(error.message);
            }
        });
    });

    $("#SendOTP").click(function(){

        var isValid = $('#signUp_mobile_no').valid();

        if (isValid == true)
        {
            var signUp_mobile_no = $("#signUp_mobile_no").val();
            var dial_code = telInputmobile.getSelectedCountryData().dialCode;

            var UserMob = {"signUp_mobile_no":signUp_mobile_no, "dial_code":dial_code};

            $.ajax({
                url: "{{url('api/sendOtpForUser')}}",
                type: "POST",
                data: UserMob,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded",

                success:function(response){

                    if (response.status == true)
                    {
                        $("#signUp_otp").val(response.otp);
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

    $("#VerifyOTP").click(function(){

        var mobileNo = $('#signUp_mobile_no').valid();
        var Otp = $('#signUp_otp').valid();

        if (mobileNo == true && Otp == true)
        {
            var signUp_mobile_no = $("#signUp_mobile_no").val();
            var signUp_otp = $("#signUp_otp").val();
            var UserData = {"signUp_mobile_no":signUp_mobile_no,"signUp_otp":signUp_otp};

        $.ajax({
            url: "{{url('api/otpverifyForUser')}}",
            type: "POST",
            data: UserData,
            dataType: 'json',

            success:function(response){

               if (response.status == true)
                {
                    var button = $('#signUp_submit');
                    $(button).removeAttr('disabled');

                    // $('#signUp_mobile_no').keypress(function(e) {
                    //     return false
                    // });

                    // $('#signUp_otp').keypress(function(e) {
                    //     return false
                    // });
                    $("#signUp_mobile_no").attr('readonly','readonly');
                    toastr.success(response.message);
                }
                else
                {
                    var button = $('#signUp_submit');
                    $(button).attr('disabled', 'disabled');

                    // $('#signUp_mobile_no').keypress(function(e) {
                    //     return true
                    // });

                    // $('#signUp_otp').keypress(function(e) {
                    //     return true
                    // });
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