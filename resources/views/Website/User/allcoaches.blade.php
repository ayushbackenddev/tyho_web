@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <div class="container">
        <div class="box_top_content">
            <h2 class="heading-md">Who They Are</h2>
            <p>Our Therapists (ie psychologists and counsellors) can help you cope, heal, and thrive, wherever you are in life.</p>
            <p class="mb-4">They not only have the right qualifications (min. Master’s degree) and professional training, but are also aligned with TYHO values. These include being empathetic, non-judgmental and sensitive to different viewpoints. Together, their diversity in background and skills will allow you to find someone who best suits your needs.</p>
            <h2 class="heading-md">Select a Therapist <a class="iconTo  oltip" data-toggle="tooltip" title="Counsellors are highly skilled in applying integrative therapies to assist people in working through their personal and emotional issues. Psychologists use evidence-based strategies to diagnose and manage more serious mental health illnesses and disorders non-medicinally over the long-term. "><i class="fas fa-info-circle"></i></a></h2>
            <p class="mb-4">You may wish to read the full profiles of our Therapists below before selecting someone suitable.  Watch their video if you would like to hear more from them (by clicking on the playback button on their photos).</p>
            <div class="boxNeed mb-4">
                <p class="mb-0 f15"><span class="fw-medium text-primary">Need help with selecting someone?</span>   Filter and sort our Therapists based on your requirements <a href="/"><strong>HERE</strong></a>.
                </p>
            </div>
        </div>
        <div class="boxfill boxTherapists mb-5">
            <div class="row mb-4" id="AddTherapist">

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
        url: "{{url('api/AllCoaches')}}",
        dataType: "json",
        data: {"id":id},

        success: function (response){

            if(response.therapistData.length > 0)
            {
                $("#AddTherapist").html("");
            }

            $("#AddTherapist").append(response.therapistData);

        },
        error: function (error)
        {
            toastr.error(error.message);
        }
    });
});
</script>