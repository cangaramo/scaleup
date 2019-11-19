var map;
var geocoder;
var markers = [];

var array_region = [];
var array_business = [];
var array_support = [];
var array_aims = [];
var array_cost = [];
var array_types = [];
var array_providers = [];

var one_to_watch = 0;
var endorsed = 0;

var home_url;

var posts_per_page = 8;

var scrollingChapters = 0;

var current_page = 1;
var posts_per_page = 10;

$( document ).ready(function() {

    //Get home url

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;


    //Slick
    $('.multiple-items').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
              }
            },
            {
                breakpoint: 650,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
            }
        ]
    });

    // Count up
    /*
    $('.counter').counterUp({
        delay: 10,
        time: 1000,
    });*/

    $("#submit-form").click(function(){
        SearchMarkers();
    });

    $('input').on('keypress', function(e) {
        var code = e.keyCode || e.which;
        if(code==13){
            SearchMarkers();
        }
    });

    $('body').on('mouseenter', '.card', function (){

        protocol = window.location.protocol
        host = window.location.host;
        home_url = protocol + "//" + host;
        
        $(this).css("background-color", "#fdd38d");
        index = $(this).attr("id");
        var image = home_url + "/wp-content/themes/scaleUpTheme/assets/images/marker_hover.png";
        markers[index].setIcon(image);        
        
    });

    $('body').on('mouseleave', '.card', function (){

        protocol = window.location.protocol
        host = window.location.host;
        home_url = protocol + "//" + host;

        $(this).css("background-color", "white");
        var image = home_url + "/wp-content/themes/scaleUpTheme/assets/images/marker.png";
        markers[index].setIcon(image);        
    });

    $(".custom-link").mouseenter(function() {
        if ( !($(this).hasClass("active")) ){
            $(this).find(".line").removeClass("leaveLink");
            $(this).find(".line").addClass("overLink");
        }
    });

    $(".custom-link").mouseleave(function() {
        if ( !($(this).hasClass("active")) ){
            $(this).find(".line").removeClass("overLink");
            $(this).find(".line").addClass("leaveLink");
        }
    });

    //If slider exists
    var pos = 1;
    if ($('.slider').length > 0) {
        const interval = setInterval(function() {
            size = $('.text-slide').length;
            last = size - 1;

            $('.text-slide').hide();
            $('.text-slide').eq(pos).fadeIn("slow");

            pos = pos + 1;
            
            if (pos == size) {
                pos = 0;
            }
        }, 10000);
         
    }


    //Search button
    $('body').on('click', '.ambassadors-list .submit-search', function (){
        lep = $("#dropdown-lep :selected").val();
        sector = $("#dropdown-sector :selected").val();

        LoadAmbassadors(lep, sector);
    });

    //Search button
    $('body').on('click', '.programmes-list .submit-search', function (){

        //Emtpy arrays
        array_region = [];
        array_business = [];
        array_support = [];
        array_aims = [];
        array_cost = [];
        array_types = [];
        array_providers = [];

        //Reset filters form
        $('.tick input:checkbox').prop('checked', false); 

        region = $("#dropdown-region :selected").val();
        type_business = $("#dropdown-type-business :selected").val();
        type_support = $("#dropdown-type-support :selected").val();

        if (region != "") {
            array_region.push(region);
        }

        if (type_business != "") {
            array_business.push(type_business);
        }

        if (type_support != "") {
            array_support.push(type_support);
        }

        current_page = 1;
        
        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);

        //Mark checkbox as checked 
        checkbox_region = "#checkbox-" + region;
        checkbox_business = "#checkbox-" + type_business;
        checkbox_support = "#checkbox-" + type_support;
        $(checkbox_region).prop('checked', true); 
        $(checkbox_business).prop('checked', true); 
        $(checkbox_support).prop('checked', true); 
    });


    //Search button
    $('body').on('click', '.one-to-watch', function (){
       
        if (one_to_watch == 0) {
            one_to_watch = 1;
            $(this).find(".checkbox .fas").css("display", "block");
        }
        else {
            one_to_watch = 0;
            $(this).find(".checkbox .fas").css("display", "none");
        }

        current_page = 1;

        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);
    });

    $('body').on('click', '.endorsed', function (){
        $(this).find(".checkbox .fas").toggle();

        if (endorsed == 0) {
            endorsed = 1;
            console.log("show");
            $(this).find(".checkbox .fas").css("display", "block");
        }
        else {
            endorsed = 0;
            console.log("hide");
            $(this).find(".checkbox .fas").css("display", "none");
        }

        current_page = 1;

        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);
    });

    
    $('body').on('click', '.more-filters', function (){
        $(".filters-window").fadeIn("slow");
        $(".close-filters").show();
    });

    $('body').on('click', '.close-filters', function (){
        $(".close-filters").hide();
        $(".filters-window").fadeOut("slow");
    });

    $('body').on('click', '.clear-btn', function(){
        $('input:checkbox').removeAttr('checked');

        //Emtpy arrays
        array_region = [];
        array_business = [];
        array_support = [];
        array_aims = [];
        array_cost = [];
        array_types = [];
        array_providers = [];

        current_page = 1;
        posts_per_page = 10;

        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);

        //Close window and scroll to top
        section = ".all-programmes";
        $('html, body').animate({
            scrollTop: $(section).offset().top},
            500,
            function(){
                $(".close-filters").hide();
                $(".filters-window").fadeOut(600);
            }    
        );  
        
        //Reset search form
        $("#dropdown-region").val("");
        $("#dropdown-type-business").val("");
        $("#dropdown-type-support").val("");

        return false;

    });

    $('body').on('click', '.filter-btn', function(){

        //Get values and filter
        array_region = $('input[name=checkbox-region]:checked').map(function() {
            return $(this).val();
        }).get();

        array_business = $('input[name=checkbox-business]:checked').map(function() {
            return $(this).val();
        }).get();

        array_support = $('input[name=checkbox-support]:checked').map(function() {
            return $(this).val();
        }).get();

        array_aims = $('input[name=checkbox-aim]:checked').map(function() {
            return $(this).val();
        }).get();

        array_cost = $('input[name=checkbox-cost]:checked').map(function() {
            return $(this).val();
        }).get();

        array_types = $('input[name=checkbox-type]:checked').map(function() {
            return $(this).val();
        }).get();

        array_providers = $('input[name=checkbox-provider]:checked').map(function() {
            return $(this).val();
        }).get();

        current_page = 1;
        posts_per_page = -1;

        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);

        //Close window and scroll to top
        section = ".all-programmes";
        $('html, body').animate({
            scrollTop: $(section).offset().top},
            500,
            function(){
                $(".close-filters").hide();
                $(".filters-window").fadeOut(600);
            }    
        );  
        
        //Reset search form
        $("#dropdown-region").val("");
        $("#dropdown-type-business").val("");
        $("#dropdown-type-support").val("");

        return false;

    });


    /* Pagination */

    $('body').on('click', '.next-btn', function(){
        current_page = parseInt(current_page) + 1;
        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);
	});

	$('body').on('click', '.prev-btn', function(){
		current_page = parseInt(current_page) - 1;
        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);
	});

    
	$('body').on('click', '.changePage', function(){
		new_page = $(this).val();
		current_page = new_page;
        LoadProgrammes("", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);
	}); 


    /* Stories */
    $('body').on('click', '.all-stories', function (){
        num_posts = parseInt(posts_per_page);
        posts_per_page = num_posts + 8;
        LoadStories(posts_per_page);
    });


    /* Chapters */

    /* Chapter menu */
    $('body').on('click', '.static-menu .chapter .header', function (){

        //1

        index = $(this).index('.static-menu .chapter .header');
        parent = ".static-menu";
        
        //Hide or show current
        img =  $(parent + ' .chapter .header img').eq(index);

        if (img.hasClass("arrow-down")){
            //Hide the rest
            $(parent + ' .chapter .content').not(':eq(' + index + ')').collapse("hide");
            $(parent + ' .chapter .header img').removeClass("arrow-up");
            $(parent + ' .chapter .header img').addClass("arrow-down");

            img.removeClass("arrow-down");
            img.addClass("arrow-up");
            $(parent + ' .chapter .content').eq(index).collapse("show");
        }
        
        else if (img.hasClass("arrow-up")) {
            img.removeClass("arrow-up");
            img.addClass("arrow-down");
            $(parent + ' .chapter .content').eq(index).collapse("hide");
        }


        //2

        parent = ".fixed-menu";
        
        //Hide or show current
        img =  $(parent + ' .chapter .header img').eq(index);

        if (img.hasClass("arrow-down")){
            //Hide the rest
            $(parent + ' .chapter .content').not(':eq(' + index + ')').collapse("hide");
            $(parent + ' .chapter .header img').removeClass("arrow-up");
            $(parent + ' .chapter .header img').addClass("arrow-down");

            img.removeClass("arrow-down");
            img.addClass("arrow-up");
            $(parent + ' .chapter .content').eq(index).collapse("show");
        }
        
        else if (img.hasClass("arrow-up")) {
            img.removeClass("arrow-up");
            img.addClass("arrow-down");
            $(parent + ' .chapter .content').eq(index).collapse("hide");
        }
    }); 

    $('body').on('click', '.fixed-menu .chapter .header', function (){

        //2

        index = $(this).index('.fixed-menu .chapter .header');
        parent = ".fixed-menu";
        
        //Hide or show current
        img =  $(parent + ' .chapter .header img').eq(index);

        if (img.hasClass("arrow-down")){
            //Hide the rest
            $(parent + ' .chapter .content').not(':eq(' + index + ')').collapse("hide");
            $(parent + ' .chapter .header img').removeClass("arrow-up");
            $(parent + ' .chapter .header img').addClass("arrow-down");

            img.removeClass("arrow-down");
            img.addClass("arrow-up");
            $(parent + ' .chapter .content').eq(index).collapse("show");
        }
        
        else if (img.hasClass("arrow-up")) {
            img.removeClass("arrow-up");
            img.addClass("arrow-down");
            $(parent + ' .chapter .content').eq(index).collapse("hide");
        }

        //1

        parent = ".static-menu";
        
        //Hide or show current
        img =  $(parent + ' .chapter .header img').eq(index);

        if (img.hasClass("arrow-down")){
            //Hide the rest
            $(parent + ' .chapter .content').not(':eq(' + index + ')').collapse("hide");
            $(parent + ' .chapter .header img').removeClass("arrow-up");
            $(parent + ' .chapter .header img').addClass("arrow-down");

            img.removeClass("arrow-down");
            img.addClass("arrow-up");
            $(parent + ' .chapter .content').eq(index).collapse("show");
        }
        
        else if (img.hasClass("arrow-up")) {
            img.removeClass("arrow-up");
            img.addClass("arrow-down");
            $(parent + ' .chapter .content').eq(index).collapse("hide");
        }

    });  


    
    /* Load chapter from menu */
    $('body').on('click', '.load-chapter', function (){
        chapter = $(this).data("article");
        LoadChapter(chapter, "fullmenu");
    });

    $('body').on('click', '.goto-chapter', function (){
        chapter = $(this).data("article");
        LoadChapter(chapter, "fullmenu");
    });

    $('body').on('click', '.short-menu .chapter', function (){
        first_chapter = $(this).data("chapter");
        LoadChapter(first_chapter, "shortmenu");
    });


    /* Content collection */
    $('body').on('click', '.open-content', function (){
        //alert ("click");
        index = $('.open-content').index(this);
        $('.content-piece').hide();
        $('.content-piece').eq(index).slideDown("slow");

        $('html, body').animate({
            scrollTop: ( ($('.content-piece').eq(index).offset().top) - 50 )
        },1100); 
    });


    $('body').on('click', '.close-content', function (){
        $('.content-box').fadeIn();
        $('.content-piece').slideUp("slow");
    });


    /* Local area summaries */
    $('body').on('click', '.area', function (){
        $('#response-area').show();
        $('.list-areas-section').hide();
        area_id = $(this).data("area");
        LoadArea(area_id);
        
    });

    $('body').on('click', '.close-area', function (){
        $('#response-area').empty();
        $('#response-area').hide();
        $('.list-areas-section').show();
    });


    $('.open-vacancy button').click(function(){
        index = $(this).index(".open-vacancy button");
        current_vacancy = $(".vacancy-info").eq(index);
        button_span = $(".open-vacancy button span").eq(index);
        if ( current_vacancy.hasClass('show')){
            button_span.text("View");
            current_vacancy.collapse("toggle");
        }
        else {
            button_span.text("Close");
            current_vacancy.collapse("toggle");
        }
    });


    /* Open sidebar */
    var close = false;
    $( "#open-btn" ).click(function() {

        //Close
        if (close) {           
            $("#sidebar .sidebar-nav").fadeOut("fast", function() {
                $("#sidebar").animate({width:'toggle'},350);
            });

            $(this).addClass("close-anim");
            close = false;
        }
        //Open
        else {
            $("#sidebar").animate(
                {
                width: "toggle",
                }, 
                {
                duration: 350,
                complete: function() {
                    $("#sidebar .sidebar-nav").fadeIn();
                    }
                }
            );
            $(this).removeClass("close-anim");
            close = true;
        }
    }); 

    /* Open search */
    $( ".open-search" ).click(function() {
        $(".search-box").slideDown( "slow", function() {
            $(".search-content").fadeIn("fast");
            $("#query-search").focus();
        }); 
    });

    $( ".close-search" ).click(function() {
        $(".search-content").fadeOut( "fast", function() {
            $(".search-box").slideUp("slow");
        });
    });

    /* Search */
    $( "#query-search" ).on('change keydown paste input', function(){
        s = $(this).val();
        //LoadPosts(s);
        LoadSearchResults(s);
    });

    $('.chapters-list').on('scroll', function(){
        index = $(this).index('.chapters-list');
        var scrollTop = $('.chapters-list').eq(index).scrollTop();
        scrollingChapters = scrollTop;        
    });


    /* Slider item */

    /* Open search */
    $( ".slider-banner .show-item" ).click(function() {
        index = $(this).index('.slider-banner .show-item');
        $('.slider-banner .item').not(':eq(' + index + ')').hide();
        $('.slider-banner .item').eq(index).show();
    });

});


$(window).on('load', function(){

    if ($('.programmes-list').length > 0) {
        LoadProgrammes("onload", array_region, array_business, array_support, array_aims, array_cost, array_types, array_providers, one_to_watch, endorsed);
    }

    if ($('.list-stories').length > 0) {
        LoadStories(posts_per_page);
    }

    if ($('.scaleup-review').length > 0) {

        var fragment = (window.location.hash).substring(1);
        if (fragment == "") {
            console.log ("first");
            chapter = "first";
            LoadChapter(chapter, "onload");
        }
    }

    if ($('.ambassadors-list').length > 0) {
        LoadAmbassadors();
    }
    
});

$hidden = false;
var lastScrollTop = 0;


$(window).scroll(function() {

    //Swap menus
    if (window.innerWidth > 992) { 

        //If starts scrolling toggle menu
        /*
        if ($(window).scrollTop() >= 10) {
            //Close menu
            $('.chapter .content').collapse("hide");
            $('.chapter .header img').removeClass("arrow-up");
            $('.chapter .header img').addClass("arrow-down");
        } */

        if ($('.scaleup-review').length > 0) {

            var scrollTop = $(window).scrollTop();
            elemTop = $('.menu').offset().top;
            elemBottom = elemTop + $('.menu').height();
    
            var st = $(this).scrollTop();
    
            //Down
            if (st > lastScrollTop){
                if ( !$hidden && scrollTop > elemTop ) { 
                $('.fixed-menu').show();
                $('.static-menu').hide();
                $hidden = true;
                }
            } 
            //Up
            else {
                if ($hidden && elemBottom > (scrollTop - 102)) {    
                    $('.fixed-menu').hide();
                    $('.static-menu').show();
                    $hidden = false; 
                } 
            }
            lastScrollTop = st;
    
            //After swapping, scroll menu to position of the other menu, so it looks like one menu
            $('.chapters-list').scrollTop(scrollingChapters);
        }
        
    }


}); 


/* Load chaper with hash */

if (window.location.hash) {
    url = window.location.href;
    if ( url.includes("scaleup-review") ) {

        protocol = window.location.protocol
        host = window.location.host;
        home_url = protocol + "//" + host;

        var host = window.location.host;
        home_url = "https://" + host;

        var fragment = (window.location.hash).substring(1);
        chapter = fragment;
        LoadChapter(chapter, "fullmenu");
    }
}

/* Load programmes */

/*
1 - Region (Geography)
2 - Business (sector)
3 - Support 
4 - Aims of the programme
5 - Cost
6 - Type of programme

*/
function LoadProgrammes(event, regions, types_business, types_support, aims, costs, types, providers, one_to_watch, endorsed){

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;

    ajax_url = home_url + "/wp-admin/admin-ajax.php";

    $.ajax({
        url: ajax_url,
        type: 'post',
        data : {
            action: "load_programmes",
            current_page: current_page,
            posts_per_page, posts_per_page,
            region: regions,
            type_business: types_business,
            type_support: types_support,
            aims: aims,
            costs: costs,
            types: types,
            providers: providers,
            one_to_watch: one_to_watch,
            endorsed:endorsed
        },
        beforeSend:function(xhr){

        },
        success:function(response){

            if (event == 'onload') {
                $("#response-programmes").html(response);
            }
            else {
                $("#response-programmes").html(response);
                $("html, body").scrollTop( ($("#response-programmes").offset().top) - 100);
            }

            /*
            $("html, body").animate({ 
                scrollTop: $('#response-programmes').offset().top 
            }, "slow"); */
        }
    });

    return false;
}

//Onload: if it's called when the review is loaded first time
//Shortmenu: if it's called from short menu
function LoadChapter(chapter, event){

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;
    
    ajax_url = home_url + "/wp-admin/admin-ajax.php";


    $.ajax({
        url: ajax_url,
        type: 'post',
        data : {
            action: "load_chapter",
            chapter: chapter
        },
        beforeSend:function(xhr){

        },
        success:function(response){

        
            //Always scroll to bottom from short menu
            if (event == 'shortmenu') {
                $("#response-chapter").html(response);
                //$(window).scrollTop($("#response-chapter").offset().top);

                $("html, body").animate({ 
                    scrollTop: $('#response-chapter').offset().top 
                }, "slow");

            }
            //Never scroll (on load)
            else if (event == 'onload') {
                $("#response-chapter").html(response);
            } 
            //Only scroll if the div has a big size
            else {
                if ( $("#response-chapter").height() > 500) {
                    moveTop = true;
                }
                else {
                    moveTop = false;
                }

                $("#response-chapter").html(response);

                if ( moveTop) {
                    $(window).scrollTop($("#response-chapter").offset().top);
                }
            }
            
        }
    });

    return false;
}

function LoadStories(posts_per_page){

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;

    ajax_url = home_url + "/wp-admin/admin-ajax.php";

    $.ajax({
        url: ajax_url,
        type: 'post',
        data : {
            action: "load_stories",
            posts_per_page: posts_per_page
        },
        beforeSend:function(xhr){

        },
        success:function(response){
            $("#response-stories").html(response);
        }
    });

    return false;

}

function LoadArea(area_id){

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;

    ajax_url = home_url + "/wp-admin/admin-ajax.php";

    $.ajax({
        url: ajax_url,
        type: 'post',
        data : {
            action: "load_area",
            area: area_id
        },
        beforeSend:function(xhr){

        },
        success:function(response){
            $("html, body").scrollTop( ($("#response-area").offset().top) - 20);
            $("#response-area").hide().html(response).fadeIn(200);
            //$("#response-area").html(response);
        }
    });

    return false;
}

function LoadSearchResults(keyword){

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;

    ajax_url = home_url + "/wp-admin/admin-ajax.php";

    $.ajax({
        url: ajax_url,
        type: 'post',
        data : {
            action: "load_search",
            keyword: keyword
        },
        beforeSend:function(xhr){

        },
        success:function(response){
            $("#search-results").html(response);
        }
    });

    return false;
}

function LoadAmbassadors(lep, sector) {

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;

    ajax_url = home_url + "/wp-admin/admin-ajax.php";

    $.ajax({
        url: ajax_url,
        type: 'post',
        data : {
            action: "load_ambassadors",
            lep: lep,
            sector: sector
        },
        beforeSend:function(xhr){

        },
        success:function(response){
            $("#response-ambassadors").html(response);
        }
    });

    return false;
}

//Init map without markers
function initMap() {

    var myLatLng = {lat: 54.4071355, lng:-1.7539647};

    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng, 
        zoom: 6,
        zoomControl: true,
        streetViewControl: false,
        mapTypeControl: false,
        styles: [
            {
                "featureType": "administrative",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": "-100"
                    }
                ]
            },
            {
                "featureType": "administrative.province",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": 65
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": "50"
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": "-100"
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
                "elementType": "all",
                "stylers": [
                    {
                        "lightness": "30"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "all",
                "stylers": [
                    {
                        "lightness": "40"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#d2d2d2"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels",
                "stylers": [
                    {
                        "lightness": -25
                    },
                    {
                        "saturation": -100
                    }
                ]
            }
        ]

        
    }); 

    geocoder = new google.maps.Geocoder;
}

function SearchMarkers(){

    var ajaxurl = $("#search_markers").data("url");

    var address = $("#input_address").val();
    var bussiness = $("#input_business option:selected").text();

    $.ajax({
        url: ajaxurl,
        type : 'post',
        data : {
            action : 'load_posts',
            speciality: bussiness,
        },
        beforeSend:function(xhr){

        },
        success:function(response){

            //Hide list until results are ready to show
            $("#map-container").html(response);
            $("#map-container").css("visibility", "hidden");

            show_results(address);
        }
    });
    return false;

}

function show_results(address){

    //Clear and empty markers
    setMapOnAll(null);
    markers = [];

    //Add markers and find address
    add_markers();
    find_addres(address);
}

//Clear markers
function setMapOnAll() {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
}

function add_markers(){

    protocol = window.location.protocol
    host = window.location.host;
    home_url = protocol + "//" + host;

    array_lat = $('#loop-location').data("lat");
    array_lng = $('#loop-location').data("lng");
    array_description = $('#loop-location').data("description");

    var image = home_url + "/wp-content/themes/scaleUpTheme/assets/images/marker.png";

    for (var i = 0; i < array_lat.length; i++) {

        var lat = array_lat[i];
        var lng = array_lng[i];
        var pos = new google.maps.LatLng(lat, lng);
        var description = array_description[i];
    
        markers[i] = new google.maps.Marker({
            position: pos,
            map: map,
            description: description,
            id: i,
            icon: image,
            animation: google.maps.Animation.DROP
        });
    }

  // var markerCluster = new MarkerClusterer(map, markers,
   // {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    
}

function find_addres(address) {
    
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == 'OK') {
          
            var location = results[0].geometry.location;

            map.setCenter();
            var marker = new google.maps.Marker({
                map: map,
                icon: 'http://localhost:8019/wp-content/themes/scaleUpTheme/assets/images/location.png',
                position: location
            });

            var lat = location.lat();
            var lng = location.lng();
            calculate_distances(lat,lng);
        } 

        else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function calculate_distances( lat, lng ) {

    var pi = Math.PI;
    var R = 6371; //equatorial radius
    var distances = [];
    var closest = -1;

    lat1 = lat;
    lon1 = lng;

    //Calculate distances
    for( i=0;i<markers.length; i++ ) {  
        var lat2 = markers[i].position.lat();
        var lon2 = markers[i].position.lng();

        var chLat = lat2-lat1;
        var chLon = lon2-lon1;

        var dLat = chLat*(pi/180);
        var dLon = chLon*(pi/180);

        var rLat1 = lat1*(pi/180);
        var rLat2 = lat2*(pi/180);

        var a = Math.sin(dLat/2) * Math.sin(dLat/2) + 
                    Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(rLat1) * Math.cos(rLat2); 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c;

        distances[i] = d;
        if ( closest == -1 || d < distances[closest] ) {
            closest = i;
        }

    }

    //Order distances
    distances_sorted = Array.from(distances)
    distances_sorted.sort(function(a, b){return a-b});

    var markers_sorted = new Array();

    for (i = 0; i < distances_sorted.length; i++) {

        dist_sort = distances_sorted[i];

        for (j = 0; j < distances.length; j++) {
                
            dist = distances[j];
           
            if (dist_sort == dist) {
                markers_sorted.push(markers[j])
                $("#cards-list .card").eq(j).attr("id", i);
            }

         }
    }

    //Order markers
    markers  = markers_sorted;

    //Order results list
    sort_results();
}


function sort_results(){

    $("#cards-list .card").sort(function(a, b) {
        return parseInt(a.id) - parseInt(b.id);
      }).each(function() {
        var elem = $(this);
        elem.remove();
        $(elem).appendTo("#cards-list");
    });

    $("#map-container").css("visibility", "visible");
      
}


function redirectTo(url, tab) {

    if (tab) {
        window.open(url, '_blank');
    }
    else {
        window.location.href = url;
    }
   

}