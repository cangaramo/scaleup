<?php 
    $title = get_the_title($area_id);
    $all_fields = get_fields($area_id);

    //Get sectors
    $categories = get_the_category($area_id);
?>

<div class="single-summary position-relative">

    <div class="close-container">
        <button class="close-area" data-dismiss="modal"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-form.png"></button>
    </div>

    <!-- Title -->
    <div class="bg-blue">
        <div class="container py-4 px-4">
            <div class="d-flex h-100 align-items-center">
                <img height="150" src="<?php echo $all_fields['map_icon'] ?>">
                <div class="pl-4">
                    <p class="label">LOCAL AREA SUMARY:</p>
                    <h3><?php echo $title ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Numbers -->
    <div class="bg-dark">

        <div class="container px-4 numbers">
            <div class="row py-5">

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/scaleups.png">
                        <p class="num counter"><?php echo $all_fields['scaleups_number'] ?></p>
                        <p class="desc">Total number of scaleups</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/employees.png">
                        <p class="num counter"><?php echo $all_fields['employee_growth'] ?></p>
                        <p class="desc">No. by employee growth</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/turnover.png">
                        <p class="num counter"><?php echo $all_fields['turnover_growth'] ?></p>
                        <p class="desc">No. by turnover growth</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/employee_growth.png">
                        <p class="num counter"><?php echo $all_fields['employee_turnover_growth'] ?></p>
                        <p class="desc">No. by employee and turnover growth</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/total_employees.png">
                        <p class="num counter"><?php echo $all_fields['total_employees'] ?></p>
                        <p class="desc">Total employees</p>
                        <div class="line"></div>
                    </div>
                </div>


                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/total_growth.png">
                        <p class="num counter"><?php echo $all_fields['total_turnover'] ?></p>
                        <p class="desc">Total turnover</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Sectors -->
    <div class="bg-black">
        <div class="container py-4 key-sectors">

            <div class="d-flex h-100 align-items-center">
                <p class="label">Key sectors</p>
                <div>
                    <?php
                        foreach ($categories as $category):
                            $term_id = $category->term_id;
                            $parent = $category->category_parent;
                    
                            if ($parent == 34) {
                                $taxonomy = $category->taxonomy;
                                $ref = $taxonomy . '_' . $term_id;
                                $icon_cat = get_field('icon', $ref);
                            }
                            ?>

                            <img src="<?php echo $icon_cat ?>">
                            
                        <?php endforeach;
                    ?>
                   
                </div>
            </div>
            
        </div>
    </div>

    <!-- Copy -->
    <div class="bg-white">

        <div class="container px-0">

            <div class="row mx-0">
                <div class="col-4 pl-4 py-4">
                    <p class="heading"><?php echo $all_fields['heading_1']; ?></p>
                    <?php echo $all_fields['copy_1']; ?>
                </div>
                <div class="col-4 py-4">
                    <p class="heading"><?php echo $all_fields['heading_2']; ?></p>
                    <?php echo $all_fields['copy_2']; ?>
                </div>
                <div class="col-4 bg-gray_blue pr-4 py-4">
                    <p class="heading"><?php echo $all_fields['heading_3']; ?></p>
                    <?php echo $all_fields['copy_3']; ?>
                </div>
                
            </div>

        </div>

    </div>

    <!-- Side boxes -->
    <div class="bg-dark-blue">
        <div class="container px-4">

            <div class="row side-boxes py-4">

                <div class="col-4 pr-2">
                    <div class="bg-dark p-3 h-100">
                        <p class="heading color-orange">Scaleup Views</p>
                        <div><?php echo $all_fields['scaleup_views']; ?></div>
                    </div>
                </div>

                <div class="col-4 px-2">
                    <div class="bg-orange p-3 h-100">
                        <p class="heading color-black">Top barries to growth</p>
                        <div><?php echo $all_fields['top_barries_to_growth']; ?></div>
                    </div>
                </div>

                <div class="col-4 pl-2">
                    <div class="bg-blue p-3 h-100">
                        <p class="heading color-black">want TO SEE more of:</p>
                        <div><?php echo $all_fields['want_to_see_more_of']; ?> </div>
                    </div>
                </div>
            
            </div>
        
        </div>
    </div>

    <!-- Call to action -->
    <div class="bg-orange">
        <div class="container px-4 py-5 call-to-action">
            <div class="row">
                <div class="col-3">
                    <div class="d-flex align-items-center h-100">
                        <img src="<?php echo get_bloginfo('template_url')?>/assets/images/CTA.png">
                    </div>
                </div>
                <div class="col-9">
                    <?php echo $all_fields['call_to_action'];  ?>
                </div>
            </div>
        </div>
    </div>

</div>