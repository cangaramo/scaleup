<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title><?php wp_title(); ?></title>

    <?php wp_head();?>
</head>

<body>

<header class="w-100">

    <div class="container p-0">

        <nav class="navbar navbar-expand-lg py-0 py-lg-4  px-0">

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                <a class="text-center d-none d-lg-block" href="<?php echo home_url(); ?>"><img height="45" src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/scaleup_logo.svg" alt="Logo"></a>

                <div class="navbar-nav w-100 mt-3 d-flex justify-content-end align-items-lg-center">

                    <?php 
                    $menu_name = 'main'; 
                    $locations = get_nav_menu_locations();
                    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                    $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

                    foreach ($menuitems as $index=> $menuitem):

                        $title = $menuitem->title;
                        $url = $menuitem->url;
                        $id = $menuitem->ID;

                        $current_title = get_the_title();
                        if ($current_title == $title) {
                            $class= "active";
                        }
                        else {
                            $class = "";
                        }
                        ?>
    
                        <!-- Normal item -->
                        <div class="custom-link mx-3 <?php echo $class ?>">
                            <a class="nav-item nav-link d-inline-block text-center my-3 my-lg-2 mx-lg-2 mx-xl-3" href="<?php echo $url?>"><span><?php echo $title ?></span></a>
                            <div class="line"></div>
                        </div>
                    
                    <?php endforeach ?>
                
                </div>

                <a href="#" class="mt-2 mx-3"><img height="17" src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/search_icon.png"></a>

                <a href="#" class="mt-2 mx-3 login-btn" >Login</a>

                <a href="#" class="m-2 pt-2"><i class="fab fa-twitter"></i></a>

                <a href="#" class="m-2 pt-2"><i class="fab fa-linkedin-in"></i></a>

            </div>

        </nav>

    </div>
</header>


    
    


