@foreach ($issues as $showcategory)
    <div class="col-md-4">
        <div class="form-field">
            <label class="form-label text-dark">{{$showcategory->category_name}}</label>
            @if( $showcategory->name == 'mood_regulation' )
                @foreach (Helper::getIssues($showcategory->id) as $showsubcategory)
                    <div class="form-check mb-1">
                        <input type="checkbox" {{in_array($showsubcategory->id,explode(",",$therapistDataForEditProfile->mood_regulation)) ? "checked" : ""}} class="form-check-input issuess" name="{{$showcategory->name}}[]" value="{{$showsubcategory->id}}">
                        <label class="form-check-label" for="issue_stress">{{$showsubcategory->subcategory}}</label>
                    </div>
                @endforeach
            @endif

            @if( $showcategory->name == 'family_and_relationships' )
                @foreach (Helper::getIssues($showcategory->id) as $showsubcategory)
                    <div class="form-check mb-1">
                        <input type="checkbox" {{in_array($showsubcategory->id,explode(",",$therapistDataForEditProfile->family_and_relationships)) ? "checked" : ""}} class="form-check-input issuess" name="{{$showcategory->name}}[]" value="{{$showsubcategory->id}}">
                        <label class="form-check-label" for="issue_stress">{{$showsubcategory->subcategory}}</label>
                    </div>
                @endforeach
            @endif

            @if( $showcategory->name == 'academic_or_work_related' )
                @foreach (Helper::getIssues($showcategory->id) as $showsubcategory)
                    <div class="form-check mb-1">
                        <input type="checkbox" {{in_array($showsubcategory->id,explode(",",$therapistDataForEditProfile->academic_or_work_related)) ? "checked" : ""}} class="form-check-input issuess" name="{{$showcategory->name}}[]" value="{{$showsubcategory->id}}">
                        <label class="form-check-label" for="issue_stress">{{$showsubcategory->subcategory}}</label>
                    </div>
                @endforeach
            @endif

            @if( $showcategory->name == 'personal' )
                @foreach (Helper::getIssues($showcategory->id) as $showsubcategory)
                    <div class="form-check mb-1">
                        <input type="checkbox" {{in_array($showsubcategory->id,explode(",",$therapistDataForEditProfile->personal)) ? "checked" : ""}} class="form-check-input issuess" name="{{$showcategory->name}}[]" value="{{$showsubcategory->id}}">
                        <label class="form-check-label" for="issue_stress">{{$showsubcategory->subcategory}}</label>
                    </div>
                @endforeach
            @endif

            @if( $showcategory->name == 'other' )
                @foreach (Helper::getIssues($showcategory->id) as $showsubcategory)
                    <div class="form-check mb-1">
                        <input type="checkbox" {{in_array($showsubcategory->id,explode(",",$therapistDataForEditProfile->other)) ? "checked" : ""}} class="form-check-input issuess" name="{{$showcategory->name}}[]" value="{{$showsubcategory->id}}">
                        <label class="form-check-label" for="issue_stress">{{$showsubcategory->subcategory}}</label>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endforeach
<div class="col-md-4">
    <div class="form-field">
        <label class="form-label text-dark">Anything else?</label>
        <textarea class="form-control" id="anything_else" name="anything_else"> </textarea>
    </div>
</div>