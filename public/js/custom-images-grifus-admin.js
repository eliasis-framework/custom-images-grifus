/**
 * Custom Images Grifus · Extensions For Grifus
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2017
 * @license    GPL-2.0+
 * @link       https://github.com/Josantonius/Custom-Images-Grifus.git
 * @since      1.0.0
 */

(function ($) {
    
   $(document).ready(function () {

      function ajaxReplace() {

         $.ajax({
            url: customImagesGrifusAdmin.ajax_url,
            type: "post",
            data: {
               action:        'replaceOldImages',
               custom_nonce : customImagesGrifusAdmin.custom_nonce
            },
            success:function(data) {

               var response = JSON.parse(data);

               if (!response) { return; }

               //console.log(response);

               if (response.post_id !== 0) {

                  /** Get unitial counters */
                  var revised = new Number($("#film-title-badge").attr("data-badge"));
                  revised = revised.toFixed();
                  revised++;

                  var imagesAdded = new Number($("#film-images-badge").attr("data-badge"));
                  imagesAdded = imagesAdded.toFixed();
                  imagesAdded = parseInt(imagesAdded) + parseInt(response.images_added);

                  /** Show actual title film */
                  $(".actual-title").text(response.post_title);
                  
                  /** Set new counters */
                  $("#film-title-badge").attr("data-badge", revised);

                  $("#film-images-badge").attr("data-badge", imagesAdded);
                     
                  ajaxReplace();

               } else {

                  /** Set films reviewed */
                  $(".actual-title").text(customImagesGrifusAdmin.revised_text);

                  /** Change color icons */
                  $("#film-title-badge").addClass("success-icon").removeClass("movie-icon");
                  $("#film-images-badge").addClass("success-icon").removeClass("picture-icon");
               
                  /** Hide spinner */
                  $("#spinner-grifus").hide();
               } 
            },
            error: function(errorThrown){
               //console.log(errorThrown);
            } 

         });

      }
      
      $("#replace-grifus-images").click(function(e) {

         e.preventDefault();

         /** Disable button */
         $(this).prop("disabled", true);

         /** Show icons */
         $("#process").slideDown();

         /** Show spinner */
         $("#spinner-grifus").show();

         ajaxReplace();

      });

   });

})(jQuery);
