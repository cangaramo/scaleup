<?php get_header(); 
    $fields = get_fields();
?>

<?php 
    $title = get_the_title();
    $all_fields = get_fields();
?>

<div class="single-report bg-light_gray">

    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <h3 class="mb-4"><?php echo $title ?></h3>
                <div class="mt-4 pt-1 mb-4"><?php echo $all_fields['content'] ?></div>
                <div class="d-block d-lg-none"><a class="download-btn" href="<?php echo $all_fields['file'] ?>"  target="_blank">Download<img src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a></div>
            </div>
            <div class="col-md-4">
                <img class="mt-4" style="max-width: 100%; max-height: 400px; height: auto; width: auto;" src="<?php echo $all_fields['thumbnail_image']?>">
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>