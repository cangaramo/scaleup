<?php 
    $args = array(
        'post_type' => 'vacancies',
        'posts_per_page' => -1
    );

    $vacancies = get_posts($args);

    $apply_copy = $values['apply_copy'];
?>

<div class="bg-gray">

    <div class="container py-5">

        <h4>Vacancies</h4>
        <?php foreach ($vacancies as $vacancy): 
            $vacancy_id = $vacancy->ID;
            $title = get_the_title($vacancy_id);
            $all_fields = get_fields($vacancy_id);
        ?>

            <div class="vacancy p-3 my-3">

                <div class="open-vacancy">
                    <div class="row">
                        <div class="col-md-4 mb-2 mb-md-0">
                            <p class="label">Job title</p>
                            <p class="info"><?php echo $title ?></p>
                        </div>

                        <div class="col-md-3 mb-2 mb-md-0">
                            <p class="label">Role</p>
                            <p class="info"><?php echo $all_fields['role'] ?></p>
                        </div>

                        <div class="col-md-3 mb-4 mb-md-0">
                            <p class="label">Date</p>
                            <p class="info"><?php echo $all_fields['date'] ?></p>
                        </div>

                        <div class="col-md-2 mb-2 mb-md-0">
                            <div class="h-100 d-flex align-items-center justify-content-md-end">
                                <button><span>View</span><img height="15" src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow.png"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse vacancy-info">
                    <div class="bg-white pt-4 pb-3">
                        <div><?php echo $all_fields['copy']; ?></div>
                    </div>
                </div>
                
            </div>

        <?php endforeach ?>
    </div>

</div>

<div class="bg-gray_blue">
    <div class="container py-5">
        <?php echo $apply_copy ?>
    </div>
</div>