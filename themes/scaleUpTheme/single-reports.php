<?php get_header(); ?>

<?php 
    $title = get_the_title();
    $all_fields = get_fields();
?>

<div class="container my-5 single-report">
    <div class="row">
        <div class="col-md-8">
            <h3 class="mb-4"><?php echo $title ?></h3>
			<?php if ($all_fields['file']) { ?>
						 <div class="d-none d-lg-block"><a class="download-btn" href="<?php echo $all_fields['file'] ?>" target="_blank">Download<img src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a></div>
			<?php } ?>
            <div class="mt-4 pt-1 mb-4"><?php echo $all_fields['copy'] ?></div>
            <?php if ($all_fields['file']) { ?>
			<div class="d-block d-lg-none"><a class="download-btn" href="<?php echo $all_fields['file'] ?>"  target="_blank">Download<img src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a></div>
			<?php } ?>
        </div>
        <div class="col-md-4">
           <img class="w-100 mt-4" src="<?php echo $all_fields['thumbnail_image']?>">
        </div>
    </div>
</div>


<?php get_footer(); ?>
