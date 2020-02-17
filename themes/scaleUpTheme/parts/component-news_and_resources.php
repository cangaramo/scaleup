<?php 
    $posts = $values['posts'];
    $title_text = $values['title'];
?>

<div class="bg-gray">
    <div class="container pt-4 pb-5" id="featured_posts">

        <h4><?php echo $title_text ?></h4>

        <div class="row">
            <?php foreach ($posts as $index=> $post):
                $id = ($post['post']);
                $title = get_the_title($id);
                $all_fields = get_fields($id);
                $link = get_the_permalink($id);
                $type = get_post_type($id);
                $date = get_the_date("d F Y", $id);
                
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
                            <p class="title mb-2"><?php echo $title ?></p>
                            <p><?php echo $date ?></p>
                            <p class="description"><?php echo $all_fields['description'] ?></p>
                        </div>
                        <div class="pos-bottom w-100">
                            <a class="link" href="<?php echo $link ?>">Read more</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

        </div>

    </div>
</div>