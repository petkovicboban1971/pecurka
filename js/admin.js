
$(document).ready(function() {

    
  $('.conf').on('click', function(e){
    e.preventDefault();
    var link = $(this).data('link');
        alertify.confirm("Da li ste sigurni da želite da izvršite akciju brisanja?",
                    function(e){
                    if(e){
                        location.href = link;
                    }
              });
  });
  /*
  $('#con-close-modal').on('show.bs.modal', function (e) {
    // console.log(e);
    // console.log(e.relatedTarget);
    
    var _button = $(e.relatedTarget); // Button that triggered the modal
    
    // console.log(_button, _button.parents("tr"));
    var _row = _button.parents("tr");
    var _invoiceAmt = _row.find(".invoice-amt").text();
    var _chequeAmt = _row.find(".cheque-amt").text();
    // console.log(_invoiceAmt, _chequeAmt);
    
    $(this).find(".invoice-amt").val(_invoiceAmt);
    $(this).find(".cheque-amt").val(_chequeAmt);
  });*/


});
