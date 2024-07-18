<form id="TherapistEditForm" name="FormSubmit" method="POST">
    <h4>Contact Details</h4>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Mobile</label>
                <div class="input-group input-withButton">
                    <input type="tel" id="mobile_no" name="mobile_no" class="form-control" placeholder="" />
                    <button class="btn btn-primary" type="button" id="sendOtpButton" name="sendOtp">Send otp</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">OTP <a href="#" class="iconTooltip" data-toggle="tooltip" title="A One Time Password (OTP) will be sent to your mobile number via SMS. This two-step verification (password & OTP) allows us to better protect your Talk Your Heart Out account."><i class="fas fa-info-circle"></i></a></label>
                <div class="input-group">
                    <input type="text" name="otp" id="otp" class="form-control" placeholder="" />
                    <button class="btn btn-primary" type="button" id="verifyOtpButton">Verify</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Email <a href="#" class="iconTooltip" data-toggle="tooltip" title="Please note that we will send all future correspondence to this email address."><i class="fas fa-info-circle"></i></a></label>
                <input type="text" class="form-control" placeholder="" name="email" id="email" value="{{$showEmail->email}}" />
                <div class="form-text">Note: You will receive a verification email to confirm the change 
                    in email address.</div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="d-grid">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg">Update</button>
            </div>
        </div>
    </div>
</form>

<script>

var mobile_no = document.querySelector("#mobile_no");
var telInputmobile = window.intlTelInput(mobile_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$("#sendOtpButton").click(function(){

    var isValid = $('#mobile_no').valid();

    if (isValid == true)
    {
        var mobile_no = $("#mobile_no").val();
        var dial_code = telInputmobile.getSelectedCountryData().dialCode;

        var TherapistMob = {"mobile_no":mobile_no, "dial_code":dial_code};

        $.ajax({
            url: "{{url('api/sendOtp')}}",
            type: "POST",
            data: TherapistMob,
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

$("#verifyOtpButton").click(function(){

    var mobile = $('#mobile_no').valid();
    var otp = $('#otp').valid();

    if (mobile == true && otp == true)
    {
        var mobile_no = $("#mobile_no").val();
        var otp = $("#otp").val();
        var UserData = {"mobile_no":mobile_no,"otp":otp};

        $.ajax({
            url: "{{url('api/verifyOtp')}}",
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

$("#TherapistEditForm").on("submit", function(e){

    e.preventDefault();
    var formData = new FormData(this);

    formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );

    $.ajax({
        url: "{{url('api/therapistProfileUpdate')}}",
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
                toastr.error(error.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});

</script>