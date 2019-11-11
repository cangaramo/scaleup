<?php 
    $title = $values['title'];
    $bg = $values['background'];
    $board = $values['board'];

    $args = array(
        'post_type' => 'people',
        'posts_per_page' => -1
    );

    if ($board) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'member',
                'field'    => 'slug',
                'terms'    => 'board',
            ),
        );
    }
    
    $people = get_posts($args);
?>

<div style="background-color: <?php echo $bg ?>">
    <div class="container py-5 people-slider">
        <h4><?php echo $title ?></h4>

        <div class="multiple-items mt-4">
            <?php foreach ($people as $person): 
                $person_id = $person->ID;
                $title = get_the_title($person_id);
                $all_fields = get_fields($person_id);
            ?>
                <div class="person position-relative">
                    <div class="bg-white h-100 mx-2 p-3">
                        <img height="100" src="<?php echo $all_fields['picture'] ?>">
                        <p class="name mt-3"><?php echo $title ?></p>
                        <p class="pos"><?php echo $all_fields['position'] ?></p>
                        <p class="mb-3"><?php echo $all_fields['short_bio'] ?></p>
                    </div>
                    <div style="position: absolute; bottom: 15px; width: 100%">
                        <div class="d-flex justify-content-center">
                            <a class="link" data-toggle="modal" data-target="#modalBasic<?php echo $partner_id?>">More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>


<?php foreach ($people as $person): 
    $person_id = $person->ID;
    $title = get_the_title($person_id);
    $all_fields = get_fields($person_id);
?>

    <!-- Modal -->
    <div class="modal fade modalBasic" id="modalBasic<?php echo $partner_id?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-4">

                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-4">
                            <img class="w-100" src="<?php echo $all_fields['picture'] ?>">
                        </div>
                        <div class="col-8">
                            <h3 class="mb-3"><?php echo $title ?></h3>
                            <?php echo $all_fields['long_bio'] ?>
                        </div>
                    </div>
                </div>
                <div class="pos-top">
                    <button data-dismiss="modal"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-form.png"></button>
                </div>

            </div>
        </div>
    </div>

     
<?php endforeach ?>
