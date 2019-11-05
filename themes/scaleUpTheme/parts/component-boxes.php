<?php 
    $boxes = $values['boxes'];
?>
<div class="container my-5" id="boxes">

    <h4>Explore The ScaleUp Institute</h4>

    <div class="row mt-4">
    <?php foreach ($boxes as $box): ?>
        <div class="col-lg-4 mb-3">
            <div class="box" onClick="redirectTo('<?php echo $box['link'] ?>')"
                style="background-color:<?php echo $box['background_colour']?>">
                <div class="overflow-hidden">
                    <div class="thumbnail-img bg-image" style="background-image:url('<?php echo $box['image']?>')">
                        <div class="layer-img">
                            <div class="d-flex h-100 w-100 align-items-center justify-content-center">
                                <p><?php echo $box['title'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="p-4"><?php echo $box['description'] ?></p>
                <div class="pos-bottom w-100">
                    <a class="link white" href="<?php echo $box['link']?>"><?php echo $box['link_label'] ?></a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>