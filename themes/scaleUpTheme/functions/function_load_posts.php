<?php 

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

?>