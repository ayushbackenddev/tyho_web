<div class="row">
    <div class="col-6 columnformDetail column_normal">
        <div class="row">
            <div class="col-6"><strong>First Name</strong> </div>
            <div class="col-6">{{ $clientsDetails->first_name }}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Last Name</strong></div>
            <div class="col-6">{{ $clientsDetails->last_name }}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Age</strong> </div>
            <div class="col-6">{{ $clientsDetails->age }}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Gender</strong></div>
            <div class="col-6">{{ $clientsDetails->gender }}</div>
        </div>
    </div>
    <div class="col-6 columnformDetail column_normal">
        <div class="row">
            <div class="col-6"><strong>City / Country</strong> </div>
            <div class="col-6">{{ $clientsDetails->city }} / {{ $clientsDetails->country }}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Preferred Language</strong></div>
            <div class="col-6"><span style="color: red; font-weight: bold;">-</span></div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Referral</strong></div>
            <div class="col-6"><span style="color: red; font-weight: bold;">-</span></div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Emergency Contact Person Details</strong></div>
            <div class="col-6">{{ $clientsDetails->contact_name }}, {{ $clientsDetails->relationship }}, {{ $clientsDetails->mobile_no }}</div>
        </div>
    </div>
</div>