@include('Website/Assets/headerForTherapist')

<!-- Content Code Start -->
<article>
    <div class="container">
            <h2 class="mb-3 heading-md">What We Look For</h2>
            <p class="mb-3">We are passionate about providing counselling services that are convenient, accessible and of high quality, at more affordable rates. To this end, we are always looking for like-minded individuals to partner with us as Therapists.</p>
            <p class="mb-3">We look for the following qualifications and attributes:</p>
            <ul class="listContent">
                <li>A minimum of a master's degree.​</li>
                <li>Excellent communication skills, and alignment with TYHO values of being non-judgemental and empathetic in interactions with clients, sensitive to diverse backgrounds (eg sexual orientations, cultural identities, or language abilities), and professional.</li>
                <li>Reliable internet connection, and a personal computer or device!</li>
            </ul>
            <h2 class="mb-3 heading-md">Benefits of Joining TYHO</h2>
            <p class="mb-2">Our platform supports Therapists in a number of ways allowing them to focus on therapy and achieving the best outcomes for their clients. We offer the following benefits to Therapists who join our platform:</p>
            <div class="contentBenefits">
                <div class="imgPhysical"><img src="{{url('assets/img/physical-img.png')}}" alt="" title=""/></div>
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <ul class="listBenefits listBenefitsLeft">
                            <li>
                                <div class="infoBox">
                                    <p>End to end support for marketing, billing & scheduling. </p>
                                    <span class="iconBenefits"><i class="fas fa-bullhorn"></i></span>
                                </div>
                            </li>
                            <li>
                                <div class="infoBox">
                                    <p>Easy online case management system providing information on upcoming & past appointments, client profiles, etc. </p>
                                    <span class="iconBenefits"><i class="fas fa-tasks"></i></span>
                                </div>
                            </li>
                            <li>
                                <div class="infoBox">
                                    <p>Flexible work, truly - choose your own workplace, days & hours.</p>
                                    <span class="iconBenefits"><i class="fas fa-laptop-house"></i></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                     <div class="col-md-4 hideMobile">
                            <img src="assets/img/physical-img.png" alt="" title=""/>
                    </div>
                    <div class="col-md-4">
                        <ul class="listBenefits listBenefitsRight">
                            <li>
                                <div class="infoBox">
                                    <p>Work from anywhere around the world! </p>
                                    <span class="iconBenefits"><i class="fas fa-globe"></i></span>
                                </div>
                            </li>
                            <li>
                                <div class="infoBox">
                                    <p>Leave client management to us, including sending of booking confirmations, reminders & follow ups.</p>
                                    <span class="iconBenefits"><i class="fas fa-user-clock"></i></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="boxTestimonials">
                <h2 class="mb-3 heading-md">Testimonials</h2>
                <div id="carouselTestimonials" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <p> TYHO has been a huge blessing for so many of my clients because it offers them the accessibility and convenience of looking and booking for a counsellor from the privacy of their homes. As a counsellor offering online counselling through THYO I have found that the clients and I have benefitted from being able to conduct counselling through variant time ranges. Lastly, the confidentiality and safety offered by the way TYHO conducts their correspondence with the clients has given me the peace of mind to know that the client -from the moment of contact with TYHO till I see them in our virtual counselling room- is held in a safe space.</p>
                        </div>
                        <div class="carousel-item">
                            <p> Working with TYHO has been great! TYHO manages the marketing and administrative aspects well, allowing me to focus fully on what I was trained to do and what I love doing – helping people with emotional difficulties. It allows me to build my private practice without having to worry about peripheral aspects such as a social media presence and building my website. I also appreciate the flexibility provided by platform. Thank you, TYHO!</p>
                        </div>
                        <div class="carousel-item">
                            <p>  Shilpa, the founder of TYHO, has created an amazing online counseling platform that allows individuals to receive support in a way that feels most safe to them. The platform is easy to navigate, and Shilpa is responsive to both clients and therapists, ensuring everyone’s needs are met. Besides providing online counseling, TYHO often collaborates with other mental health platforms, to advocate for mental health support through podcasts and/or webinars. This is truly a reflection of Shilpa’s passion for mental health and her drive for creating a platform like TYHO. Support for mental health should be accessible to everyone, and it should be an easy and safe process. I truly believe that TYHO has accomplished that.</p>
                        </div>
                    </div>
                    </div>
            </div>

            <div class="formJoining">
                <p class="mb-5">Thank you for your interest in joining us as a Therapist. We are excited about working with you to make counselling more accessible, affordable, and convenient. Please leave a message here, and someone from our team will contact you soon.</p>
                <form id="expressionForm" name="formSubmit" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 col-md-4">
                            <div class="form-field">
                                <label class="form-label">First Name*</label>
                                <input type="text" id="expression_first_name" maxlength="20" name="expression_first_name" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-field">
                                <label class="form-label">Last Name*</label>
                                <input type="text" id="expression_last_name" maxlength="20" name="expression_last_name" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">Email*</label>
                                <input type="email" id="expression_email" name="expression_email" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">Mobile*</label>
                                <div class="input-group">
                                    <input type="tel" id="expression_phone" name="expression_phone" maxlength="15" class="form-control only_digits" placeholder=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">Current Occupation*</label>
                                <select class="form-control styledSelect selectOccupation" id="current_occupation" name="current_occupation" >
                                    <option selected disabled></option>
                                    <option>Psychologist</option>
                                    <option>Counsellor</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="form-field boxOccupationOther">
                                <label class="form-label">Other*</label>
                                <div class="input-group">
                                    <input type="text" id="other_occupation" name="other_occupation" class="form-control"  placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">Highest Qualifications*</label>
                                <input type="text" id="highest_qualifications" name="highest_qualifications" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">Relevant Experience (years)*</label>
                                <input type="text" id="relevant_experience" name="relevant_experience" class="form-control" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">Languages*</label>
                                <div class="input-group">
                                    <select name="languages[]" id="languages" multiple>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">Upload CV</label>
                                <div class="input-group">
                                    <input type="file" id="upload_cv" name="upload_cv" class="filestyle form-control" placeholder="Upload Document" data-buttonText="<i class='fas fa-file-upload'></i>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-field">
                                <label class="form-label">LinkedIn Profile</label>
                                <div class="input-group">
                                    <input type="text" id="linkedin_profile" name="linkedin_profile" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-field">
                        <label class="form-label">Tell us more about yourself and why you would like to join TYHO.*</label>
                        <div class="input-group">
                            <textarea class="form-control textarea-lg" id="tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO" name="tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="row pt-4 mb-5">
                        <div class="col-md-4">
                            <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="expression_submit" name="expression_submit">submit</button>
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

$(function(){
    $('.selectOccupation').on('change', function() {
      var data = $(".selectOccupation option:selected").text();
      if (data == "Other"){
        $(".boxOccupationOther").addClass("show");
      }
      else{
        $(".boxOccupationOther").removeClass("show");
        $(".boxOccupationOther input").val("");
      }
    })
});

/*var $current_occupation = $('#current_occupation'), $other_occupation = $('#other_occupation');
$current_occupation.change(function () {
    if ($current_occupation.val() == 'other')
    {
        $other_occupation.removeAttr('disabled');
    }
    else
    {
        $other_occupation.attr('disabled', 'disabled').val('');
    }
}).trigger('change');*/

var expression_phone = document.querySelector("#expression_phone");
var telInputmobile = window.intlTelInput(expression_phone, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$(document).ready(function () {

/*-------------------------email custom validation --------------*/
jQuery.validator.addMethod("emailExt", function(value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter a valid email address');


/*-------------------------extension custom validation --------------*/
jQuery.validator.addMethod("extension", function (value, element, param) {
    param = typeof param === "string" ? param.replace(/,/g, '|') : "pdf|doc|docx";
    return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
},'Please select only pdf and doc file');

    $("#expressionForm").validate({
        rules: {
            expression_first_name: {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            expression_last_name: {
                required: true,
                minlength: 2,
                maxlength: 20,
            },
            expression_email: {
                required: true,
                emailExt:true,
            },
            expression_phone: {
                required: true,
                number:true,
                minlength: 6,
                maxlength: 15,
            },
            current_occupation: {
                required: true,
            },
            other_occupation:{
                required:true,
            },
            highest_qualifications: {
                required: true,
            },
            relevant_experience: {
                required: true,
                number:true,
            },
            upload_cv: {
                extension: "pdf|doc|docx",
            },
            'languages[]': {
                required: true,
            },
            tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO: {
                required: true,
            },
        },
        messages: {
            expression_first_name: {
                required: "Please enter your first name",
                minlength: "Please enter at least 2 characters",
            },
            expression_last_name: {
                required: "Please enter your last name",
                minlength: "Please enter at least 2 characters",
            },
            expression_email: {
                required: "Please enter your email address",
            },
            expression_phone: {
                required: "Please enter your phone number",
                number: "Only digits are allowed",
                minlength: "Mobile number must be at least 6 digits",
            },
            current_occupation: {
                required: "Please select one of the options",
            },
            other_occupation:{
                required: "Please provide your occupation",
            },
            highest_qualifications: {
                required: "Please enter your highest qualifications",
            },
            relevant_experience: {
                required: "Please enter a value here",
                number: "Only digits are allowed",
            },
            upload_cv: {
                extension: "Please select only pdf and doc file",
            },
            'languages[]': {
                required: "Please enter your spoken languages",
            },

            tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO: {
                required: "Please tell us more about yourself here",
            },
        }
    });

    $("#expressionForm").on("submit", function(e){

        var validation = $("#expressionForm").valid();
        if (validation == false) {

            e.preventDefault();
        }
        else
        {
            e.preventDefault();

            var formData = new FormData(this);

            formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );

            $.ajax({
                url: "{{url('api/expression')}}",
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
        }
    });

    $.ajax({
        url: "{{url('api/getlanguages')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

            $('#languages').empty();
            $('#languages').append('<option value="" disabled="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                $('#languages').append('<option value="' + data.id + '">' + data.language_name + '</option>');
            });
        }
    });
});
</script>