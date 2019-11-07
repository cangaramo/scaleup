<?php 
    $title = $values['title'];
    $partner_id = $values['partner'];
    $partner_title = get_the_title($partner_id);
    $all_fields = get_fields($partner_id);
?>

<div class="bg-light_gray">
    <div class="container py-5">
        <h4 class="mb-5"><?php echo $title ?></h4>
        <div class="row">
            <div class="col-4">
                <img class="w-100" src="<?php echo $all_fields['picture'] ?>">
            </div>
            <div class="col-8">
                <h5 class="mb-3"><strong><?php echo $partner_title ?></strong></h5>
                <div><?php echo $all_fields['copy'] ?></div>
            </div>
        </div>
    </div>
</div>