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
                <div class="col-9">
                    <p class="label">Programme</p>
                    <h3><?php echo $title ?></h3>
                </div>
                <div class="col-3 float-right">
                    <img height="55" class="ml-3" src="<?php echo get_bloginfo('template_url')?>/assets/images/endorsed.svg">
                    <img height="55" class="ml-3" src="<?php echo get_bloginfo('template_url')?>/assets/images/leadership.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Numbers -->
    <div class="bg-dark">
        <div class="container py-4">
            <p class="label">Impact for scaleups</p>

            <div class="row numbers pt-4">

                <?php foreach ($icons as $icon): ?>
                    <div class="col-2">
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

    <!-- Sectors -->
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
                    
                            if ($parent == 34) {
                                $taxonomy = $category->taxonomy;
                                $ref = $taxonomy . '_' . $term_id;
                                $icon_cat = get_field('icon', $ref);
                            }
                            ?>

                            <img alt="<?php echo $name ?>" title="<?php echo $name ?>" src="<?php echo $icon_cat ?>">
                            
                        <?php endforeach;

                    ?>
                   
                </div>
            </div>
            
        </div>
    </div>

    <!-- Copy -->
    <div class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="py-5 p-3">
                        <?php echo $all_fields['copy'] ?>
                    </div>
                </div>
                <div class="col-4 bg-gray_blue p-0">
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
    <div class="bg-orange">
        <div class="container px-4 py-5 call-to-action">
            <div class="row">
                <div class="col-3">
                    <div class="d-flex align-items-center h-100">
                        <img src="<?php echo get_bloginfo('template_url')?>/assets/images/CTA.png">
                    </div>
                </div>
                <div class="col-9">
                    <?php echo $all_fields['call_to_action'];  ?>
                </div>
            </div>
        </div>
    </div>

</div>