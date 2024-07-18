<h2 class="text-center">Intake Form {{$clientintekform->first_name}}  {{$clientintekform->last_name}}(#{{$clientintekform->user_id}})</h2>
<p class="mb-4">Information about client. This will help you prepare and be effective during sessions with them.</p>
<div class="formFillintake">
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Age</label>
                <p>{{$clientintekform->age}}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Gender</label>
                <p>{{$clientintekform->gender}}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Country of Residence</label>
                <p>{{$clientintekform->country_of_residence}} </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">City of Residence</label>
                <p>{{$clientintekform->city_of_residence}}</p>
            </div>
        </div>
    </div>
    <h3 class="pb-2">Emergency Contact</h3>
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Name</label>
                <p>{{$clientintekform->name}}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Relationship</label>
                <p>{{$clientintekform->relationship}}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-field">
                <label class="form-label">Mobile</label>
                <p> {{$clientintekform->dial_code}} &nbsp {{$clientintekform->mobile}} </p>
            </div>
        </div>
    </div>
    <h3 class="pb-2">Issues</h3>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Mood Regulation</label>
                @php
                $getallmoodRe = "";
                if($clientintekform->mood_regulation != null){
                    $getallmoodRe =  Helper::getAllSingleMoodRegulation($clientintekform->mood_regulation);
                }else{
                    $getallmoodRe  = "0" ;
                }
                @endphp
               @if($getallmoodRe != false)

                    @foreach($getallmoodRe as $key => $value)
                          <p> {{$value->subcategory}} </p>
                    @endforeach

               @else
                    <p> {{"N/A"}} </p><br>
               @endif
               
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Family and Relationships</label>
           
                @php
                $getallmoodRe = "";
                if($clientintekform->family_and_relationships != null){
                    $getallmoodRe =  Helper::getAllSingleMoodRegulation($clientintekform->family_and_relationships);
                }else{
                    $getallmoodRe  = "0" ;
                }
                @endphp
               @if($getallmoodRe != false)

                    @foreach($getallmoodRe as $key => $value)
                          <p> {{$value->subcategory}} </p>
                    @endforeach

               @else
                    <p> {{"N/A"}} </p><br>
               @endif
               
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Academic or Work-related</label>
               
                @php
                $getallmoodRe = "";
                if($clientintekform->academic_or_work_related != null){
                    $getallmoodRe =  Helper::getAllSingleMoodRegulation($clientintekform->academic_or_work_related);
                }else{
                    $getallmoodRe  = "0" ;
                }
                @endphp
               @if($getallmoodRe != false)

                    @foreach($getallmoodRe as $key => $value)
                          <p> {{$value->subcategory}} </p>
                    @endforeach

               @else
                    <p> {{"N/A"}} </p><br>
               @endif
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Personal</label>
                @php
                $getallmoodRe = "";
                if($clientintekform->personal != null){
                    $getallmoodRe =  Helper::getAllSingleMoodRegulation($clientintekform->personal);
                }else{
                    $getallmoodRe  = "0" ;
                }
                @endphp
               @if($getallmoodRe != false)

                    @foreach($getallmoodRe as $key => $value)
                          <p> {{$value->subcategory}} </p>
                    @endforeach

               @else
                    <p> {{"N/A"}} </p><br>
               @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Other</label>
            
                @php
                $getallmoodRe = "";
                if($clientintekform->other != null){
                    $getallmoodRe =  Helper::getAllSingleMoodRegulation($clientintekform->other);
                }else{
                    $getallmoodRe  = "0" ;
                }
                @endphp
               @if($getallmoodRe != false)

                    @foreach($getallmoodRe as $key => $value)
                          <p> {{$value->subcategory}} </p>
                    @endforeach

               @else
                    <p> {{"N/A"}} </p><br>
               @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-field">
                <label class="form-label">Anything else? </label>
                <p>{{$clientintekform->anything_else}} </p>
            </div>
        </div>
    </div>
    <h3 class="pb-2">General Information</h3>
    <div class="form-field">
        <label class="form-label">What is your current relationship status?</label>
        <p>{{$clientintekform->your_relationship_status == null ? "N/A" : $clientintekform->your_relationship_status }} </p>
    </div>
    <div class="form-field">
        <label class="form-label">What is your occupation?</label>
        <p>{{$clientintekform->your_occupation == null ? "N/A" : $clientintekform->your_occupation}} </p>
    </div>
    <div class="form-field">
        <label class="form-label">What are you highest educational qualifications?</label>
        <p>{{$clientintekform->highest_qualifications == null ? "N/A" : $clientintekform->highest_qualifications }} </p>
    </div>
    <div class="form-field">
        <label class="form-label">Have you previously had one or more sessions with a psychologist, counsellor or social worker?</label>
        <p>{{$clientintekform->previously_had_any_sessions_with_anyone == 0 ? "No" : "Yes" }} </p>
    </div>
    @if($clientintekform->previously_had_any_sessions_with_anyone == 1)
    <div class="form-field">
        <label class="form-label">If yes, please tell us when you last consulted someone and what they helped you with.</label>
        <p>{{$clientintekform->if_yes_last_consulted == null ? "N/A" : $clientintekform->if_yes_last_consulted }}</p>
    </div>
    @endif

    <div class="form-field">
        <label class="form-label">Are you currently consulting with a psychologist, counsellor or social worker?</label>
        <p>{{ $clientintekform->are_you_currently_consulting_with_anyone == 0 ? "No" : "Yes" }} </p>
    </div>
    @if($clientintekform->are_you_currently_consulting_with_anyone == 1 )
    <div class="form-field">
        <label class="form-label">If yes, please tell us what they are helping you with.</label>
        <p>{{$clientintekform->if_yes_they_are_helping_you == null ? "N/A" : $clientintekform->if_yes_they_are_helping_you }}</p>
    </div>
    @endif
    <div class="form-field">
        <label class="form-label">Please share the personal or professional goals that you would like to work towards with your Therapist. (100 words max)</label>
        <p>{{$clientintekform->share_personal_and_professional_goals == null ? "N/A" : $clientintekform->share_personal_and_professional_goals }} </p>
    </div>
</div>
