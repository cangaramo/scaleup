<?php 
    $title = $component['title'];
    $icons = $component['icons'];
?>
<div class="module-icons py-3 px-45 bg-white">
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