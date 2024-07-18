<form id="clientEditProfile" method="POST" name="formSubmit">
    <div class="row">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="" name="first_name" value="{{$editProfile->first_name}}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" placeholder="" name="last_name" value="{{$editProfile->last_name}}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Email <a href="#" class="iconTooltip" data-toggle="tooltip" title="Please note that we will send all future correspondence to this email address."><i class="fas fa-info-circle"></i></a></label>
                <input type="text" class="form-control" placeholder="" name="email" value="{{$editProfile->email}}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Mobile</label>
                <div class="input-group input-withButton">
                    <input type="hidden" class="form-control" id="isMobileVerified" name="isMobileVerified" value="0" />
                    <input type="tel" class="form-control" name="mobile_no" id="mobile_no" placeholder=""/>
                    <button class="btn btn-primary" id="SendOTP" type="button">Send otp</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">OTP <a href="#" class="iconTooltip" data-toggle="tooltip" title="A One Time Password (OTP) will be sent to your mobile number via SMS. This two-step verification (password & OTP) allows us to better protect your Talk Your Heart Out account."><i class="fas fa-info-circle"></i></a></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="otp" name="otp" placeholder="" />
                    <button class="btn btn-primary" id="VerifyOTP" type="button">Verify</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Password</label>
                <div class="input-password">
                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="" >
                    <a class="iconEye" id="toggle-current-passw"><i id="toggle-current-pass-imageSignIn" class="far fa-eye-slash" toggle="#client_password"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">New Password</label>
                <div class="input-password">
                    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="">
                    <a class="iconEye" id="toggle-new-passw"><i id="toggle-new-pass-imageSignIn" class="far fa-eye-slash" toggle="#client_password"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Confirm New Password</label>
                <div class="input-password">
                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="">
                    <a class="iconEye" id="toggle-confirm-passw"><i id="toggle-confirm-pass-imageSignIn" class="far fa-eye-slash" toggle="#client_password"></i></a>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-3">
            <div class="d-grid">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg">Update</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">

var mobile_no = document.querySelector("#mobile_no");
var telInputmobile = window.intlTelInput(mobile_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$("#toggle-current-passw").click(function() {
        $("#toggle-current-pass-imageSignIn").toggleClass("fa-eye fa-eye-slash");
        var input = $("#current_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    $("#toggle-new-passw").click(function() {
        $("#toggle-new-pass-imageSignIn").toggleClass("fa-eye fa-eye-slash");
        var input = $("#newpassword");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });


    $("#toggle-confirm-passw").click(function() {
        $("#toggle-new-confirm-imageSignIn").toggleClass("fa-eye fa-eye-slash");
        var input = $("#confirmpassword");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

$("#SendOTP").click(function(){

    var mobile_no = $("#mobile_no").val();
    var dial_code = telInputmobile.getSelectedCountryData().dialCode;

    var UserMob = {"mobile_no":mobile_no, "dial_code":dial_code};

    $.ajax({
        url: "{{url('api/sendOtpClient')}}",
        type: "POST",
        data: UserMob,
        dataType: 'json',
        contentType: "application/x-www-form-urlencoded",

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
});

$("#VerifyOTP").click(function(){

    var mobileNo = $('#mobile_no').valid();
    var Otp = $('#otp').valid();

    if (mobileNo == true && Otp == true)
    {
        var mobile_no = $("#mobile_no").val();
        var otp = $("#otp").val();
        var UserData = {"mobile_no":mobile_no,"otp":otp};

    $.ajax({
        url: "{{url('api/otpverifyClient')}}",
        type: "POST",
        data: UserData,
        dataType: 'json',

        success:function(response){

           if (response.status == true)
            {
                $("#mobile_no").attr('readonly','readonly');
                $("#isMobileVerified").val("1");
                $(button).attr('disabled', 'enable');
                toastr.success(response.message);
            }
            else
            {
                var button = $('#submit');
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
    
$("#clientEditProfile").on("submit", function(e){

    e.preventDefault();

    var formData = new FormData(this);
    formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );

    $.ajax({
        url: "{{url('api/updateClientProfile')}}",
        type: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success:function(response){

            if (response.status == true)
            {
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
});

</script>