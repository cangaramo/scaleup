<?php 
    $form_title = $values['form_title'];
    $form_description = $values['form_description'];
    $form_image = $values['form_image'];
    $form_bg_image = $values['form_bg_image'];
?>

<div class="programmes-list bg-gray">

    <div class="bg-image" style="background-image: url('<?php echo $form_bg_image ?>')">
        <div class="container form-programmes py-5">
            <div class="row">
                <div class="col-lg-5">
                    <div class="title"><?php echo $form_title ?></div>
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

                    <button class="submit-search">Search now<img src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow.png"></button>

                </div>
                <div class="col-lg-4 offset-lg-2 d-none d-lg-block">
                    <div class="d-flex h-100 align-items-center">
                        <img style="height:220px" src="<?php echo $form_image ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 position-relative all-programmes">

        <!-- Basic filters -->
        <div class="container">
            <div class="row filters pb-4">
                <div class="col-lg-4">
                    <h4>All programmes</h4>
                </div>
                <div class="col-lg-8">

                    <div class="d-flex flex-column flex-sm-row justify-content-lg-end">
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
                        <div>
                            <img class="close-filters" src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-form.png">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Response -->
        <div class="container">
            <div  id="response-programmes"></div>
        </div>

        <!-- Advanced filters -->
        <?php require 'part-filters.php'; ?>

    </div>

</div>
