<?php 
?>
<footer>

   <div class="container py-4">

      <div class="row">
         
         <!-- Twitter -->
         <div class="col-lg-8">
            <div class="d-flex flex-column flex-lg-row h-100 align-items-center">

               <div class="mr-3 mb-3"><i class="fab fa-twitter"></i></div>
               <div class="">
                  <?php
                     /* your parameters */
                     $jltw_args = array(
                        'username'	=> 'scaleupinst',
                        'nb_tweets'	=> 1,
                        'avatar'	=> false,
                        'cache'		=> 120,
                        'transition'	=> false,
                        'delay'		=> 8,
                        'links'		=> true
                     );

                     /* display widget */
                     jltw($jltw_args);
                  ?>
               </div>

            </div>
           
         </div>

         <!-- Contact info -->
         <div class="col-lg-3 offset-lg-1 contact-info">
            <p>A: 101 Euston Road, London, NW1 2RA</p>
            <p>E: <a href="mailto:info@scaleupinstitute.org.uk">info@scaleupinstitute.org.uk</a></p><br>
            <p><a href="/privacy-policy/">Privacy Policy</a> | <a href="/data-protection-policy/">Data Protection Policy</a></p>
            <p><a target="_blank" href="http://www.twitter.com/scaleupinst"><i class="fab fa-twitter"></i></a><a href="https://www.linkedin.com/in/irene-graham-1ab87ab7" target="_blank"><i class="fab fa-linkedin-in"></i></a></p>
         </div>
   
      </div> <!-- row -->

   </div>

</footer>

<?php wp_footer(); ?>

<!-- Google Maps -->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb4aa1NMZ5gB0NclaWCOkyxIWD53rX4kU&callback=initMap"async defer></script>


<!-- Count up -->
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>


<!-- Infographic scripts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!--
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
                  --> 

<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>

<script src="<?php echo get_bloginfo('template_url')?>/infographic/js/vendor/modernizr-3.7.1.min.js"></script>
<script src="<?php echo get_bloginfo('template_url')?>/infographic/js/vendor/visible.js"></script>
<script src="<?php echo get_bloginfo('template_url')?>/infographic/js/vendor/animateNumber.js"></script>
<script src="<?php echo get_bloginfo('template_url')?>/infographic/js/plugins.js"></script>
<script src="<?php echo get_bloginfo('template_url')?>/infographic/js/main.js"></script>

</body>
</html>
