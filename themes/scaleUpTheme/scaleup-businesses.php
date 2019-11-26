<?php
/*
Template Name: Find Businesses
*/
?>

<?php get_header(); ?>


<div class="bg-gray_blue">
	<div class="container businesses-finder py-5">

		<div clas="row">

			<div class="col-6">

				<h3 class="mt-3 mb-4">Find a Scaleup business</h3>

				<form id="scaleups_form" method="POST">

					<div class="d-flex flex-column">
						

						<!-- Sectors -->
						<div class="py-1 mb-2 btn-sectors" style="" data-toggle="modal" data-target="#sectorsModal"><p class="m-0">Sectors...</p></div>

						<!-- Add LEPs dynamically  -->
						<select class="lepSelect mb-2" name="lep_code" id="lep_code">
							<option value="-">LEP</option> 
						</select>

						<!-- Turnover -->
						<select name="turnover" id="turnover" class="mb-2">
							<option value="-">Turnover</option>
							<option value="1-2">1-2 million</option>
							<option value="2-5">2-5 million</option>
							<option value="5-10">5-10 million</option>
							<option value="10-50">10-50 million</option>
							<option value="50+">50+ million</option>
						</select>

						<!-- Growth -->
						<select name="growth" id="growth" class="mb-2">
							<option value="-">Growth</option>
							<option value="20-30">20-30%</option>
							<option value="30-40">30-40%</option>
							<option value="40-50">40-50%</option>
							<option value="50+">50%+</option>
						</select>

						<!-- Employees -->
						<select name="employees" id="employees" class="mb-2">
							<option value="-">Number of employees</option>
							<option value="10-14">10-14</option>
							<option value="15-24">15-24</option>
							<option value="25-50">25-50</option>
							<option value="51-100">51-100</option>
							<option value="100+">100+</option>
						</select>

						<div><input class="my-2 submit-search" type="submit" name="submit" value="Search now" placeholder="Submit" ></div>

					</div>

				</form>	

			</div> <!-- col-6 -->

		</div> <!-- row -->

	</div>
<div class="bg-gray_blue">


<!-- Modal -->
<div class="modal fade" id="sectorsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">

    	<div class="modal-content">
			

      		<div class="modal-body">
      			<div class="row">
      				<div class="col-9">
      					<h3>Sectors</h3>
						<p style="">Browse the Sectors and their sub categories. Tick the box next to any categories you would like to include in your search.</p>
      				</div>
      				<div class="col-3 pr-0">
      					<button type="button" class="btn close-form float-right" data-dismiss="modal"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-blue.png"></button>
      				</div>
      			</div>
      			
        		<div class="innerModal" style="position: relative;">
        			
        		</div>
      		</div>

      		<div class="modal-footer">
        		<button type="button" class="confirm-sectors" data-dismiss="modal">Confirm</button>
      		</div>

    	</div>
	</div>
</div>


<!-- Move this script later -->
<script src="<?php echo get_bloginfo('template_url'); ?>/businesses-finder/js/leps.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/businesses-finder/js/test-sectors.json"></script>

<script>

$( document ).ready(function() {

	//LEPs
	readLEPs();

	//Sectors
	readSectors();

	$('.confirm-sectors').click(function(){

		sectorcodes = '';
		$('input[name="sector"]').each(function(){
			if($(this).attr('checked')=='checked'){
				sectorcodes += $(this).next().text()+", ";
			}
		});
		sectorcodes = sectorcodes.substring(0, 60) + "...";
		$('.btn-sectors p').text(sectorcodes);
	});
	
	/* Submit search */
	$('#scaleups_form').submit(function(e){

		//Sectors
		sectorcodes = '';
		$('input[name="sector"]').each(function(){
			if($(this).attr('checked')=='checked'){
				//sectorcodes += $(this).data('id')+'-';
				sectorcodes += $(this).val()+'-';
			}
		});

		lepcode = $('#lep_code').val();
		turnover = $('#turnover').val();
		growth = $('#growth').val();
		employees = $('#employees').val();
		
		//var action = jQuery('#scaleups_form').attr('action');
		var action = /scaleup-businesses-results/;

		action += "?lepcode=" + lepcode;
		action += "&sector=" + sectorcodes;
		action += "&turnover=" + turnover;
		action += "&growth=" + growth; 
		action += "&employees=" + employees; 

		$('#scaleups_form').attr('action', action);
	});
	

});

function readLEPs(){

	//Get leps from JSON
	var leps = getLEPs();
	var lepCodes = [];
	var allLeps = [];
	for(var i=0; i<leps.length;i++){
		if(lepCodes.indexOf(leps[i].code)<0){
			lepCodes.push(leps[i].code);
			allLeps.push({
				code: leps[i].code,
				name: leps[i].name
			});
		}
	}

	//Sort alphabetically
	allLeps.sort(function(a,b){
		var textA = a.name.toUpperCase();
		var textB = b.name.toUpperCase();
		return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
	});

	//Append to dropdown
	for(var i=0; i<allLeps.length; i++){
		var option = $('<option value="'+allLeps[i].code+'">'+allLeps[i].name+'</option>');
		$('.lepSelect').append($(option));
	} 
}

//Read sectors
function readSectors(){
	readTextFile("<?php echo get_bloginfo('template_url'); ?>/businesses-finder/js/test-sectors.json", function(text){
	    var data_sectors = JSON.parse(text);
	    createSectorList(data_sectors);	
	});
}

// Read JSON file
function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}


function createSectorList(data_sectors){

	//Create HTML elements
	var list = getChildren(data_sectors);	
	var listContainer = jQuery('<div class="listContainer"></div>');
	jQuery(listContainer).append(list);

	jQuery('.modal-body .innerModal').append(listContainer);

	/* Events */
			
	//Check groups		
	jQuery('.sectorItem input[type="checkbox"]').click(function(e){
		if(jQuery(this).attr('checked')!='checked'){
			jQuery(this).parent().find('input[type="checkbox"]').attr('checked', 'checked');
			jQuery(this).parent().find('input[type="checkbox"]').prop('checked',true);
		}else {
			jQuery(this).parent().find('input[type="checkbox"]').removeAttr('checked');	
			jQuery(this).parent().find('input[type="checkbox"]').prop('checked',false);
		}
	});

	//Close and open
	$( ".collapsable" ).click(function() {
		collapse_div = $(this).next();
		if (collapse_div.hasClass("show")) {
			collapse_div.collapse('hide');
			$(this).removeClass("down");
		}
		else {
			collapse_div.collapse('show');
			$(this).addClass("down");
		}			
	});

	//Show first level
	$('.sectorList').eq(0).addClass('show');

}

//Create all sector children
function getChildren(sector){

	var list = jQuery('<div></div>').addClass('sectorList collapse');

	for(var i=0; i<sector.length;i++){
		var item = jQuery('<div></div>').addClass('sectorItem');
		var checkedAttr = ''; 
		var checkbox = jQuery('<input type="checkbox" value="'+jQuery.trim(sector[i].code)+'" data-id="'+jQuery.trim(sector[i].id)+'" name="sector" class="filterCheck" '+checkedAttr+' />');
		var title = jQuery('<span class="collapsable">'+sector[i].title+'</span>');
		jQuery(item).attr('code', jQuery.trim(sector[i].code)).append(checkbox).append(title);
			
		if(sector[i].children && sector[i].children.length>0){
			var childlist = getChildren(sector[i].children);
			jQuery(item).append(childlist);
		}else {
				jQuery(item).addClass('child');
		}
		jQuery(list).append(item);
	}
	return list;
}


</script>


<?php get_footer(); ?>