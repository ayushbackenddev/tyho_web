@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <input type="hidden" value="{{isset($id)?$id:''}}" id="client_id_fk" name="client_id_fk">
    <div class="container">
        <div class="box_form_detail" id="userDetails">
            
        </div>
        <button type="submit" onclick="showintekform()" class="btn btn-primary mt-3 mb-5">View intake form</button></td>
        <table class="table align-top" id="showClientSessionsData">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="column_session">Session</th>
                    <th scope="col">Status</th>
                    <th scope="col">Service</th>
                    <th scope="col">Medium</th>
                    <th scope="col" class="column_quick_notes2">Quick Notes</th>
                    <th scope="col" class="column_actions">Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        <div class="page-center mb-5 pb-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-3 mb-5">
                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</article>

<!-- Modal Code-->
    <div class="modal fade" id="modelNotes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                <div class="modal-body p-3" id="forQuickNote">
                    <form id="addQuickNotes" name="FormSubmit" method="POST">
                        <input type="hidden" id="order_session_id" name="order_session_id">
                        <div class="form-field">
                            <label class="form-label">Quick Notes</label>
                            <textarea class="form-control" name="quick_notes"></textarea>
                        </div>
                        <p class="mb-0 text-end"><button type="submit" class="btn btn-sm btn-primary">Update</button> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Code-->

<!-- Content Code End -->

@include('Website/Assets/footer')

<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">


$("#addQuickNotes").on("submit", function(e){

    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: "{{url('api/addNotes')}}",
        type: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success:function(response){

            if (response.status == true)
            {
                toastr.success(response.message);
                window.location.href = window.location.href;
            }
            else
            {
                toastr.error(error.message);
            }
        },
        error:function(error){
            console.log(error);
            toastr.error(error.message);
        },
    });
});

var client_id_fk = $("#client_id_fk").val();
    
$.ajax({
    url: "{{url('api/clientDetail')}}",
    type: "POST",
    data: {'client_id_fk':client_id_fk},
    dataType: 'json',
    
    success:function(response){

        if (response.status == true)
        {
            $("#userDetails").append(response.clientsDetails);
        }
        else
        {
            toastr.error(response.message);
        }
    },
    error:function(error){
        toastr.error(error.message);
    },
});

$(document).ready(function () {
    var id = $("#client_id_fk").val();
    tbl_clientsDetails = $('#showClientSessionsData').DataTable(
    {
        "serverSide": true,
        paging:true,
        pageLength:10,
        "processing": false,
        "pagingType": "full_numbers",
        "scrollX": false,
        "searching": true,
        ajax: {
            url: "{{url('api/clientData')}}",
            type: "POST",
            data: {'id': id },
            allInOne: false,
            refresh: false,
            dataSrc: function (json)
            {
                for (var i = 0; i < json.data.length; i++)
                {
                    var object =  json.data[i];
                    
                    object.sessions = object.slot_date +', '+ object.start_time + '-' + object.end_time;
                  
                    object.status = '<span style="color: red; font-weight: bold;">-</span>';
                    object.action = '<span style="color: red; font-weight: bold;">-</span>';
                    object.medium = "<span class='text-primary' data-toggle='tooltip' title='Tooltip Text'>"+ object.medium +"</span>"
                    if (object.quick_notes != null) {
                        object.quick_notes = object.quick_notes +' '+ '<a type="button" data-id="'+object.id+'" class="btn_edit addQuickNotes"><i class="fas fa-pencil-alt"></i></a>';
                    }else{
                        object.quick_notes = '<a type="button" data-id="'+object.id+'" class="btn_edit addQuickNotes"><i class="fas fa-pencil-alt"></i></a>';
                    }
                }
                return json.data;
            },
        },
        "columnDefs": [
            { "orderable": false, "targets": [0,1,2,3,4,5,6] }
        ],
        "columns":
        [
            { "data": "id"},
            { "data": "sessions"},
            { "data": "status"},
            { "data": "service"},
            { "data": "medium"},
            { "data": "quick_notes"},
            { "data": "action"},
        ]
    });
});

$(document).off().on('click', '.addQuickNotes', function () {

    var id = $(this).data("id");
    $('#modelNotes').modal('show');
    $("#order_session_id").val(id)
});

</script>