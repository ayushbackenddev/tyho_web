@include('Website/Assets/header')

<!-- Content Code Start -->

    <article>
        <div class="container">
            <div class="row mb-4 rowPaymentTop align-items-center">
                <div class="col-md-8">
                    <p>Please note that payment notes are generated on the 1st of every month for the previous month.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <button type="submit" class="btn btn-primary">Download all</button>
                </div>
            </div>
            <div class="tableSmall">
                <div class="box_table">
                    <table class="table" id="dataTableForPaymentNotes">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Month</th>
                                <th scope="col">Amount</th>
                                <th scope="col" class="columnAction">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
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

<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    
$(document).ready(function () {

    tbl_clientsList = $('#dataTableForPaymentNotes').DataTable(
    {
        "serverSide": true,
        paging:true,
        pageLength:10,
        "processing": false,
        "pagingType": "full_numbers",
        "scrollX": false,
        "searching": true,
        ajax: {
            url: "{{url('api/showPaymentsNotes')}}",
            type: "POST",
            allInOne: false,
            refresh: false,
            dataSrc: function (json)
            {
                for (var i = 0; i < json.data.length; i++)
                {
                    var object =  json.data[i];

                    object.action = "<a type='button' class='btn btn-primary'>Download</a>";
                }
                return json.data;
            },
        },
        "columns":
        [
            { "data": "id"},
            { "data": "booking_date"},
            { "data": "amount"},
            { "data": "action"},
        ]
    });
});

</script>