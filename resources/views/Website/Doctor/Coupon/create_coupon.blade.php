<form id="CouponForm" name="formSubmit" method="POST">
    <h2 class="text-center mb-4 pb-3">Create Discount Code</h2> 
    <input type="hidden" name="id" id="id" >
    <div class="form-field">
        <label class="form-label">Client(s)</label>
        <select style="width: 100%;" name="cliend_name_id[]" id="cliend_name_id" multiple>
        </select>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Discount Code</label>
                <input type="text" name="discount_code" id="discount_code" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Number of Sessions Limit (per client)</label>
                <input type="number" name="per_user_limit" id="per_user_limit" class="form-control" min="1" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Expiry Date</label>
                <input type="text" data-toggle="datepicker" name="expiry_date" id="expiry_date"  class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-field">
                <label class="form-label">Discount Value</label>
                <input type="number" name="discount_value" id="discount_value" min="1" class="form-control" placeholder="">
            </div>
        </div>
    </div>
    <div class="form-field">
        <label class="form-label">Description (for your reference only)</label>
        <textarea name="description" id="description" class="form-control textarea-big"></textarea>
    </div>
    <p class="pt-2"><button type="submit" class="btn btn-primary btn-long">CREATE AND SEND CODE</button></p>
</form>

<script type="text/javascript" language="javascript" src="{{url('assets/js/custom.js')}}?t={{now()->timestamp}}"></script>

<script>

$('[data-toggle="datepicker"]').datepicker({
    });

$(document).ready(function () {

    $.ajax({
        url: "{{url('api/getclientDetails')}}",
        type: "POST",
        dataType: 'json',
        success: function (response) {

        $('#cliend_name_id').empty();
        $('#cliend_name_id').append('<option value=""disable>Please Select</option>');

        $.each(response.data ,function(index,data)
        {
            $('#cliend_name_id').append('<option value="' + data.id + '">' + data.first_name +' '+data.last_name +' </option>');
        });
        //$('#cliend_name_id').selectpicker('refresh');
        }
    });

    $("#CouponForm").on("submit", function(e){

        e.preventDefault();

        var formData = new FormData(this);
       
        $.ajax({
            url: "{{url('api/addCoupons')}}",
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success:function(response){

                if (response.status == true)
                {
                      alert(response.message);
                      tbl_couponDetails.ajax.reload();
                      $("#modelCreateDiscountCode").modal('hide');   
                }
                else
                {
                    alert(response.message);
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