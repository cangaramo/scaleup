<?php get_header(); ?>

<?php 
    $title = get_the_title();
    $all_fields = get_fields();
?>
<div class="single-programme">

    <div class="bg-dark">
        <div class="container programmes-top py-4">
            <div  class="d-flex justify-content-between align-items-center">
                <h2 class="my-2">Scaleup programmes</h2>
                <div><a class="btn-blue" href="/programmes"><img src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow-back.png">Back to programmes</a></div>
            </div>
        </div>
    </div>

    <div class="bg-blue">
        <div class="container programme-banner py-5">
            <p class="label">Programme</p>
            <h3><?php echo $title ?> / LEP NAME HERE</h3>
        </div>
    </div>

    <div class="bg-dark">
        <div class="container py-5">
            <p class="label">Impact for scaleups</p>
        </div>
    </div>

    <div class="bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="py-5 pr-4">
                        <?php echo $all_fields['copy'] ?>
                    </div>
                </div>
                <div class="col-4 bg-white p-0">
                    <img class="w-100" src="<?php echo $all_fields['thumbnail_image']?>">
                    <div class="bg-gray_blue p-5 sector">
                        <p class="title">Sector focus</p>
                    </div>
                    <div class="quote p-5">
                        <p><?php echo  $all_fields['quote'] ?></p>
                        <p class="author"><?php echo  $all_fields['quote_author'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-orange py-5">
        <div class="container">
            Call to action
        </div>
    </div>

</div>


<?php get_footer(); ?>
