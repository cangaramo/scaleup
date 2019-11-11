<?php
    $title = get_the_title();
    $all_fields = get_fields();
    print_r($fields);
    $committees = $all_fields['committee'];
    $reports = $all_fields['latest_reports'];
?>

<?php get_header(); ?>

<main>

    <div class="bg-gray_blue">
        <div class="container py-5">

            <!-- Title and copy -->
            <div class="row pb-3">
                <div class="col-lg-7">
                    <div class="d-flex flex-column flex-lg-row align-items-center mb-4">
                        <img height="60" class="mr-3" src="<?php echo $all_fields['icon'] ?>">
                        <h2 class="mb-0"><?php echo $title ?></h2>
                    </div>  
                    <div><?php echo $all_fields['copy']?></div>
                </div>
            </div>

            <!-- Committee -->
            <h4>Committee</h4>
            <div class="row committees">
                <?php foreach ($committees as $committee_id):
                    echo $committee;
                    $title = get_the_title($committee_id);
                    $committee_fields = get_fields($committee_id);
                ?>
                    <div class="col-lg-4">
                        <div class="bg-white box mx-lg-2 my-2 p-3">
                            <p><?php echo $title ?></p>
                            <p><?php echo $committee_fields['position']?></p>
                            <a href="<?php echo $committee_fields['link'] ?>">View Linkedin Profile</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <!-- Title and copy -->
            <div class="row pt-4">
                <div class="col-lg-7">
                    <div><?php echo $all_fields['copy_2']?></div>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Latest reports -->
    <div class="bg-white">
        <div class="container my-5" id="latest_reports">

            <div class="row">
                <div class=col-lg-6>
                    <h4><?php echo $all_fields['reports_title'] ?></h4>
                    <p><?php echo $all_fields['reports_description'] ?></p>
                </div>
            </div>
            
            <div class="row">
                <?php foreach ($reports as $report):  
                    $id = $report;
                    $title = get_the_title($id);
                    $report_fields = get_fields($id);
                    $link = get_the_permalink($id); 
                ?>
               
                    <div class="col-lg-6 mb-4">
                        <div class="report position-relative d-flex align-items-center">

                            <div class="content p-3">
                                <div class="row h-100">
                                    <div class="col-6 offset-5 h-100">
                                        <div class="position-relative h-100">
                                            <p class="date"><?php echo $report_fields['date']?></p>
                                            <p class="title"><?php echo $title ?></p>
                                            <div class="pos-bottom w-100">
                                                <a href="<?php echo $link ?>" class="link white">More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="position:absolute; top: 0; height: 210px">
                                <div class="row">
                                    <div class="col-4 offset-lg-3">
                                        <img height="210" src="<?php echo $report_fields['thumbnail_image']?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> 

                <?php endforeach ?>

            </div>

        </div>
    
    </div>

    <!--- All reports -->
    <div class="all-posts white-gray">
        <div class="line-top">
            <a href="#">All reports</a>
        </div>
        <div class="line-bottom" style="">
            <div class="w-100" style="position: absolute; top: 0;">
                <div class="d-flex justify-content-center">
                    <div class="arrow-down"></div>
                </div>
            </div>
            <div class="w-100" style="position: absolute; top: 0;">
                <div class="d-flex justify-content-center">
                     <div><a href="#"><img class="arrow-icon" src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow_down.svg"></a></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Responses to consultations -->
    <div class="bg-gray">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <h4>Responses to consultations</h4>
                    <p><?php echo ($all_fields['responses']['copy']) ?></p>

                    <div class="bg-white p-3">

                        <div class="row">
                            <div class="col-lg-9">
                                <p class="title-blue-lowercase mb-3"><?php echo ($all_fields['responses']['title']) ?></p>
                                <p><?php echo ($all_fields['responses']['description']) ?></p>
                            </div>
                            <div class="col-lg-3">
                                <a href="<?php echo $all_fields['responses']['file'] ?>" target="_blank" class="btn-blue float-lg-right">Download<img class="btn-icon" src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a>
                            </div>
                        </div>    

                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
</main>

<?php get_footer(); ?>
