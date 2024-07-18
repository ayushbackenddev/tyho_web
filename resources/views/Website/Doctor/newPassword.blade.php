@include('Website/Assets/headerForTherapist')

<!-- Content Code Start -->
    <article>
        <div class="container">
            <div class="boxForm">
                <h2 class="text-center">Set Password</h2>
                <p class="text-center f15 mb-4">Email us at contact@talkyourheartout.com if you face any issues.</p>
                <form id="docSetPassForm" name="formSubmit" method="POST">
                @csrf
                    <div class="form-field mb-4">
                        <input type="hidden" value="{{isset($id)?$id:''}}" id="id" name="id">
                        <label class="form-label">New Password</label>
                        <div class="input-password">
                            <input type="password" id="tharapistSet_password" name="tharapistSet_password" class="form-control pr-password" placeholder="" maxlength="20"/>
                            <a class="iconEye" id="toggle-pswd"><i id="toggle-pass-image" class="far fa-eye-slash" toggle="#tharapistSet_password"></i></a>
                        </div>
                    </div>
                    <div class="form-field mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-password">
                            <input type="password" id="cnf_tharapistSet_password" name="cnf_tharapistSet_password" class="form-control" placeholder="" />
                            <a class="iconEye" id="toggle-pswd1"><i id="toggle-pass-image1" class="far fa-eye-slash" toggle="#cnf_tharapistSet_password"></i></a>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" id="therapistSet_submit" name="therapistSet_submit">SET</button>
                    </div>
                </form>
            </div>
        </div>
    </article>
<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

/*-------------------------password custom validation --------------*/
    jQuery.validator.addMethod("pass", function(value, element, param) {
        return value.match(/^(?=.*\d)(?=.*[A-Z])(?=.*\W).*$/);
    },'Please enter atleast one UpperCase, one LowerCase, one Number,one SpecialChar and min 8 Chars');

$(document).ready(function(){

    $("#docSetPassForm").validate({

        rules: {
            tharapistSet_password: {
                required: true,
                pass:true,
                minlength: 8,
                maxlength: 20,
            },
            cnf_tharapistSet_password: {
                equalTo: "#tharapistSet_password",
            },
        },
        messages: {
            tharapistSet_password : {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters",
            },
            cnf_tharapistSet_password: {
                equalTo: "Passwords do not match",
            }
        },

        submitHandler: function(form){
            var formData = new FormData(form);
            $.ajax({
                url: "{{url('api/setTherapistPassword')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){

                    if (response.status == true)
                    {
                        toastr.success(response.message);
                        window.location.replace("{{url('/Dlogin')}}");
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
        var input = $("#tharapistSet_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });

    $("#toggle-pswd1").click(function() {
        $("#toggle-pass-image1").toggleClass("fa-eye fa-eye-slash");
        var input = $("#cnf_tharapistSet_password");
        if (input.prop("type") == "password") {
            input.prop("type", "text");
        }
        else{
            input.prop("type", "password");
        }
    });
});
</script>