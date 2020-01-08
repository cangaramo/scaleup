<?php
/*
Template Name: Company
*/
?>

<?php get_header(); ?>


<?php 
$id = isset($_GET['id']) ? $_GET['id'] : 'null';
?>

<div class="container py-4 title-nav">
    <div class="d-flex justify-content-between">
        <div>
            <p class="label">Business profile</p>
            <h3 class="name"></h3>
        </div>
        <div>
            <div class="d-flex flex-column">
                <a class="btn-blue" href="/scaleup-businesses"><img src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow-back.png">Back to search</a>
                <a class="btn-orange mt-2 company-website" href="">Company website<img src="<?php echo get_bloginfo('template_url')?>/assets/images/arrow.png"></a>
            </div>
        </div>
    </div>
</div>

<div class="bg-blue py-4 highlights" >
    <h4 class="text-center">Highlights</h4>
    <div class="d-flex justify-content-center content">
        <div class="highlight">
            <p class="turnover num">-</p>
            <p class="desc">Turnover</p>
            <p class="turnover_delta"></p>
        </div>
        <div class="highlight">
            <p class="net num">-</p>
            <p class="desc">Net assets</p>
            <p class="net_delta"></p>
        </div>
        <div class="highlight">
            <p class="return_capital num">-</p>
            <p class="desc">Return on Capital Employed</p>
        </div>
    </div>
</div>

<div class="bg-light_gray">
    <div class="container py-5">

        <div class="row info-company mt-4">

            <div class="col-9">

                <h5 class="mb-4">Details</h5>

                <div class="row mb-4">

                    <div class="col-4">
                        <p class="label mt-2">Registered Address</p>
                        <p class="address1"></p>
                        <p class="address2"></p>
                        <p class="address3"></p>
                        <p class="address4"></p>
                        <p class="label">Website</p>
                        <a class="website"></a>
                        <p class="label">Telephone</p>
                        <p class="telephone"></p>
                    </div>

                    <div class="col-4">
                        <p class="label mt-2">Company number</p>
                        <p class="number"></p>
                        <p class="label">Company type</p>
                        <p class="type"></p>
                        <p class="label">Incorporation date</p>
                        <p class="date"></p>
                        <p class="label">SIC 2003</p>
                        <p class="sic2003"></p>
                    </div>

                    <div class="col-4">
                        <p class="label mt-2">SIC 2007</p>
                        <p class="sic2007"></p>
                        <p class="label">Type of accounts filing</p>
                        <p class="accounts"></p>
                        <p class="label">Latest annual returns</p>
                        <p class="returns"></p>
                        <p class="label">Latest annual accounts</p>
                        <p class="annual_accounts"></p>
                    </div>

                </div>

                <table class="mt-5">
                    <tr>
                        <th class="column">Turnover</th>
                        <th class="column">Employees</th>
                        <th class="column">Gross profit</th>
                        <th class="column">Pre-tax profit</th>
                        <th class="column">Total assets</th>
                        <th class="column">Net assets</th>
                        <th class="column">Exports</th>
                        <th class="column">Year</th>
                    </tr>
                </table>

            </div>
            
            <div class="col-3">
                <h5 class="mb-4">People</h5>
                <div class="people">
                </div>
            </div>
        </div>

    </div>
</div>

<script>

$( document ).ready(function() {

    id = <?php echo json_encode($id) ?>; 
    getCompany(id);
    getPeople(id);
    getAccounts(id);
});


function getCompany(id){

    $.ajax({
        url: "https://www.scaleupinstitute.org.uk/getCompany.php",
        data : {
            id: id
        },
        beforeSend:function(xhr){
        },
        success:function(response){
            company = JSON.parse(response);
            $(".name").text(company[0]['name']);
            $(".telephone").text(company[0]['telephone']);
            $(".address1").text(company[0]['address1']);
            $(".address2").text(company[0]['address2']);
            $(".address3").text(company[0]['address3']);
            $(".address4").text(company[0]['address4']);
            $(".number").text(company[0]['company_no']);
            $(".type").text(company[0]['type']);
            $(".date").text(company[0]['incorporation_date']);
            $(".sic2003").text(company[0]['sic_2003']);
            $(".sic2007").text(company[0]['sic_2007']);
            $(".accounts").text(company[0]['accounts']);
            $(".returns").text(company[0]['latest_returns']);
            $(".annual_accounts").text(company[0]['annual_accounts']);
            $(".turnover").text(company[0]['turnover']);

            website = company[0]['website'];
            website = website.toLowerCase();
            link = "http://" + website;
            $(".website").text(website);
            $(".company-website").attr("href", link);
            $(".website").attr("href", link);

            /* Highlights */
            if (company[0]["turnover"]){
                shorten_turnover = "£" + nFormatter(parseInt(company[0]["turnover"]));
                $(".turnover").text(shorten_turnover);
            }

            if (company[0]["turnover_delta"]){
                shorten_turnover_delta = "£" + nFormatter(parseInt(company[0]["turnover_delta"])) + "%";
                shorten_turnover_delta = "<i class='fas fa-caret-up mr-2'></i>" + shorten_turnover_delta;
                $(".turnover_delta").html(shorten_turnover_delta);
            }
            
            if (company[0]["net_assets"]){
                shorten_net = "£" + nFormatter(parseInt(company[0]["net_assets"]));
                $(".net").text(shorten_net);
            }
            
            if (company[0]["net_assets_delta"]) {
                shorten_net_delta = "£" + nFormatter(parseInt(company[0]["net_assets_delta"])) + "%";
                shorten_net_delta = "<i class='fas fa-caret-up mr-2'></i>" + shorten_net_delta;
                $(".net_delta").text(shorten_net_delta);
            }

            if (company[0]["return_on_capital_employed"]){
                shorten_return_capital = "£" + nFormatter(parseInt(company[0]["return_on_capital_employed"]));
                $(".return_capital").text(shorten_return_capital);
            }

            $('.title-nav').css("opacity", 1);
            $('.highlights h4').css("opacity", 1);
            $('.highlights .highlight').css("opacity", 1);
            $('.info-company').css("opacity", 1);
            
        }
    });
}

function getPeople(id){

    $.ajax({
        url: "https://www.scaleupinstitute.org.uk/getPeople.php",
        data : {
            id: id
        },
        beforeSend:function(xhr){
        },
        success:function(response){
            people = JSON.parse(response);

            for(var i=0; i<people.length; i++){

                /* Name */
                person = "<p class='person_name'>" + people[i]['forename'] + " " + people[i]['surname'] + "</p>";

                /* Dates */
                join_date = people[i]['join_date'];
                leave_date = people[i]['leave_date'];
                d1 = new Date(join_date);
                d2 = new Date(leave_date);

                months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

                day1 = ("0" + d1.getDate()).slice(-2);
                month1 = months[d1.getMonth()];
                date1 =  day1 + " " + month1 + " " + d1.getFullYear() ;

                day2 = ("0" + d2.getDate()).slice(-2);
                month2 = months[d2.getMonth()];
                date2 =  day2 + " " + month2 + " " + d2.getFullYear() ;

                if (d1 == "0000-00-00") {
                    date1 = "";
                }

                if (leave_date == "0000-00-00") {
                    date2 = "";
                }

         
                date = "<p>Director " + date1 + " - " + date2 + "</p>";

                $(".people").append(person);
                $(".people").append(date);
            }
        }
    });
}

function getAccounts(id){

    $.ajax({
        url: "https://www.scaleupinstitute.org.uk/getAccounts.php",
        data : {
            id: id
        },
        beforeSend:function(xhr){
        },
        success:function(response){
            accounts = JSON.parse(response);

            for(var i=0; i<accounts.length; i++){

                date = accounts[i]["date"];
                year = date.substr(0, 4);
                
                shorten_turnover = "-";
                shorten_gross = "-";
                shorten_pretax = "-";
                shorten_assets = "-";
                shorten_net = "-";
                shorten_exports = "-";

                if (accounts[i]["turnover"]){
                    shorten_turnover = "£" + nFormatter(parseInt(accounts[i]["turnover"]));
                }
                if (accounts[i]["gross_profit"]){
                    shorten_gross = "£" + nFormatter(parseInt(accounts[i]["gross_profit"]));
                }
                if (accounts[i]["pre_tax_profit"]){
                    shorten_pretax = "£" + nFormatter(parseInt(accounts[i]["pre_tax_profit"]));
                }
                if (accounts[i]["assets_total"]){
                    shorten_assets = "£" + nFormatter(parseInt(accounts[i]["assets_total"]));
                }
                if (accounts[i]["assets_net"]) {
                    shorten_net = "£" + nFormatter(parseInt(accounts[i]["assets_net"]));
                }
                if (accounts[i]["exports"]) {
                    shorten_exports = "£" + nFormatter(parseInt(accounts[i]["exports"]));
                }

                var row = 
                "<tr>" +
                    "<td>" + shorten_turnover + "</td>" +
                    "<td>" + accounts[i]["employee_count"] + "</td>" +
                    "<td>" + shorten_gross + "</td>" +
                    "<td>" + shorten_pretax + "</td>" +
                    "<td>" + shorten_assets + "</td>" +
                    "<td>" + shorten_net + "</td>" +
                    "<td>" + shorten_exports + "</td>" +
                    "<td>" + year + "</td>" +
                "</tr>";

                $("table").append(row);
                $("table").css("opacity", 1);
            }
        }
    });
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

</script>


<?php get_footer(); ?>