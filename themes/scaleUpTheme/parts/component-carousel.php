<?php 
    $items = $values['items'];
    $slider = $values['slider_content'];
?>


<div class="position-relative">


    <!-- Carousel -->
    <div id="carouselBanner" class="carousel slide" data-ride="carousel">

        <!--
        <ol class="carousel-indicators">

            <?php 
            if (sizeof($items) > 1): ?>

                <?php foreach ($items as $index=>$item): ?>

                    <?php if ($index == 0): ?>
                        <li data-target="#carouselBanner" data-slide-to="<?php echo $index?>" class="active"></li>
                    <?php else: ?>
                        <li data-target="#carouselBanner" data-slide-to="<?php echo $index?>"></li>
                    <?php endif; ?>

                <?php endforeach ?>

            <?php endif; ?>

        </ol> -->

        <div class="carousel-inner">

            <?php foreach ($items as $index=>$item): ?>

                    <?php if ($index == 0): ?>
                        <div class="carousel-item active">
                    <?php else: ?>
                        <div class="carousel-item">
                    <?php endif; ?>

                        <div class="position-relative">

                            <div class="bg-image big-banner" style="background-image:url('<?php echo $item['image'] ?>');"></div>
                            
                            <div class="layer h-100 w-100">
                                <div class="row h-100 m-0">
                                    <div class="col-lg-6 blue-bg h-100"> </div>
                                </div>
                            </div>

                            <div class="layer h-100 w-100">
                                <div class="container h-100">
                                    <div class="row h-100">
                                        <div class="col-lg-5 col-xl-4 h-100 mt-banner h-100">
                                            <div class="d-flex align-items-center h-100">
                                                <div>
                                                    <h3 class="mb-4"><?php echo $item['headline'] ?></h3>
                                                    <p><?php echo $item['text'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

            <?php endforeach ?>

        </div>

        <?php if (sizeof($items) > 1): ?>

            <a class="carousel-control-prev" href="#carouselBanner" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselBanner" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        <?php endif; ?>

    </div> <!-- carousel -->

    <div class="slider">
            
            <?php foreach ($slider as $index=> $slide): ?>

                <?php if ($index == 0): ?>

                    <div class="text-slide h-100" style="display:block">

                <?php else: ?>

                    <div class="text-slide h-100">

                <?php endif ?>

                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div><p class="my-0 mr-4"><?php echo $slide['slide'] ?></p></div>
                        <img src="<?php echo get_bloginfo('template_directory')?>/assets/images/speaker.png">    
                    </div>

                </div>
                    
            <?php endforeach ?>
           
       
    </div>

</div>
