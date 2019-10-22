<?php 
    $form_title = $values['form_title'];
    $form_description = $values['form_description'];
    $form_image = $values['form_image'];
?>

<div class="programmes-list bg-gray">

    <div class="bg-dark">
        <div class="container form-programmes py-5">
            <div class="row">
                <div class="col-5">
                    <p class="title"><?php echo $form_title ?></p>
                    <p class="description"><?php echo $form_description ?></p>

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
                    $cat_business = get_category_by_slug("type-of-business");
                    $types_business = get_categories(
                        array( 
                            'parent' => $cat_business->cat_ID,
                            'hide_empty' => FALSE,
                            'orderby'=> 'title',
                            'order'	=> 'ASC'
                        )
                    ); 
                    $cat_support = get_category_by_slug("type-of-support");
                    $types_support = get_categories(
                        array( 
                            'parent' => $cat_support->cat_ID,
                            'hide_empty' => FALSE,
                            'orderby'=> 'title',
                            'order'	=> 'ASC'
                        )
                    ); 
                    ?>

                    <!-- Regions -->
                    <select id="dropdown-region">
                            <option value="">Which area are you based in?</option>
                        <?php foreach ($regions as $region):
                            $name = $region->cat_name;
                            $id = $region->cat_ID; ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Types of business -->
                    <select id="dropdown-type-business">
                            <option value="">What type of business are you?</option>
                        <?php foreach ($types_business as $type):
                            $name = $type->cat_name;
                            $id = $type->cat_ID; ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Types of support -->
                    <select id="dropdown-type-support">
                            <option value="">What support are you looking for?</option>
                        <?php foreach ($types_support as $type):
                            $name = $type->cat_name;
                            $id = $type->cat_ID; ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input class="submit-search" type="submit" value="Search now">

                </div>
                <div class="col-4 offset-2">
                    <div class="d-flex h-100 align-items-center">
                        <img style="height:220px" src="<?php echo $form_image ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 position-relative">

        <!-- Filters -->
        <div class="row filters pb-4">
            <div class="col-4">
                <h4>All programmes</h4>
            </div>
            <div class="col-8">

                <div class="d-flex justify-content-end">
                    <div class="item one-to-watch">
                        <a>One to watch</a>
                        <div class="checkbox"><i class="fas fa-check"></i></div>
                    </div>
                    <div class="item endorsed">
                        <a>Endorsed</a>
                        <div class="checkbox"><i class="fas fa-check"></i></div>
                    </div>
                    <div class="item-black more-filters">
                        <a>More filters</a>
                        <div class="open-filters"><i class="fas fa-caret-down"></i></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Response -->
        <div  id="response-programmes"></div>

        <!-- Filters window -->
        <div class="filters-window" style="padding-top:140px">

            <h5>Region</h5>

            <div class="row">
                <?php foreach ($regions as $region):
                    $name = $region->cat_name;
                    $id = $region->cat_ID; ?>
                    <div class="col-4">
                        <div class="tick">
                            <input name="checkbox-region" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                            <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <hr class="my-4">

            <h5>Types of business</h5>

            <div class="row">
                <?php foreach ($types_business as $type):
                    $name = $type->cat_name;
                    $id = $type->cat_ID; ?>
                    <div class="col-4">
                        <div class="tick">
                            <input name="checkbox-business" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                            <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <hr class="my-4">


            <h5>Types of support</h5>

            <div class="row">
                <?php foreach ($types_support as $type):
                    $name = $type->cat_name;
                    $id = $type->cat_ID; ?>
                    <div class="col-4">
                        <div class="tick">
                            <input name="checkbox-support" type="checkbox" value="<?php echo $id ?>" id="checkbox-<?php echo $id?>">
                            <label for="checkbox-<?php echo $id?>"><?php echo $name ?></label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="filter-btn">Update the results</button>

        </div>
            

    </div>

</div>
