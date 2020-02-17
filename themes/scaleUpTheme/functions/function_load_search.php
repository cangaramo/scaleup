<?php 

function load_search(){
	
	$keyword = $_POST['keyword'];

	/* General arguments */
	$args = array(
		'post_type'   => array('page', 'programmes', 'news', 'reports', 'stories', 'area_summaries', 'articles'),
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);

	//Main query 
	$query = new WP_Query( $args );

	// LOOP - show posts
	
	if( $query->have_posts() ) :

		$total = 0;
		$results = array();
		
		while( $query->have_posts() ): $query->the_post();
			$mypost = $query->post;
			$id = get_the_ID();
			$link = get_the_permalink(); 
			$post_type = get_post_type($id);
			$title = get_the_title($id); ?>

			<?php 
			$found = false;

			$fields = get_fields();
			$components = $fields['components'];

			if (strlen($keyword) > 1 ) {
				
				//Check if title contains keyword
				if (stripos($title, $keyword) !== false) {
					$found = true;
				}


				//Check if fields of components contain keyword
				foreach ($components as $component): 
					
					$layout = $component['acf_fc_layout'];

					if ($layout == "copy"):
				
						$copy  = $component['copy'];

						if (stripos($copy, $keyword) !== false) {
							$found = true;
						}

					endif;
						
				endforeach; 

			}

			if ($found && $total < 6): ?>
				
				<a class="result" data-link="<?php echo $link ?>" href="<?php echo $link ?>"> <?php echo $title ?></a> 
			<?php
			
				$total = $total + 1;
				//array_push($results, $id);
				//$results.append($id);
			?>

				
			<?php endif;


		endwhile;

		/*
		foreach ($results as $result):
			$id = $result;
			$link = get_the_permalink($id); 
			$title = get_the_title($id);
		?>

			<a class="result" data-link="<?php echo $link ?>" href="<?php echo $link ?>"> <?php echo $title ?></a>

		<?php endforeach;*/

			
		wp_reset_postdata();
	else : ?>
			
		<p class="no-posts">No posts found</p>
			
	<?php endif;


	die();
}

?>