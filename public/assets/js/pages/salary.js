

 var url=config._url+'/';
 var Item = function () {


     var init = function () {


        handleChangeSalary();

     };

    var handleChangeSalary  = function () {
        $('#emp_id').on('change', function (){
            var employee= $(this).val();
            if (employee) {
                $.get(url+ employee, function (data) {
                    if (data.length != 0) {
                       $('#loan_deduction').val(data.loan);
                       $('#total').val(data.total);
                    }
                }, "json");

            }
        })
   }


     return {
         init: function () {
             init();
         }
     };

 }();
 jQuery(document).ready(function () {
     Item.init();
 });
