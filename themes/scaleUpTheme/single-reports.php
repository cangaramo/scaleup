<?php get_header(); ?>

<?php 
    $title = get_the_title();
    $all_fields = get_fields();
?>

<div class="single-report">

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <h3 class="mb-4"><?php echo $title ?></h3>
                <div class="d-none d-lg-block"><a class="download-btn" href="<?php echo $all_fields['file'] ?>" target="_blank">Download<img src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a></div>
                <div class="mt-4 pt-1 mb-4"><?php echo $all_fields['copy'] ?></div>
                <div class="d-block d-lg-none"><a class="download-btn" href="<?php echo $all_fields['file'] ?>"  target="_blank">Download<img src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a></div>
            </div>
            <div class="col-md-4">
            <img class="w-100 mt-4" src="<?php echo $all_fields['thumbnail_image']?>">
            </div>
        </div>
    </div>

    <div class="bg-gray">
        <div class="container">
            <h4>Visible scaleups</h4>
        </div>
    </div>

</div>

<?php get_footer(); ?>
