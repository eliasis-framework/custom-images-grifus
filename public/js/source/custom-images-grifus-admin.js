/**
 * Custom Images Grifus · Extensions For Grifus
 *
 * @author    Josantonius <hello@josantonius.com>
 * @package   Josantonius/Custom-Images-Grifus
 * @copyright 2017 - 2018 (c) Josantonius - Custom Images Grifus
 * @license   GPL-2.0+
 * @link      https://github.com/Josantonius/Custom-Images-Grifus.git
 * @since     1.0.0
 */

(function ($) {
    
   $(document).ready(function () {

      if (typeof eliasis !== 'undefined') {
         var custom_images_grifus_admin = eliasis;
      } else {
         var custom_images_grifus_admin = customImagesGrifusAdmin;
      }

      /**
       * Replace images.
       *
       * @since 1.0.0
       */
      function ajaxReplace() {

         $.ajax({
            url: custom_images_grifus_admin.ajax_url,
            type: "post",
            data: {
               action: 'replace_old_images',
               nonce : custom_images_grifus_admin.nonce
            },
            success:function(data) {

               var response = JSON.parse(data);
               
               //console.log(response);
               
               if (!response) { return; }

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
                     var revisedText = custom_images_grifus_admin.added_text;
                  } else {
                     var revisedText = custom_images_grifus_admin.revised_text;
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
            url: custom_images_grifus_admin.ajax_url,
            type: "post",
            data: {
               action:  'replace_when_add',
               state:   state,
               nonce:   custom_images_grifus_admin.nonce
            },
            success:function(data) {
               var response = JSON.parse(data);
               //console.log(response);

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
