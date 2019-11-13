<?php
    $id = get_the_ID();
    $url = home_url() . '/infographic';
    echo'<script> window.location=" ' .  $url .  '"; </script> ';    
?>