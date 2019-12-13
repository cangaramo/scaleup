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
    else {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'member',
                'field'    => 'slug',
                'terms'    => 'team',
            ),
        );
    }
    
    $people = get_posts($args);
?>

<div style="background-color: <?php echo $bg ?>">
    <div class="container py-5 people-slider">
        <h4><?php echo $title ?></h4>

        <div class="row multiple-items mt-4">
            <?php foreach ($people as $person): 
                $person_id = $person->ID;
                $title = get_the_title($person_id);
                $all_fields = get_fields($person_id);
            ?>
                <div class="col-lg-4 mt-3">
                    <div class="person position-relative">
                        <div class="bg-white h-100 p-3">
                            <img height="100" src="<?php echo $all_fields['picture'] ?>">
                            <p class="name mt-3"><?php echo $title ?></p>
                            <p class="pos"><?php echo $all_fields['position'] ?></p>
                            <p class="mb-3"><?php echo $all_fields['short_bio'] ?></p>
                        </div>
                        <div style="position: absolute; bottom: 15px; width: 100%">
                            <div class="d-flex justify-content-center">
                                <a class="link" data-toggle="modal" data-target="#modalBasic<?php echo $person_id?>">More</a>
                            </div>
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

    require 'part-modal.php';

 endforeach ?>
