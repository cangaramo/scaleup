<?php
/* Add menus */
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
require 'functions/function_load_posts.php';
add_action( 'wp_ajax_nopriv_load_posts', 'load_posts' );
add_action( 'wp_ajax_load_posts', 'load_posts' );


/* AJAX LOAD PROGRAMMES */
require 'functions/function_load_programmes.php';
add_action ('wp_ajax_nopriv_load_programmes', 'load_programmes');
add_action ('wp_ajax_load_programmes', 'load_programmes');


/* AJAX LOAD STORIES */
require 'functions/function_load_stories.php';
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
require 'functions/function_load_search.php';
add_action( 'wp_ajax_nopriv_load_search', 'load_search' );
add_action( 'wp_ajax_load_search', 'load_search' );

/* AJAX LOAD AMBASSADORS */
function load_ambassadors(){

	$lep = $_POST['lep'];
	$sector = $_POST['sector'];

	$args = array(
        'post_type' => 'ambassadors',
        'posts_per_page' => -1
	);
	
	//LEP
    if($lep) {
        $lep_operator = "IN";
    }
    else {
        $lep_operator = "NOT IN";
	}
	
	//Ecosystem sector
	if($sector) {
        $sector_operator = "IN";
    }
    else {
        $sector_operator = "NOT IN";
	}	

	$args['tax_query'] = 
	array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'lep',
			'field' => 'term_id',
			'terms' => $lep,
			'operator' => $lep_operator,
		),
		array(
            'taxonomy' => 'ecosystem_sector',
            'field'    => 'term_id',
            'terms'    => $sector,
            'operator' => $sector_operator,
        ),
	);

	$ambassadors = get_posts($args);
	$query = new WP_Query($args);
	$total = $query->post_count;
	?>

	<h4><?php echo $total?> Found</h4>

	<div class="row">
        
		<?php foreach ($ambassadors as $ambassador): 
			$ambassador_id = $ambassador->ID;
			$title = get_the_title($ambassador_id);
			$all_fields = get_fields($ambassador_id);
		?>
			<div class="col-lg-3">
				<div class="person position-relative my-3">
					<div class="bg-white h-100 p-3">
						<img height="100" src="<?php echo $all_fields['picture'] ?>">
						<p class="name mt-3"><?php echo $title ?></p>
						<p class="pos"><?php echo $all_fields['position'] ?></p>
						<p class="mb-3"><?php echo $all_fields['short_bio'] ?></p>
					</div>
					<div style="position: absolute; bottom: 15px; width: 100%">
						<div class="d-flex justify-content-center">
							<a class="link" data-toggle="modal" data-target="#modalBasic<?php echo $partner_id?>">More</a>
						</div>
					</div>
				</div>
			</div>

		<?php endforeach ?>

	</div>

	<?php 
	die();
}
add_action( 'wp_ajax_nopriv_load_ambassadors', 'load_ambassadors' );
add_action( 'wp_ajax_load_ambassadors', 'load_ambassadors' );

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

function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

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
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
