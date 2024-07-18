@include('Website/Assets/headerForClient')

<!-- Content Code Start -->
<article>
    <div class="container">
        <div class="boxForm boxintakeForm boxFormBig boxintakeForm2">
            <h2 class="text-center mb-4">Intake Form (2 of 2)</h2>
            <form id="IntakeForm2" name="FormSubmit" method="POST">
                @csrf
                <input type="hidden" value="{{isset($id)?$id:''}}" id="id" name="id">
                <div class="form-field mb-3 pb-1">
                    <label class="form-label mb-3">Have you previously had one or more sessions with a psychologist, counsellor or social worker?</label>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" value="1" name="previously" id="yes1">
                        <label class="form-check-label" for="yes1"> Yes</label>
                    </div>
                    <div class="form-check d-inline-block">
                        <input class="form-check-input" type="radio" value="0" name="previously" id="yes2" checked>
                        <label class="form-check-label" for="yes2"> No</label>
                    </div>
                </div>
                <div class="form-field mb-5" id="previouslySessions">
                    <label class="form-label">If yes, please tell us when you last consulted someone and what they helped you with.*</label>
                    <input type="text" class="form-control " placeholder="" id="previously_had_any_sessions_with_anyone" name="previously_had_any_sessions_with_anyone" />
                </div>

                <div class="form-field mb-3 pb-1">
                    <label class="form-label mb-3">Are you currently consulting with a psychologist, counsellor or social worker?</label>
                    <div class="form-check d-inline-block me-2">
                        <input class="form-check-input" type="radio" value="1" name="currently" id="yes3">
                        <label class="form-check-label" for="yes3"> Yes</label>
                    </div>
                    <div class="form-check d-inline-block">
                        <input class="form-check-input" value="0" type="radio" name="currently" id="yes4" checked>
                        <label class="form-check-label" for="yes4"> No</label>
                    </div>
                </div>
                <div class="form-field mb-5" id="currentlyConsulting">
                    <label class="form-label">If yes, please tell us what they are helping you with.*</label>
                    <input type="text" class="form-control" placeholder="" id="are_you_currently_consulting_with_anyone" name="are_you_currently_consulting_with_anyone" />
                </div>
                <div class="form-field mb-5">
                    <label class="form-label mb-3">Please share the personal or professional goals that you would like to work towards with your Therapist.* (100 words max)
                    </label>
                    <textarea class="form-control textarea-md" id="share_personal_and_professional_goals" maxlength="100" name="share_personal_and_professional_goals"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="intake2_submit" name="intake2_submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</article>
<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

var button = $('#previouslySessions');
$(button).hide();

$('#yes1').click(function() {
    $(button).show();
});
$('#yes2').click(function() {
    $(button).hide();
});

var button1 = $('#currentlyConsulting');
$(button1).hide();

$('#yes3').click(function() {
    $(button1).show();
});
$('#yes4').click(function() {
    $(button1).hide();
});

var maxLength = 10;
$('textarea').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#textarea').text(textlen);
});

$(document).ready(function () {

    $("#IntakeForm2").validate({
        rules: {
            previously_had_any_sessions_with_anyone: {
                required: true,
            },
            are_you_currently_consulting_with_anyone: {
                required: true,
            },
            share_personal_and_professional_goals: {
                required: true,
                maxlength:100,
            },
        },
        messages: {
            previously_had_any_sessions_with_anyone: {
                required: "Please fill this",
            },
            are_you_currently_consulting_with_anyone: {
                required: "Please fill this",
            },
            share_personal_and_professional_goals: {
                required: "Please enter your goals here",
            },
        },
    });

    $("#IntakeForm2").on("submit", function(e){

        var validations = $("#IntakeForm2").valid();

        if (validations == false) {

            e.preventDefault();
        }
        else{

            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{url('api/intake2')}}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,

                success:function(response){
                    toastr.success(response.message);
                    window.location.href = "/";
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