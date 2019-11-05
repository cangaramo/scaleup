<?php 
    $reference = $component['reference'];
    $footnote = $component['footnote'];
?>
<div id="<?php echo $reference?>" class="py-3 module-footnote">
    <hr>
    <div class="d-flex">
        <span class="reference mr-3"><?php echo $reference ?> </span>
        <div><?php echo $footnote ?></div>
    </div>
</div> 