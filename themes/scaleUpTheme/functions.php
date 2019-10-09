<?php
/***********************************************************************************************/
/* Add Menus */
/***********************************************************************************************/
  add_theme_support( 'post-thumbnails' ); 
  
	register_nav_menus(
		array(
			'main' => __('Main Menu'),
			'footer' => __('Footer  Menu')
		)
	);



/* Enqueue styles and scripts */

function enqueue_theme_scripts() {
	//CSS
	wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css');
	wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
	wp_enqueue_style( 'font-brandon', 'https://use.typekit.net/rxd1qvx.css');
	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/min/styles.min.css', '', '1.1'); // Register the compiled stylesheets


	//JS
	wp_deregister_script( 'jquery' );
	wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js');
	wp_register_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'));
	wp_register_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'));
	wp_register_script('main-js', get_template_directory_uri() . '/assets/js/min/scripts.min.js', array('jquery'), '1.1');

	//Google maps
	//wp_register_script('marker-clusterer', 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js');
	//wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ06-isKwMWAWW1EBy2nvVm7I2Xijc384&callback=initMap',  array(), '', true);
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('popper-js');
	wp_enqueue_script('bootstrap-js');
	wp_enqueue_script('main-js');
	//wp_enqueue_script('marker-clusterer');
	//wp_enqueue_script('google-maps');
	
}
add_action( 'wp_enqueue_scripts', 'enqueue_theme_scripts' );

/* ACF */
function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDb4aa1NMZ5gB0NclaWCOkyxIWD53rX4kU');
}

add_action('acf/init', 'my_acf_init');


function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyDb4aa1NMZ5gB0NclaWCOkyxIWD53rX4kU';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


function load_posts(){

	$speciality = $_POST['speciality'];
	
	$args = array (
		'post_type' => 'programmes',
		'posts_per_page' => -1,
		'meta_key'		=> 'speciality',
		'meta_value'	=> $speciality
	);
	$programmes = get_posts($args);
	$lat_array = array();
	$lng_array = array();
	$description_array = array();

	?>

			<div id="cards-list">

                    <?php foreach ($programmes as $index=>$programme): 
                        $post_id = $programme->ID;
                        $title = get_the_title($post_id);
                        $fields = get_fields($post_id);
                        $location = $fields['location'];
                        $lat = $location['lat'];
						$lng = $location['lng'];
						$loc = $fields['location_text'];
                        array_push($lat_array,$lat);
                        array_push($lng_array,$lng);
						array_push($description_array,$loc);

                        ?>
                        <div class="card my-3 p-3">

                            <p class="m-0 title"><?php echo $title ?></p>
                            <hr>
							<p class="m-0 subtitle">LOCATION:</p>
                            <p><?php echo $fields['location_text'] ?></p>
							<p class="m-0 subtitle">SPECIALITY:</p>
                            <p><?php echo $fields['speciality'] ?></p>
							<p class="m-0 subtitle">TOP STAT:</p>
                            <p class="m-0"><?php echo $fields['stat'] ?></p>
                        </div>
                    <?php 
                    endforeach;
                    ?>

			</div>

			<div id="loop-location"  data-lat='<?php echo json_encode ($lat_array)?>' data-lng='<?php echo json_encode($lng_array) ?>' data-description='<?php echo json_encode($description_array) ?>'></div>

	<?php 

	die();
}

add_action( 'wp_ajax_nopriv_load_posts', 'load_posts' );
add_action( 'wp_ajax_load_posts', 'load_posts' );

function load_programmes(){

	/* Get array */
	$array_regions = $_POST['region'];
	$array_types_business = $_POST['type_business'];
	$array_types_support = $_POST['type_support'];

	print_r($array_regions);
	print_r($array_types_business);
	print_r($array_types_support);


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
	);
	
	
	$programmes = get_posts($args);
	?>

	<div class="row">

		<?php foreach ($programmes as $programme):
			$id = $programme->ID;
			$title = get_the_title($id);
			$all_fields = get_fields($id);
			$link = get_permalink($id);
		?>

		<div class='col-3 my-3'>
			<div class="box">
				<div class="bg-image thumbnail-image" style="background-image:url('<?php echo $all_fields['thumbnail_image']?>')"></div>
				<div class="p-3 h-100">
					<p><?php echo $title ?></p>
					<p><?php echo $all_fields['description'] ?></p>
				</div>
				<div class="pos-bottom">
					<div class="p-3">
						<a href="<?php echo $link ?>" class="link">Read more</a>
					</div>
				</div>
			</div>
		</div>

		<?endforeach ?>

	</div>

	<?php 
	die();
}

add_action ('wp_ajax_nopriv_load_programmes', 'load_programmes');
add_action ('wp_ajax_load_programmes', 'load_programmes');