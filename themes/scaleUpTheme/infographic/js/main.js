$(document).ready(function(){

    var host = window.location.host;
    home_url = "http://" + host;
    template_url = home_url + "/wp-content/themes/scaleUpTheme/"

	$({numberValue: 0}).animate({numberValue: 36510}, { duration:1500, easing: 'linear',
        step: function (now) {
        $('#section-1-number-1').text(Math.ceil(now).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));            
        }
    });

    $({numberValue: 0}).animate({numberValue: 33}, { duration:1500, easing: 'linear',
        step: function (now) {
            $('#section-1-number-2').text(Math.ceil(now).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        }
    });

    $({numberValue: 0}).animate({numberValue: 1.3}, { duration:1500, easing: 'linear',
            step: function (now) {
            $('#section-1-number-3').text( (Math.round(now * 10)/10).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        }
    });

    $('.map-btn').mouseenter(function(){
        $(this).attr('src', template_url + 'infographic/img/btn-white.png')
    });

    $('.map-btn').mouseleave(function(){
        $(this).attr('src', template_url + 'infographic/img/btn-orange.png')
    });

    /* DOTTED MAP */

    $('.map-growth-btn').click(function(){
        $('.dot-wrapper-div').removeClass('shown-div');
        $('#'+ $(this).attr('data-attr')).addClass('shown-div')
    })

    /* MAP CHART */
      
    /* MAP CHART CITIES */

    $('#map-btn-01').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/northern-ireland.png');
    });

    $('#map-btn-1').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/scotland.png');
    });

    $('#map-btn-2').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/scotland.png');
    });

    $('#map-btn-3').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/north-west.png');
    });

    $('#map-btn-4').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/yorkshire.png');
    });

    $('#map-btn-5').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/west-midlands.png');
    });

    $('#map-btn-6').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/west-midlands.png');
    });

    $('#map-btn-7').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/west-midlands.png');
    });

    $('#map-btn-8').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/west-midlands.png');
    });

    $('#map-btn-9').click(function(){ 
        $('img.chart-image').attr('src', template_url + 'infographic/img/west-midlands.png');
    });

    $('#map-btn-10').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/east-of-england.png');
    });

    $('#map-btn-11').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/south-west.png');
    });

    $('#map-btn-12').click(function(){
        $('img.chart-image').attr('src', template_url + 'infographic/img/south-east.png');
    });
         
    /* carousel */
    $('#slick-items-1').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
        ]
    }); 

    
    $('#slick-items-2').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
        ]
    });


    $('#slick-items-3').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
        ]
    });

    $('#slick-items-4').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
        ]
    });

    $('#slick-items-5').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
        ]
    });

    

    $('.slick-carousel-holder').slick({
  		infinite: true,
  		slidesToShow: 1,
  		slidesToScroll: 1,
  		dots: true,
  		autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
             }
        }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
	});

        /* CHART 1 */
        var options = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                },
                
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            series: [{
                name: 'Scaleups 2016',
                data: [44, 55, 41, 37, 22, 43, 21]
            },{
                name: 'Change in Scaleups 2016-2017',
                data: [53, 32, 33, 52, 13, 43, 32]
            }
            ],
            title: {
                text: 'Scale ups are present across all sectors of the economy'
            },
            xaxis: {
                categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
                labels: {
                    formatter: function(val) {
                        return val + "K"
                    }
                }
            },
            yaxis: {
                title: {
                    text: undefined
                },
                
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                    return val + "K"
                }
                }
            },
            fill: {
                opacity: 1
                
            },
            
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40
            }
        }

         /* ICON TABS */

        $('.click-item').click(function(){

            load_slick = false;

            if ($(this).hasClass("active")){
                load_slick = false;
            }
            else {
                load_slick = true;
            }

         	$('.click-item').removeClass('active');
         	$(this).addClass('active');
         	_dataAttr = $(this).attr('data-open');
         	$('.sub-section-holder').fadeOut(300);
            $('#'+ _dataAttr +'').delay(350).fadeIn(300);
            
            if (load_slick){
                switch (_dataAttr){
                    case "icons-talent":
                        $('#slick-items-1').slick('refresh');
                    break;
    
                    case "icons-leadership":
                         $('#slick-items-2').slick('refresh');
                    break;
    
                    case "icons-markets":
                        $('#slick-items-3').slick('unslick');
                        $('#slick-items-3').slick('init');
                        $('#slick-items-3').slick('refresh');
                    break;
    
                    case "icons-finance":
                        $('#slick-items-4').slick('unslick');
                        $('#slick-items-4').slick('init');
                        $('#slick-items-4').slick('refresh');
                    break;
    
                    case "icons-infrastructure":
                        $('#slick-items-5').slick('refresh');
                    break;
                }
            }
            
            
        });

});

 
 $(window).scroll(function(){

 	    $('section').each(function( index ) {

           if($(this).visible(true))
           {
    	       if( !$(this).hasClass('active') )
    	       {
    	       	 $(this).addClass('active');
    	     

                // GROWTH FIGURES 


                 $({numberValue: 0}).animate({numberValue: 50}, { duration:1500, easing: 'linear',
                    step: function (now) {
                    $('.active #f-digit-1').text(now.toFixed(0)); 
                    }
                 });


                 $({numberValue: 0}).animate({numberValue: 2500}, { duration:1500, easing: 'linear',
                    step: function (now) {
                    $('.active #f-digit-2').text(Math.ceil(now).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    }
                 });


                 $({numberValue: 0}).animate({numberValue: 1900}, { duration:1500, easing: 'linear',
                    step: function (now) {
                    $('.active #f-digit-3').text(Math.ceil(now).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    }
                 });


                 $({numberValue: 0}).animate({numberValue: 10000}, { duration:1500, easing: 'linear',
                    step: function (now) {
                    $('.active #f-digit-4').text(Math.ceil(now).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    }
                 });


                 $({numberValue: 0}).animate({numberValue: 23}, { duration:1500, easing: 'linear',
                    step: function (now) {
                    $('.active #f-digit-5').text(now.toFixed(0)); 
                    }
                 });

    	       }
           }
           else
           {
           	$(this).removeClass('active');
           }

        });

 });


   

 