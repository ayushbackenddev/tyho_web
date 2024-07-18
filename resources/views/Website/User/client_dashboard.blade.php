@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <div class="container">
        <input type="hidden" name="client_id_fk" id="client_id_fk" value="{{ Session::get('loggedUser') }}">
        <div class="boxSessions">
            <div class="row">
                <div class="col-md-9">
                    <div class="boxfill boxSessionsInner mb-3">
                        <div class="row rowDetailSessionTop">
                            <div class="col-md-4">
                                <div class="btns_actions showOnmobile">
                                    <ul class="listactionsButtons">
                                        <li class="dropdownTimeZone">
                                           <span class="textTimeZone"> Time Zone: <i data-toggle="tooltip" title="Please change your default time zone from client preferences" class="fas fa-info-circle"></i></span>
                                            <select class="form-control styledSelect">
                                                <option>SGT</option>
                                                <option>IST</option>
                                                <option>Aus</option>
                                            </select>
                                        </li>
                                        <li class="dropdownWalletBalance">
                                            <a href="#" class="linkWallet">
                                                Current Wallet Balance:
                                                <span class="textWallet">
                                                    S$ 200
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="owl-carousel owl-theme carouselCoachSessions" id="fetchOtherTherapist">

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="btns_actions hideMobile">
                                    <ul class="listactionsButtons">
                                        <li class="dropdownTimeZone">
                                            <span class="textTimeZone"> Time Zone: <i data-toggle="tooltip" title="Please change your default time zone from client preferences" class="fas fa-info-circle"></i></span>
                                            <select class="form-control styledSelect">
                                                <option>SGT</option>
                                                <option>IST</option>
                                                <option>Aus</option>
                                            </select>
                                        </li>
                                        <li class="dropdownWalletBalance">
                                            <a href="#" class="linkWallet">
                                                Current Wallet Balance:
                                                <span class="textWallet">
                                                    S$ 200
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="box_banner">
                                    <h3 class="textBanner">Banner for how it works</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="boxLeftMenu showOnmobile">
                        <ul class="menuLeft">
                            <li><a href="/clientEditProfile"><span class="icon_menu"><i class="far fa-edit"></i></span> My Profile</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-sliders-h"></i></span> Preferences</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-wallet"></i></span> Wallet</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="far fa-smile"></i></span> Leave Feedback</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-gift"></i></span> Purchase Gift Card</a> </li>
                        </ul>
                        <hr class="mb-2">
                        <ul class="menuLeft">
                            <li><a href="/sessionRecpt"><span class="icon_menu"><i class="fas fa-file-invoice"></i></span> Session Receipts </a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="far fa-comments"></i></span> Request for Support </a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-exclamation-triangle"></i></span> Make a Complaint </a> </li>
                        </ul>
                        <hr class="mb-2">
                        <ul class="menuLeft">
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-clipboard"></i></span> Preparing For Your Session</a> </li>
                        </ul>
                    </div>
                    <div class="boxfill boxSessionsInner">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-6">
                                <h2 class="mb-0">Sessions</h2>
                            </div>
                            <div class="col-md-6 text-end">
                                <ul class="listOptions">
                                    <li><a href="#">Upcoming</a></li>
                                    <li class="active"><a href="#">Passed</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pb-3">
                            You have <strong><span id="client_session_count"></span></strong> upcoming sessions
                        </div>
                        <div class="row row_mainsessions" id="clientBookedSessionDetails">
                           
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
                <div class="col-md-3 hideMobile">
                    <div class="boxLeftMenu">
                        <ul class="menuLeft">
                            <li><a href="/clientEditProfile"><span class="icon_menu"><i class="far fa-edit"></i></span> My Profile</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-sliders-h"></i></span> Preferences</a> </li>
                            <li><a href="/myWallet"><span class="icon_menu"><i class="fas fa-wallet"></i></span> Wallet</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="far fa-smile"></i></span> Leave Feedback</a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-gift"></i></span> Purchase Gift Card</a> </li>
                        </ul>
                        <hr class="mb-2">
                        <ul class="menuLeft">
                            <li><a href="{{url('sessionRecpt')}}"><span class="icon_menu"><i class="fas fa-file-invoice"></i></span> Session Receipts </a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="far fa-comments"></i></span> Request for Support </a> </li>
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-exclamation-triangle"></i></span> Make a Complaint </a> </li>
                        </ul>
                        <hr class="mb-2">
                        <ul class="menuLeft">
                            <li><a href="#"><span class="icon_menu"><i class="fas fa-clipboard"></i></span> Preparing For Your Session</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_Events">
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
        </div>
    </div>
</article>

<!-- Content Code End -->

<!-- Modal -->
<div class="modal fade" id="modal_video" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
        <div class="modal-body p-3">
            <video width="100%" controls>
                <source src="assets/video/Alicia-Video.mp4" type="video/mp4">
            </video>
        </div>
    </div>
    </div>
</div>

@include('Website/Assets/footer')

<script type="text/javascript" language="javascript">

var client_id_fk = $("#client_id_fk").val();

$.ajax({
    url: "{{url('api/showBookedSessions')}}",
    type: "POST",
    dataType: 'json',
    data: {"client_id_fk":client_id_fk},

    success:function(response){

        if (response.status == false) {

        }else{

            $("#client_session_count").html(response.client_session_count);
            $("#clientBookedSessionDetails").append(response.client_session);
        }
    },
    error:function(error){
         console.log(error);
         toastr.error(error.message);
    },
});

// function getTherapist(value) {

    $.ajax({
        type: "POST",
        url: "{{url('api/otherBookedTherapist')}}",
        data: {},
        dataType: 'json',
        contentType: false,
        processData: false,
        success:function(response){
            if(response.status == false)
            {
                $("#fetchOtherTherapist").html("");
            }else
            {
                if(response.OtherBookedTherapist.length > 0)
                {
                    $("#fetchOtherTherapist").html("");
                }
                $("#fetchOtherTherapist").html(response.OtherBookedTherapist);

                // if (value == 2)
                // {
                //     $('.carouselCoachSessions').owlCarousel('destroy');
                // }

                $('.carouselCoachSessions').owlCarousel({
                    loop:true,
                    margin:20,
                    nav:true,
                    dots: true,
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
                            items:1
                        },
                        1000:{
                            items:1
                        }
                    }
                    // onTranslated : counter,
                    // onInitialized : counter
                });
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
//}

// function counter(event) {

//     if($(".center .item").data() === undefined)
//     {
//         $("#fetchTherapistData").html("");
//         return
//     }
//     var id = $(".center .item").data().id;
//     showTherapistData(id);
// }


// $('.owl-carousel-events').owlCarousel({
//     loop:true,
//     margin:0,
//     nav: true,
//     autoplay: true,
//     navText: [
//         "<i class='fas fa-chevron-left'></i>",
//         "<i class='fas fa-chevron-right'></i>"
//     ],
//     responsive:{
//         0:{
//             items:1
//         },
//         600:{
//             items:1
//         },
//         1000:{
//             items:2
//         }
//     }
// })
// $(document).ready(function() {
//     $('.btn-runningopen').click(function() {
//         $(".content_session").addClass('showPopup');
//     });
//     $('.btnCloseSm').click(function() {
//         $(".content_session").removeClass('showPopup');
//     });
// });

</script>

<script type="text/javascript">
function closeIntroVideo() {

    var video = document.getElementById('therapist_video_modal_video');
    video.pause();
    $('#modal_video').modal('hide');
}

function openVideo(video_url) {

    var video = document.getElementById('therapist_video_modal_video');
    video.src = video_url;
    video.play();
    $('#modal_video').modal('show');
}
</script>