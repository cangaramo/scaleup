<?php 
    $pieces = $component['pieces'];
?>

<div class="py-4 module-content-collection">

    <h4 class="text-center">Introductions</h4>

    <div class="row mb-5">
        <?php foreach ($pieces as $piece): 
            if ($piece['bg_colour'] == "#DDE3E8"){
                $class_colour = "dark-colour";
            }
            else {
                $class_colour = "";
            }
        ?>
            <div class="col-4">
                <div class="content-box <?php echo $class_colour ?>" style="background-color:<?php echo $piece['bg_colour']?>">
                    <div class="w-100 bg-image" style="height: 180px; background-image:url('<?php echo $piece['thumbnail_image'] ?>')"></div>
                    <div class="p-3">
                        <p class="title"><?php echo $piece['heading'] ?></p>
                        <p><?php echo $piece['short_description'] ?></p>
                        <div class="pos-bottom">
                            <a class="open-content link white">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <?php foreach ($pieces as $piece):?>
        <div class="content-piece">
            <div class="px-4 py-3 top" style="background-color:<?php echo $piece['bg_colour']?>">
             
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
             
                <div class="pos-top">
                    <button class="close-content"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-form.png"></button>
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
    <?php endforeach ?>

   

</div>