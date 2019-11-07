<?php get_header(); 
$all_fields = get_fields();
?>

<main class="single-summary">

    <!-- Title -->
    <div class="bg-blue">
        <div class="container py-5">
            <div class="d-flex">
                <img height="150" src="<?php echo $all_fields['map_icon'] ?>">
                <div>
                    <p class="label">LOCAL AREA SUMARY:</p>
                    <h3><?php echo get_the_title(); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Numbers -->
    <div class="bg-dark">

        <div class="container numbers">
            <div class="row py-5">

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/scaleups.png">
                        <p class="num counter"><?php echo $all_fields['scaleups_number'] ?></p>
                        <p class="desc">Total number of scaleups</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/employees.png">
                        <p class="num counter"><?php echo $all_fields['employee_growth'] ?></p>
                        <p class="desc">No. by employee growth</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/turnover.png">
                        <p class="num counter"><?php echo $all_fields['turnover_growth'] ?></p>
                        <p class="desc">No. by turnover growth</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/employee_growth.png">
                        <p class="num counter"><?php echo $all_fields['employee_turnover_growth'] ?></p>
                        <p class="desc">No. by employee and turnover growth</p>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/total_employees.png">
                        <p class="num counter"><?php echo $all_fields['total_employees'] ?></p>
                        <p class="desc">Total employees</p>
                        <div class="line"></div>
                    </div>
                </div>


                <div class="col-2">
                    <div class="box">
                        <img class="mx-auto d-block" src="<?php echo get_bloginfo('template_url')?>/assets/images/total_growth.png">
                        <p class="num counter"><?php echo $all_fields['total_turnover'] ?></p>
                        <p class="desc">Total turnover</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Copy -->
    <div class="bg-light_gray">

        <div class="container py-5">

            <div class="row">
                <div class="col-3">
                    <p class="heading"><?php echo $all_fields['heading_1']; ?></p>
                    <?php echo $all_fields['copy_1']; ?>
                </div>
                <div class="col-3">
                    <p class="heading"><?php echo $all_fields['heading_2']; ?></p>
                    <?php echo $all_fields['copy_2']; ?>
                </div>
                <div class="col-3">
                    <p class="heading"><?php echo $all_fields['heading_3']; ?></p>
                    <?php echo $all_fields['copy_3']; ?>
                </div>
                <div class="col-3 side-boxes">
                    <div class="bg-dark p-3">
                        <p class="heading color-orange">Scaleup Views</p>
                        <p><?php echo $all_fields['scaleup_views']; ?></p>
                    </div>
                    <div class="bg-orange p-3">
                        <p class="heading color-black">Top barries to growth</p>
                        <p><?php echo $all_fields['top_barries_to_growth']; ?></p>
                    </div>
                    <div class="bg-blue p-3">
                        <p class="heading color-black">want TO SEE more of:</p>
                        <p><?php echo $all_fields['want_to_see_more_of']; ?> </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Call to action -->
    <div class="bg-orange">
        <div class="container py-5 call-to-action">
            <div class="row">
                <div class="col-3">
                    <div class="d-flex align-items-center h-100">
                        <img src="<?php echo get_bloginfo('template_url')?>/assets/images/CTA.png">
                    </div>
                </div>
                <div class="col-9">
                    <?php echo $all_fields['call_to_action'];  ?>
                </div>
            </div>
        </div>
    </div>
    
    
</main>

<?php get_footer(); ?>