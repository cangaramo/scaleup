<?php
    $id = get_the_ID();
    $url = home_url() . '/scaleup-review#' . $id;
    echo'<script> window.location=" ' .  $url .  '"; </script> ';    
?>