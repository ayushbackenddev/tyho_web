@include('Website/Assets/headerForTherapist')

<!-- Content Code Start -->

<article>
    <div class="container">
        <input type="hidden" name="therapist_id_fk" id="therapist_id_fk" value="{{ Session::get('loggedTherapist') }}">
        <div class="boxSessions boxSessions_therapist">
            <div class="row">
                <div class="col-md-9">
                    <div class="boxfill boxSessionsInner">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-6">
                                <h2 class="mb-0">Your Sessions</h2>
                            </div>
                            <div class="col-md-6 text-end">
                                <ul class="listOptions">
                                    <li><a href="#">Upcoming</a></li>
                                    <li class="active"><a href="#">Passed</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pb-3">
                            You have <strong><span id="therapist_session_count"></span></strong>  upcoming sessions
                            <div class="dropdown d-inline ms-1 dropdown-total">
                                <a class="dropdown-toggle"  id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">in total</a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                                    <li>
                                        <div class="form-check">
                                            <input type="radio"  class="form-check-input" name="1"/>
                                            <label class="form-check-label" for="issue_financial_stress">in total</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="radio"  class="form-check-input" name="1" />
                                            <label class="form-check-label" for="issue_addictions">today</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="radio"  class="form-check-input" name="1" />
                                            <label class="form-check-label" for="issue_habit_change">tomorrow</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="radio"  class="form-check-input" name="1" />
                                            <label class="form-check-label" for="issue_cultural_adjustment">this week </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="radio"  class="form-check-input" name="1" />
                                            <label class="form-check-label" for="issue_trauma_or_ptsd">next week </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="radio"  class="form-check-input" name="1" />
                                            <label class="form-check-label" for="issue_trauma_or_ptsd">this month</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input type="radio"  class="form-check-input" name="1" />
                                            <label class="form-check-label" for="issue_trauma_or_ptsd">next month</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row row_mainsessions" id="session_details">
                            
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-3 mb-4">
                              <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                              <li class="page-item"><a class="page-link" href="#">2</a></li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                            </ul>
                          </nav>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="boxLeftMenu">
                        <ul class="menuLeft">
                            <li><a href="{{url('editTherapistProfile')}}"><span class="icon_menu"><i class="far fa-edit"></i></span> My Profile</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-sliders-h"></i></span> Preferences</a> </li>
                            <li><a href="{{url('myClients')}}"><span class="icon_menu"><i class="fas fa-user"></i></span> Clients</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-network-wired"></i></span> Referrals</a> </li>
                        </ul>
                        <hr class="mb-2">
                        <ul class="menuLeft">
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-cogs"></i></span> Resources </a> </li>
                        </ul>
                        <hr class="mb-2">
                        <ul class="menuLeft">
                            <li><a href="{{url('/couponview')}}"><span class="icon_menu"><i class="fas fa-tag"></i></span> Coupon</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-comments"></i></span> Message Client </a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-wallet"></i></span> Payment Notes</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-clipboard"></i></span> Case Notes</a> </li>
                            <li><a href="{{url('/calender_view')}}"><span class="icon_menu"><i class="fas fa-clipboard"></i></span> Calender</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="section_Events">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-md-6 align-items-center">
                        <h2>Events</h2>
                    </div>
                    <div class="col-md-6 text-end">
                        <ul class="listOptions">
                            <li class="active"><a href="#">Upcoming</a></li>
                            <li><a href="#">Passed</a></li>
                        </ul>
                    </div>
                </div>
                <div class="outerSliderBox">
                    <div class="owl-carousel owl-carousel-events owl-theme">
                        <div class="item">
                            <div class="boxEvents">
                                <h4>Lorem Ipsum is simply dummy </h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.  industry. Lorem Ipsum has been.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <div class="eventsInner">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="userBox">
                                                <div class="boxUserImg">
                                                    <img src="assets/img/coach-1.png" alt="" title=""/>
                                                </div>
                                                <h5>Alicia Prescott</h5>
                                                <p>Life Coach & Counsellor</p>
                                            </div>
                                            <ul class="listTimeTables">
                                                <li>
                                                    <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                                    12 Dec 2020, 2:00 PM to 4:00 PM (SGT)
                                                </li>
                                                <li>
                                                    <span class="icon"><i class="fas fa-globe-americas"></i></span>
                                                    Online webinar (Zoom)
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <p><a href="#" class="btn btn-primary d-block">Book Now </a></p>
                                            <div class="textEventPrice">
                                                <h3>S$120</h3>
                                                <p>per person</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="boxEvents">
                                <h4>Lorem Ipsum is simply dummy </h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.  industry. Lorem Ipsum has been.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <div class="eventsInner">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="userBox">
                                                <div class="boxUserImg">
                                                    <img src="assets/img/coach-1.png" alt="" title=""/>
                                                </div>
                                                <h5>Alicia Prescott</h5>
                                                <p>Life Coach & Counsellor</p>
                                            </div>
                                            <ul class="listTimeTables">
                                                <li>
                                                    <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                                    12 Dec 2020, 2:00 PM to 4:00 PM (SGT)
                                                </li>
                                                <li>
                                                    <span class="icon"><i class="fas fa-globe-americas"></i></span>
                                                    Online webinar (Zoom)
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <p><a href="#" class="btn btn-primary d-block">Book Now </a></p>
                                            <div class="textEventPrice">
                                                <h3>S$120</h3>
                                                <p>per person</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="boxEvents">
                                <h4>Lorem Ipsum is simply dummy </h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.  industry. Lorem Ipsum has been.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <div class="eventsInner">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="userBox">
                                                <div class="boxUserImg">
                                                    <img src="assets/img/coach-1.png" alt="" title=""/>
                                                </div>
                                                <h5>Alicia Prescott</h5>
                                                <p>Life Coach & Counsellor</p>
                                            </div>
                                            <ul class="listTimeTables">
                                                <li>
                                                    <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                                    12 Dec 2020, 2:00 PM to 4:00 PM (SGT)
                                                </li>
                                                <li>
                                                    <span class="icon"><i class="fas fa-globe-americas"></i></span>
                                                    Online webinar (Zoom)
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <p><a href="#" class="btn btn-primary d-block">Book Now </a></p>
                                            <div class="textEventPrice">
                                                <h3>S$120</h3>
                                                <p>per person</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</article>

<!-- Content Code End -->

@include('Website/Assets/footer')

<script type="text/javascript" language="javascript">

var therapist_id_fk = $("#therapist_id_fk").val();

$.ajax({
    url: "{{url('api/showSessions')}}",
    type: "POST",
    dataType: 'json',
    data: {"therapist_id_fk":therapist_id_fk},

    success:function(response){

        if (response.status == false) {

        }else{

            $("#therapist_session_count").html(response.therapist_session_count);
            $("#session_details").append(response.therapist_sessions);
        }
    },
    error:function(error){
         console.log(error);
         toastr.error(error.message);
    },
});

$('.carouselCoach').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    dots: false,
    center:true,
    navText: [
        "<i class='fas fa-chevron-left'></i>",
        "<i class='fas fa-chevron-right'></i>"
    ],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
$('.owl-carousel-events').owlCarousel({
    loop:true,
    margin:0,
    nav: true,
    autoplay: true,
    navText: [
        "<i class='fas fa-chevron-left'></i>",
        "<i class='fas fa-chevron-right'></i>"
    ],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:2
        }
    }
})
$(document).ready(function() {
    $('.btn-runningopen').click(function() {
        $(".content_session").addClass('showPopup');
    });
    $('.btnCloseSm').click(function() {
        $(".content_session").removeClass('showPopup');
    });
});
$(document) .ready(function(){
    var div =  $(".owl-item .box_therapists");
    $(".owl-item .box_therapists").click(function(){
        div.removeClass('active');
    });
});

</script>