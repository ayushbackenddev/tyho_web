@include('Website/Assets/header')

<article>
    <div class="container">
        <div class="row rowBalanceDetail">
            <div class="col-md-6">
                <div class="btn btn-primary btn-round me-3">
                    Current Balance: S$ 250
                </div>
                <div class="dropdown_simple">
                    <select class="form-control styledSelect">
                        <option selected>Singapore Dollar (S$)</option>
                        <option>Singapore Dollar (S$)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_walletLedger" id="wallet_ledger">Wallet ledger</button>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modelWithdrawFunds" id="withdraw">Withdrawal</button>
            </div>
        </div>
        <form data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="wallet_form">
            <div class="content_box_normal boxMyWalletMain">
                <div class="row g-4">
                    <div class="col-md-6 pe-4">
                        <h4 class="mb-3">Wallet Top up</h4>
                        <div class="form-field inline_radioBtns radioBtnsBox">
                            <div class="form-check d-inline-block me-2">
                                <input class="form-check-input" type="radio" name="package" id="package" checked="">
                                <label class="form-check-label" for="package"> Package</label>
                            </div>
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="radio" name="package" id="customAmount">
                                <label class="form-check-label" for="customAmount"> Custom Amount</label>
                            </div>  
                        </div>
                        <div class="boxPackage show">
                            <div class="form-field">
                                <label class="form-label">Type of Therapist <a data-toggle="tooltip" title="Please check the profile of your preferred Therapist to see whether they are a Empathy or Care Therapist." href="#"><i class="fas fa-info-circle"></i></a></label>
                                <ul class="listcheckboxButtons">
                                    <li>
                                        <input type="checkbox" class="btn-check" id="empathyTherapist">
                                        <label class="btn" for="empathyTherapist">Empathy Therapist</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="careTherapist" checked>
                                        <label class="btn" for="careTherapist">Care Therapist</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-field">
                                <label class="form-label">Service</label>
                                <ul class="listcheckboxButtons">
                                    <li>
                                        <input type="checkbox" class="btn-check" id="introductory">
                                        <label class="btn" for="introductory">Introductory</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="individuals">
                                        <label class="btn" for="individuals">Individuals</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="couples" checked="">
                                        <label class="btn" for="couples">Couples</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="family">
                                        <label class="btn" for="family">Family</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="assessment">
                                        <label class="btn" for="assessment">Assessment</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-field">
                                <label class="form-label">Medium</label>
                                <ul class="listcheckboxButtons">
                                    <li>
                                        <input type="checkbox" class="btn-check" id="video1" checked>
                                        <label class="btn" for="video1">Video</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="audio1">
                                        <label class="btn" for="audio1">Audio</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="textBasedChat1">
                                        <label class="btn" for="textBasedChat1">Text-Based Chat</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="inPerson1">
                                        <label class="btn" for="inPerson1">In-Person</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" class="btn-check" id="HomeVisit1">
                                        <label class="btn" for="HomeVisit1">Home Visit</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-field">
                                        <label class="form-label">Number of Sessions </label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>    
                                </div>
                            </div>
                            <div class="row row_servicesDetail align-items-center">
                                <div class="col-md-5"><h6 class="text-primary">Service</h6></div>
                                <div class="col-md-5">
                                    <ul class="list_servicesDetail">
                                        <li class="column_services">Individual</li>
                                        <li class="column_price">S$ 150</li>
                                        <li class="column_course"><span class="text-courses">X 3</span></li>
                                    </ul>
                                </div>
                                <div class="col-md-2">S$ 450</div>
                            </div>
                            <div class="row row_servicesDetail align-items-center">
                                <div class="col-md-5"><h6 class="text-primary">Medium </h6></div>
                                <div class="col-md-5">
                                    <ul class="list_servicesDetail">
                                        <li class="column_services">In-Person</li>
                                        <li class="column_price">S$ 30</li>
                                        <li class="column_course"><span class="text-courses">X 3</span></li>
                                    </ul>
                                </div>
                                <div class="col-md-2">S$ 90</div>
                            </div>
                            <div class="row row_servicesDetail align-items-center">
                                <div class="col-md-5"><h6 class="text-primary">Total Credits Purchased <a data-toggle="tooltip" title="This is the amount that will be credited into your wallet." href="#"><i class="fas fa-info-circle"></i></a></h6></div>
                                <div class="col-md-5"></div>
                                <div class="col-md-2">S$ 560</div>
                            </div>
                            <div class="row row_servicesDetail align-items-center">
                                <div class="col-md-3"><h6 class="text-primary">Discount</h6></div>
                                <div class="col-md-7"></div>
                                <div class="col-md-2"><span class="dash-text">-</span> S$ 40  </div>
                            </div>
                            <hr/>
                            <div class="row row_servicesDetail align-items-center">
                                <div class="col-md-10"><h3>Amount Due</h3> </div>
                                <div class="col-md-2"><h3>S$ 500</h3> </div>
                            </div>
                        </div>    
                        <div class="boxCustomAmount">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-field">
                                        <label class="form-label">Wallet Top Up Amount (S$)</label>
                                        <input type="text" class="form-control" name="amount" id="amount" value="500">
                                    </div>
                                </div>
                            </div>
                            <div class="row row_servicesDetail align-items-center">
                                <div class="col-md-3"><h6 class="text-primary">Discount</h6></div>
                                <div class="col-md-7"></div>
                                <div class="col-md-2"><span class="dash-text">-</span> S$ 40  </div>
                            </div>
                            <hr/>
                            <div class="row row_servicesDetail align-items-center">
                                <div class="col-md-10"><h3>Amount Due</h3> </div>
                                <div class="col-md-2"><h3>S$ 500</h3> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ps-4">
                        <h4 class="mb-3">Billing Details</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-field">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" id="full_name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-field">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-field">
                            <label class="form-label">Address</label>
                            <textarea class="form-control textarea_address" id="address" name="address"></textarea>
                        </div>
                        <div class="boxfill boxPaymentMethod p-4 mb-4">
                            <div class="form-field mb-0">
                                <label class="form-label">Credit / Debit  (Stripe)  </label>
                                <ul class="listPaymentcard">
                                    <li><img src="assets/img/mastercard.svg"> </li>
                                    <li><img src="assets/img/american-express.svg"> </li>
                                    <li><img src="assets/img/visa.svg"> </li>
                                </ul>
                                <div class="inputs_carddetail">
                                    <input type="text" class="form-control inputCard" placeholder="Card Number" name="card_number" id="card_number" />
                                    <input type="text" class="form-control inputMonth" placeholder="MM / YY" name="expiry_month_year" id="expiry_month_year" />
                                    <input type="text" class="form-control inputCVV" placeholder="CVV" name="cvv" id="cvv" />
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary" type="submit">Make Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form id="balanceTransfer" name="formSubmit" method="POST">
            <div class="row rowTransferBalance">
                <div class="col-md-6">
                    <div class="content_box_normal p-4">
                        <h4>Wallet Policy</h4>
                        <ul class="listSimple">
                            <li>We provide a 7% discount for a top up of S$ 300 or more, and 10% discount for S$ 750 or more.</li>
                            <li>You may withdraw your wallet credits at any time. There is a 15% charge to account for the discount provided, and administrative and transaction costs.</li>
                            <li>Your wallet credits can be used to book across different types of services and mediums. </li>
                            <li>Your wallet credits will expire two years after the date of purchase (some exceptions apply).</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content_box_normal p-4">
                        <h4>Transfer Balance</h4>
                        <p>You may wish to transfer your credits to a friend or family member's TYHO account. Please specify the email address associated with their TYHO account.</p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-field">
                                    <label class="form-label">Recipient's Email Address</label>
                                    <input type="text" class="form-control" name="email" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-field">
                                    <label class="form-label">Amount (SGD)</label>
                                    <input type="text" class="form-control" name="amount" placeholder="">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="submit">Transfer balance</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</article>

<!-- Wallet Ledger Modal Code-->
   <div class="modal fade" id="modal_walletLedger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                <div class="modal-body p-4" id="wallet_ledger_form">

                </div>
            </div>
        </div>
    </div>
<!-- End Wallet Ledger Modal Code-->

<!-- Withdraw Modal Code-->
    <div class="modal fade" id="modelWithdrawFunds" tabindex="-1" aria-labelledby="modelWithdrawFunds" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                <div class="modal-body" id="withdrawModal">

                </div>
            </div>
        </div>
    </div>
<!-- End Withdraw Modal Code-->

@include('Website/Assets/footer')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$("#balanceTransfer").on("submit", function(e){

    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "{{url('api/insertWallet')}}",
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
                toastr.error(response.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(response.message);
        },
    });
});

$("#wallet_ledger").click(function(){
    $.ajax({
        type: "POST",
        url: "{{url('api/ledgerForm')}}",
        dataType: "json",

        success: function (data){
            $("#wallet_ledger_form").empty();
            $("#wallet_ledger_form").append(data.data);
            $('#modal_walletLedger').modal('show');
        },
        error: function (error) {
          console.log(error);
            alert("Data loading issue");
        }
    });
});

$("#withdraw").click(function(){
    $.ajax({
        type: "POST",
        url: "{{url('api/withdrawForm')}}",
        dataType: "json",

        success: function (data){
            $("#withdrawModal").empty();
            $("#withdrawModal").append(data.data);
            $('#modelWithdrawFunds').modal('show');
        },
        error: function (error) {
          console.log(error);
            alert("Data loading issue");
        }
    });
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
        let form = document.getElementById('wallet_form');

        var formData = new FormData(form);
        formData.append( 'token', token );

        $.ajax({
            url: "{{url('api/stripePayment')}}",
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,

            success:function(response){

                if (response.status == true)
                {
                    toastr.success(response.message);
                    //window.location.href = "/clientDashboard";
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
    }
}

$("#wallet_form").validate({

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
    
$(document).ready(function() {
    $('.btn-runningopen').click(function() {
        $(".content_session").addClass('showPopup');
    });
    $('.btnCloseSm').click(function() {
        $(".content_session").removeClass('showPopup');
    });
}); 
$(function() {
    $("input[name='package']").click(function() {
        if ($("#package").is(":checked")) {
        $(".boxPackage").addClass("show");
        } else {
        $(".boxPackage").removeClass("show");
        }
    });
    $("input[name='package']").click(function() {
        if ($("#customAmount").is(":checked")) {
        $(".boxCustomAmount").addClass("show");
        } else {
        $(".boxCustomAmount").removeClass("show");
        }
    });
});

</script>