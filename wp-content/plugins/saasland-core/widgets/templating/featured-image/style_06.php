<div class="typgraphy_img">
    <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ) ?>
    <div class="circle_shape_1 wow fadeInUp" data-wow-delay="600ms"></div>
</div>
<style>
    @-webkit-keyframes circleAnimation {
        0%, 100% {
            border-radius: 42% 58% 70% 30%/45% 45% 55% 55%;
            -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
            transform: translate3d(0, 0, 0) rotateZ(0.01deg);
        }
        34% {
            border-radius: 70% 30% 46% 54%/30% 29% 71% 70%;
            -webkit-transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
            transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
        }
        50% {
            -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
            transform: translate3d(0, 0, 0) rotateZ(0.01deg);
        }
        67% {
            border-radius: 100% 60% 60% 100%/100% 100% 60% 60%;
            -webkit-transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
            transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
        }
    }
    @keyframes circleAnimation {
        0%, 100% {
            border-radius: 42% 58% 70% 30%/45% 45% 55% 55%;
            -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
            transform: translate3d(0, 0, 0) rotateZ(0.01deg);
        }
        34% {
            border-radius: 70% 30% 46% 54%/30% 29% 71% 70%;
            -webkit-transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
            transform: translate3d(0, 5px, 0) rotateZ(0.01deg);
        }
        50% {
            -webkit-transform: translate3d(0, 0, 0) rotateZ(0.01deg);
            transform: translate3d(0, 0, 0) rotateZ(0.01deg);
        }
        67% {
            border-radius: 100% 60% 60% 100%/100% 100% 60% 60%;
            -webkit-transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
            transform: translate3d(0, -3px, 0) rotateZ(0.01deg);
        }
    }
    .typgraphy_img {
        position: relative;
    }
    .typgraphy_img .circle_shape_1 {
        border-radius: 50%;
        background: #fef5f3;
        position: absolute;
        right: 47px;
        width: 400px;
        height: 400px;
        animation: circleAnimation 7s linear infinite;
        z-index: -1;
        bottom: 70px;
    }
    .typgraphy_img img {
        box-shadow: 30px 10px 70px rgba(18, 1, 64, 0.1);
    }
</style>