<?php 
    $programme = $component['programme'];
    $title = get_the_title ($programme);
    $all_fields = get_fields($programme);
    $icons = $all_fields['icons'];

    //Get sectors
    $categories = get_the_category($programme);

?>
<div class="single-programme">


    <div class="bg-blue">
        <div class="container programme-banner py-5">
            <p class="label">Programme</p>
            <h3><?php echo $title ?> / LEP NAME HERE</h3>
        </div>
    </div>

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

    <div class="bg-black">
        <div class="container py-4">

            <div class="d-flex">
                <p class="label">Key sectors</p>
                <div>
                    <?php
                    
                        foreach ($categories as $category):
                            $term_id = $category->term_id;
                            $parent = $category->category_parent;
                    
                            if ($parent == 34) {
                                $taxonomy = $category->taxonomy;
                                $ref = $taxonomy . '_' . $term_id;
                                $icon_cat = get_field('icon', $ref);
                            }
                            ?>

                            <img src="<?php echo $icon_cat ?>">
                            
                        <?php endforeach;

                    ?>
                   
                </div>
            </div>
            
        </div>
    </div>

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
                    <div class="bg-gray_blue p-5 sector">
                        <p class="title">Sector focus</p>
                    </div>
                    <div class="quote p-5">
                        <p><?php echo  $all_fields['quote'] ?></p>
                        <p class="author"><?php echo  $all_fields['quote_author'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-orange py-5">
        <div class="container">
            Call to action
        </div>
    </div>

</div>