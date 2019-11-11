<?php 
    $column1 = $values['column_1'];
    $column2 = $values['column_2'];
    $bg = $values['background'];
?>

<div style="background:<?php echo $bg?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <?php echo $column1 ?>
            </div>
            <div class="col-lg-6">
                <?php echo $column2 ?>
            </div>
        </div>
    </div>
</div>
