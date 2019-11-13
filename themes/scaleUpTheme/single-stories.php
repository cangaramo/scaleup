<?php
	$all_fields = get_fields();
?>

<?php get_header(); ?>
			
	<main>

		<div class="single-story">

			<div class="banner">
				<div class="container h-100">
					<div class="d-flex h-100 align-items-center">
						<div class="row">
							<div class="col-lg-8">
								<h3><?php the_title(); ?></h3>
								<p><?php echo $all_fields['description'] ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container my-5">
				<div class="row">
					<div class="col-lg-6">
						<?php echo $all_fields['copy'] ?>
					</div>
					<div class="col-lg-6">
						<img class="w-100" src="<?php echo $all_fields['image']?>">
						<p class="mt-3 quote"><?php echo $all_fields['quote'] ?></p>
						<p class="mt-3 full-name"><?php echo $all_fields['full_name'] ?></p>
					</div>

				</div>
			</div>

			<?php 
				$args = array(
					'post_type' => 'stories',
					'posts_per_page' => 4,
					'orderby' => 'rand',
					'order'    => 'ASC'
				);
				$posts = get_posts($args);
			?>

			<div class="bg-gray">
				<div class="container py-5 more-stories">
					<div class="row">
						<?php foreach ($posts as $post): 
							$id = $post->ID;
							$title = get_the_title($id);
							$permalink = get_the_permalink($id);
							$all_fields = get_fields($id);
						?>
							<div class="col-md-6 col-lg-3 mb-3">
								<div class="box">
									<div class="bg-image" style="background-image:url('<?php echo $all_fields['image_thumbnail']?>')"></div>
									<div class="p-3">
                                		<p class="title"><?php echo $title ?></p>
                                		<p class="description"><?php echo $all_fields['description'] ?></p>
                                		<div class="pos-bottom">
                                    		<a class="link" href="<?php echo $permalink ?>">Read more</a>
                                		</div>
                            		</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>

		</div>

	</main> <!-- end #content -->

<?php get_footer(); ?>
