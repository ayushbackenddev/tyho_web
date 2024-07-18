<form id="TherapistEditProfileForm">
    <h4>General Details</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{$therapistDataForEditProfile->first_name}}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Middle Name</label>
                <input type="text" id="middle_name" value="{{$therapistDataForEditProfile->middle_name}}" name="middle_name" class="form-control" placeholder=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Last Name</label>
                <input type="text" id="last_name" value="{{$therapistDataForEditProfile->last_name}}" name="last_name" class="form-control" placeholder=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Languages Spoken</label>
                <input type="hidden" id="language" value="{{$therapistDataForEditProfile->language_id_fk}}" class="form-control" placeholder=""/>
                <select class="form-control styledSelect" name="languages_spoken[]" id="languages_spoken" multiple>

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Gender</label>
                <select class="form-control styledSelect" id="gender" name="gender" size="1">
                    <option selected disabled></option>
                    <option {{$therapistDataForEditProfile->gender == 'Male' ? 'selected' : ''}}>Male</option>
                    <option {{$therapistDataForEditProfile->gender == 'Female' ? 'selected' : ''}}>Female</option>
                    <option {{$therapistDataForEditProfile->gender == 'Non-binary' ? 'selected' : ''}}>Non-binary</option>
                    <option {{$therapistDataForEditProfile->gender == 'Prefer not to say' ? 'selected' : ''}}>Prefer not to say </option>
                </select>
            </div>
        </div>
    </div> 
    <label class="form-label mb-3">What do you assist clients with (please select the ones that apply to your practice)?</label>
    <div class="row g-4" id="showIssues">

    </div>
    <div class="row g-3">
        <div class="form-field">
            <label class="form-label mb-0">Address(es) for in-person sessions (if applicable)</label>
            <div class="row" id="address">
                
            </div>                                                   
        </div>    
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label text-dark f13">Address Title <a href="#" class="iconTooltip" data-toggle="tooltip" title="Address Title"><i class="fas fa-info-circle"></i></a></label>
                <input type="text" id="address_title" class="form-control" placeholder="" />
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label text-dark f13">Address Line 1</label>
                <input type="text" id="address_line1" class="form-control" placeholder="" />
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label text-dark f13">Address Line 2</label>
                <input type="text" id="address_line2" class="form-control" placeholder="" />
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label text-dark f13">Landmark</label>
                <input type="text" id="landmark" class="form-control" placeholder="" />
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label text-dark f13">City</label>
                <input type="text" id="city" class="form-control" placeholder="" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label text-dark f13">Postal Code</label>
                <input type="text" id="postal_code" class="form-control" placeholder="" />
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label text-dark f13">Country</label>
                <select class="form-control styledSelect" id="country_id_fk">
                    
                </select>
            </div>
        </div>
    </div>
    <div class="row pt-3 pb-5">
        <div class="col-md-4">
            <div class="d-grid">
                <button type="button" id="addAddress" class="btn btn-primary btn-lg">Add address</button>
            </div>
        </div>
    </div>
    <h4 class="mb-2">Further Details</h4>
    <p class="f14">Changes will be notified to Admin, who will acknowledge the changes made and update your profile from the backend, if required.</p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">What services are you able to provide?</label>
                @foreach (Helper::getMyService() as $showService)
                    <div class="col-md-4">
                        <div class="form-check mb-1">
                            <input type="checkbox" class="form-check-input" id="service_id_{{$showService->id}}" name="services_provide[]" value="{{$showService->id}}" {{in_array($showService->id,explode(",",$therapistDataForEditProfile->services_are_you_able_to_provide)) == true ? "checked" : ""}}>
                            <label class="form-check-label" for="{{$showService->service}}">{{$showService->service}}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">What mediums are you able to use for counselling?</label>
                @foreach (Helper::getMyMedium() as $showMedium)
                    <div class="col-md-4">
                        <div class="form-check mb-1">
                            <input type="checkbox" class="form-check-input" id="medium_id_{{$showMedium->id}}" name="for_counselling[]" value="{{$showMedium->id}}" {{in_array($showMedium->id,explode(",",$therapistDataForEditProfile->medium_are_you_able_to_use_for_counselling)) == true ? "checked" : ""}}>
                            <label class="form-check-label" for="{{$showMedium->medium}}">{{$showMedium->medium}}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-6">
            <div class="form-field filestyleButton">
                <label class="form-label">Photo(s)*(Please ensure white background, with upper arms included.)</label>                               
                <div class="input-group">
                    <div id="dZUpload" class="dropzone-custom">
                        <div class="dz-default dz-message">
                            <input type="hidden" name="" class="dz-default dz-message">
                            <span class="btn btn-sm"><i class='fas fa-file-upload'></i> Upload Photo(s)</span>
                        </div>
                    </div>
                </div>                                             
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field filestyleButton">
                <label class="form-label">Video* (max 60 seconds)<br></label>                               
                <div class="input-group">
                    <div id="dZUpload2" class="dropzone-custom">
                        <div class="dz-default dz-message">
                            <span class="btn btn-sm"><i class='fas fa-file-upload'></i> Upload Video</span>
                        </div>
                    </div>
                </div>                        
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label">Profile Description*</label>
                <div class="input-group">
                    <textarea class="form-control textarea-lg" placeholder="" id="profile_description" name="profile_description">{{$therapistDataForEditProfile->profile_description}}</textarea>
                </div>   
            </div>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">City of Residence</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->city_of_residence}}" id="city_of_residence" name="city_of_residence" placeholder="" />
            </div>   
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Country of Residence</label>
                <input type="hidden" id="country" value="{{$therapistDataForEditProfile->country_of_residence}}">
                <select class="form-control styledSelect" id="country_of_residence" name="country_of_residence">

                </select>
            </div>   
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Areas of Expertise / Specialisation</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->areas_of_expertise_specialisation}}" id="areas_of_expertise_specialisation" name="areas_of_expertise_specialisation" placeholder="" />
            </div>   
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Occupation</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->occupation == 'other' ? $therapistDataForEditProfile->occupation_other : $therapistDataForEditProfile->occupation}}" id="occupation_other" name="occupation_other" placeholder="" />
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Length of Experience (years)</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->length_of_experience}}" id="length_of_experience" name="length_of_experience" placeholder="" />
            </div>   
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Therapeutic Approaches (eg CBT)</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->therapeutic_approaches}}" id="therapeutic_approaches" name="therapeutic_approaches" placeholder="" />
            </div>   
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Current / Last Place of Work</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->current_last_place_of_work}}" id="current_last_place_of_work" name="current_last_place_of_work" placeholder="" />
            </div>   
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Educational Qualifications</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->educational_qualifications}}" id="educational_qualifications" name="educational_qualifications" placeholder="" />
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Professional Certifications</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->professional_certifications}}" id="professional_certifications" name="professional_certifications" placeholder="" />
            </div>   
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Professional Memberships</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->professional_memberships}}" id="professional_memberships" name="professional_memberships" placeholder="" />
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label">Do you work with any specific groups of people (eg industries, age groups etc)?</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->work_with_any_specific_groups_of_people}}" placeholder="" id="work_with_any_specific_groups_of_people" name="work_with_any_specific_groups_of_people" />
            </div>   
        </div>
    </div>
    <div class="row">  
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label">Are there are any clients that you prefer not to work with for personal reasons (eg personality disorders, sexual offenders etc)?</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->any_clients_that_you_prefer_not_to_work_with_for_personal_reason}}" placeholder="" id="any_clients_that_you_prefer_not_to_work_with_for_personal_reason" name="any_clients_that_you_prefer_not_to_work_with_for_personal_reason" />
            </div>   
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field mb-3 pb-1 inline_radioBtns">
                <label class="form-label mb-3 d-block">Are you currently under supervision? </label>
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" type="radio" value="1" {{$therapistDataForEditProfile->currently_under_supervision == 1 ? 'checked' : ''}}  name="currently_under_supervision" id="currently_under_supervisionYes">
                    <label class="form-check-label" for="currently_under_supervision"> Yes</label>
                </div>
                <div class="form-check d-inline-block">
                    <input class="form-check-input" type="radio" value="0" {{$therapistDataForEditProfile->currently_under_supervision == 0 ? 'checked' : ''}} name="currently_under_supervision" id="currently_under_supervisionNo">
                    <label class="form-check-label" for="currently_under_supervision"> No</label>
                </div>  
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field provideDetailsOne">
                <label class="form-label">Please provide details</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->supervision_please_provide_details}}" placeholder="" id="supervision_please_provide_details" name="supervision_please_provide_details">
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field mb-3 pb-1 inline_radioBtns">
                <label class="form-label mb-3 d-block">Do you currently have any professional indemnity insurance?</label>
                <div class="form-check d-inline-block me-2">
                    <input class="form-check-input" value="1" {{$therapistDataForEditProfile->currently_have_any_professional_indemnity_insurance == 1 ? 'checked' : ''}} type="radio" name="currently_have_any_professional_indemnity_insurance" id="currently_have_any_professional_indemnity_insuranceYes">
                    <label class="form-check-label" for="currently_have_any_professional_indemnity_insurance"> Yes</label>
                </div>
                <div class="form-check d-inline-block">
                    <input class="form-check-input" value="0" {{$therapistDataForEditProfile->currently_have_any_professional_indemnity_insurance == 0 ? 'checked' : ''}} type="radio" name="currently_have_any_professional_indemnity_insurance" id="currently_have_any_professional_indemnity_insuranceNo">
                    <label class="form-check-label" for="currently_have_any_professional_indemnity_insurance"> No</label>
                </div>  
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field insuranceDetail">
                <label class="form-label">Please provide details</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->insurance_please_provide_details}}" placeholder="" id="insurance_please_provide_details" name="insurance_please_provide_details">
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Approximate availability (hours per week)</label>
                <input type="text" class="form-control" value="{{$therapistDataForEditProfile->approximate_availability}}" placeholder="" id="approximate_availability" name="approximate_availability">
            </div>
        </div>
    </div>     
    <div class="row g-3">
        <div class="form-field">
            <label class="form-label d-block mb-3">Which days & timeslots are you likely to be available? </label>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label text-dark f13">Days </label>
                    <div class="row mb-2">
                        <div class="col-3">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress14" value="Monday" name="days[]" {{in_array('Monday',explode(", ",$therapistDataForEditProfile->days)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress14">Mon</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress15" value="Tuesday" name="days[]" {{in_array('Tuesday',explode(", ",$therapistDataForEditProfile->days)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress15">Tue</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress16" value="Wednesday" name="days[]" {{in_array('Wednesday',explode(", ",$therapistDataForEditProfile->days)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress16">Wed </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress17" value="Thrusday" name="days[]" {{in_array('Thrusday',explode(", ",$therapistDataForEditProfile->days)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress17">Thu</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress18" value="Friday" name="days[]" {{in_array('Friday',explode(", ",$therapistDataForEditProfile->days)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress18">Fri</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress19" value="Saturday" name="days[]" {{in_array('Saturday',explode(", ",$therapistDataForEditProfile->days)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress19">Sat</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress20" value="Sunday" name="days[]" {{in_array('Sunday',explode(", ",$therapistDataForEditProfile->days)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress20">Sun</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-dark f13">Timeslots</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress21" value="Morning (7 AM - 12 PM)" name="timeslots[]" {{in_array('Morning (7 AM - 12 PM)',explode(", ",$therapistDataForEditProfile->timeslots)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress21">Morning (7 AM - 12 PM)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress22" value="Afternoon (12 PM - 6 PM)" name="timeslots[]" {{in_array('Afternoon (12 PM - 6 PM)',explode(", ",$therapistDataForEditProfile->timeslots)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress22">Afternoon (12 PM - 6 PM)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mb-1">
                                <input type="checkbox" class="form-check-input" id="issue_stress23" value="Evening (6 PM - 10 PM)" name="timeslots[]" {{in_array('Evening (6 PM - 10 PM)',explode(", ",$therapistDataForEditProfile->timeslots)) == true ? "checked" : ""}}>
                                <label class="form-check-label" for="issue_stress23">Evening (6 PM - 10 PM) </label>
                            </div>
                        </div>
                    </div>
                </div>    
            </div> 
        </div>
    </div>    
    <div class="row pt-5 mb-5">
        <div class="col-md-3">
            <div class="d-grid">
                <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<script>

$( "#address_title" ).keyup(function() {

    if ($(this).val().length > 0)
    {
        $("#address_line1").prop('required',true);
        $("#address_line2").prop('required',true);
        $("#landmark").prop('required',true);
        $("#city").prop('required',true);
        $("#postal_code").prop('required',true);
        $("#country_id_fk").prop('required',true);

    }else
    {
        $("#address_line1").prop('required',false);
        $("#address_line2").prop('required',false);
        $("#landmark").prop('required',false);
        $("#city").prop('required',false);
        $("#postal_code").prop('required',false);
        $("#country_id_fk").prop('required',false);
    }
});

var images = [];
var videos = new Array();
window.onload = function() {
    // access Dropzone here

    Dropzone.autoDiscover = false;



    var dropzoneImages = new Dropzone ("#dZUpload", {
        url: "hn_SimpeFileUploader.ashx",
        maxFilesize: 256, // Set the maximum file size to 256 MB
        paramName: "document[attachment]", // Rails expects the file upload to be something like model[field_name]
        autoProcessQueue: false,
        acceptedFiles: ".jpg,.png",
        addRemoveLinks: true // Don't show remove links on dropzone itself.
    });

    dropzoneImages.on("removedfile", function(file){
        for (var i = images.length - 1; i >= 0; i--) {
            if (images[i] === file) {
                images.splice(i, 1);
            }
        }
    });

    dropzoneImages.on("addedfile", function(file){
        images.push( file);
    });

    

    var dropzoneVideo = new Dropzone ("#dZUpload2", {
        url: "hn_SimpeFileUploader.ashx",
        maxFilesize: 256, // Set the maximum file size to 256 MB
        paramName: "document[attachment]", // Rails expects the file upload to be something like model[field_name]
        autoProcessQueue: false,
        acceptedFiles: ".mp4",
        addRemoveLinks: true // Don't show remove links on dropzone itself.
    });

    dropzoneVideo.on("removedfile", function(file){

        for (var i = videos.length - 1; i >= 0; i--) {
            if (videos[i] === file) {
                videos.splice(i, 1);
            }
        }
        console.log(videos);
    });

    dropzoneVideo.on("addedfile", function(file){
        videos.push( file);
        console.log(videos);
    });
};

$(document).ready(function () {


    

    $.ajax({
        url: "{{url('api/getCountry')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

            $('#country_id_fk').empty();
            $('#country_id_fk').append('<option value="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                $('#country_id_fk').append('<option value="' + data.id + '">' + data.name + '</option>');
            });
        }
    });

    var languages = $("#language").val();

    $.ajax({
        url: "{{url('api/getlanguages')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

            $('#languages_spoken').empty();
            $('#languages_spoken').append('<option value="" disabled="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                if(data.id == languages){  
                    $('#languages_spoken').append('<option value="' + data.id + '" selected>' + data.language_name + '</option>');
                }else{
                    $('#languages_spoken').append('<option value="' + data.id + '">' + data.language_name + '</option>');
                }
            });
        }
    });

    var country_of_residence = $("#country").val();

    $.ajax({
        url: "{{url('api/getCountry')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

            $('#country_of_residence').empty();
            $('#country_of_residence').append('<option value="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                if(data.id == country_of_residence){  
                    $('#country_of_residence').append('<option value="' + data.id + '" selected>' + data.name + '</option>');
                }else{
                    $('#country_of_residence').append('<option value="' + data.id + '">' + data.name + '</option>');
                }
            });
        }
    });

    $("#country_of_residence").select2();

    $("#addAddress").click(function () {

        $('#address_line1').valid();
        $('#address_line2').valid();
        $('#landmark').valid();
        $('#city').valid();
        $('#postal_code').valid();
        $('#country_id_fk').valid();

        var AddressTitle = $("#address_title").val();

        if ($('#address_line1').valid() == true && $('#address_line2').valid() == true && $('#landmark').valid() == true && $('#city').valid() == true && $('#postal_code').valid() == true && $('#country_id_fk').valid() == true && AddressTitle != "")
        {
            var Address1 = $("#address_line1").val();
            var Address2 = $("#address_line2").val();
            var Landmark = $("#landmark").val();
            var City = $("#city").val();
            var PostalCode = $("#postal_code").val();
            var Country = $("#country_id_fk option:selected").text();
            var Country_val = $("#country_id_fk").val();

            $("#address").append('<div class="col-12 col-md-6"><div class="alert alert-address alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button><p class="mb-0"><strong><input type="hidden" name="address_title[]" value="'+AddressTitle+'">'+AddressTitle+'</strong></p><p><input type="hidden" name="address_line1[]" value="'+Address1+'"><input type="hidden" name="address_line2[]" value="'+Address2+'"><input type="hidden" name="landmark[]" value="'+Landmark+'"><input type="hidden" name="city[]" value="'+City+'"><input type="hidden" name="postal_code[]" value="'+PostalCode+'"><input type="hidden" name="country_id_fk[]" value="'+Country_val+'">'+Address1+', '+Address2+', '+Landmark+', '+City+', '+PostalCode+', '+Country_val+'</p></div></div>');

            $("#address_title").val("");
            $("#address_line1").val("");
            $("#address_line2").val("");
            $("#landmark").val("");
            $("#city").val("");
            $("#postal_code").val("");
            $("#country_id_fk").val("");

            $("#address_line1").prop('required',false);
            $("#address_line2").prop('required',false);
            $("#landmark").prop('required',false);
            $("#city").prop('required',false);
            $("#postal_code").prop('required',false);
            $("#country_id_fk").prop('required',false);
        }
    });

    $("#TherapistEditProfileForm").on("submit", function(e){

        e.preventDefault();
        var formData = new FormData(this);

        for (var i = images.length - 1; i >= 0; i--) {
            formData.append("image[]", images[i]);
        }

        for (var i = videos.length - 1; i >= 0; i--) {
            formData.append("videos[]", videos[i]);
        }

        formData.append( 'dial_code', telInputmobile.getSelectedCountryData().dialCode );

        $.ajax({
            url: "{{url('api/updateProfile')}}",
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
});
</script>