<?php 
    $programme = $component['programme'];
    $title = get_the_title ($programme);
    $all_fields = get_fields($programme);
    $icons = $all_fields['icons'];

    //Get sectors
    $categories = get_the_category($programme);

?>
<div class="single-programme">

    <!-- Title -->
    <div class="bg-blue">
        <div class="container programme-banner py-5">
            <div class="row">
                <div class="col-lg-6">
                    <p class="label">Programme</p>
                    <h3 class="mb-4 mb-lg-0"><?php echo $title ?></h3>
                </div>
                <div class="col-lg-6 float-lg-right">

                    <div class="d-flex justify-content-lg-end badges h-100 align-items-center">

                        <?php if ($all_fields['endorsed'] == 1): ?>
                            <img height="58" class="ml-3" src="<?php echo get_bloginfo('template_url')?>/assets/images/endorsed.svg">
                        <?php elseif ($all_fields['one_to_watch'] == 1): ?>
                            <img height="58" class="ml-3" src="<?php echo get_bloginfo('template_url')?>/assets/images/one_to_watch.png">
                        <?php endif ?>

                        <!-- Themes -->
                        <?php foreach ($categories as $category):
                            $term_id = $category->term_id;
                            $name = $category->name;
                            $parent = $category->category_parent;
                    
                            if ($parent == 97) :
                                $taxonomy = $category->taxonomy;
                                $ref = $taxonomy . '_' . $term_id;
                                $icon_cat = get_field('white_icon', $ref); ?>
                            
                                <div class="theme ml-3 w-100" style="font-weight:bold">
                                    <img height="50" title="<?php echo $name ?>" src="<?php echo $icon_cat ?>">
                                    <p><?php echo $name ?></p>
                                </div>

                            <?php endif ?>

                        <?php endforeach; ?>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Numbers -->
    <?php 
    if ($icons[0]['icon']):?>
        <div class="bg-dark">
            <div class="container py-4">
                <p class="label">Impact for scaleups</p>

                <div class="row numbers pt-4">

                    <?php foreach ($icons as $icon): ?>
                        <div class="col-sm mb-4 mb-lg-0">
                            <div class="box">
                                <img class="mx-auto d-block" src="<?php echo $icon['icon']?>">
                                <p class="num counter"><?php echo $icon['number'] ?></p>
                                <p class="desc"><?php echo $icon['description'] ?></p>
                                <div class="line"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                
            </div>
        </div>
    <?php endif ?>

    <!-- Sectors -->
    <?php 
    $show_sectors = false;
    foreach ($categories as $category):
        $term_id = $category->term_id;
        $name = $category->name;
        $parent = $category->category_parent;
        if ($parent == 34) :
            $show_sectors = true; 
        endif;
    endforeach; ?>

    <?php if ($show_sectors): ?>
        <div class="bg-black">
            <div class="container py-4 key-sectors">

                <div class="d-flex h-100 align-items-center">
                    <p class="label">Key sectors</p>
                    <div>
                        <?php
                            foreach ($categories as $category):
                                $term_id = $category->term_id;
                                $name = $category->name;
                                $parent = $category->category_parent;
                        
                                if ($parent == 34) :
                                    $taxonomy = $category->taxonomy;
                                    $ref = $taxonomy . '_' . $term_id;
                                    $icon_cat = get_field('white_icon', $ref); 
                                ?>
                                    <img alt="<?php echo $name ?>" title="<?php echo $name ?>" src="<?php echo $icon_cat ?>">
                                
                                <?php endif ?>
                                
                            <?php endforeach;
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    <?php endif ?>

    <!-- Copy -->
    <div class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="py-5 p-3">
                        <?php echo $all_fields['copy'] ?>
                    </div>
                </div>
                <div class="col-lg-4 bg-gray_blue p-0">
                    <img class="w-100" src="<?php echo $all_fields['thumbnail_image']?>">
                    
                    <!-- Reviews -->
                    <div class="quote p-4">

                        <?php
                        $reviews = $all_fields['reviews'];
                        foreach ($reviews as $review): ?>

                            <p class="text"><?php echo  $review['review'] ?></p>
                            <p class="author"><?php echo  $review['author'] ?></p>

                        <?php endforeach; ?>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Call to action -->
    <?php if ($all_fields['call_to_action']): ?>
        <div class="bg-orange">
            <div class="container px-4 py-5 call-to-action">
                <div class="row">
                    <div class="col-lg-2 mb-4">
                        <div class="d-flex align-items-center h-100">
                            <img src="<?php echo get_bloginfo('template_url')?>/assets/images/CTA.png">
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <?php echo $all_fields['call_to_action'];  ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

</div>