@foreach ($allIssues as $showcategory)
    <div class="col-md-2">
        <div class="form-field">
            <h3>{{$showcategory->category_name}}</h3>
            @foreach (Helper::getAllIssues($showcategory->id) as $showsubcategory)
                <div class="form-check mb-1">
                    <input type="checkbox" class="form-check-input checkByUser onCheckedIssues" id="issue_checkbox_{{$showsubcategory->id}}" data-id="{{$showsubcategory->id}}" data-catname="{{$showsubcategory->subcategory}}" data-categoryname="{{preg_replace('/[\s-]/', '_', strtolower($showcategory->category_name))}}" name="{{$showcategory->name}}[]" value="{{$showsubcategory->id}}">
                    <label class="form-check-label" for="issue_stress">
                        {{$showsubcategory->subcategory}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
@endforeach