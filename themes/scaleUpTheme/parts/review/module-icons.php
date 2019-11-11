<?php 
    $title = $component['title'];
    $icons = $component['icons'];
    $bg = $component['background'];
    $text_colour = $component['text_colour'];

    if(count($bg) == 0) {
        $bg = "#548095";
        $text_colour = "#FFFFFF";
    }

?>
<div class="module-icons py-2 px-45" style="background: <?php echo $bg?>; color: <?php echo $text_colour ?>">
    <p class="title"><?php echo $title ?></p>

    <div class="row">
        <?php foreach ($icons as $icon): ?>
            <div class="col-sm">
                <img class="mx-auto d-block" src="<?php echo $icon['image'];?>">
                <p><?php echo $icon['description']; ?></p>
            </div>
        <?php endforeach ?>
    </div>
    
</div>