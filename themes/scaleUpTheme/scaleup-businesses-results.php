<?php
/*
Template Name: Businesses results
*/
?>

<?php get_header(); ?>


<?php 
$lepcode = isset($_GET['lepcode']) ? $_GET['lepcode'] : 'null';
$sector_codes = isset($_GET['sector']) ? $_GET['sector'] : 'null';
$turnover = isset($_GET['turnover']) ? $_GET['turnover'] : 'null';
$growth = isset($_GET['growth']) ? $_GET['growth'] : 'null';
$employees = isset($_GET['employees']) ? $_GET['employees'] : 'null';
?>

<div class="bg-gray_blue">
    <div class="container py-5">

        <div id="businesses-results">

            <div class="d-flex justify-content-between mt-2 mb-5">
                <h3>Find a Scaleup business</h3>
                <div><a class="download-data">Download <img src="<?php echo get_bloginfo('template_url')?>/assets/images/download-icon.png"></a></div>
            </div>

            <div class="aggregated-data mb-5">
                <div class="row">
                    <div class="col-3">
                        <p class="total value"></p>
                        <p>ScaleUp businesses found</p>
                    </div>
                    <div class="col-3">
                        <p class="turnover value"></p>
                        <p>Combined turnover</p>
                    </div>
                    <div class="col-3">
                        <p class="growth value"></p>
                        <p>Average turnover growth</p>
                    </div>
                    <div class="col-3">
                        <p class="employees value"></p>
                        <p>Combined number of employees</p>
                    </div>
                </div>
            </div>
            
            <div style="min-height: 600px">
                <table>
                    
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mt-5">
                <a class="prev-page" data-page="1"></a>
                <div id="pagination">
                    <div class="d-flex justify-content-center pages">
                    </div>
                </div>
                <a class="next-page" data-page="1"></a>
            </div>

        </div>


    </div>
</div>

<?php get_footer(); ?>


<script>

var response_companies;
var min_turnover;
var max_turnover;
var min_employees;
var max_employees;
var min_growth;
var max_growth;
var sector_codes;
var lepcode;

$( document ).ready(function() {

    //Sector codes
    sectorlist = <?php echo json_encode($sector_codes) ?>; 
    sector_codes = sectorlist.split("-"); 
    sector_codes = sector_codes.filter(e => e !== ""); //remove blank space

    //Turnover
    turnover = <?php echo json_encode($turnover) ?>;
    turnover_nums = turnover.split("-"); 
    million = Math.pow(10, 6);
    min_turnover = turnover_nums[0] * million;
    max_turnover = turnover_nums[1] * million;

    //Employees
    employees = <?php echo json_encode($employees) ?>;
    employees_nums = employees.split("-"); 
    min_employees = employees_nums[0];
    max_employees = employees_nums[1];

    //Turnover delta (growth)
    growth = <?php echo json_encode($growth) ?>;
    growth_nums = growth.split("-"); 
    min_growth = growth_nums[0];
    max_growth = growth_nums[1];

    //LEP code
    lep_code = <?php echo json_encode($lepcode) ?>;

    searchCompanies();


    $("body").on('click', '.page', function() {

        page = parseInt($(this).text());
        completeTable(response_companies, page);
        $('.next-page').data('page', page);
        $('.prev-page').data('page', page);

        $("html, body").animate({
            scrollTop: $("#businesses-results").offset().top - 30
        }, 0);

        updatePagination(response_companies, page);

    });


    $("body").on('click', '.next-page', function() {
        page = $(this).data('page');
        next_page = parseInt(page + 1);
    
        completeTable(response_companies, next_page);
        $('.next-page').data('page', next_page);
        $('.prev-page').data('page', next_page);

        $("html, body").animate({
            scrollTop: $("#businesses-results").offset().top - 30
        }, 0);

        updatePagination(response_companies, next_page);
    });

    $("body").on('click', '.prev-page', function() {
        page = $(this).data('page');
        prev_page = parseInt(page - 1);
    
        completeTable(response_companies, prev_page);
        $('.next-page').data('page', prev_page);
        $('.prev-page').data('page', prev_page);

        $("html, body").animate({
            scrollTop: $("#businesses-results").offset().top - 30
        }, 0);

        updatePagination(response_companies, prev_page);
    });


    $("body").on('click', '.download-data', function() {

        string_companies = JSON.stringify(response_companies);

        //Remove commas from JSON before converting to CSV
        string_companies = string_companies.replace(/capital,/g,"capital");
        string_companies = string_companies.replace(/,Limited/g,"Limited");
        string_companies = string_companies.replace(/, Limited/g,"Limited");
        string_companies = string_companies.replace(/,Ltd/g,"Ltd");
        string_companies = string_companies.replace(/, Ltd/g,"Ltd");
        string_companies = string_companies.replace(/, Inc/g,"Inc");

        download_companies = JSON.parse(string_companies);

        var csv = JSON2CSV(download_companies);
        csv = "Name,Number,Company type,Incorporation Date,Employee count,SIC 2007,Turnover,Turnover growth,LEP" + '\r\n' + csv;
       
        var downloadLink = document.createElement("a");
        var blob = new Blob(["\ufeff", csv]);
        var url = URL.createObjectURL(blob);
        downloadLink.href = url;
        downloadLink.download = "scaleup-businesses.csv";

        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink); 
    });

    //Redirect to company page
    $("body").on('click', '.name', function() {
        id = $(this).data("id");
        window.location.href = "/company/?id=" + id;
    });

});


function searchCompanies(){

    $.ajax({
        url: "http://scaleup-institute.bladedev.co.uk/getCompanies.php",
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
                response_companies = matchSectors(response_companies);
            }

            //Filter by LEP
            if (lep_code != '-') {
                response_companies = matchLep(response_companies);
            }

            //Display if not too many
            if (response_companies.length) {
                displayAggregated(response_companies);
                completeTable(response_companies, 1);
                updatePagination(response_companies, 1);
            }
        }
    });
}

//Filter by sector
function matchSectors(response_companies){

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

//Calculate aggregated data
function displayAggregated(response_companies){
    total = response_companies.length;
    sumturnover = 0;
    sumgrowth = 0;
    sumemployees = 0;

    companies = response_companies;
    for(var i=0; i<companies.length; i++){
        sumturnover += parseInt(companies[i]['turnover']);
        sumgrowth += parseInt(companies[i]['turnover_delta']);
        sumemployees += parseInt(companies[i]['employee_count']);
    }

    avggrowth = Math.round((sumgrowth/total) * 100)/100;
    percentgrowth = avggrowth + "%";
    shorten_turnover = "£" + shorten_num(sumturnover, 0);
    shorten_employees = shorten_num(sumemployees, 0);

    $('.aggregated-data .total').text(total);
    $('.aggregated-data .turnover').text(shorten_turnover);
    $('.aggregated-data .growth').text(percentgrowth);
    $('.aggregated-data .employees').text(shorten_employees);
}

//Display table
function completeTable(response_companies, current_page){
    companies = response_companies;

    //Get page array
    per_page = 20;
    start = (current_page - 1)* per_page;
    end = current_page * per_page;
    companies = companies.slice(start,end);

    //Loop and add rows to table
    $("table").empty();
    $("table").hide();

    var row = 
        "<tr>" +
            "<th></th>" +
            "<th>Incorporate Date</th>" +
            "<th>Company Type</th>" +
            "<th>Turnover</th>" +
            "<th>Turnover Growth</th>" +
            "<th>Employee Count</th>" +
        "</tr>";

    $("table").append(row);

    for(var i=0; i<companies.length; i++){
        
        shorten_turnover = "£" + nFormatter(parseInt(companies[i]["turnover"]));

        var row = 
        "<tr>" +
            "<td class='name' data-id='" + companies[i]["company_no"] + "'>" + companies[i]["name"] + "</td>" +
            "<td class='number'>" + companies[i]["incorporation_date"] + "</td>" +
            "<td>" + companies[i]["type"] + "</td>" +
            "<td >" + shorten_turnover + "</td>" +
            "<td class='number'>" + companies[i]["turnover_delta"] + "%</td>" +
            "<td class='number'>" + companies[i]["employee_count"] + "</td>" +
        "</tr>";

        $("table").append(row);
        $("table").fadeIn();
    }
}


function updatePagination (response_companies, current_page){

    total = response_companies.length;
    per_page = 20;
    pages = Math.ceil(total/20) + 1;
    last = pages - 1;

    /* Hide or show navigation buttons */
    if (current_page < 2) {
        $('.prev-page').hide();
    }
    else {
        $('.prev-page').show();
    }

    if (current_page >= last){
        $('.next-page').hide();
    }
    else {
        $('.next-page').show();
    }

    //Last pages
    if ( (current_page > (last-2))  && (pages > 4)) {
        start = last - 4;
        end = last + 1;

        if (start < 1){
            start = 1;
        }

        $("#pagination .pages").empty();

        if (pages > 5) {
            first_item = "<a class='page'>" + 1 + "</a>";
            $("#pagination .pages").append(first_item);

            if (pages > 7)
            $("#pagination .pages").append("<span class='dots'>...</span>");
        }

        for(var i=start; i< end; i++){
            var page_item = "<a class='page'>" + i + "</a>";
            $("#pagination .pages").append(page_item);
        }

        //Second to last
        if (current_page == (last-1) ) {
            second_to_last = ($('.page').length) - 2;
            $('.page').removeClass("active");
            $('.page').eq(second_to_last).addClass('active');
        }
        //Last
        else if (current_page == last) {
            $('.page').removeClass("active");
            $('.page').last().addClass('active');
        }
    }
    //Middle pages
    else if ( (current_page > 2) && (pages > 4)) {

        start = current_page - 2;
        end = current_page + 3;

        $("#pagination .pages").empty();

        //if (current_page != 3) {
        if (current_page > 3) {
            first_item = "<a class='page'>" + 1 + "</a>";
            $("#pagination .pages").append(first_item);
            if (current_page > 4) {
                $("#pagination .pages").append("<span class='dots'>...</span>");
            }
        }
        
        for(var i=start; i< end; i++){
            var page_item = "<a class='page'>" + i + "</a>";
            $("#pagination .pages").append(page_item);
        }

        if (current_page < (last-2)) {
            if (current_page < (last-3)){
                $("#pagination .pages").append("<span class='dots'>...</span>");
            }
            last_item = "<a class='page'>" + last + "</a>";
            $("#pagination .pages").append(last_item);
        }

        $('.page').removeClass("active");
        //if (current_page != 3) {
        if (current_page > 3) {
            $('.page').eq(3).addClass('active');
        }
        else {
            $('.page').eq(2).addClass('active');
        }
    }
    //First pages
    else {

        start = 1;
        end = 5;

        if (pages < 7) {
            end = pages;
        }

        $("#pagination .pages").empty();

        for(var i=start; i< end; i++){
            var page_item = "<a class='page'>" + i + "</a>";
            $("#pagination .pages").append(page_item);
        }
        if (pages > 6) {       
            $("#pagination .pages").append("<span class='dots'>...</span>");
            last_item = "<a class='page'>" + last + "</a>";
            $("#pagination .pages").append(last_item);
        }

        //First page
        if (current_page == 1) {
            $('.page').removeClass("active");
            $('.page').eq(0).addClass('active');
        }
        //Second page
        else if (current_page == 2) {
            $('.page').removeClass("active");
            $('.page').eq(1).addClass('active');
        }
        else if (current_page == 3) {
            $('.page').removeClass("active");
            $('.page').eq(2).addClass('active');
        }
    }
    
 
}

function nFormatter(num) {
     if (num >= 1000000000) {
        return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + 'G';
     }
     if (num >= 1000000) {
        return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
     }
     if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
     }
     return num;
}

function shorten_num(num, dec){
	var length = num.toString().length;
	var minus = 0;
	if(num[0]=='-'){
		minus = 1;
		num = num.toString().substr(1);
	}
	var suffix = '';
	if(parseInt(length)<=3){
		suffix = '';
	}else if(parseInt(length)<=6){
			num = num.toString().substr(0, length+(dec-3));
		suffix = 'K';
	}else if(parseInt(length)<=9){
		num = num.toString().substr(0, length+(dec-6));
		suffix = 'M';
	}else if(parseInt(length)>9){
		num = num.toString().substr(0, length+(dec-9));
		suffix = 'Bn';
	}
	var numSplit = 0;
	var numSplit = num.toString().split('');
	if(dec>0){
		numSplit.splice(numSplit.length-dec, 0, '.');
		num = numSplit.toString();
	}
	numArray = num.toString().split('.');
	numArray = [];
	var nonZero = 0;
	if(numArray.length>1){
		for(var i=0; i<numArray[1].length; i++){
			if(numArray[1][i]!='0'){
			    nonZero++;
			}
		}
		if(nonZero==0){
			num = numArray[0];
		}
	}
	if(minus==1){
		return '-'+num+suffix;
	}
	return num+suffix;
}

function JSON2CSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    var line = '';

    if ($("#labels").is(':checked')) {
        var head = array[0];
        if ($("#quote").is(':checked')) {
            for (var index in array[0]) {
                var value = index + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        } else {
            for (var index in array[0]) {
                line += index + ',';
            }
        }

        line = line.slice(0, -1);
        str += line + '\r\n';
    }

    for (var i = 0; i < array.length; i++) {
        var line = '';

        if ($("#quote").is(':checked')) {
            for (var index in array[i]) {
                var value = array[i][index] + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        } else {
            for (var index in array[i]) {
                line += array[i][index] + ',';
            }
        }

        line = line.slice(0, -1);
        str += line + '\r\n';
    }
    return str;
}

</script>