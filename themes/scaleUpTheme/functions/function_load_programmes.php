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
        'posts_per_page' => -1
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


    $programmes = get_posts($args);

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
                    <div class="p-3 h-100">
                        <div class="row">
                            <div class="col-9 pr-0">
                                <p><?php echo $title ?></p>
                                <p><?php echo $all_fields['description'] ?></p>
                            </div>
                            <div class="col-3">
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
                                    <img style="height:40px; margin-top:-5px" src="<?php echo get_bloginfo('template_url')?>/assets/images/endorsed.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php  if ($count == 3 || $count == 6 ): 

                if ($count == 3):
                    $class = "bg-orange";
                elseif ($count == 6):
                    $class = "bg-blue";
                    $count = 0; 
                endif;

            ?>

                <div class="col-sm-6 col-lg-3 my-3">
                    <div class="box <?php echo $class ?> call-to-action p-3">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <div><img src="<?php echo get_bloginfo('template_url')?>/assets/images/question_mark.png"></div>
                            <p>Want to be considered for a programme?</p>
                            <a href="">Tell us now</a>
                        </div>
                    </div>
                </div>

            <?php endif ?>

        <?php endforeach ?>

        </div>

    <?php else: ?>

        <div class="d-flex justify-content-center text-center align-items-center h-100" style="min-height:550px">
            <p>No programmes found</p>
        </div>

    <?php endif ?>


    <?php 
    die();
}

