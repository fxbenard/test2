jQuery(document).ready(function($) {

  $('#test_2_license_activate').live( "click", function() {


      $.ajax({
        type: "POST",
        //timeout: 15000,
        url: Test2Ajax.ajaxurl,
        data: {
          'action': 'test_2_activate_license',
          'test_2_nonce': Test2Ajax.test_2_nonce,
        },
        beforeSend: function(reponse) {
          $('#spinner-test-2').addClass('is-active');
        },
        success: function(response) {
          $('#spinner-test-2').removeClass('is-active');
          $('#test2-reponse').html(response);
        }

      });

  });

  $('#test_2_license_deactivate').live( "click", function() {


    $.ajax({
      type: "POST",
      //timeout: 15000,
      url: Test2Ajax.ajaxurl,
      data: {
        'action': 'test_2_deactivate_license',
        'test_2_nonce': Test2Ajax.test_2_nonce,
      },
      beforeSend: function(reponse) {
        $('#spinner-test-2').addClass('is-active');
      },
      success: function(response) {
        $('#spinner-test-2').removeClass('is-active');
        $('#test2-reponse').html(response);
        $('#test_2_license_key').val('');
        $('h1').after('<div class="updated"><p>' + Test2Ajax.license_deactivate.license_deactivate + '</p></div>');
      }

    });

  });

});
