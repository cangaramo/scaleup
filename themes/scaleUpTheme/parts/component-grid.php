<?php 
    $group1 = $values['call_to_action_1'];
    $group2 = $values['call_to_action_2'];
    $links = $values['links'];
?>

<div class="bg-gray">
    <div class="container pt-5 pb-4" id="grid">

        <!-- First call to action -->
        <div class="box-200 bg-image" style="background-image:url('<?php echo $group1['image']?>')">

            <div class="overlay">
            </div>

            <div class="p-5 position-relative">
                <p class="title"><?php echo $group1['title'] ?></p>
                <p class="mb-4"><?php echo $group1['description'] ?></p>
                <a class="link white" href="<?php echo $group1['link_url'] ?>"><?php echo $group1['link_label'] ?></a>
            </div>
            
        </div>

        <div class="row pt-3">

            <!-- Links -->
            <div class="col-md-6 pr-md-2 mb-3"> 
                <?php foreach ($links as $link): ?>

                    <div class="link-box px-5" onClick="redirectTo('<?php echo $link['link'] ?>')"
                        style="color: <?php echo $link['text_color']?>; background-color: <?php echo $link['background']?>">
                        <div class="d-flex align-items-center h-100 w-100">
                            <div class="position-relative w-100">    
                                <p class="link-title"><?php echo $link['title'] ?></p>
                                <p class="link-description"><?php echo $link['description'] ?></p>
                                <div class="arrow">
                                    <?php if ($link['background'] == "#ffffff"):?>
                                        <img height="15" src="<?php echo get_bloginfo('template_url') ?>/assets/images/arrow_blue.png">
                                    <?php else: ?>
                                        <img height="15" src="<?php echo get_bloginfo('template_url') ?>/assets/images/arrow.png">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>

            <!-- Second call to action -->
            <div class="col-md-6 pl-md-2">
                <div class="box-400 p-5" style="background-image:url('<?php echo $group2['image']?>')">
                    <div class="d-flex text-center justify-content-center align-items-center h-100 w-100">
                        <div>
                            <p class="title mb-4"><?php echo $group2['title'] ?></p>
                            <a class="link white" href="<?php echo $group2['link_url'] ?>"><?php echo $group1['link_label'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>