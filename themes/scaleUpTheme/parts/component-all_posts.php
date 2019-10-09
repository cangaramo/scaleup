<?php 
    $link_label = $values['link_label']; 
    $link = $values['link']; 
    $colours = $values['colours'];

    if ($colours == "Gray to white"){
        $class_colours = "gray-white";
    }
    else {
        $class_colours = "white-gray";
    }
?>

<div class="all-posts <?php echo $class_colours ?>">
    <div class="line-top">
        <a href="<?php echo $link ?>"><?php echo $link_label ?></a>
    </div>
    <div class="line-bottom" style="">
        <div class="w-100" style="position: absolute; top: 0;">
            <div class="d-flex justify-content-center">
                <div class="arrow-down"></div>
            </div>
        </div>
        <div class="w-100" style="position: absolute; top: 0;">
            <div class="d-flex justify-content-center">
                <div><a href="<?php echo $link ?>"><img class="arrow-icon" src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow_down.svg"></a></div>
            </div>
        </div>
    </div>
</div>



