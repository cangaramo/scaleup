<div class='col-sm-6 col-lg-3 my-3'>
                    <div class="box">

                        <div class="overflow-hidden" style="border-bottom: 1px solid #f0f0f0">
                            <div class="bg-image thumbnail-image" onClick="redirectTo('<?php echo $link ?>')"
                                style="background-image:url('<?php echo $all_fields['thumbnail_image']?>')"></div>
                            </div>

                        <div class="p-3">
                            <div class="row">
                                <div class="col-12">
                                    <p><?php echo $title ?></p>
                                    <!-- <p><?php echo $all_fields['description'] ?></p> -->
                                </div>
                            </div>
                        </div>

                        <div class="pos-bottom w-100">
                            <div class="px-3 py-1">
                                <div class="row">
                                    <div class="col-9">
                                        <a href="<?php echo $link ?>" class="link">Read more</a>
                                    </div>
                                    <div class="col-3">

                                        <!-- Endorsed programmes -->
                                        <?php 
                                        if ($all_fields['endorsed'] == 1 ): ?>
                                            <img style="height:40px; margin-top:-5px" src="<?php echo get_bloginfo('template_url')?>/assets/images/endorsed.svg">
                                        <?php elseif ($all_fields['one_to_watch'] == 1 ): ?>
                                            <img style="height:40px; margin-top:-5px" src="<?php echo get_bloginfo('template_url')?>/assets/images/teal_one_to_watch.png">
                                        <?php else: ?>
                                            <div style="height:40px"></div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>