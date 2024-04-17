<form action="javascript:void(0)" class="mailchimp digital_agency_newsletter" method="post">
    <div class="newsletter_form d-flex">
        <label for="colFormLabelSm" class="col-form-label col-form-label-sm">
            <i class="fas fa fa-envelope me-1"></i>
            <?php echo esc_html__('Newsletter', 'saasland-core' )?>
        </label>
        <input type="text" id="colFormLabelSm" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
        <button type="submit" class="submit_btn"><?php echo esc_html( $settings['btn_label'] ) ?></button>
        <p class="mchimp-errmessage" style="display: none;"></p>
        <p class="mchimp-sucmessage" style="display: none;"></p>
    </div>
</form>
