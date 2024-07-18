@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <div class="container">
        <div class="box_top_content">
            <div class="row align-items-center">
                <div class="col-6">
                    <p class="mb-0">You have 24 clients</p>
                </div>
                <div class="col-6 text-end">
                    <div class="boxSearch">
                        <input type="text" id="myInputTextField" class="form-control" placeholder="Search">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box_table">
            <table class="table" id="showClientsData">
                <thead>
                    <tr>
                        <th scope="col">Date Acquired</th>
                        <th scope="col">Name</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Gender</th>
                        <th scope="col">City</th>
                        <th scope="col">Country</th>
                        <th class="column_booked" scope="col">Sessions Booked</th>
                        <th class="column_upcoming" scope="col">Upcoming Session</th>
                        <th scope="col">Last Session</th>
                        <th class="column_quicknotes" scope="col">Quick Notes</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="page-center mb-5 pb-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                </ul>
            </nav>
            <!-- <ul class="listActions">
                <li><a href="#" data-toggle="tooltip" title="Message"><i class="far fa-comments"></i></a></li>
                <li><a href="#" data-toggle="tooltip" title="Intake Form"><i class="far fa-file-alt"></i></a></li>
                <li><a href="#" data-toggle="tooltip" title="All Information"><i class="fas fa-chevron-right"></i></a></li>
            </ul> -->
        </div>
    </div>
</article>

<!-- Modal Code-->

<div class="modal fade" id="clientinteckform" tabindex="-1" aria-labelledby="modelintakeform" >
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
            <div class="modal-body" id="clientinteckpop">

            </div>
        </div>
    </div>
</div>

<!-- Modal Code-->

<!-- Content Code End -->

@include('Website/Assets/footer')

<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>

function viewClientProfile(id){
    window.location.href = "{{url('clientDetail')}}/"+id;
}

$(document).ready(function () {

    tbl_clientsList = $('#showClientsData').DataTable(
    {
        "serverSide": true,
        paging:true,
        pageLength:10,
        "processing": false,
        "pagingType": "full_numbers",
        "scrollX": false,
        "searching": true,
        ajax: {
            url: "{{url('api/myclient')}}",
            type: "POST",
            allInOne: false,
            refresh: false,
            dataSrc: function (json)
            {
                for (var i = 0; i < json.data.length; i++)
                {
                    var object =  json.data[i];

                    object.action = "<ul class='listActions'><li><a type='button' style='color: #888CC4;' onclick='clientinteckform("+object.client_id_fk+")' data-toggle='tooltip' title='' data-bs-original-title='Intake Form' aria-label='Intake Form'><i class='far fa-file-alt'></i></a></li><li><a type='button' style='color: #888CC4;' data-toggle='tooltip' title='All Information' onclick='viewClientProfile("+object.client_id_fk+")'><i class='fas fa-chevron-right'></i></a></li></ul>";
                    if (object.slot_date != "") {
                        object.upcoming_sessions = object.slot_date +', '+ object.start_time + '-' + object.end_time + '(SGT)';
                    }
                    else{
                        object.upcoming_sessions = "-";
                    }
                    if (object.slot_date != "") {
                        object.last_sessions = object.slot_date;
                    }
                    else{
                        object.last_sessions = "-";
                    }
                    //object.quick_notes = '<span style="color: red; font-weight: bold;">-</span>';
                }
                return json.data;
            },
        },
        "columnDefs": [
            { "orderable": false, "targets": [2,3,5,6,9,10] },
            { "orderable": true, "targets": [0,1,4,7,8] }
        ],
        "columns":
        [
            { "data": "booking_date","name":"booking_date"},
            { "data": "full_name","name":"full_name"},
            { "data": "user_id"},
            { "data": "gender"},
            { "data": "city","name":"city"},
            { "data": "country"},
            { "data": "booked_session"},
            { "data": "upcoming_sessions","name":"slot_date"},
            { "data": "last_sessions","name":"slot_date"},
            { "data": "quick_notes"},
            { "data": "action"},
        ]
    });
});

function clientinteckform(id){
    var client_id_fk = id ;
   
    $.ajax({
        type: "POST",
        url: "{{url('api/clientintakForm')}}",
        data: {'client_id_fk':client_id_fk},
        dataType: "json",

        success: function (data){
            $("#clientinteckpop").empty();
            $("#clientinteckpop").append(data.data);
            $('#clientinteckform').modal('show');
        },
        error: function (error) {
            console.log(error);
            alert("Data loading issue");
        }
    });
}

</script>