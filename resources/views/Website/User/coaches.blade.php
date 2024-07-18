@include('Website/Assets/header')

<!-- Content Code Start -->

    <article>
        <div class="container">
            <div class="boxFull">
                <div class="row g-3 row_profileDetail">
                    <input type="hidden" value="{{isset($id)?$id:''}}" id="id" name="id">
                    <div class="col-md-8 profile_leftColumn" id="AddTherapistDataBox">

                    </div>
                    <div class="col-md-4 profile_rightColumn">
                        <div class="boxfill p-3">
                            <div class="content_innerBox">
                                <h3>What Therapist Can Help With:</h3>
                                <ul class="listCheck" id="therapist_can_help_with">

                                </ul>
                            </div>
                            <div class="content_innerBox">
                                <h3>Educational Qualifications/ Certifications:</h3>
                                <ul class="listCheck" id="therapeutic_qualifications_certifications">

                                </ul>
                            </div>
                            <div class="content_innerBox">
                                <h3>Professional Memberships / Affiliations</h3>
                                <ul class="listCheck" id="therapist_memberships_affilications">

                                </ul>
                            </div>
                            <div class="content_innerBox">
                                <h3>Therapeutic Approaches</h3>
                                <ul class="listCheck" id="therapist_therapeutic_approaches">

                                </ul>
                            </div>
                            <!-- <div class="content_innerBox">
                                <h3>Webinar Recordings</h3>
                                <ul class="listWebinar">
                                    <li>
                                        <a href="#">
                                            <span class="iconVideo"><i class="fas fa-video"></i></span>
                                            <p>Newly Married: Communication Pitfalls & What You Can Do</p>
                                            <ul class="listDate">
                                                <li>12 Jan 2020</li>
                                                <li>Online webinar</li>
                                            </ul>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="content_innerBox mb-0">
                                <h3>Blog Posts</h3>
                                <ul class="listBlog">
                                    <li>
                                        <div class="blogImage">
                                            <a href="#"><img src="{{url('assets/img/blog1.png')}}" alt="" title=""/> </a>
                                        </div>
                                        <div class="blogContent">
                                            <h5><a href="#">How To Do 5 Self-Care Tips Better</a> </h5>
                                            <span class="text_date">12 Jan 2020 </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="blogImage">
                                            <a href="#"><img src="{{url('assets/img/blog1.png')}}" alt="" title=""/> </a>
                                        </div>
                                        <div class="blogContent">
                                            <h5><a href="#">How To Do 5 Self-Care Tips Better</a> </h5>
                                            <span class="text_date">12 Jan 2020 </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="blogImage">
                                            <a href="#"><img src="{{url('assets/img/blog1.png')}}" alt="" title=""/> </a>
                                        </div>
                                        <div class="blogContent">
                                            <h5><a href="#">How To Do 5 Self-Care Tips Better</a> </h5>
                                            <span class="text_date">12 Jan 2020 </span>
                                        </div>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

$(document).ready(function () {

    var id = $("#id").val();

    $.ajax({
        type: "POST",
        url: "{{url('api/singleCoacheData')}}",
        dataType: "json",
        data: {"id":id},

        success: function (response){

            if (response.status == true)
            {
                $("#AddTherapistDataBox").append(response.singleTherapistData);

                $("#therapist_can_help_with").html(response.data.what_therapist_can_help_with_1);
                $("#therapeutic_qualifications_certifications").html(response.data.educational_qualification_certification);
                $("#therapist_memberships_affilications").html(response.data.professional_membership_affiliation);
                $("#therapist_therapeutic_approaches").html(response.data.therapist_therapeutic_approaches);
            }
        },
        error: function (error)
        {
            toastr.error(error.message);
        }
    });

});
</script>