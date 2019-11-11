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
	wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
	wp_enqueue_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css');

	//JS
	wp_deregister_script( 'jquery' );
	wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js');
	wp_register_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'));
	wp_register_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'));
	wp_register_script('main-js', get_template_directory_uri() . '/assets/js/min/scripts.min.js', array('jquery'), '1.1');
	wp_register_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'));

	//Google maps
	//wp_register_script('marker-clusterer', 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js');
	//wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ06-isKwMWAWW1EBy2nvVm7I2Xijc384&callback=initMap',  array(), '', true);
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('popper-js');
	wp_enqueue_script('bootstrap-js');
	wp_enqueue_script('main-js');
	wp_enqueue_script('slick-js');
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


/* AJAX LOAD POSTS */

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


/* AJAX LOAD PROGRAMMES */
require 'functions/function_load_programmes.php';
add_action ('wp_ajax_nopriv_load_programmes', 'load_programmes');
add_action ('wp_ajax_load_programmes', 'load_programmes');


/* AJAX LOAD STORIES */
function load_stories (){

	$posts_per_page = $_POST['posts_per_page'];

	$args = array(
        'post_type' => 'stories',
        'posts_per_page' => $posts_per_page
    );
	$posts = get_posts($args);
	?>

	<div class="row">

		<?php foreach ($posts as $index=>$post): 
			$post_id = $post->ID;
			$title = get_the_title($post_id);
			$permalink = get_the_permalink($post_id);
			$all_fields = get_fields($post_id);

			//Padding medium screen
			if ($index%2 ==0 ){
				$class_md = "pr-md-0";
			}
			else {
				$class_md = "pl-md-0";
			}

			//Padding large screen
			if ($index%4 == 0) {
				$class_lg = "pr-lg-0";
			}
			else if (($index+1)%4 == 0){
				$class_lg = "pl-lg-0 ";
			}
			else {
				$class_lg = "p-lg-0";
			}
		?>

			<div class="col-md-6 col-lg-3 <?php echo $class_lg?> <?php echo $class_md?>">
				<div class="story">
					<div class="bg-image w-100 h-100" style="background-image:url('<?php echo $all_fields['image_thumbnail']?>')"></div>
					<div class="layer">
						<div class="d-flex h-100 w-100 align-items-center text-center justify-content-center">
							<div class="p-3">
								<p class="title"><?php echo $title ?></p>
								<p class="description mb-4"><?php echo $all_fields['description']?></p>
								<a href="<?php echo $permalink ?>" class="link white">Read more</a>
							</div>
						</div>
					</div>
				</div>
			</div>
				
		<?php endforeach ?>

	</div>

	<?php 
	die ();
}


add_action( 'wp_ajax_nopriv_load_stories', 'load_stories' );
add_action( 'wp_ajax_load_stories', 'load_stories' );


/* AJAX LOAD CHAPTER */

function load_chapter(){

	$chapter = $_POST['chapter'];

	if ($chapter == "first") {

		$args = array(
			'post_type' => 'articles',
			'posts_per_page' => 1,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		);

		$chapter = get_posts($args)[0]->ID; 

	}

    $all_fields = get_fields($chapter);
    $components_article = $all_fields['components'];

    foreach ($components_article as $component):
        $layout_name = $component['acf_fc_layout'];
		$layout_path = "parts/review/module-" . $layout_name . ".php";
		
        require($layout_path);
    endforeach; 

	die();
}
add_action( 'wp_ajax_nopriv_load_chapter', 'load_chapter' );
add_action( 'wp_ajax_load_chapter', 'load_chapter' );


/* AJAX LOAD AREA */

function load_area(){

	$area_id = $_POST['area'];
	
	require 'parts/part-area_summary.php';

	die();
}
add_action( 'wp_ajax_nopriv_load_area', 'load_area' );
add_action( 'wp_ajax_load_area', 'load_area' );


/* AJAX LOAD SEARCH RESULTS */

function load_search(){
	
	$keyword = $_POST['keyword'];

	/* General arguments */
	$args = array(
		'post_type'   => array('page'),
		'orderby' => 'relevance', 
		'order'	=> 'ASC',
		'posts_per_page' => 5,
		's' => $keyword
	);

	//Main query 
	$query = new WP_Query( $args );

	// LOOP - show posts
	if( $query->have_posts() ) :

		while( $query->have_posts() ): $query->the_post();
			$mypost = $query->post;
			$id = get_the_ID();
			$link = get_the_permalink(); 
			$post_type = get_post_type($id);
			$title = get_the_title($id);
			?>	
			<a class="result" data-link="<?php echo $link ?>" href="<?php echo $link ?>"> <?php echo $title ?></a>
		<?php

		endwhile;

			
		wp_reset_postdata();
	else : ?>
			
		<p class="no-posts">No posts found</p>
			
	<?php endif;


	die();
}
add_action( 'wp_ajax_nopriv_load_search', 'load_search' );
add_action( 'wp_ajax_load_search', 'load_search' );


/* TWITTER */

if( !function_exists('see_more_tweets_link')) {

	function see_more_tweets_link($time_ago) {
		$time_ago['before']  = '<span>';
		$time_ago['content'] = __('See the status', 'juiz_ltw');
		$time_ago['after']   = __(' Ago', 'juiz_ltw') . '</span>';
		
		return $time_ago;
	}
}
add_filter('juiz_ltw_time_ago', 'see_more_tweets_link');


/* Custom formats WYSIWYG */

//Add buttons to editor
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

//Create styles
function my_mce_before_init_insert_formats( $init_array ) {  
	 
	$style_formats = array(  
		array(  
			'title' => 'Black heading',  
			'block' => 'span',  
			'classes' => 'heading',
			'wrapper' => true,
		),
		array(  
			'title' => 'Blue subheading',  
			'inline' => 'span',  
			'classes' => 'subheading',
			'wrapper' => true,
		),
		array(  
			'title' => 'Orange',  
			'inline' => 'span',  
			'classes' => 'color-orange',
			'wrapper' => true,
		),
		array(  
			'title' => 'Quote',  
			'block' => 'span',  
			'classes' => 'box-quote',
			'wrapper' => true,
		),
		array(
			'title' => 'Blue title section',
			'block' => 'span',
			'classes' => 'title-blue',
			'wrapper' => 'title'
		),
		array(
			'title' => 'Orange with border',
			'block' => 'span',
			'classes' => 'border-orange',
			'wrapper' => 'title'
		),
		array(
			'title' => 'Blue with border',
			'block' => 'span',
			'classes' => 'border-blue',
			'wrapper' => 'title'
		),
	);  
	$init_array['style_formats'] = json_encode( $style_formats );  
	return $init_array;  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
