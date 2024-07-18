
$(document).ready(function() {
    $('.styledSelect').select2();
    $("select").select2({minimumResultsForSearch: -1});
    $('.toast').toast("show")
});


$(function () {
    /*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    */

    $('[data-toggle="tooltip"]').tooltip();
})
var input = document.querySelector("#phone");
  window.intlTelInput(input, {
  separateDialCode: true,
  initialCountry: "sg"
    // any initialisation options go here
  });
  var input = document.querySelector("#phone2");
  window.intlTelInput(input, {
  separateDialCode: true,
  initialCountry: "sg"
    // any initialisation options go here
  });
  
  $(document).ready(function(){
    $('.toast').toast('show');
  });

  var toastElList = [].slice.call(document.querySelectorAll('.toast'))
  var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl, option)
  })