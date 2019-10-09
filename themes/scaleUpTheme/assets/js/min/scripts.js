var map;
var geocoder;
var markers = [];

$( document ).ready(function() {

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
        $(this).css("background-color", "#fdd38d");
        index = $(this).attr("id");
        var image = 'http://localhost:8019/wp-content/themes/scaleUpTheme/assets/images/marker_hover.png'
        markers[index].setIcon(image);        
        
    });

    $('body').on('mouseleave', '.card', function (){
        $(this).css("background-color", "white");
        var image = 'http://localhost:8019/wp-content/themes/scaleUpTheme/assets/images/marker.png'
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

            //haz cosis aqui
            console.log(pos);
            $('.text-slide').hide();
            $('.text-slide').eq(pos).fadeIn("slow");

            pos = pos + 1;
            
            if (pos == size) {
                pos = 0;
            }
        }, 10000);
         
    }

    //Search button
    $('body').on('click', '.submit-search', function (){

        array_region = [];
        array_business = [];
        array_support = [];

        region = $("#dropdown-region :selected").val();
        type_business = $("#dropdown-type-business :selected").val();
        type_support = $("#dropdown-type-support :selected").val();

        if (region != "") {
            array_region.push(region);
        }

        if (type_business != "") {
            array_business.push(type_business);
        }

        if (array_support != "") {
            array_support.push(type_support);
        }

        LoadProgrammes(array_region, array_business, array_support);
    });


    //Search button
    $('body').on('click', '.one-to-watch', function (){
        $(this).find(".checkbox .fas").toggle();
    });

    $('body').on('click', '.endorsed', function (){
        $(this).find(".checkbox .fas").toggle();
    });

    $('body').on('click', '.more-filters', function (){
        $(".filters-window").fadeIn("slow");
    });

});


$(window).on('load', function(){

    if ($('.programmes-list').length > 0) {
        LoadProgrammes();
    }
    
});

/* Load programmes */

function LoadProgrammes(regions, types_business, types_support){

    full_url = window.location.href;
    path_url = window.location.pathname;
    home_url = full_url.replace(path_url,"");

    ajax_url = home_url + "/wp-admin/admin-ajax.php";

    $.ajax({
        url: ajax_url,
        type: 'post',
        data : {
            action: "load_programmes",
            region: regions,
            type_business: types_business,
            type_support: types_support
        },
        beforeSend:function(xhr){

        },
        success:function(response){
            $("#response-programmes").html(response);
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

    array_lat = $('#loop-location').data("lat");
    array_lng = $('#loop-location').data("lng");
    array_description = $('#loop-location').data("description");

    var image = 'http://localhost:8019/wp-content/themes/scaleUpTheme/assets/images/marker.png'

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


function redirectTo(url) {
    window.location.href = url;

}