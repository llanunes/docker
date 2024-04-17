<?php
wp_enqueue_style( 'date-countdown' );
wp_enqueue_script( 'knob' );
wp_enqueue_script( 'throttle' );
wp_enqueue_script( 'moment' );
wp_enqueue_script( 'redcountdown' );

?>
<section class="event_counter_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="event_text wow fadeInLeft">
                    <?php
                    if ( $title ) {
                        echo '<h3>' . saasland_kses_post( $title ) . '</h3>';
                    } ?>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="event_countdown wow fadeInRight">
                    <div class="event_counter red-time-counter">
                        <?php if ( $date_count_down ) { ?>
                            <div class="red-countdown red-countdown-one" data-countdown="<?php echo esc_attr( $date_count_down ); ?>"></div>
                            <?php
                        } ?>
                        <script>
                            ( function( $ ){

                                jQuery(document).ready(function(){
                                    var redCounter = $('.red-countdown');
                                    if(redCounter.length){
                                        redCounter.each(function() {
                                            var $this = $(this), NewDate = $(this).data('countdown');

                                            //var NewDate = '28/12/2019';

                                            let current_datetime = new Date();
                                            let formatted_date = current_datetime.getDate() + "/" + (current_datetime.getMonth() + 1) + "/" + current_datetime.getFullYear();
                                            var a = moment(formatted_date, 'DD/MM/YYYY');
                                            var b = moment(NewDate, 'DD/MM/YYYY');
                                            var remainingDays = b.diff(a, 'days');
                                            //var remainingDays = moment(NewDate).fromNow(true);
                                            var currentHours = current_datetime.getHours();
                                            var FinalHours = (24-currentHours)*60*60;
                                            var currentMins = current_datetime.getMinutes();
                                            var FinalMins = (60-currentMins)*60;
                                            var currentSecs = current_datetime.getSeconds();
                                            var FinalSecs = (60-currentSecs);
                                            var remainSum = FinalHours+FinalMins+FinalSecs;

                                            var endDate = remainingDays*24*60*60;
                                            var FinalendDate = endDate+remainSum;
                                            //alert(FinalendDate);
                                            $('.red-countdown-one').redCountdown({
                                                end: $.now() + FinalendDate,
                                                labels: true,
                                                style: {
                                                    element: "",
                                                    textResponsive: 0.5,
                                                    daysElement: {
                                                        gauge: {
                                                            thickness: 0.09,
                                                            bgColor: "#f2ede6",
                                                            fgColor: "#fd485e"
                                                        }
                                                    },
                                                    hoursElement: {
                                                        gauge: {
                                                            thickness: 0.09,
                                                            bgColor: "#f2ede6",
                                                            fgColor: "#2d8dfa"
                                                        }
                                                    },
                                                    minutesElement: {
                                                        gauge: {
                                                            thickness: 0.09,
                                                            bgColor: "#f2ede6",
                                                            fgColor: "#9449fb"
                                                        }
                                                    },
                                                    secondsElement: {
                                                        gauge: {
                                                            thickness: 0.09,
                                                            bgColor: "#f2ede6",
                                                            fgColor: "#4ad425"
                                                        }
                                                    }

                                                },
                                                onEndCallback: function() { console.log("Time out!"); }
                                            });
                                        });
                                    }
                                })
                            })(jQuery);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>