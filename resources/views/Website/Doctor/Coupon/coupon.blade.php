@include('Website/Assets/headerForTherapist')
    <!-- Content Code Start -->

    <article>
        <div class="container">
            <div class="box_top_content">
                <div class="row align-items-center">
                    <div class="col-6">
                        
                    </div>
                    <div class="col-6 text-end">
                        <a href="#" onclick="createcouponform()" class="btn btn-primary btn-long" data-bs-toggle="modal" data-bs-target="#modelCreateDiscountCode">Create new</a>
                    </div>
                </div>
            </div>
            <div class="box_table">
                <table class="table table-discount" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Discount Value</th>
                            <th scope="col">Date of Issue</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col">Number of<br/> Sessions Limit</th>
                            <th class="column_clients" scope="col">Client(s)</th>
                            <th class="column_description" scope="col">Description </th>
                            <th scope="col">Status</th>
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
            </div>
        </div>
    </article>

    <!-- Content Code End -->
    <!-- Modal Code-->
    <div class="modal  fade" id="modelCreateDiscountCode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <a href="#" class="btnClose" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                <div class="modal-body" id="createcouponform">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Code-->


    @include('Website/Assets/footer')
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" language="javascript" src="assets/js/datepicker.js"></script>
<script>
    // $('#dataTable').DataTable({
    //     bPaginate: false,
    //     bFilter: false,
    //     //ordering: false,
    //     searching: true,  
    //     responsive: true,
    // });   
    // oTable = $('#dataTable').DataTable(); 
    //     $('#myInputTextField').keyup(function(){
    //     oTable.search($(this).val()).draw() ;
    // })
    // $(document).ready(function() {
    //     $('#modelCreateDiscountCode').modal('show');
    // });
    $('[data-toggle="datepicker"]').datepicker({
    });
</script>
<script>
function createcouponform(){
    $.ajax({
        type: "POST",
        url: "{{url('api/createcouponForm')}}",
        dataType: "json",

        success: function (data){
            $("#createcouponform").empty();
            $("#createcouponform").append(data.createcoupon);
            $('#modelCreateDiscountCode').modal('show');
        },
        error: function (error) {
            console.log(error);
            alert("Data loading issue");
        }
    });

} 



$(document).ready(function () {
    tbl_couponDetails = $('#dataTable').DataTable(
    {
        "serverSide": true,
        paging:true,
        pageLength:10,
        "processing": false,
        "pagingType": "full_numbers",
        "scrollX": false,
        "searching": true,
        ajax: {
            url: "{{url('api/showCouponData')}}",
            type: "POST",
            allInOne: false,
            refresh: false,
            dataSrc: function (json)
            {
                for (var i = 0; i < json.data.length; i++)
                {
                    var object =  json.data[i];
                    
                    if(object.datestutas == 1){
                        object.stutas = "<span class='badge rounded-pill bg-success text-white'>Active </span>";
                    }else if(object.datestutas == 2) {
                        object.stutas = "<span class='badge rounded-pill bg-warning text-white'>Upcoming </span>";  
                    }else if(object.datestutas == 3){
                        object.stutas = "<span class='badge rounded-pill bg-danger text-white'>Expired / Redeemed </span>"; 
                    }else{
                        object.stutas = "_"; 
                    }
                    if(object.status == 1){
                        object.deactivate = "<a href='#' onclick='deleterole("+object.id+","+object.status+")' class='btn btn-primary btn-sm btn-deactivate m-0'>Deactivate</a></div>";
                    }else{
                        object.deactivate = "<a href='#' onclick='deleterole("+object.id+","+object.status+")' class='btn btn-primary btn-sm btn-deactivate m-0'>activate</a></div>";
                    }
                    object.action = "<div class='d-grid gap-2'><a href='#' class='btn btn-primary btn-sm'>View details</a>"+object.deactivate ;

                }
                return json.data;
            },
        },
        "columns":
        [
            { "data": "discount_code","name" :"discount_code"},
            { "data": "discount_value","name":"discount_value"},
            { "data": "date_of_issue","name":"date_of_issue"},
            { "data": "expiry_date","name":"expiry_date"},
            { "data": "per_user_limit","name":"per_user_limit"},
            { "data": "cliend_name_id"},
            { "data": "description"},
            { "data": "stutas"},
            { "data": "action"},
        ]
    });
});

function deleterole(id,status)
{
    if (status == 1){
    
        $.ajax({
            type: "POST",
            url: "{{url('api/therapiscoupuntatus')}}",
            dataType: "json",
            data:{"id":id, "status":status == 0 ? 1:0},
            success: function (data){
            tbl_couponDetails.ajax.reload();
            },
            error: function (error){
            console.log(error);
            alert("Data loading issue");
            }
        });  
    }else{
    
      $.ajax({
        type: "POST",
        url: "{{url('api/therapiscoupuntatus')}}",
        dataType: "json",
        data:{"id":id, "status":status == 0 ? 1:0},
        success: function (data){
        tbl_couponDetails.ajax.reload();
        },
        error: function (error){
          console.log(error);
          alert("Data loading issue");
        }
      });
    }
  
}
	
</script>

