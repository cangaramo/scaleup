<?php 
    $heading = $component['heading'];
    $subheading = $component['subheading'];
    $image = $component['image'];
    $footnote = $component['footnote'];
?>

<div class="module-graphic py-3 px-45 bg-white">
    <h3><?php echo $heading ?></h3>
    <h4><?php echo $subheading ?></h4>
    <hr>
    <img src="<?php echo $image ?>">
    <p class="footnote"><?php echo $footnote ?></p>
</div>