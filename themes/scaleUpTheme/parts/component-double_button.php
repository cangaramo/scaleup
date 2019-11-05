<?php 
    $text_1 = $values['label_1'];
    $link_1 = $values['link_1'];
    $text_2 = $values['label_2'];
    $link_2 = $values['link_2'];
?>
<div class="container double-link">

    <div class="row py-4">
        <div class="col-md-6 pr-md-0">
            <a class="first-link btn-link" href="<?php echo $link1 ?>"><?php echo $text_1 ?></a>
        </div>
        <div class="col-md-6 pl-md-0">
            <a class="second-link btn-link" href="<?php echo $link2 ?>"><?php echo $text_2 ?></a>
        </div>
    </div>

</div>