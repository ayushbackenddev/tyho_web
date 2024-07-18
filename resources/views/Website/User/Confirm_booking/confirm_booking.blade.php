@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <form data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        @csrf
        <div class="container">
            <div class="content_box_normal mb-2 cartEmpty">
                <p style="text-align: center;"> Your cart is empty</p>
            </div>
            <div class="content_box_normal mb-2 cartDetail">
                <div class="box_booking_details">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0">Booking Details</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <input type="hidden" name="userId" id="userId" value="{{Session::get('loggedUser')}}">
                            <a onclick="editBooking({{Session::get('loggedUser')}});" class="btn btn-primary">EDIT BOOKING</a>
                        </div>
                    </div>
                </div>
                <div class="row row_bookingDetail g-4">
                    <div class="col-md-6 border-end pe-4" id="showBookingData">

                    </div>
                    <div class="col-md-6 ps-4">
                        <h4 class="mb-3">Selected Slots</h4>
                        <ul class="list_slots" id="listOfSelectedSlots">

                        </ul>
                    </div>
                </div>
            </div>
            <p class="mb-4 f14 cartDetail">Please note our 24 hour rescheduling policy  <a data-toggle="tooltip" title="Title Text" href="#"><i class="fas fa-info-circle"></i></a></p>
            <div class="content_box_normal mb-5 p-4" id="addressHomevisit">
                <h4>Home Visit Address</h4>
                <p>Your Therapist will see you at the below address. Please note that the address cannot be changed later.</p>
                <div class="row rowHomeVisit">
                    <div class="col-md-5">
                        <div class="form-field">
                            <label class="form-label">Address</label>
                            <textarea class="form-control form_address" name="homevisit_address" id="homevisit_address"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-field">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" name="zip_code" id="zip_code" />
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-field">
                                    <label class="form-label">Phone <a href="#" class="iconTooltip" data-toggle="tooltip" title="The Therapist will contact this number if they are unable to find the home visit address provided."><i class="fas fa-info-circle"></i></a></label>
                                    <input id="phone_no" type="tel" class="form-control" name="phone_no" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-field">
                                    <label class="form-label">Country</label>
                                    <select class="form-control styledSelect" name="country" id="country">
                                    
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-field">
                                    <label class="form-label">State</label>
                                    <select class="form-control styledSelect" name="state" id="state">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-field">
                                    <label class="form-label">City</label>
                                    <select class="form-control styledSelect" name="city" id="city">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_box_normal mb-5 p-4 cartDetail" id="billingdetails">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Billing Details</h4>
                        <p>Please note that your session receipt(s) will reflect the details below, and cannot be changed later.</p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-field">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" id="full_name" name="full_name" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-field">
                                    <label class="form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-field mb-0">
                            <label class="form-label">Address</label>
                            <textarea class="form-control textarea_address" name="address" id="address"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-3">Payment Method</h4>
                        <div class="boxfill boxPaymentMethod p-4">
                            <div class="form-field mb-0">
                                <label class="form-label">Credit / Debit  (Stripe)  </label>
                                <ul class="listPaymentcard">
                                    <li><img src="assets/img/mastercard.svg"/> </li>
                                    <li><img src="assets/img/american-express.svg"/> </li>
                                    <li><img src="assets/img/visa.svg"/> </li>
                                </ul>
                                <div class="inputs_carddetail">
                                    <input type="text" class="form-control inputCard" placeholder="Card Number" name="card_number" id="card_number" />
                                    <input type="text" class="form-control inputMonth" placeholder="MM / YY" name="expiry_month_year" id="expiry_month_year" />
                                    <input type="text" class="form-control inputCVV" placeholder="CVV" name="cvv" id="cvv" />
                                </div>

                            </div>
                        </div>
                        <div class="d-grid btn_checkout_spacing">
                            <button class="btn btn-lg btn-primary" type="submit" >Make Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</article>

<!-- Content Code End -->

<div class="modal fade" id="modelClientBooking" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
            <div class="modal-body p-3" id="forBooking">

            </div>
        </div>
    </div>
</div>

@include('Website/Assets/footer')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

var phone_no = document.querySelector("#phone_no");
var telInputmobile = window.intlTelInput(phone_no, {
    separateDialCode: true,
    preferredCountries:["sg"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

function stripeResponseHandler(status, response) {
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
            alert(response.error.message);
    } else {
        /* token contains id, last4, and card type */
        var token = response['id'];
        let form = document.getElementById('payment-form');

        var formData = new FormData(form);
        formData.append( 'token', token );

        $.ajax({
            url: "{{url('api/paymentStripe')}}",
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,

            success:function(response){

                if (response.status == true)
                {
                    toastr.success(response.message);
                    window.location.href = "/clientDashboard";
                }
                else
                {
                    toastr.error(response.message);
                }
            },
            error:function(error){
                console.log(error);
                toastr.error(error.message);
            },
        });

        // $form.find('input[type=text]').empty();
        // $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        // $form.get(0).submit();
    }
}

$("#payment-form").validate({

    rules: {
        full_name: {
            required: true,
        },
        email: {
            required: true,
        },
        address: {
            required: true,
        },
        card_number: {
            required: true,
        },
        expiry_month_year: {
            required: true,
        },
        cvv: {
            required: true,
        },
    },
    messages: {
        full_name: {
            required: "Please enter your full name",
        },
        email: {
            required: "Please enter your email address",
        },
        address: {
            required: "Please enter your address",
        },
        card_number: {
            required: "Please enter your card number",
        },
        expiry_month_year: {
            required: "Please enter expiry month and year",
        },
        cvv: {
            required: "Please enter CVV number",
        },
    },

    submitHandler: function(form,event){

        event.preventDefault();

        var cardnumber = $("#card_number").val();
        var expiryDate = $("#expiry_month_year").val();

        var expiryMonth = expiryDate.split("/")[0];

        var expiryYear = expiryDate.split("/")[1];

        var cvv = $("#cvv").val();

        Stripe.setPublishableKey('pk_test_51J93rqSEMD4ImV1Nek8B9QW2pSfgC2BC14si8J2QSrNqoz6Y2NyGXtDIioK39qKFxoGvVKMQLe5XcN9khfYIZLS500Y8eqPVLa');
        Stripe.createToken({
            number: cardnumber,
            cvc: cvv,
            exp_month: expiryMonth,
            exp_year: expiryYear,
        }, stripeResponseHandler);

        return false;
    },
});

$(".cartDetail").show();
$("#addressHomevisit").hide();
$.ajax({
    url: "{{url('api/showSelectedSlots')}}",
    type: "POST",
    dataType: 'json',
    contentType: false,
    processData: false,

    success:function(response){

        if (response.status == false) {

            $(".cartDetail").hide();
            $(".cartEmpty").show();

        }else{

            console.log(response.selectedSlots);

            if (response.hasHomeVisit ==  true) {
                $("#addressHomevisit").show();
              
            }
            else{
                $("#addressHomevisit").hide();
               
            }

            $(".cartEmpty").hide();

            if(response.rightSide.length > 0)
            {
                $("#listOfSelectedSlots").html("");
                $("#showBookingData").html("");
            }
            $("#listOfSelectedSlots").append(response.rightSide);
            $("#showBookingData").append(response.leftSide);
        }
    },
    error:function(error){
        console.log(error);
        toastr.error(error.message);
    },
});

function mywalletuse(){
    var usewalletbalence = 0 ;
    var totalamount = $("#totalamount").val();
    var mywallet = $("#mywallet").val();
    let AmountDue = $("#divhideinshow");
    let billingdetails = $("#billingdetails");
   
    
    if ($("#walletBalance").is(':checked')) {
       if(mywallet >= totalamount){
            var usewalletbalence = totalamount ;
            $('#percentage').text(usewalletbalence);
            AmountDue.hide();
            billingdetails.hide();
       }else{
            var usewalletbalence = mywallet ;
            var makepaymentitem = totalamount - mywallet ;
            $('#percentage').text(usewalletbalence); 
       }
    }else{
        var usewalletbalence = 0;
        $('#percentage').text(usewalletbalence);
       
        AmountDue.show();
        billingdetails.show();
    }
}

function applycoupondisable(){
    var cart_id = $("#cart_id").val();

    if(cart_id != " "){
        $.ajax({
            type: "POST",
            url: "{{url('api/applycoupondisable')}}",
            dataType: "json",
            data: {"cart_id":cart_id},

            success: function (response){
               if(response.status == true){
                toastr.success(response.message);
               }else{
                toastr.error(error.message)  
               }
            },
            error:function(error){
                console.log(error);
                toastr.error(error.message);
            },

            
        });

        $.ajax({
            url: "{{url('api/showSelectedSlots')}}",
            type: "POST",
            dataType: 'json',
            contentType: false,
            processData: false,

            success:function(response){

                if (response.status == false) {

                    $(".cartDetail").hide();
                    $(".cartEmpty").show();

                }else{

                    console.log(response.selectedSlots);

                    if (response.hasHomeVisit ==  true) {
                        $("#addressHomevisit").show();
                    
                    }
                    else{
                        $("#addressHomevisit").hide();
                    
                    }

                    $(".cartEmpty").hide();

                    if(response.rightSide.length > 0)
                    {
                        $("#listOfSelectedSlots").html("");
                        $("#showBookingData").html("");
                    }
                    $("#listOfSelectedSlots").append(response.rightSide);
                    $("#showBookingData").append(response.leftSide);
                }
            },
            error:function(error){
                console.log(error);
                toastr.error(error.message);
            },
        });
    } 
}

$(document).on('click', '.removeSlotFromCart', function () {

    var slot_id_fk = $(this).data("slot_id_fk");

    $("#closeSelectedSlotBox"+slot_id_fk).remove();

    $.ajax({
        url: "{{url('api/removeSlot')}}",
        type: "POST",
        dataType: 'json',
        data: {"slot_id_fk":slot_id_fk},

        success:function(response){
            if (response.refershPage == true)
            {
                window.location.reload();
                toastr.success(response.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});

var userID = $("#userId").val();

function editBooking(userID)
{
    $.ajax({
        type: "POST",
        url: "{{url('api/editSlot')}}",
        dataType: "json",
        data: {"userID":userID},

        success: function (response){

            $("#forBooking").empty();
            $("#forBooking").append(response.clientBooking);
            $('#modelClientBooking').modal('show');
        },
        error: function (error)
        {
            console.log(error);
            alert("Data loading issue");
        }
    });
}
function getCouponAplly(){
    var therapist_id_fk = $("#therapist_id_fk").val();
    var couponcode = $("#couponaplly").val();
    var totalPrice = $("#totalPrice").val();
    if(couponcode != ""){
        $.ajax({
            type: "POST",
            url: "{{url('api/apllycoupncode')}}",
            dataType: "json",
            data: {"couponcode":couponcode,"userID":userID,"therapist_id_fk":therapist_id_fk,"totalPrice":totalPrice},

            success: function (response){
               if(response.status == true){
                toastr.success(response.message);
               }else{
                toastr.error(error.message)  
               }
            },
            error:function(error){
                console.log(error);
                toastr.error(error.message);
            },
        });

        $.ajax({
            url: "{{url('api/showSelectedSlots')}}",
            type: "POST",
            dataType: 'json',
            contentType: false,
            processData: false,

            success:function(response){

                if (response.status == false) {

                    $(".cartDetail").hide();
                    $(".cartEmpty").show();

                }else{
                    console.log(response.selectedSlots);

                    if (response.hasHomeVisit ==  true) {
                        $("#addressHomevisit").show();
                    }
                    else{
                        $("#addressHomevisit").hide();
                    }

                    $(".cartEmpty").hide();

                    if(response.rightSide.length > 0)
                    {
                        $("#listOfSelectedSlots").html("");
                        $("#showBookingData").html("");
                    }
                    $("#listOfSelectedSlots").append(response.rightSide);
                    $("#showBookingData").append(response.leftSide);
                }
            },
            error:function(error){
                console.log(error);
                toastr.error(error.message);
            },
        });
    }    
}


var getValue = " ";

$.ajax({
    url: "{{url('api/getCountry')}}",
    type: "POST",
    dataType: 'json',
    success: function (response) {

        $('#country').empty();
        $('#country').append('<option value="">Please Select</option>');

        $.each(response.data ,function(index,data)
        {
            $('#country').append('<option value="' + data.id + '">' + data.name + '</option>');
        });
    }
});

$("#country").select2();

$('#country').change(function(){
    var countryID = $(this).val();
    $.ajax({
        url: "{{url('api/getState')}}?country_id="+countryID,
        type: "POST",
        data: {country_id:countryID},
        dataType: 'json',
        success: function (response) {

            $('#state').empty();
            $('#state').append('<option value="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                $('#state').append('<option value="' + data.state_id + '">' + data.state_name + '</option>');
            });
        }
    });
});

$("#state").select2();

$('#state').change(function(){
    var stateID = $(this).val();
    $.ajax({
        url: "{{url('api/getCity')}}?state_id="+stateID,
        type: "POST",
        data: {state_id:stateID},
        dataType: 'json',
        success: function (response) {

            $('#city').empty();
            $('#city').append('<option value="">Please Select</option>');

            $.each(response.data ,function(index,data)
            {
                $('#city').append('<option value="' + data.id + '">' + data.name + '</option>');
            });
        }
    });
});

$("#city").select2();

</script>