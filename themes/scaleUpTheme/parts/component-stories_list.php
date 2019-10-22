<?php 
    $args = array(
        'post_type' => 'stories',
        'posts_per_page' => -1
    );
    $posts = get_posts($args);
    
?>

<div class="bg-gray">

    <div class="container py-5 list-stories">

        <?php foreach ($posts as $index=>$post): 
            if ($index == 0 || $index == 10 ) : ?>

                <div class='row'>

                    <!-- Story 0 -->
                    <div class='col-6 pr-2'>
                        <?php 
                            $post_id = $posts[0];
                            $title = get_the_title($post_id);
                            $permalink = get_the_permalink($post_id);
                            $all_fields = get_fields($post_id);
                        ?>
                        <div class="story tall">
                            <div class="bg-image" style="background-image:url('<?php echo $all_fields['image_thumbnail']?>')"></div>
                            <div class="p-3">
                                <p class="title"><?php echo $title ?></p>
                                <p><?php echo $all_fields['description'] ?></p>
                                <div class="pos-bottom">
                                    <a class="link" href="<?php echo $permalink ?>">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stories 1-4 -->
                    <div class='col-6'>
                        <div class="row">
                            <?php for ($i=1; $i<5; $i++):
                                $post_id = $posts[$i];
                                $title = get_the_title($post_id);
                                $permalink = get_the_permalink($post_id);
                                $all_fields = get_fields($post_id);
                            ?>
                                <div class="col-6 pl-2">
                                    <div class="story mb-3">
                                        <div class="bg-image" style="background-image:url('<?php echo $all_fields['image_thumbnail']?>')"></div>
                                        <div class="p-3">
                                            <p class="title"><?php echo $title ?></p>
                                            <p><?php echo $all_fields['description'] ?></p>
                                            <div class="pos-bottom">
                                                <a class="link" href="<?php echo $permalink ?>">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endfor ?>
                        </div>
                    </div>

                    <!-- Stories 5-8 -->
                    <div class="col-6">
                        <div class="row">
                            <?php for ($i=5; $i<9; $i++):
                                $post_id = $posts[$i];
                                $title = get_the_title($post_id);
                                $permalink = get_the_permalink($post_id);
                                $all_fields = get_fields($post_id);
                            ?>
                                <div class="col-6 pr-2">
                                    <div class="story mb-3">
                                        <div class="bg-image" style="background-image:url('<?php echo $all_fields['image_thumbnail']?>')"></div>
                                        <div class="p-3">
                                            <p class="title"><?php echo $title ?></p>
                                            <p><?php echo $all_fields['description'] ?></p>
                                            <div class="pos-bottom">
                                                <a class="link" href="<?php echo $permalink ?>">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endfor ?>
                        </div>

                    </div>
                    <div class="col-6 pl-2">
                        <?php 
                            $post_id = $posts[9];
                            $title = get_the_title($post_id);
                            $permalink = get_the_permalink($post_id);
                            $all_fields = get_fields($post_id);
                        ?>
                        <div class="story tall">
                            <div class="bg-image" style="background-image:url('<?php echo $all_fields['image_thumbnail']?>')"></div>
                            <div class="p-3">
                                <p class="title"><?php echo $title ?></p>
                                <p><?php echo $all_fields['description'] ?></p>
                                <div class="pos-bottom">
                                    <a class="link" href="<?php echo $permalink ?>">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif;
        ?>

        <?php endforeach ?>

    </div>

</div>