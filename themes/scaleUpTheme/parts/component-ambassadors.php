<?php 
    $form_title = $values['form_title'];
    $form_description = $values['form_description'];
    $form_image = $values['form_image'];
    $form_bg_image = $values['form_bg_image'];
?>

<div class="ambassadors-list">
    <div class="bg-image" style="background-image: url('<?php echo $form_bg_image ?>')">
        <div class="container py-5 form-banner">
            <div class="row">
                <div class="col-lg-5">
                    <div class="title"><?php echo $form_title ?></div>
                    <p class="description"><?php echo $form_description ?></p>

                    <?php 
                    $leps = get_terms( array(
                        'taxonomy' => 'lep',
                        'hide_empty' => false,
                        'orderby'=> 'title',
                        'order'	=> 'ASC'
                    ) ); 

                    $sectors = get_terms( array(
                        'taxonomy' => 'ecosystem_sector',
                        'hide_empty' => false,
                        'orderby'=> 'title',
                        'order'	=> 'ASC'
                    ) ); 
                    ?>

                    <!-- LEPs -->
                    <select id="dropdown-lep">
                        <option value="">Local area</option>
                        <?php foreach ($leps as $lep):
                            $name = $lep->name;
                            $id = $lep->term_id; ?>

                            <option value="<?php echo $id ?>"><?php echo $name ?></option>

                        <?php endforeach; ?>
                    </select>

                    <!-- LEPs -->
                    <select id="dropdown-sector">
                        <option value="">Ecosystem sector</option>
                        <?php foreach ($sectors as $sector):
                            $name = $sector->name;
                            $id = $sector->term_id; ?>

                            <option value="<?php echo $id ?>"><?php echo $name ?></option>

                        <?php endforeach; ?>
                    </select>

                    <button class="submit-search dark">Search now<img src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow.png"></button>       

                </div>

                <div class="col-lg-4 offset-lg-2 d-none d-lg-block">
                    <div class="d-flex h-100 align-items-center">
                        <img style="height:220px" src="<?php echo $form_image ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray_blue py-5">

    <div class="container">
        <div id="response-ambassadors"></div>
    </div>

</div>