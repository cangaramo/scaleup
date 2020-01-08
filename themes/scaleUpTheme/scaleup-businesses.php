<?php
/*
Template Name: Find Businesses
*/
?>

<?php get_header(); ?>


<div class="bg-gray_blue position-relative">

	<div id="map" style="height:750px"></div> 

	<div class="pos-key">
		<div class="px-3 py-2 d-flex flex-column key">
			<div><img src="<?php echo get_bloginfo('template_url')?>/assets/images/cluster_images/m1.png"><p>1-10</p></div>
			<div><img src="<?php echo get_bloginfo('template_url')?>/assets/images/cluster_images/m2.png"><p>10-100</p></div>
			<div><img src="<?php echo get_bloginfo('template_url')?>/assets/images/cluster_images/m3.png"><p>100-1000</p></div>
			<div><img src="<?php echo get_bloginfo('template_url')?>/assets/images/cluster_images/m4.png"><p>1000+</p></div>
		</div>
	</div>

	<div class="pos-form">
		
		<div class="businesses-finder" >

			<div class="pt-5">

				<h3 class="mt-3 mb-4">Find a Scaleup business</h3>

				<form id="scaleups_form" method="POST">

					<div class="d-flex flex-column">

						<!-- Sectors -->
						<div class="py-1 mb-2 btn-sectors" style="" data-toggle="modal" data-target="#sectorsModal"><p class="m-0">Sectors...</p></div>

						<!-- Add LEPs dynamically  -->
						<select class="lepSelect mb-2 filter" name="lep_code" id="lep_code">
							<option value="-">LEP</option> 
						</select>

						<!-- Turnover -->
						<select name="turnover" id="turnover" class="mb-2 filter">
							<option value="-">Turnover</option>
							<option value="1-2">1-2 million</option>
							<option value="2-5">2-5 million</option>
							<option value="5-10">5-10 million</option>
							<option value="10-50">10-50 million</option>
							<option value="50+">50+ million</option>
						</select>

						<!-- Growth -->
						<select name="growth" id="growth" class="mb-2 filter">
							<option value="-">Growth</option>
							<option value="20-30">20-30%</option>
							<option value="30-40">30-40%</option>
							<option value="40-50">40-50%</option>
							<option value="50+">50%+</option>
						</select>

						<!-- Employees -->
						<select name="employees" id="employees" class="mb-2 filter">
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

			</div> <!-- row -->

		</div>

	</div>

</div>


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

	//Update filters
	updateFilters();

	$('.confirm-sectors').click(function(){

		sectorcodes = '';
		$('input[name="sector"]').each(function(){
			if($(this).attr('checked')=='checked'){
				sectorcodes += $(this).next().text()+", ";
			}
		});
		//Add sectors to input (only 60 characters)
		sectorcodes = sectorcodes.substring(0, 60) + "...";
		$('.btn-sectors p').text(sectorcodes);

		console.log("confirm sectors");
		updateFilters();
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


	$('.filter').on('change', function() {
		updateFilters();
	});
		
});

function updateFilters(){
	//Sectors
	sectorcodes = '';
	$('input[name="sector"]').each(function(){
		if($(this).attr('checked')=='checked'){
			sectorcodes += $(this).val()+'-';
		}
	});

	lepcode = $('#lep_code').val();
	turnover = $('#turnover').val();
	growth = $('#growth').val();
	employees = $('#employees').val();

	filterAndSearch(lepcode, sectorcodes, turnover, growth, employees);
}

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

		//Check
		if(jQuery(this).attr('checked')!='checked'){
			jQuery(this).parent().find('input[type="checkbox"]').attr('checked', 'checked');
			jQuery(this).parent().find('input[type="checkbox"]').prop('checked',true);
		}
		//Uncheck 
		else {
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


/* Search companies */

function filterAndSearch(lepcode, sectorcodes, turnover, growth, employees){
	
	//Sector codes
    sectorlist = sectorcodes; 
    sector_codes = sectorlist.split("-"); 
    sector_codes = sector_codes.filter(e => e !== ""); //remove blank space

    //Turnover
    turnover = turnover;
    turnover_nums = turnover.split("-"); 
    million = Math.pow(10, 6);
    min_turnover = turnover_nums[0] * million;
    max_turnover = turnover_nums[1] * million;

    //Employees
    employees = employees;
    employees_nums = employees.split("-"); 
    min_employees = employees_nums[0];
    max_employees = employees_nums[1];

    //Turnover delta (growth)
    growth = growth;
    growth_nums = growth.split("-"); 
    min_growth = growth_nums[0];
    max_growth = growth_nums[1];

    //LEP code
    lep_code = lepcode;

    searchCompanies(sector_codes, lep_code, min_turnover, max_turnover, min_employees, max_employees, min_growth, max_growth);
}

var map;
var markers = [];
var markerCluster;

function searchCompanies(sector_codes, lep_code, min_turnover, max_turnover, min_employees, max_employees, min_growth, max_growth){

	$.ajax({
		url: "https://www.scaleupinstitute.org.uk/getLocations.php",
		data : {
			offset: 0,
			min_turnover: min_turnover,
			max_turnover: max_turnover,
			min_employees: min_employees,
			max_employees: max_employees,
			min_growth: min_growth,
			max_growth: max_growth,
		},
		beforeSend:function(xhr){
		},
		success:function(response){

			response_companies = JSON.parse(response);

			//Filter by sector
			if (sector_codes.length > 0){
				response_companies = matchSectors(response_companies, sector_codes);
			}

			//Filter by LEP
			if (lep_code != '-') {
				response_companies = matchLep(response_companies);
			}

			//Display if not too many
			if (response_companies.length) {
				addMarkers(response_companies);
			}
		}
	});
}

//Filter by sector
function matchSectors(response_companies, sector_codes){

	companies = response_companies;
	filtered_companies = [];

	for(var i=0; i<companies.length; i++){

		for(var j=0; j<sector_codes.length; j++){
			
			if (sector_codes[j] != "" && sector_codes[j] == companies[i]['sic_2007']){
				filtered_companies.push(companies[i]);
			}
		}
	}

	return filtered_companies;
}

//Filter by LEP
function matchLep(response_companies){

	companies = response_companies;
	filtered_companies = [];

	for(var i=0; i<companies.length; i++){
			
		if (lep_code == companies[i]['lep_code']){
			filtered_companies.push(companies[i]);
		}
	}

	return filtered_companies;
}


/* MAP */
function addMarkers(response_companies){

	//Clear and empty markers and markercluster
	setMapOnAll(null);
	markers = [];

	if (markerCluster) {
		markerCluster.clearMarkers(markerCluster.getMarkers());
	}
	//Add markers
	protocol = window.location.protocol
	host = window.location.host;
	home_url = protocol + "//" + host;
	var image = home_url + "/wp-content/themes/scaleUpTheme/assets/images/marker.png";

	infowindow = new google.maps.InfoWindow();

	for (var i = 0; i < response_companies.length; i++) {
		var lat = response_companies[i]['lat'];
		var lng = response_companies[i]['lng'];
		var pos = new google.maps.LatLng(lat, lng);
		var description = 'description';

		markers[i] = new google.maps.Marker({
			position: pos,
			map: map,
			description: description,
			id: i,
			icon: image,
		});

		markers[i].addListener('click', function() {

			index = this.id;
			company = response_companies[index];
			link = '/company/?id=' + company['company_no'];

			contentString = '<div id="content" class="p-2">'+
			'<h6 class="mb-3">' + company['name'] + '</h6>'+
			'<div id="bodyContent">'+
			'<p>' + company['address1'] + ',</p>' +
			'<p>' + company['address2'] + ',</p>' +
			'<p>' + company['address3'] + '</p>' +
			'<p class="mb-2">' + company['address4'] + '</p>' +
			'<p class="mb-4"><strong>Tel:</strong> ' + company['telephone'] + '</p>' +
			'<a class="btn-blue-small" href="' + link + '">More info</a>' +
			'</div>'+
			'</div>';

			infowindow.setContent(contentString);
			infowindow.open(map, this);
		}); 
	
	}

	mcOptions = {
	styles: [{
			height: 53,
			url: home_url + "/wp-content/themes/scaleUpTheme/assets/images/cluster_images/m1.png",
			width: 53,
            textColor:"white",
		},
		{
			height: 56,
			url: home_url + "/wp-content/themes/scaleUpTheme/assets/images/cluster_images/m2.png",
			width: 56,
			textColor:"white",
		},
		{
			height: 66,
			url: home_url + "/wp-content/themes/scaleUpTheme/assets/images/cluster_images/m3.png",
			width: 66,
			textColor:"white",
		},
		{
			height: 78,
			url: home_url + "/wp-content/themes/scaleUpTheme/assets/images/cluster_images/m4.png",
			width: 78,
			textColor:"white",
		},
		{
			height: 90,
			url: home_url + "/wp-content/themes/scaleUpTheme/assets/images/cluster_images/m5.png",
			width: 90
		}
	]
	}

	markerCluster = new MarkerClusterer(map, markers, mcOptions);
	
}

//Clear markers
function setMapOnAll() {
    for (var i = 0; i < markers.length; i++) {
	  markers[i].setMap(null);
    }
}

function initMap() {

	var uk = {lat: 54.478954, lng:-7.6460152 };
	map = new google.maps.Map(document.getElementById('map'), {
		center: uk,
		zoom: 6, 
		minZoom: 6,
		zoomControl: true,
		streetViewControl: false,
		mapTypeControl: false,
		styles: [
			{
				"featureType": "administrative",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#444444"
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "all",
				"stylers": [
					{
						"color": "#f2f2f2"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "labels.text",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road",
				"elementType": "all",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"lightness": 45
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "all",
				"stylers": [
					{
						"color": "#dee3e8"
					},
					{
						"visibility": "on"
					}
				]
			}
		]
		
	});
}




</script>


<?php get_footer(); ?>