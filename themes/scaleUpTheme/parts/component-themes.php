<?php 
    $title = $values['title'];
    $description = $values['description'];
    $areas = $values['areas'];
?>


<div class="bg-gray">
    <div class="container themes">
        <div class="row">
            <div class="col-lg-3 pr-lg-0">
                <div class="bg-dark h-100 p-4">
                    <p class="title pt-3"><?php echo $title ?></p>
                    <p class="desc"><?php echo $description ?></p>
                </div>
            </div>
            <div class="col-lg-9 pr-lg-4">
                <div class="row">
                    <?php foreach ($areas as $index=>$area): 

                        if ($index%2 == 0): 
                            $class = "bg-black";
                        else:
                            $class = "bg-dark";
                        endif; ?>

        
                        <div class="col <?php echo $class ?> py-5 box d-none d-lg-block">
                            <img style="height:60px" src="<?php echo $area['icon'] ?>">
                            <p><?php echo $area['title'] ?></p>
                        </div>
              
             
                        <div class="col-12 d-block d-lg-none">
                            <div class="<?php echo $class ?> py-4 py-md-3 box">
                                <img style="height:60px" src="<?php echo $area['icon'] ?>">
                                <p><?php echo $area['title'] ?></p>
                            </div>
                        </div>
              

                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>