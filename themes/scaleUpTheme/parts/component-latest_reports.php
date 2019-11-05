<?php 
    $title = $values['title'];
    $description = $values['description'];
    $reports = $values['reports'];
?>

<div class="container my-5" id="latest_reports">

    <div class="row">
        <div class=col-lg-6>
            <h4><?php echo $title ?></h4>
            <p><?php echo $description ?></p>
        </div>
    </div>

    <div class="row">
        <?php foreach ($reports as $report): 
            $id = ($report['posts']);
            $title = get_the_title($id);
            $all_fields = get_fields($id);
            $link = get_the_permalink($id);
        ?>
            <div class="col-lg-6 mb-4">
                <div class="report position-relative d-flex align-items-center">

                    <div class="content p-3">
                        <div class="row h-100">
                            <div class="col-6 offset-5 h-100">
                                <div class="position-relative h-100">
                                    <p class="date"><?php echo $all_fields['date']?></p>
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
                                <img height="210" src="<?php echo $all_fields['thumbnail_image']?>">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach ?>
    
    </div>

</div>