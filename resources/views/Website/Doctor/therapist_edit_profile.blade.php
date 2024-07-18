@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <div class="box_landing_tabs box_editprofile_tabs">
    <input type="hidden" name="therapist_id_fk" id="therapist_id_fk" value="{{ Session::get('loggedTherapist') }}">
        <div class="tab_landing">
            <div class="container">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#profile-tab" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><span class="icon_tab"><i class="fas fa-user"></i></span> Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#contact-details" type="button" role="tab" aria-controls="pills-Gender" aria-selected="false"><span class="icon_tab"><i class="fas fa-phone-alt"></i></span> Contact Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#preferences" type="button" role="tab" aria-controls="pills-Language" aria-selected="false"><span class="icon_tab"><i class="fas fa-sliders-h"></i></span> Preferences</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="profile-tab" role="tabpanel">

                </div>
                <div class="tab-pane fade" id="contact-details" role="tabpanel">

                </div>
                <div class="tab-pane fade" id="preferences" role="tabpanel">
                    <form id="TherapistProfileForm" name="FormSubmit" method="POST"> 
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-field">
                                    <label class="form-label">Notice Period for New Bookings</label>
                                    <select class="form-control styledSelect" name="notice_period_for_new_bookings">
                                        <option selected disabled></option>
                                        <option>Bookings 1</option>
                                        <option>Bookings 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-field">
                                    <label class="form-label">My Time Zone</label>
                                    <select class="form-control styledSelect" name="my_timezone">
                                        <option selected disabled></option>
                                        <option>Time Zone 1</option>
                                        <option>Time Zone 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>    
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-field mb-3 pb-1 inline_radioBtns">
                                    <label class="form-label mb-3 d-block">Taking New Clients</label>
                                    <div class="form-check d-inline-block me-2">
                                        <input class="form-check-input" type="radio" name="taking_new_clients" checked="" value="1">
                                        <label class="form-check-label" for="clientsYes"> Yes</label>
                                    </div>
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="taking_new_clients" id="clientsNo" value="0">
                                        <label class="form-check-label" for="clientsNo"> No</label>
                                    </div>  
                                    <div class="form-text">Note: To disallow a particular client from booking a session with you, please email us at <a href="#" class="textLink text-lowercase">contact@talkyourheartout.com</a> with their user ID and name.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-field">        
                                    <label class="form-label">Email Notifications <a href="#" class="iconTooltip" data-toggle="tooltip" title="Please note that we will send all future correspondence to this email address."><i class="fas fa-info-circle"></i></a></label>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications1" name="email_notifications[]" value="1">
                                        <label class="form-check-label" for="notifications1">New appointment scheduled</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications2" name="email_notifications[]" value="2">
                                        <label class="form-check-label" for="notifications2">24 hour reminder for sessions </label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications3" name="email_notifications[]" value="3">
                                        <label class="form-check-label" for="notifications3">10 min reminder for sessions</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications5" name="email_notifications[]" value="4">
                                        <label class="form-check-label" for="notifications5">Appointment rescheduled by client</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications6" name="email_notifications[]" value="5">
                                        <label class="form-check-label" for="notifications6">Appointment cancelled by client</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications7" name="email_notifications[]" value="6">
                                        <label class="form-check-label" for="notifications7">Appointment cancelled by Therapist</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications8" name="email_notifications[]" value="7">
                                        <label class="form-check-label" for="notifications8">Intake form completed or updated by client  (only if there are upcoming appointments)</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications9" name="email_notifications[]" value="8">
                                        <label class="form-check-label" for="notifications9">Reschedule request sent by client  (ie within 24 hours of appointment)</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="notifications10" name="email_notifications[]" value="9">
                                        <label class="form-check-label" for="notifications10">Monthly payment note generated</label>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="row mt-5 mb-5">
                            <div class="col-md-3">
                                <div class="d-grid">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>   
    </div>
</article>

<!-- Content Code End -->

@include('Website/Assets/footer')

<script>

var therapist_id_fk = $("#therapist_id_fk").val();

$.ajax({
    url: "{{url('api/therapistProfileEditAPI')}}",
    type: "POST",
    dataType: 'json',
    data: {"therapist_id_fk":therapist_id_fk},

    success:function(response){
        if (response.status == true)
        {
            $('#profile-tab').append(response.therapistDataForEditProfile);
            $('#contact-details').append(response.showEmail);
            $('#address').append(response.therapistAddresses);
            $('#showIssues').append(response.issues);
        }
        else{

        }
    },
    error:function(error){
        console.log(error);
    },
});

$("#TherapistProfileForm").on("submit", function(e){

    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "{{url('api/updateTherapistProfile')}}",
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