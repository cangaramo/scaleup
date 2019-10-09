<?php 
    $title = $values['title'];
    $text = $values['text'];
    $image = $values['background_image'];
    $icon = $values['icon'];
    $links = $values['links'];
    $colour = $values['text_colour'];
    $btn_colour = $values['buttons_colour'];

    if ($btn_colour == "Blue"){
        $btn_class = "btn-blue";
    }
    else {
        $btn_class = "btn-white";
    }
?>
<div class="bg-image banner" style="background-image:url(<?php echo $image ?>); color: <?php echo $colour ?>">
    <div class="container h-100">
        <div class="d-flex align-items-center h-100">
            <div class="row">
                <div class="col-7">
                    <div class="title"><?php echo $title ?></div>
                    <div class="description mt-4"><?php echo $text ?></div>
                    <div class="d-flex mt-4 pt-1">
                        <?php if ($links[0]['link_label']):?>
                            <a class="<?php echo $btn_class?>" href="<?php echo $links[0]['link'] ?>"><?php echo $links[0]['link_label'] ?></a>
                        <?php endif ?>
                        <?php if ($links[1]['link_label']):?>
                            <a class="<?php echo $btn_class?>" href="<?php echo $links[1]['link'] ?>"><?php echo $links[1]['link_label'] ?></a>
                        <?php endif ?>
                        <?php if ($links[2]['link_label']):?>
                            <a class="<?php echo $btn_class?>" href="<?php echo $links[2]['link'] ?>"><?php echo $links[2]['link_label'] ?></a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-3 offset-2">
                    <img height="180" src="<?php echo $icon ?>">
                </div>
            </div>
        </div>
    </div>
</div>