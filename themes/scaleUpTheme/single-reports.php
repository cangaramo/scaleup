<?php get_header(); ?>

<?php 
    $title = get_the_title();
    $all_fields = get_fields();
?>

<div class="container my-5 single-report">
    <div class="row">
        <div class="col-8">
            <h3 class="mb-4"><?php echo $title ?></h3>
            <a class="download-btn">Download<img src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a>
            <div class="mt-4 pt-1"><?php echo $all_fields['copy'] ?></div>
        </div>
        <div class="col-4">
           <img class="w-100" src="<?php echo $all_fields['thumbnail_image']?>">
        </div>
    </div>
</div>


<?php get_footer(); ?>
