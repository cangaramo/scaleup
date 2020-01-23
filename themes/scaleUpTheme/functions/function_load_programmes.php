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
    $posts_per_page = $_POST['posts_per_page'];

    $uk_results = false;

    /* If empty: Get all of them (NOT IN empty array) */

    //Regions
    if( sizeof($array_regions) == 0 ) {
        $region_operator = "NOT IN";
    }
    else {
        $region_operator = "IN";
        if ( !(in_array(32, $array_regions) ) && !( in_array(33, $array_regions)) ) { 
            $uk_results = true;
        }
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


    /* Filters */

    $args = array (
        'post_type' => 'programmes',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
	    'order' => 'ASC'
    );

    /* Checkboxes */

    if( ($one_to_watch == 1) && ($endorsed == 1)) {
        $args['meta_query'] = array(
            'relation'		=> 'OR',
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

    /* Categories */

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

    
    /* Args uk */
    $args_uk = $args;

    $args_uk['tax_query'] = 
    array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => 32,
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

    /* Pagination for local */
    $pagination_enabled = true;

    if($pagination_enabled){
        $args['posts_per_page'] = $posts_per_page;
        $args['paged'] = $current_page;
    };

    /* Display all for national */
    $args_uk['posts_per_page'] = -1;

    //UK programes
    $programmes_uk = get_posts($args_uk);
    $query_uk = new WP_Query($args_uk);
    $count_uk = $query_uk->post_count;
    
    //Local programmes
    $programmes = get_posts($args);
    $query = new WP_Query($args);
    
    //Total
    $args_total = $args;
    $args_total['posts_per_page'] = -1;
    $query_total = new WP_Query($args_total);
    $programmes_total = get_posts($args_total);
    $count = $query_total->post_count;

    if ($uk_results) {
        $total = $count_uk + $count;
    }
    else {
        $total = $count;
    }

    //Order local programmes 
    $endorsed_programmes = array();
    $one_to_watch_programmes = array();
    $other_programmes = array();
    foreach ($programmes_total as $programme):
        $id = $programme->ID;
        $all_fields = get_fields($id);
        if ($all_fields['endorsed'] == 1 ): 
            array_push($endorsed_programmes, $id);
        elseif ($all_fields['one_to_watch'] == 1):
            array_push($one_to_watch_programmes, $id);
        else:
            array_push($other_programmes, $id);
        endif;
    endforeach;

    $all_progammes = array_merge($endorsed_programmes, $one_to_watch_programmes); 
    $all_progammes = array_merge($all_progammes, $other_programmes); 
    $args['post__in'] = $all_progammes;
    $args['orderby'] = 'post__in';


    //Order UK programmes
    $endorsed_programmes_uk = array();
    $other_programmes_uk = array();
    $one_to_watch_programmes_uk = array();

    foreach ($programmes_uk as $programme):
        $id = $programme->ID;
        $all_fields = get_fields($id);
        if ($all_fields['endorsed'] == 1 ): 
            array_push($endorsed_programmes_uk, $id);
        elseif ($all_fields['one_to_watch'] == 1):
            array_push($one_to_watch_programmes_uk, $id);
        else:
            array_push($other_programmes_uk, $id);
        endif;
    endforeach;

    $all_progammes_uk = array_merge($endorsed_programmes_uk, $one_to_watch_programmes_uk);
    $all_progammes_uk = array_merge($all_progammes_uk, $other_programmes_uk);  
    $args_uk['post__in'] = $all_progammes_uk;
    $args_uk['orderby'] = 'post__in'; 

    //Local programmes
    $programmes = get_posts($args);
    $query = new WP_Query($args);

    //UK programmes
    $programmes_uk = get_posts($args_uk);
    $query_uk = new WP_Query($args_uk);

    ?>

    <div style="position: absolute; top:0; width:200px">
        <div class="row total-results">
            <div class="col-12">
            <h4><?php echo $total ?> programmes</h4>
            </div>
        </div>
    </div>

    <?php
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

                $path = get_stylesheet_directory()  . '/parts/part-box.php';
                require ($path);

                if ($count == 3 || $count == 10 ): 

                    if ($count == 3):
                        $class = "bg-orange";
                        $text = "Want to be considered for a programme?";
                        $link = "/contact/";
                        $target = "_blank";
                    elseif ($count == 10):
                        $class = "bg-blue";
                        $text = "Your programme not listed?";
                        $link = "https://www.surveymonkey.co.uk/r/2JQ2XHJ";
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
            
        <?php if ($uk_results): ?>

            <div class="d-flex justify-content-center text-center align-items-center h-100" style="min-height:350px">
                <p>No local programmes found in this area</p>
            </div>
           
        <?php else: ?>

            <div class="d-flex justify-content-center text-center align-items-center h-100" style="min-height:550px">
                <p>No programmes found</p>
            </div>

        <?php endif ?></div>

    <?php endif ?>


    <?php if ($uk_results && $programmes_uk): ?>

        <!--- UK Results -->
        <div class="row">
            <div class="col-12">
                <div class="bg-dark-blue mb-3 mt-5 py-3">
                    <p class="mb-0 national-results">National programmes matching your search</p>
                </div>
            </div>
        </div>

        <div class="row">

            <?php foreach ($programmes_uk as $programme_uk):
                $id = $programme_uk->ID;
                $title = get_the_title($id);
                $all_fields = get_fields($id);
                $link = get_permalink($id);
                $path = get_stylesheet_directory()  . '/parts/part-box.php';
                require ($path);
            ?>
            

            <?php endforeach;?>
            
        </div>

    <?php endif ?>


    <?php 
    die();
}

