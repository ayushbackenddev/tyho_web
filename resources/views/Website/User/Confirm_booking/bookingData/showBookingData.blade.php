@foreach ($leftSide as $details)
    <h4 class="mb-3">Your Therapist - {{$details->first_name ." ". $details->middle_name ." ". $details->last_name}}</h4>
    <input type="hidden" name="therapist_id_fk" id="therapist_id_fk" value="{{$details->therapist_id_fk}}">
    <input type="hidden" name="cart_id" id="cart_id" value="{{$details->id}}">

    <div class="row row_servicesDetail align-items-center">
        <div class="col-md-3"><h6 class="text-primary">Service</h6></div>
        <div class="col-md-7">
            <ul class="list_servicesDetail">
                <li class="column_services">{{$details->service}}</li>
                <li class="column_price">{{ Helper::getServicePrice($details->therapist_id_fk, $details->service_id_fk) }}</li>
                <li class="column_course"><span class="text-courses">X {{$showSelectedSlots}}</span></li>
            </ul>
        </div>
        
        @php
            $servicePrice = Helper::getServicePrice($details->therapist_id_fk, $details->service_id_fk);
            $selectedServiceCount = $showSelectedSlots;
            $totalServicePrice = $servicePrice * $selectedServiceCount;
        @endphp
        <div class="col-md-2">{{Helper::getTherapistCurrency($details->therapist_id_fk)}} {{$totalServicePrice}}</div>
    </div>
    <div class="row row_servicesDetail align-items-center">
        <div class="col-md-3"><h6 class="text-primary">Medium <a data-toggle="tooltip" title="Title Text" href="#"><i class="fas fa-info-circle"></i></a></h6></div>
        <div class="col-md-7">
            <ul class="list_servicesDetail">
                <li class="column_services">{{$details->medium}}</li>
                <li class="column_price">{{ Helper::getMediumPrice($details->medium_id_fk) }}</li>
                <li class="column_course"><span class="text-courses">X {{$showSelectedSlots}}</span></li>
            </ul>
        </div>
        @php
            $mediumPrice = Helper::getMediumPrice($details->medium_id_fk);
            $selectedMediumCount = $showSelectedSlots;
            $totalMediumPrice = $mediumPrice * $selectedMediumCount;
        @endphp
        <div class="col-md-2">{{Helper::getTherapistCurrency($details->therapist_id_fk)}} {{$totalMediumPrice}}</div>
    </div>
    <div class="row row_servicesDetail align-items-center">
        <div class="col-md-3"><h6 class="text-primary">Total</div>
        <div class="col-md-7"></div>
        @php
            $totalPrice = $totalServicePrice + $totalMediumPrice;
        @endphp
        <div class="col-md-2">{{Helper::getTherapistCurrency($details->therapist_id_fk)}} {{$totalPrice}}</div>
    </div>
    <div class="row row_servicesDetail align-items-center">
        <div class="col-md-3"><h6 class="text-primary">Discount Code </h6></div>
        <div class="col-md-7">
            <div class="box_discountCode">
                <input type="hidden" name="totaleprice" id="totaleprice" value="{{$totalPrice}}">
                <input type="text" name="couponaplly" id="couponaplly" class="form-control" placeholder="Enter code"/>
                <button onclick="getCouponAplly()" class="btn btn-primary btn-sm">Apply</button>
            </div>
        </div>
        @php
            $discount_type = " ";
            $discount_value = "0";
            $discountValue = "0";
            $dicountCoupon = $details->discount_coupon;
            if($dicountCoupon != "" || $dicountCoupon != null){
                $getcoupon = Helper::getCouponDetails($dicountCoupon); 
                if(count($getcoupon) > 0){
                    foreach($getcoupon as $value){
                        $discount_type = $value->discount_type;
                        $discount_value = $value->discount_value;
                    }
                    if($discount_type == 2){
                        $disValue = $totalPrice * $discount_value ;
                        $discountValue = $disValue /100;
                    }else{
                        $discountValue = $discount_value;
                    }  
                }
            }
            $totalamount = $totalPrice - $discountValue ;
       @endphp
       <input type="hidden" name="totalamount" id="totalamount" value="{{$totalamount}}">
        <div class="col-md-2"><span class="dash-text">-</span>  {{Helper::getTherapistCurrency($details->therapist_id_fk)}} {{$discountValue}} 
         <a onclick="applycoupondisable()" class="close_button"><i class="fas fa-times-circle"></i></a> </div>
    </div>
    @php
        $wallet = 0;
    @endphp
    <div class="row row_servicesDetail align-items-center">
        <div class="col-md-3"><h6 class="text-primary">Wallet <a data-toggle="tooltip" title="Title Text" href="#"><i class="fas fa-info-circle"></i></a></h6></div>
        <div class="col-md-7">
            <span class="textBalanceTable">Balance {{Helper::getTherapistCurrency($details->therapist_id_fk)}} {{$mywallet}}</span>
            <div class="form-check form-check-wallet">
                <input type="hidden" name="mywallet" id="mywallet" value ="{{$mywallet}}">
                <input type="checkbox" onclick="mywalletuse()" class="form-check-input" id="walletBalance">
                <label class="form-check-label" for="walletBalance">Use Wallet Balance</label>
            </div>
        </div>
        <div class="col-md-2"><span class="dash-text">-</span> {{Helper::getTherapistCurrency($details->therapist_id_fk)}} <span class="fill" id="percentage" ></span></div>
    </div>
    <hr/>
    <div class="row row_servicesDetail align-items-center" id="divhideinshow">
        <div class="col-md-10"><h3>Amount Due</h3> </div>
        <div class="col-md-2"><h3>{{Helper::getTherapistCurrency($details->therapist_id_fk)}} <span class="fill" id="duemount">{{$totalamount }} </span></h3> </div>
        <input type="hidden" name="amount" value="{{$totalamount}}">
    </div>
@endforeach