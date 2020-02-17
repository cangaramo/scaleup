<?php 
$terms = get_terms( array(
    'taxonomy' => 'companies_area',
    'hide_empty' => false,
) );
?>

<div class="bg-gray visible-scaleups">
    <div class="container">

        <div> 
            <select id="dropdown-lep">
                <option value="-1">Filter</option> 
                    <?php foreach ($terms as $term): ?>
                        <option value="<?php echo $term->term_id ?>"><?php echo $term->name ?></option> 
                    <?php endforeach ?>
            </select>
        </div>

        <div id="visible_scaleups_response">
        </div>

    </div>
</div>