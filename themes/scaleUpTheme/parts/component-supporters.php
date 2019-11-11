<?php 
    $title = $values['title'];
    $bg = $values['background'];
    $type = $values['type'];

    $args = array(
        'post_type' => 'partners',
        'posts_per_page' => '-1'
    );
    
    if ($type == "Lead") {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'supporter',
                'field'    => 'slug',
                'terms'    => 'lead',
            ),
        );
    } 
    else {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'supporter',
                'field'    => 'slug',
                'terms'    => 'associate',
            ),
        );
    }

    $partners = get_posts($args);
?>

<div style="background:<?php echo $bg ?>">
    <div class="container supporters py-5">

        <h4><?php echo $title ?></h4>

        <div class="row">
            <?php foreach($partners as $partner): 
                $partner_id = $partner->ID;
                $all_fields = get_fields($partner_id);
            ?>
                <div class="col-lg-3">
                    <div class="bg-white box mb-4" data-toggle="modal" data-target="#modalBasic<?php echo $partner_id?>">
                        <img class="w-100" src="<?php echo $all_fields['picture'] ?>">
                        <?php if ($type == "Lead"): ?>
                            <div class="p-3 info">
                                <?php echo $all_fields['short_description']; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
        
            <?php endforeach ?>
        </div>

    </div>
</div>

<?php foreach($partners as $partner): 
    $partner_id = $partner->ID;
    $title = get_the_title($partner_id);
    $all_fields = get_fields($partner_id); ?>

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
                            <?php echo $all_fields['copy'] ?>
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

