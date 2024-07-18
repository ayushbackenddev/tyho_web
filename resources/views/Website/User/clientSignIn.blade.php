<style type="text/css">

    #loginForm .iti__country-list
    {
        width: 400px;
    }

    /*#loginForm #client_singIn_mobile_no{
        width: 419px;
    }*/
</style>

<div class="boxFormModal">
    <h2 class="text-center">Sign In</h2>
    <p class="text-center f15 mb-4">Book and manage appointments with your Therapist and track your progress, all in one place.</p>
    <form id="loginForm" name="formSubmit" method="POST">
        @csrf
        <div class="form-field">
            <label class="form-label">Mobile</label>
            <input type="tel" id="client_singIn_mobile_no" name="client_singIn_mobile_no" class="form-control only_digits" maxlength="15" />
        </div>
        <div class="form-field mb-4">
            <label class="form-label">Password</label>
            <div class="input-password">
                <input type="password" name="client_password" id="client_password" class="form-control" placeholder="" maxlength="20" />
                <a class="iconEye" id="toggle-passw"><i id="toggle-pass-imageSignIn" class="far fa-eye-slash" toggle="#client_password"></i></a>
            </div>
        </div>
        <div class="form-field mb-4 pb-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberme2">
                        <label class="form-check-label" for="rememberme2">Remember me</label>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="textLink" id="forget">Forgot password?</a>
                </div>
            </div>
        </div>
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary btn-lg" id="client_login_submit" name="client_login_submit">Sign in</button>
        </div>
        <p class="text-center m-0">If you are not an existing user, sign up <a href="#" class="textLink" id="signup">here</a>.</p>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script>

var client_singIn_mobile_no = document.querySelector("#client_singIn_mobile_no");
var telInputmobile = window.intlTelInput(client_singIn_mobile_no, {
    separateDialCode: true,
    customPlaceholder: "",
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$(function()
{
    $("#loginForm").validate({
        rules: {
            client_singIn_mobile_no: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 15,
            },
            client_password: {
                required: true,
                minlength: 8,
                maxlength: 20,
            },
        },
        messages: {
            client_singIn_mobile_no: {
                required: "Please enter your mobile number",
                number: "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",
            },
            client_password: {
                required: "Please enter your password",
                minlength: "Password must be at least 8 characters",
            },
        },

        submitHandler: function(form){
            var formData = new FormData(form);
            formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );
            $.ajax({
                url: "{{url('api/signIn')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    if (response.status == true)
                    {
                        toastr.success(response.message);
                        $('#modelSignIn').modal('toggle');
                        window.location.href = "clientDashboard";
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

$(document).ready(function () {

    $(".only_digits").bind("keypress", function (e) {

        var keyCode = e.which ? e.which : e.keyCode

        if (!(keyCode >= 48 && keyCode <= 57)) {

            $(".error").css("display", "inline");

            return false;

            }
            else{

                $(".error").css("display", "inline");
            }

    });

    $("#toggle-passw").click(function() {
        $("#toggle-pass-imageSignIn").toggleClass("fa-eye fa-eye-slash");
        var input = $("#client_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    $("#forget").click(function(){
        $.ajax({
            type: "POST",
            url: "{{url('api/ResetPassword')}}",
            dataType: "json",

            success: function (data){

                $('#modelSignIn').modal('hide')

                setTimeout(function(){
                    $("#resetPassBody").empty();
                    $("#resetPassBody").append(data.data);
                    $('#modelResetPass').modal('show');

                },800);
                // $('#modelSignIn').modal('toggle');

                // $('#modelSignIn').one('hidden.bs.modal', function() {
                //     alert("1");
                //    $("#resetPass").empty();
                //     $("#resetPass").append(data.data);
                //     $('#modelResetPass').modal('show');
                // }).modal('hide');
            },
            error: function (error) {
              console.log(error);
              toastr.error(error.message);
            }
        });
    });

    $("#signup").click(function(){
        $.ajax({
            type: "POST",
            url: "{{url('api/RegForm')}}",
            dataType: "json",

            success: function (data){
                $('#modelSignIn').modal('hide')

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