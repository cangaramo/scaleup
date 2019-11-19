<!-- Filters window -->
<div class="filters-window" style="">

    <?php 
    $cat_region = get_category_by_slug("region");
    $regions = get_categories(
        array( 
            'parent' => $cat_region->cat_ID,
            'hide_empty' => FALSE,
            'orderby'=> 'title',
            'order'	=> 'ASC'
        )
    ); 
    $cat_business = get_category_by_slug("sector");
    $types_business = get_categories(
        array( 
            'parent' => $cat_business->cat_ID,
            'hide_empty' => FALSE,
            'orderby'=> 'title',
            'order'	=> 'ASC'
        )
    ); 
    $cat_support = get_category_by_slug("support-available");
    $types_support = get_categories(
        array( 
            'parent' => $cat_support->cat_ID,
            'hide_empty' => FALSE,
            'orderby'=> 'title',
            'order'	=> 'ASC'
        )
    ); 
    $cat_aims = get_category_by_slug("primary-aims");
    $types_aims = get_categories(
        array( 
            'parent' => $cat_aims->cat_ID,
            'hide_empty' => FALSE,
            'orderby'=> 'title',
            'order'	=> 'ASC'
        )
    );
    $cat_types_of = get_category_by_slug("programme-type");
    $types_programmes = get_categories(
        array( 
            'parent' => $cat_types_of->cat_ID,
            'hide_empty' => FALSE,
            'orderby'=> 'title',
            'order'	=> 'ASC'
        )
    );  
    $cat_providers = get_category_by_slug("provider-type");
    $types_providers = get_categories(
        array( 
            'parent' => $cat_providers->cat_ID,
            'hide_empty' => FALSE,
            'orderby'=> 'title',
            'order'	=> 'ASC'
        )
    ); 
    $cat_cost = get_category_by_slug("programme-cost");
    $types_cost = get_categories(
        array( 
            'parent' => $cat_cost->cat_ID,
            'hide_empty' => FALSE,
            'orderby'=> 'title',
            'order'	=> 'ASC'
        )
    ); 
    ?>

    <div class="container">
    
        <h5>Support available</h5>

        <div class="row">
            <?php foreach ($types_support as $type):
                $name = $type->cat_name;
                $id = $type->cat_ID; ?>
                <div class="col-lg-4">
                    <div class="tick">
                        <input name="checkbox-support" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                        <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-3">

        <h5>Primary aims of the programme</h5>

        <div class="row">
            <?php foreach ($types_aims as $type):
                $name = $type->cat_name;
                $id = $type->cat_ID; ?>
                <div class="col-lg-4">
                    <div class="tick">
                        <input name="checkbox-aim" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                        <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-3">

        <h5>Programme cost</h5>

        <div class="row">
            <?php foreach ($types_cost as $type):
                $name = $type->cat_name;
                $id = $type->cat_ID; ?>
                <div class="col-lg-4">
                    <div class="tick">
                        <input name="checkbox-cost" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                        <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-3">

        <h5>Geography</h5>

        <div class="row">
            <?php foreach ($regions as $region):
                $name = $region->cat_name;
                $id = $region->cat_ID; ?>
                <div class="col-lg-4">
                    <div class="tick">
                        <input name="checkbox-region" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                        <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-3">

        <h5>Types of programmes</h5>

        <div class="row">
            <?php foreach ($types_programmes as $type):
                $name = $type->cat_name;
                $id = $type->cat_ID; ?>
                <div class="col-lg-4">
                    <div class="tick">
                        <input name="checkbox-type" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                        <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-3">

        <h5>Sector</h5>

        <div class="row">
            <?php foreach ($types_business as $type):
                $name = $type->cat_name;
                $id = $type->cat_ID; ?>
                <div class="col-lg-4">
                    <div class="tick">
                        <input name="checkbox-business" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                        <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-3">


        <h5>Provider type</h5>

        <div class="row">
            <?php foreach ($types_providers as $type):
                $name = $type->cat_name;
                $id = $type->cat_ID; ?>
                <div class="col-lg-4">
                    <div class="tick">
                        <input name="checkbox-provider" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                        <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-3">

       
        
        <div class="d-flex justify-content-between">
            <button class="clear-btn">Clear filters<img src="<?php echo get_bloginfo('template_url')?>/assets/images/close.png"></button>
            <button class="filter-btn">Update results<img src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow.png"></button>
        </div>

    </div>

</div>
