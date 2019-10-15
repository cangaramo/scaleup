<?php 
    $address = $values['address'];
?>
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