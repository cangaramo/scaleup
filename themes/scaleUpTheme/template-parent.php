<?php
/*
Template Name: Content Components
*/
$fields = get_fields(get_the_ID());

if (empty($fields)) {
	echo '<div class="component-error">ACF: NO FIELDS TO OUTPUT</div>';
	return;
}

$page_components = array();
foreach($fields['components'] as $field){
	if($field_name !== 'components'){
		array_push($page_components, $field['acf_fc_layout']);
	}
}

?>

<?php get_header(); ?>
			
	<main>

		<?php
			foreach($page_components as $index => $component){
				require('parts/util-get-component-values.php');
				require(locate_template( 'parts/component-' . $component . '.php', false, false));
			}	
		?>


	</main> <!-- end #content -->

<?php get_footer(); ?>
