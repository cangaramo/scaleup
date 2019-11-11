<?php 

function load_programmes(){

    /* Get arrays */
    $array_regions = $_POST['region'];
    $array_types_business = $_POST['type_business'];
    $array_types_support = $_POST['type_support'];
    $array_aims = $_POST['aims'];
    $array_cost = $_POST['costs'];
    $array_types = $_POST['types'];
    $array_providers = $_POST['providers'];

    $one_to_watch = $_POST['one_to_watch'];
    $endorsed = $_POST['endorsed'];

    $current_page = $_POST['current_page'];

    /* If empty: Get all of them (NOT IN empty array) */

    //Regions
    if( sizeof($array_regions) == 0 ) {
        $region_operator = "NOT IN";
    }
    else {
        $region_operator = "IN";
    }

    //Types of business
    if( sizeof($array_types_business) == 0 ) {
        $business_operator = "NOT IN";
    }
    else {
        $business_operator = "IN";
    }

    //Types of support
    if( sizeof($array_types_support) == 0 ) {
        $support_operator = "NOT IN";
    }
    else {
        $support_operator = "IN";
    }

    //Aims of the programme
    if( sizeof($array_aims) == 0 ) {
        $aims_operator = "NOT IN";
    }
    else {
        $aims_operator = "IN";
    }

    //Cost of the programme
    if( sizeof($array_cost) == 0 ) {
        $costs_operator = "NOT IN";
    }
    else {
        $costs_operator = "IN";
    }

    //Type of programme
    if( sizeof($array_types) == 0 ) {
        $type_operator = "NOT IN";
    }
    else {
        $type_operator = "IN";
    }

    //Providers
    if( sizeof($array_providers) == 0 ) {
        $providers_operator = "NOT IN";
    }
    else {
        $providers_operator = "IN";
    }


    /* Query */

    $args = array (
        'post_type' => 'programmes',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
	    'order' => 'ASC'
    );

    $args['tax_query'] = 
    array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $array_regions,
            'operator' => $region_operator,
        ),
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $array_types_business,
            'operator' => $business_operator,
        ),
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $array_types_support,
            'operator' => $support_operator,
        ),
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $array_aims,
            'operator' => $aims_operator,
        ),
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $array_cost,
            'operator' => $costs_operator,
        ),
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $array_types,
            'operator' => $type_operator,
        ),
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $array_providers,
            'operator' => $providers_operator,
        ),
    );


    /* Checkboxes */

    if( ($one_to_watch == 1) && ($endorsed == 1)) {
        $args['meta_query'] = array(
            'relation'		=> 'AND',
            array(
                'key'	 	=> 'one_to_watch',
                'value'	  	=> "1",
                'compare' 	=> '=',
            ),
            array(
                'key'	  	=> 'endorsed',
                'value'	  	=> '1',
                'compare' 	=> '=',
            ),
        ); 
    }
    else if ($one_to_watch == 1) {
        $args['meta_key'] = 'one_to_watch';
        $args['meta_value'] = '1';
    }
    else if ($endorsed == 1){
        $args['meta_key'] = 'endorsed';
        $args['meta_value'] = '1';
    } 

    /* Pagination */
    $pagination_enabled = true;

    if($pagination_enabled){
        //$args['posts_per_page'] = intval($posts_per_page);
        //$args['paged'] = $current_page;
        $args['posts_per_page'] = 10;
        $args['paged'] = $current_page;
    };
    

    //Get programmes
    $programmes = get_posts($args);

    //Main query
	$query = new WP_Query( $args );

    if ($programmes): ?>

        <div class="row">

            <?php 
            $count = 0;
            foreach ($programmes as $programme):
                $id = $programme->ID;
                $title = get_the_title($id);
                $all_fields = get_fields($id);
                $link = get_permalink($id);
                $count = $count + 1;

            ?>

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


            <?php  if ($count == 3 || $count == 10 ): 

                if ($count == 3):
                    $class = "bg-orange";
					$text = "Want to be considered for a programme?";
					$link = "https://www.surveymonkey.co.uk/r/2JQ2XHJ";
					$target = "_blank";
                elseif ($count == 10):
                    $class = "bg-blue";
					$text = "Your programme not listed?";
					$link = "/contact/";
					$target = "_self";
                    $count = 0; 
                endif;

            ?>

                <div class="col-sm-6 col-lg-3 my-3">
                    <div class="box <?php echo $class ?> call-to-action p-3">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <div><img src="<?php echo get_bloginfo('template_url')?>/assets/images/question_mark.png"></div>
                            <p><?php echo $text ?></p>
                            <a href="<?php echo $link ?>" target="<?php echo $target ?>">Tell us now</a>
                        </div>
                    </div>
                </div>

            <?php endif ?>

        <?php endforeach ?>

        </div>

        <?php 
        /* Pagination */
        if($pagination_enabled){ 

            $max = $query->max_num_pages;

                if($max > 1){ 

                    $next_disabled = false;
                    $prev_disabled = false;

                    if ($current_page == $max):
                        $next_disabled = true;
                    elseif ($current_page == 1):
                        $prev_disabled = true;
                    endif;
                    					
					$current_page_prev_prev = $current_page - 2;
					$current_page_prev = $current_page - 1;
					$current_page_next = $current_page + 1;
					$current_page_next_next = $current_page + 2;
                    ?>

                    <div class="w100 d-flex justify-content-center pagination mt-5 mb-4 pt-3" >

                        <form >
                            <!-- Prev button -->
                            <?php if (!$prev_disabled) : ?>
                                <input type="button"  id="prev-btn" class="align-middle prev-btn"> 
                            <?php else: ?>
                                <input type="button"  id="prev-btn" disabled class="align-middle prev-btn"> 
                            <?php endif; ?>

							<!-- First item -->
							<?php if ( ($current_page > 2) && ($max>3) ): ?>
								<input type="button" value="1" class="changePage"> 
								<!-- Hide ellipsis -->
								<?php if ( ($current_page > 3) && ($max>4) ) : ?>
									<input type="button" value="..." class="dots"> 
								<?php endif ?>
							<?php endif ?>

							<!-- Go to other page -->
							<!-- First page is active -->
							<?php if ($current_page == 1): ?>
								<input type="button" value="<?php echo $current_page?>" class="active changePage"> 
								<input type="button" value="<?php echo $current_page_next?>" class="changePage"> 
								<?php if ($current_page_next_next <= $max): ?>
									<input type="button" value="<?php echo $current_page_next_next?>" class="changePage"> 
								<?php endif ?>
							<!-- Last page is active -->
							<?php elseif ($current_page == $max): ?>
								<?php if ($current_page_prev > 1): ?>
									<input type="button" value="<?php echo $current_page_prev_prev?>" class="changePage"> 
								<?php endif ?>
								<input type="button" value="<?php echo $current_page_prev?>" class="changePage"> 
								<input type="button" value="<?php echo $current_page?>" class="active changePage"> 
							<?php else: ?>
								<input type="button" value="<?php echo $current_page_prev?>" class="changePage"> 
								<input type="button" value="<?php echo $current_page?>" class="active changePage"> 
                            	<input type="button" value="<?php echo $current_page_next?>" class="changePage"> 
							<?php endif ?>
							

							<!-- Last item -->
							<?php if ( ($current_page < ($max-1)) && ($max>3) ): ?>
								<!-- Hide ellipsis -->
								<?php if (($current_page < ($max-2)) && ($max>4) ): ?>
									<input type="button" value="..." class="dots"> 
								<?php endif ?>
								<input type="button" value="<?php echo $max?>" class="changePage"> 
							<?php endif ?>

                            <!-- Next button -->
                            <?php if (!$next_disabled) : ?>
                                <input type="button" value="" class="next-btn align-middle">
                            <?php else: ?>
                                <input type="button" value="" disabled class="next-btn align-middle"> 
                            <?php endif; ?>
                        
                        </form>
                    
                    </div>
            	<?php
				}
		
		} ?>

    <?php else: ?>

        <div class="d-flex justify-content-center text-center align-items-center h-100" style="min-height:550px">
            <p>No programmes found</p>
        </div>

    <?php endif ?>


    <?php 
    die();
}

