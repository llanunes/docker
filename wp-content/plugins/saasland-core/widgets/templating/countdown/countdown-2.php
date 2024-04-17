<?php
wp_deregister_script( 'countdown-jquery' );

if( $date_count_down2 ){
    ?>
    <div class="gadget_discount_info">
        <div class="discount-time">
            <div id="clockdiv" class="saasland-cl clock" data-date="<?php echo esc_attr( $date_count_down2 ); ?>"></div>
        </div>
    </div>

    <script>
        (function ( $ ) {

            function pad(n) {
                return (n < 10) ? ("0" + n) : n;
            }

            $.fn.showclock = function() {

                var currentDate=new Date();
                var fieldDate=$(this).data('date').split('-');
                var futureDate=new Date(fieldDate[0],fieldDate[1]-1,fieldDate[2]);
                var seconds=futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

                if(seconds<=0 || isNaN(seconds)){
                    this.hide();
                    return this;
                }

                var days=Math.floor(seconds/86400);
                seconds=seconds%86400;

                var hours=Math.floor(seconds/3600);
                seconds=seconds%3600;

                var minutes=Math.floor(seconds/60);
                seconds=Math.floor(seconds%60);

                var html="";

                if(days!=0){
                    html+="<div class='timer days drdt-ignore-dark'>"
                    html+="<span class='days days-bottom drdt-ignore-dark'>"+pad(days)+"</span>";
                    html+="<div class='smalltext days-top drdt-ignore-dark'>Days</div>";
                    html+="</div>";
                }

                html+="<div class='timer hours drdt-ignore-dark'>"
                html+="<span class='hours hours-bottom drdt-ignore-dark'>"+pad(hours)+"</span>";
                html+="<div class='smalltext hours-top drdt-ignore-dark'>Hours</div>";
                html+="</div>";

                html+="<div class='timer minutes drdt-ignore-dark'>"
                html+="<span class='minutes minutes-bottom drdt-ignore-dark'>"+pad(minutes)+"</span>";
                html+="<div class='smalltext minutes-top drdt-ignore-dark'>Mins</div>";
                html+="</div>";

                html+="<div class='timer seconds drdt-ignore-dark'>"
                html+="<span class='seconds seconds-bottom drdt-ignore-dark'>"+pad(seconds)+"</span>";
                html+="<div class='smalltext seconds-top drdt-ignore-dark'>Secs</div>";
                html+="</div>";

                this.html(html);
            };

            $.fn.countdown = function() {
                var el=$(this);
                el.showclock();
                setInterval(function(){
                    el.showclock();
                },1000);

            }

            jQuery(document).ready(function(){
                if(jQuery(".saasland-cl").length>0)
                    jQuery(".saasland-cl").countdown();
            })

        }(jQuery));
    </script>
    <?php
}
