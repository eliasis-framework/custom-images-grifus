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

      /**
       * Replace images.
       *
       * @since 1.0.0
       */
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

               /** Get initial counters */
               var revised = new Number($("#film-title-badge").attr("data-badge"));
               revised = revised.toFixed();

               if (response.post_id !== 0) {

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
                  
                  if (revised > 0) {

                     var revisedText = customImagesGrifusAdmin.added_text;
                  
                  } else {

                     var revisedText = customImagesGrifusAdmin.revised_text;
                  }
                  
                  /** Set films reviewed */
                  $(".actual-title").text(revisedText);

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

      /**
       * Replace images when add a post.
       *
       * @since 1.0.1
       */
      function replaceWhenAdd(state) {

         $.ajax({
            url: customImagesGrifusAdmin.ajax_url,
            type: "post",
            data: {
               action:        'replaceWhenAdd',
               state:         state,
               custom_nonce:  customImagesGrifusAdmin.custom_nonce
            },
            success:function(data) {

               var response = JSON.parse(data);

               console.log(response);

            },
            error: function(errorThrown){
               //console.log(JSON.stringify(errorThrown));
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

      $("#checkbox-images").click(function(e) {

         var state = ($(this).is(':checked')) ? 1 : 0;

         replaceWhenAdd(state);

      });

   });

})(jQuery);
