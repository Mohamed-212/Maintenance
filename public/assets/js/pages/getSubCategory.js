
 var url=config._url+'/';
 var SubCategory = function () {
    
 
     var init = function () {
 
 
        handleChangeCategory();
 
     };
 
     var handleChangeCategory  = function () {
         $('#category').on('change', function () {
             var brand= $(this).val();
             console.log(brand);
             $('#subCategory').html("");
             $('#subCategory').html('<option selected value="0">' +'none' + '</option>');
             subCategories = "";
             if (brand) {
                 $.get(url+ brand, function (data) {
                    console.log(data);
                     if (data.length != 0) {
                         for (var x = 0; x < data.length; x++) {
                             var sub = data[x];
                             subCategories  += '<option value="' + sub.id + '">' + sub.name + '</option>';
                         }
                         $('#subCategory').append(subCategories);
                     }
                 }, "json");
                 console.log(subCategories);
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
    SubCategory.init();
 });
 