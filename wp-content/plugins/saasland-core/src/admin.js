import $ from 'jquery';
import './admin.scss';

$(function(){

  let isMegaMenu =  $('#drdt_template_type').val();
  
  if(isMegaMenu != 'f0f') {
    $('.active-404-page').css('display', 'none');
  }

  if('mega_menu' == isMegaMenu || 'f0f' == isMegaMenu ) {
      $('#drdt_template_display').parents('.section-block').css('display', 'none');
      $('#drdt_template_notdisplay').parents('.section-block').css('display', 'none');
      $('#drdt_template_role').parents('.section-block').css('display', 'none');
  }
  
  // hide theme on change 
  $('#drdt_template_type').on('change', function(){
    if('mega_menu' == $(this).val() || 'f0f' == $(this).val()) {
        $('#drdt_template_display').parents('.section-block').css('display', 'none');
        $('#drdt_template_notdisplay').parents('.section-block').css('display', 'none');
        $('#drdt_template_role').parents('.section-block').css('display', 'none');
    }else{
        $('#drdt_template_display').parents('.section-block').removeAttr('style');
        $('#drdt_template_notdisplay').parents('.section-block').removeAttr('style');
        $('#drdt_template_role').parents('.section-block').removeAttr('style');
    };
    if('f0f' == $(this).val()) { 
      $('.active-404-page').css('display', 'block');
    }else{
      $('.active-404-page').css('display', 'none');
    }
  });
  // active 404 page 

  $(document).on('change', '.is-active-404', function(){
  
    let ifon = $(this).val();
     var data = {
      'action': 'my_action',
      'post_id': $(this).data('post-id'),
      'status' : ifon
    };

      jQuery.post(ajax_object.ajax_url, data, function(response) {
         $('.droit-error').html(response);
         $('.droit-error').fadeIn('slow').addClass('show');
        console.log('Got this from the server: ' + response);
      });
    
      setTimeout(close_post_box, 3000);
      function close_post_box() {
        if($('.droit-error.show').length > 0 ){
          $('.droit-error').fadeOut('slow');
        }
      }
  });

});