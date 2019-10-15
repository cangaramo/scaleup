<?php 
    $image_bg = $values['background_image'];
    $label = $values['label'];
    $file = $values['file'];
?>

<div class="bg-image download" onClick="redirectTo('<?php echo $file ?>', true)"
    style="background-image:url(<?php echo $image_bg ?>)">

    <div class="overlay">
    </div>

    <div class="container h-100">
        <div class="d-flex align-items-center h-100">
            <img height="40" src="<?php echo get_bloginfo('template_url')?>/assets/images/open-book.png">
            <p class="mx-4"><?php echo $label ?></p>
            <img height="30" src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow-download.png">
        </div>
        
    </div>
</div>