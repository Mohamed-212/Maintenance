
 var url=config._url+'/';
  var _lang=config._lang;
 var Area = function () {


     var init = function () {


        handleChangeCity();

     };

     var handleChangeCity  = function () {
         $('#city').on('change', function () {
             var city= $(this).val();
             $('#area').html("");
             areas = "";
             if (city) {
                 $.get(url+ city, function (data) {
                     if (data.length != 0) {
                         for (var x = 0; x < data.length; x++) {
                             var item = data[x];
                             areas  += '<option value="' + item.id + '">' + item['name_'+_lang] + '</option>';
                         }
                         $('#area').append(areas);
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
     Area.init();
 });
