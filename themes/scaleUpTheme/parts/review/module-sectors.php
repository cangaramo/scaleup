<?php 
    $sectors = $component['sectors'];
?>
<div class="module-sectors">
    <!-- Sectors -->
    <div class="bg-blue">
        <div class="container py-4 key-sectors">

            <div class="d-flex flex-column flex-lg-row h-100 align-items-center">
                <p class="label">Participating sectors</p>
                <div>
                    <?php
                    
                        foreach ($sectors as $sector):
                            $term_id = $sector;
                            $taxonomy = 'category';
                            $ref = $taxonomy . '_' . $term_id;
                            $icon_cat = get_field('white_icon', $ref);
                            ?>

                            <img alt="<?php echo $name ?>" title="<?php echo $name ?>" src="<?php echo $icon_cat ?>">
                            
                        <?php endforeach;

                    ?>
                   
                </div>
            </div>
            
        </div>
    </div>
</div>