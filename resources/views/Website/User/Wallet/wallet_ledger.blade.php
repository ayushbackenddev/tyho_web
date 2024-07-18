<h2 class="text-center pt-3">Wallet Ledger</h2>
<div class="box_table">
    <table class="table" id="dataTableForWalletLedger">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="columnDate2">Date</th>
                <th scope="col" class="columnDetails2">Details</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Balance</th>
                <th scope="col" class="columnExpiryDate">Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
<div class="page-center pb-4">
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

<script type="text/javascript">
    
var tbl_wallet_ledger;

tbl_wallet_ledger = $('#dataTableForWalletLedger').DataTable(
{
    "serverSide": true,
    paging:true,
    pageLength:10,
    "processing": false,
    "pagingType": "full_numbers",
    "scrollX": false,
    "searching": true,
    ajax: {
        url: "{{url('api/walletData')}}",
        type: "POST",
        allInOne: false,
        refresh: false,
        // data:function( d ) {
        //     d.start_date= $('#start_date').val();
        //     d.end_date= $('#end_date').val();
        // },
        dataSrc: function (json)
        {
            for (var i = 0; i < json.data.length; i++)
            {
                var object =  json.data[i];

                object.balance = "-";
                object.expiry_date = "-";
            }
            return json.data;
        },
    },
    // "columnDefs": [
    //     { "orderable": false, "targets": [4] },
    //     { "orderable": true, "targets": [0,1,2,3] }
    // ],
    "columns":
    [
        { "data": "id"},
        { "data": "created_at"},
        { "data": "details"},
        { "data": "transaction_id"},
        { "data": "type"},
        { "data": "amount"},
        { "data": "balance"},
        { "data": "expiry_date"},
    ]
});

</script>