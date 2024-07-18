<div class="accordion-body">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">First Name</label>
                <p class="f13" id="a_first_name">{{$applicationData->first_name == null ? "N/A" : $applicationData->first_name}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Middle Name</label>
                <p class="f13" id="a_middle_name">{{$applicationData->middle_name == null ? "N/A" : $applicationData->middle_name}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Last Name </label>
                <p class="f13" id="a_last_name">{{$applicationData->last_name == null ? "N/A" : $applicationData->last_name}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Email Address</label>
                <p class="f13" id="a_email">{{$applicationData->email == null ? "N/A" : $applicationData->email}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Country of Residence</label>
                <p class="f13" id="country_of_residence">{{$applicationData->country_of_residence == null ? "N/A" : $applicationData->country_of_residence}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">City of Residence</label>
                <p class="f13" id="city_of_residence">{{$applicationData->city_of_residence == null ? "N/A" : $applicationData->city_of_residence}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Gender</label>
                <p class="f13" id="gender">{{$applicationData->gender == null ? "N/A" : $applicationData->gender}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Occupation</label>
                <p class="f13" id="occupation">{{$applicationData->occupation == null ? "N/A" : $applicationData->occupation}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Other</label>
                <p class="f13" id="occupation_other">{{$applicationData->occupation_other == null ? "N/A" : $applicationData->occupation_other}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Languages Spoken</label>
                <p class="f13" id="language_id_fk">{{ Helper::getMultipleLanguages_1($applicationData->language_id_fk) }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Length of Experience (years)</label>
                <p class="f13" id="length_of_experience">{{$applicationData->length_of_experience == null ? "N/A" : $applicationData->length_of_experience}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Areas of Expertise / Specialisation</label>
                <p class="f13" id="areas_of_expertise_specialisation">{{$applicationData->areas_of_expertise_specialisation == null ? "N/A" : $applicationData->areas_of_expertise_specialisation}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Therapeutic Approaches (eg CBT)</label>
                <p class="f13" id="therapeutic_approaches">{{$applicationData->therapeutic_approaches == null ? "N/A" : $applicationData->therapeutic_approaches}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Current / Last Place of Work</label>
                <p class="f13" id="current_last_place_of_work">{{$applicationData->current_last_place_of_work == null ? "N/A" : $applicationData->current_last_place_of_work}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Educational Qualifications</label>
                <p class="f13" id="educational_qualifications">{{$applicationData->educational_qualifications == null ? "N/A" : $applicationData->educational_qualifications}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Professional Certifications</label>
                <p class="f13" id="professional_certifications">{{$applicationData->professional_certifications == null ? "N/A" : $applicationData->professional_certifications}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Professional Memberships</label>
                <p class="f13" id="professional_memberships">{{$applicationData->professional_memberships == null ? "N/A" : $applicationData->professional_memberships}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label">Do you work with any specific groups of people (eg industries, age groups etc)?</label>
                <p class="f13" id="work_with_any_specific_groups_of_people">{{$applicationData->work_with_any_specific_groups_of_people == null ? "N/A" : $applicationData->work_with_any_specific_groups_of_people}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label">Are there are any clients that you prefer not to work with for personal reasons
                    (eg personality disorders, sexual offenders etc)?
                    </label>
                <p class="f13" id="any_clients_that_you_prefer_not_to_work_with_for_personal_reason">{{$applicationData->any_clients_that_you_prefer_not_to_work_with_for_personal_reason == null ? "N/A" : $applicationData->any_clients_that_you_prefer_not_to_work_with_for_personal_reason}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Are you currently under supervision?</label>
                <p class="f13" id="currently_under_supervision">{{$applicationData->currently_under_supervision == 0 ? "No" : "Yes"}}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Please provide details</label>
                <p class="f13" id="supervision_please_provide_details">{{$applicationData->supervision_please_provide_details == null ? "N/A" : $applicationData->supervision_please_provide_details}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Do you currently have any professional indemnity insurance?</label>
                <p class="f13" id="currently_have_any_professional_indemnity_insurance">{{$applicationData->currently_have_any_professional_indemnity_insurance == 0 ? "No" : "Yes"}}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Please provide details</label>
                <p class="f13" id="insurance_please_provide_details">{{$applicationData->insurance_please_provide_details == null ? "N/A" : $applicationData->insurance_please_provide_details}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label d-block mb-1">What services are you able to provide?</label>
                <label class="form-label f13 text-dark">Counselling Services </label>
                <p class="f13">
                    @php
                        $servicesIds = explode("," , $applicationData->services_are_you_able_to_provide);
                    @endphp
                    @foreach( $servicesIds as $services )
                        {{ Helper::getServicesForApplicationView($services) }},
                    @endforeach
                </p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label">What mediums are you able to use for counselling?</label>
                <p class="f13" id="medium_are_you_able_to_use_for_counselling">
                    @php
                        $mediumIds = explode("," , $applicationData->medium_are_you_able_to_use_for_counselling);
                    @endphp
                    @foreach( $mediumIds as $mediums )
                        {{ Helper::getMediumForApplicationView($mediums) }},
                    @endforeach
                </p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-field">
                <label class="form-label">Approximate availability (hours per week)</label>
                <p class="f13" id="approximate_availability">{{$applicationData->approximate_availability == null ? "N/A" : $applicationData->approximate_availability}}</p>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-field mb-0">
                <label class="form-label d-block mb-1">Which days & timeslots are you likely to be available? </label>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label f13 text-dark">Days</label>
                            <p class="f13" id="days">{{$applicationData->days == null ? "N/A" : $applicationData->days}}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-field">
                            <label class="form-label f13 text-dark">Timeslots</label>
                            <p class="f13" id="timeslots">{{$applicationData->timeslots == null ? "N/A" : $applicationData->timeslots}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-field mb-0">
                <label class="form-label mb-1">What do you assist clients with (please select the ones that apply to your practice)? </label>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label f13 text-dark">Mood Regulation</label>
                        <p class="f13" id="mood_regulation">{{ Helper::AllIssues($applicationData->mood_regulation == null ? "N/A" : $applicationData->mood_regulation) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label f13 text-dark">Family and Relationships </label>
                        <p class="f13" id="family_and_relationships">{{ Helper::AllIssues($applicationData->family_and_relationships == null ? "N/A" : $applicationData->family_and_relationships) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label f13 text-dark">Academic or Work-related </label>
                        <p class="f13" id="academic_or_work_related">{{ Helper::AllIssues($applicationData->academic_or_work_related == null ? "N/A" : $applicationData->academic_or_work_related) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label f13 text-dark">Personal</label>
                        <p class="f13" id="personal">{{ Helper::AllIssues($applicationData->personal == null ? "N/A" : $applicationData->personal) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label f13 text-dark">Other</label>
                        <p class="f13" id="other">{{ Helper::AllIssues($applicationData->other == null ? "N/A" : $applicationData->other) }}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="form-field mb-0">
                            <label class="form-label f13 text-dark">Anything else?</label>
                            <p class="f13 mb-0" id="anything_else">{{$applicationData->anything_else == null ? "N/A" : $applicationData->anything_else}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>