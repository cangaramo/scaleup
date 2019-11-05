<?php 
    $title = $component['title'];
    $image = $component['image'];
    $footnote = $component['footnote'];
?>

<div class="module-chart py-3">
    <hr>
    <h5><?php echo $title ?></h5>
    <img src="<?php echo $image ?>">
    <p class="footnote"><?php echo $footnote ?></p>
</div>