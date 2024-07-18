@foreach ($issuesMoodRegulation as $showcategory)
    <div class="col-md-4">
        <div class="form-field">
            <h5>{{$showcategory->category_name}}</h5>
            @foreach (Helper::getAllMoodRegulation($showcategory->id) as $showsubcategory)
                <div class="form-check mb-1">
                    <input type="checkbox" class="form-check-input issuess" name="{{$showcategory->name}}[]" value="{{$showsubcategory->id}}" onclick="checkValidationForCheckbox()">
                    <label class="form-check-label" for="issue_stress">
                        {{$showsubcategory->subcategory}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
<div class="col-md-4">
    <div class="form-field">
        <label class="form-label text-dark f13">Anything else?</label>
        <textarea type="text" class="form-control" placeholder="" id="anything_else" name="anything_else" onkeyup="checkValidationForCheckbox()" maxlength="30"></textarea>
    </div>
</div>

<script type="text/javascript">

$("#issuesValidation").hide();

    function checkValidationForCheckbox()
    {
        var oneSelected = false;
        $('.issuess').each(function (index, obj) {
            if (this.checked === true) {
                oneSelected = true;
                $("#issuesValidation").hide();
            }
        });

        if (oneSelected == true)
        {
            $("#issuesValidation").hide();
            return true;
        }else
        {
            if ($("#anything_else").val() == "")
            {
                $("#issuesValidation").show();
                return false;
            }else
            {
                $("#issuesValidation").hide();
                return true;
            }
        }
    }

</script>