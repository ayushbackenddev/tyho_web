@include('Website/Assets/header')

<!-- Content Code Start -->

<article>
    <div class="container">
        <p>Please note a receipt is only generated after the session is completed.</p>
        <div class="row-dateSelect">
            <div class="form-field d-flex mb-0">
                <label class="form-label">From</label>
                <input data-toggle="datepicker" type="text" class="form-control" placeholder="Select Date" id="start_date">
            </div>
            <div class="form-field d-flex mb-0">
                <label class="form-label">to</label>
                <input data-toggle="datepicker" type="text" class="form-control" placeholder="Select Date" id="end_date">
            </div>
            <button type="submit" class="btn btn-primary ms-3" id="download">Download all</button>
        </div>
        <div class="box_table">
            <table class="table" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date of Purchase</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
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

@include('Website/Assets/footer')

<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" language="javascript" src="{{url('assets/js/datepicker.js')}}?t={{now()->timestamp}}"></script>

<script>

$('[data-toggle="datepicker"]').datepicker({
    inline: true
});

  var start_date = document.getElementById('start_date');
  var end_date = document.getElementById('end_date');
  const reset = ()=>{
    start_date.value='';
    end_date.value='';
  }

var tbl_session;

tbl_session = $('#dataTable').DataTable(
{
    "serverSide": true,
    paging:true,
    pageLength:10,
    "processing": false,
    "pagingType": "full_numbers",
    "scrollX": false,
    "searching": true,
    ajax: {
        url: "{{url('api/sessionOrder')}}",
        type: "POST",
        allInOne: false,
        refresh: false,
        data:function( d ) {
            d.start_date= $('#start_date').val();
            d.end_date= $('#end_date').val();
        },
        dataSrc: function (json)
        {
            for (var i = 0; i < json.data.length; i++)
            {
                var object =  json.data[i];

                object.action = "<a href='#' class='btn btn-primary'>Download</a>";
            }
            return json.data;
        },
    },
    "columnDefs": [
        { "orderable": false, "targets": [4] },
        { "orderable": true, "targets": [0,1,2,3] }
    ],
    "columns":
    [
        { "data": "id","name" : "id"},
        { "data": "title","name" : "title"},
        { "data": "purchaseDate","name" : "purchaseDate"},
        { "data": "amount","name" : "amount"},
        { "data": "action"},
    ]
});

$('#download').click(function(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();

      tbl_session.ajax.reload();
});

</script>