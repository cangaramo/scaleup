<?php 
    $copy = $values['copy'];
    $background = $values['background'];
    $text_colour = $values['text_colour'];

    if ($text_colour) {
        if ($text_colour == "White"){
            $col = "white";
        }
        else {
            $col = "black";
        }
    }
    else {
        $col = "#FFFFFF";
    }

?>

<div class="copy col-<?php echo $col ?>" style="background:<?php echo $background ?>;">
    <div class="container pt-5 pb-4">
        <div class="row">
            <div class="col-lg-7">
                <?php echo $copy ?>
            </div>
        </div>
    </div>
</div>
