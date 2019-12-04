<!-- Modal -->
<div class="modal fade" id="modalNewsletter" tabindex="-1" role="dialog" aria-labelledby="modalNewsletter" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-7">
                        <img style="height: 55px" src="<?php echo get_bloginfo('template_url') ?>/assets/images/newsletter.png" >
                        <?php gravity_form( 2, $display_title = true, $display_description = true, $display_inactive = false, $field_values = null, $ajax = true, $tabindex, $echo = true );?>
                    </div>
                </div>
                
            </div>

            <div style="position: absolute; top:0; right: 0">
                <button class="close-form" data-dismiss="modal"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-form.png"></button>
            </div>

        </div>
    </div>

</div>