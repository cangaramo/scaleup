<?php 
    $title = $component['title'];
    $image = $component['image'];
    $footnote = $component['footnote'];
?>

<div class="module-chart py-3 px-45 bg-white">
    <hr>
    <h5><?php echo $title ?></h5>
    <a href="<?php echo $image ?>" target="_blank"><img src="<?php echo $image ?>"></a>
    <p class="footnote"><?php echo $footnote ?></p>
</div>