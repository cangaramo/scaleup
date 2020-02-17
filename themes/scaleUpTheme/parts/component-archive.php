<?php 
    $title = $values['title'];
    $post_type = $values['post_type'];

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1
    );

    $posts = get_posts($args);

    if ($post_type == "reports") {
        $id = "latest_reports";
        $bg = "bg-white";
    }
    else {
        $id = "featured_posts";
        $bg = "bg-light_gray";
    }
?>

<div class="<?php echo $bg?> py-4">
    <div class="container my-4" id="<?php echo $id ?>">

        <h3><?php echo $title ?></h3>

        <div class="row py-4">
            <?php foreach ($posts as $post): 
                $id = $post->ID;
                $title = get_the_title($id);
                $all_fields = get_fields($id);
                $link = get_the_permalink($id);
                
                if ($post_type == "reports"): ?>

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

                <?php else: 
                    $type = get_post_type($id);
                                    
                    switch ($type){
                        case 'news':
                            $title_type = "News";
                            break;
                        case 'programmes':
                            $title_type = "Programme";
                            break;
                        default:
                            $title_type = "Reports";
                            break;
                    }

                    if ($index == 0):
                        $class = "pd-first-box";
                    elseif ($index == 3):
                        $class = "pd-last-box";
                    else:
                        $class = "";
                    endif;

                ?>

                    <div class="col-md-6 col-lg-3 pd-box <?php echo $class ?> mb-4">
                        <div class="box position-relative">
                            <div class="pos-top w-100">
                                <p class="type"><?php echo $title_type ?></a>
                            </div>
                            <div class="overflow-hidden" onClick="redirectTo('<?php echo $link ?>')">
                                <div class="bg-image thumbnail" style="background-image: url('<?php echo $all_fields['thumbnail_image']?>')"></div>
                            </div>
                            <div class="px-3 py-2">
                                <p class="title"><?php echo $title ?></p>
                                <p class="description"><?php echo $all_fields['description'] ?></p>
                            </div>
                            <div class="pos-bottom w-100">
                                <a class="link" href="<?php echo $link ?>">Read more</a>
                            </div>
                        </div>
                    </div>


                <?php endif ?>
                
            <?php endforeach ?>

        </div>

    </div>
</div>