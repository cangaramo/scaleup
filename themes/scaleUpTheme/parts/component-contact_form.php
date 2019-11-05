<?php 
    $banner_title = $values['banner_title'];
    $banner_description = $values['banner_description'];
    $banner_image = $values['banner_image'];
    $button_label = $values['button_label'];
    $address = $values['address'];
?>

<!-- Banner -->
<div class="bg-image banner contact-banner" style="background-image:url(<?php echo $banner_image ?>); color: <?php echo $colour ?>">
    <div class="container h-100 py-5 py-lg-0">
        <div class="d-flex align-items-center h-100">
            <div class="row">
                <div class="col-lg-7">
                    <div class="title"><?php echo $banner_title ?></div>
                    <div class="description mt-4"><?php echo $banner_description ?></div>
                    <div class="d-flex mt-4 pt-1">
                        <a class="btn-blue" href="" data-toggle="modal" data-target="#modalNewsletter"><?php echo $button_label ?><img src="<?php echo get_bloginfo('template_url')?>/assets/images/newsletter.png"></a>
                    </div>
                </div>
                <div class="col-lg-3 offset-2 d-none d-lg-block">
                    <img height="180" src="<?php echo $icon ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form -->
<div class="bg-gray">
    <div class="container contact-form">

        <div class="row py-4">
            <div class="col-lg-6 order-last order-lg-first">
                <?php 
                gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = true, $tabindex, $echo = true );
                ?>
            </div>
            <div class="col-lg-6 order-first order-lg-last">
                <div class="my-lg-5 py-4">
                    <div class="address"><?php echo $address ?></div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNewsletter" tabindex="-1" role="dialog" aria-labelledby="modalNewsletter" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <div class="row">
                    <div class="col-7">
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
