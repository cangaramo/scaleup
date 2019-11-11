<!-- Modal -->
<div class="modal fade modalBasic" id="modalBasic<?php echo $person_id?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-4">

                <div class="modal-body p-2 p-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="w-100 mb-3" src="<?php echo $all_fields['picture'] ?>">
                        </div>
                        <div class="col-lg-8">
                            <h3 class="mb-3"><?php echo $title ?></h3>
                            <?php echo $all_fields['long_bio'] ?>
                        </div>
                    </div>
                </div>
                <div class="pos-top">
                    <button data-dismiss="modal"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-form.png"></button>
                </div>

            </div>
        </div>
    </div>