<?php 

function load_stories (){

	$posts_per_page = $_POST['posts_per_page'];

	$args = array(
        'post_type' => 'stories',
        'posts_per_page' => $posts_per_page
    );
	$posts = get_posts($args);

	//Total
	$args_total = array(
        'post_type' => 'stories',
        'posts_per_page' => -1
    );
	$query_total = new WP_Query( $args_total );
	$count = $query_total->post_count;

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
				<div class="story" onClick="redirectTo('<?php echo $permalink ?>')">
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
	
	<?php if ($count > $posts_per_page) :?>
		<div class="d-flex justify-content-center">
			<div class="all-stories pt-4">
				<p class="text-center">All stories</p>
				<img class="d-block mx-auto" src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow-down.png">
			</div>
		</div>
	<?php endif ?>

	<?php 
	die ();
}

?>