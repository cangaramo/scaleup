<?php
    $piece = $component;
?>
<div class="module-content-piece">
    <div class="content-piece">

        <div class="px-4 py-3 top" style="background-color:<?php echo $piece['background_colour']?>">
            <div class="row h-100">
                <div class="col-6">
                    <div class="d-flex h-100 align-items-center">
                         <div>
                            <p class="title-heading" style="color:<?php echo $piece['heading_colour']?>"><?php echo $piece['heading'] ?></p>
                            <?php if ($piece['subheading']): ?>
                                <div class="title-subheading"><?php echo $piece['subheading'] ?></div>
                            <?php endif?>
                        </div>
                     </div>
                </div>
                <div class="col-6">
                    <img class="float-right icon-bg" src="<?php echo $piece['background_icon']?>">
                </div>
             </div>
        </div>

        <div class="row p-4">
             <div class="col-8">
                <?php echo $piece['content'] ?>
            </div>
            <div class="col-4">
                <img class="w-100" src="<?php echo $piece['picture'] ?>">
            </div>
        </div>

    </div>

</div>