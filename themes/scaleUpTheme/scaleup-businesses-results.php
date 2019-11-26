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
    <div class="container py-5" style="min-height: 500px">

        <div id="businesses-results">

            <h3 class="mt-3 mb-4">Find a Scaleup business</h3>

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
            
            <table>
                <tr>
                    <th class="column"></th>
                    <th class="column">Incorporate Date</th>
                    <th class="column">Company Type</th>
                    <th class="column">Turnover</th>
                    <th class="column">Turnover Growth</th>
                    <th class="column">Employee Count</th>
                </tr>
                
            </table>
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
    sector_codes = sector_codes.filter(e => e !== "");

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
            if (response_companies.length < 200) {
                displayAggregated(response_companies);
                completeTable(response_companies);
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
function completeTable(response_companies){


    //Loop and add rows to table
    companies = response_companies;

    for(var i=0; i<companies.length; i++){
        
        shorten_turnover = "£" + nFormatter(parseInt(companies[i]["turnover"]));

        var row = 
        "<tr>" +
            "<td class='name'>" + companies[i]["name"] + "</td>" +
            "<td class='number'>" + companies[i]["incorporation_date"] + "</td>" +
            "<td>" + companies[i]["type"] + "</td>" +
            "<td >" + shorten_turnover + "</td>" +
            "<td class='number'>" + companies[i]["turnover_delta"] + "%</td>" +
            "<td class='number'>" + companies[i]["employee_count"] + "</td>" +
        "</tr>";

        $("table").append(row);
        $("table").show();
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

</script>