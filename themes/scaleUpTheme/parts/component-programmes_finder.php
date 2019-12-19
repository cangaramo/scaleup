<?php 
$args = array (
    'post_type' => 'programmes',
    'posts_per_page' => -1
);
$programmes = get_posts($args);
$lat_array = array();
$lng_array = array();
?>
<?php $ajaxurl = home_url() . '/wp-admin/admin-ajax.php'; ?>

<div class="container" id="search_markers" data-url="<?php echo $ajaxurl ?>">

    <div class="row">
        <div class="col-5">
            <p>Find the suppport to grow your bussiness</p>
            <div id="form-search">
                <select id="input_business" class="w-100">
                    <option value="volvo">What type of business are you?</option>
                    <option value="saab">Speciality a</option>
                    <option value="mercedes">Speciality b</option>
                    <option value="audi">Speciality c</option>
                </select>
                <input id="input_address" class="w-100" type="text" placeholder="Which area are you based in?"> <br>
                <input class="w-100" type="text" placeholder="What support are you looking for?"> <br>
                <input id="submit-form" class="w-100" type="submit">
            </div>
        </div>
    </div>

    <div>
    
        <div class="row">
            <div class="col-6">

                <div id="map-container">
                    <!-- Results here -->
                </div>
            
            </div>
    
            <div class="col-6">
                <div id="map"></div>
            </div>
        </div>

    </div>

</div>

