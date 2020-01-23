<?php 

function load_search(){
	
	$keyword = $_POST['keyword'];

	/* General arguments */
	$args = array(
		'post_type'   => array('page', 'programmes', 'news', 'reports', 'stories', 'area_summaries', 'articles'),
		'orderby' => 'relevance', 
		'order'	=> 'ASC',
		'posts_per_page' => 5,
		's' => $keyword,
		'post_status' => 'publish'
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

?>