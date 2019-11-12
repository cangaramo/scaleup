<?php 
$items = $values['items'];
?>

<div class="bg-blue slider-banner">
    <div class="container h-100 py-5">

        <div class="my-3 item">
            <div class="row">
                <div class="col-lg-7"> 
                    <div class="title"><?php echo $items[0]['title'] ?></div>
                    <div class="description mt-4"><?php echo $items[0]['text'] ?></div>
                        
                </div>
                <div class="col-3 offset-2 d-none d-lg-block">
                     <img height="170" src="<?php echo $items[0]['icon'] ?>">
                </div>
            </div>
        </div>

        <div class="my-3 item" style="display:none">
            <div class="row">
                <div class="col-lg-7">
                    <div class="title"><?php echo $items[1]['title'] ?></div>
                    <div class="description mt-4"><?php echo $items[1]['text'] ?></div>
                        
                </div>
                <div class="col-3 offset-2 d-none d-lg-block">
                     <img height="170" src="<?php echo $items[1]['icon'] ?>">
                </div>
            </div>
        </div>

        <div class="my-3 item" style="display:none">
            <div class="row">
                <div class="col-lg-7">
                    <div class="title"><?php echo $items[2]['title'] ?></div>
                    <div class="description mt-4"><?php echo $items[2]['text'] ?></div>
                        
                </div>
                <div class="col-3 offset-2 d-none d-lg-block">
                     <img height="170" src="<?php echo $items[2]['icon'] ?>">
                </div>
            </div>
        </div>
     

        <div class="d-flex flex-column flex-md-row mt-4 pt-1">
            <div><a class="btn-blue-overblue show-item"><?php echo $items[0]['button_label'] ?></a></div>
            <div><a class="btn-blue-overblue show-item"><?php echo $items[1]['button_label'] ?></a></div>
            <div><a class="btn-blue-overblue show-item"><?php echo $items[2]['button_label'] ?></a></div>
        </div>

    </div>
</div>
