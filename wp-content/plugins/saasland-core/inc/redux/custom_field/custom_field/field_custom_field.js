/* global confirm, redux, redux_change */

jQuery(document).ready(function($) {

 
  $(document).on('click', '.redux-group-menu li', function(){
    if($(this).find('span').text() == 'Get Updated') {
        $('.subscribe-form').addClass('show-form');
    }else{
        $('.subscribe-form').removeClass('show-form');
    }
  });
  
 


  $('#from_wrapper').parents('.redux-container').append('<div class="subscribe-form"><h2>Subscribe To Get Goodies!</h2><p>Subscribe to our newsletter to get important updates of Saasland and all our products, offers, new products news and all other awesome stuff! We promise that we will not disclose your email to anyone. We also promise that we will not spam you, will not bombard you with swarm of emails.</p><form action="javascript:void(0)" class="mailchimp input-group rest_newsletter rave-subscribe" method="post" data-action-url="https://droitthemes.us19.list-manage.com/subscribe/post?u=5d334217e146b083fe74171bf&id=a6ddc4fcb3"><input type="text" name="EMAIL" class="form-control memail" placeholder="Email *" required><input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="Name"><button type="submit" class="mail-chim-subscribe-form-submit"> Subscrib Now</button></form><p class="mchimp-errmessage text-center mt-3" style="display: none;"></p><p class="mchimp-sucmessage text-center mt-3" style="display: none;"></p></div>');

    var mailchimpContainer = $(".mailchimp");
    var dataUrl = mailchimpContainer.data('action-url');

    if ( mailchimpContainer.length > 0 ) {
        mailchimpContainer.ajaxChimp({
            callback: mailchimpCallback,
            url: dataUrl,
        });

        $(".memail").on("focus", function () {
            $(".mchimp-errmessage").fadeOut();
            $(".mchimp-sucmessage").fadeOut();
        });
        $(".memail").on("keydown", function () {
            $(".mchimp-errmessage").fadeOut();
            $(".mchimp-sucmessage").fadeOut();
        });
        $(".memail").on("click", function () {
            $(".memail").val("");
        });

        function mailchimpCallback(resp) {
            if (resp.result === "success") {
                $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                $(".mchimp-sucmessage").fadeOut(500);
            } else if (resp.result === "error") {
                $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
            }
        }

    }
    

    function mailchimpCallback(resp) {

        if (resp.result === "success") {
            console.log();
            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
            $(".mchimp-sucmessage").fadeOut(500);
        } else if (resp.result === "error") {
            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
        }
    }
    $.fn.inlineStyle = function (prop) {
        var styles = this.attr("style"),
            value;
        styles && styles.split(";").forEach(function (e) {
            var style = e.split(":");
            if ($.trim(style[0]) === prop) {
                value = style[1];           
            }                    
        });   
        return value;
   };
   var  dBlock = $("#from_wrapper").parents('.redux-group-tab').inlineStyle("display");
  
   if(dBlock == 'block') {
       console.log('block')
   }
   if( dBlock == 'block') {
    console.log(dBlock);
    $('.subscribe-form').addClass('show-form');
   }else{
    $('.subscribe-form').removeClass('show-form');
   }
  
});

