<?php 
    $args = array(
        'post_type' => 'area_summaries',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
	    'order' => 'ASC'
    );
    $areas = get_posts($args);
?>

<div class="py-4 module-areas">

    <div class="list-areas-section">

        <h4 class="text-center mb-3">Local area summaries</h4>
        <p class="text-center">Select an area to reveal the data</p>

        <div class="row list-areas mt-5">
    
            <?php foreach ($areas as $area): 
                $area_id = $area->ID;
                $title = get_the_title($area_id);
                $permalink = get_the_permalink($area_id);
            ?>

                <div class="col-6 mb-2">
                    <div class="area py-2" data-area="<?php echo $area_id ?>">
                        <div class="d-flex h-100 align-items-center justify-content-between">
                            <p class="w-100 text-center mb-0"><?php echo $title ?></p>
                            <img src="<?php echo get_bloginfo('template_url')?>/assets/images/chevron.png">
                        </div>
                    </div>
                </div>

            <?php endforeach ?>

        </div>
    
    </div>

    <div id="response-area"></div>

</div>

