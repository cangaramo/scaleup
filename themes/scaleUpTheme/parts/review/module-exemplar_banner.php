<?php 
    $heading = $component['heading'];
    $subheading = $component['subheading'];
?>
<div class="bg-dark module-exemplar">
    <div class="d-flex align-items-center h-100 p-4">
        <img class="mr-3" height="80" src="<?php echo get_bloginfo('template_url')?>/assets/images/exemplar.png">
        <div>
            <h3 class="heading mb-1"><?php echo $heading ?></h3>
            <p class="title-blue"><?php echo $subheading ?></p>
        </div>
    </div>
</div>