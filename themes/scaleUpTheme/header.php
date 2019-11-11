<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


    <!-- Move to functions.php later 
    <link rel="stylesheet" href="css/normalize.css"> -->

    <title><?php wp_title(); ?></title>

    <?php wp_head();?>
</head>

<body>

<?php 
    $menu_name = 'main'; 
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
?>

<header class="w-100">

    <!-- Sidebar (absolute) -->
    <div class="d-block d-lg-none">
        <div id="sidebar">
            <div class="sidebar-nav">
                <?php foreach ($menuitems as $menuitem):

                    $parent = $menuitem->menu_item_parent;
                    $title = $menuitem->title;
                    $url = $menuitem->url;
                    $id = $menuitem->ID;

                    $current_title = get_the_title();
                    if ($current_title == $title) {
                        $class= "active";
                    }
                    else {
                        $class = "";
                    } ?>

                    <?php if ($parent == 0) :?>
                        <!--
                        <a class="nav-item nav-link px-3 mx-4 my-3 <?php echo $class ?>" href="<?php echo $url?>"><?php echo $title ?></a> --->

                        <?php
                        $dropdown = false;
                        foreach ($menuitems as $menusubitem):
                            $parentsubitem = $menusubitem->menu_item_parent;
                            if ($parentsubitem == $id ):
                                $dropdown = true;
                            endif; 
                        endforeach; 

                        /* Dropdown item */
                        if ($dropdown): ?>

                            <div class="dropdown">

                                <!-- Desktop -->
                                <a href="<?php echo $url ?>" class="nav-item nav-link dropdown-toggle <?php echo $class ?> text-center my-2 mx-lg-2 mx-xl-3 d-none d-lg-inline-block" 
                                id="dropdownMenuButton" ><?php echo $title ?>
                                </a>

                                <!-- Mobile -->
                                <div class="text-center">

                                    <a href="<?php echo $url ?>" class="nav-item nav-link d-inline-block d-lg-none text-center my-3 mx-lg-2 mx-xl-3">
                                        <?php echo $title ?>
                                    </a> 
                                  
                                    <a href="#" class="dropdown-toggle d-inline-block d-lg-none open-dropdown" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-chevron-down"></i></a> 
                                    
                                    <div class="dropdown-menu m-0" style="transform: 0" aria-labelledby="dropdownMenuLink">

                                        <?php foreach ($menuitems as $menusubitem):
                                            $parentsubitem = $menusubitem->menu_item_parent;
                                            $titlesubitem = $menusubitem->title;
                                            $urlsubitem = $menusubitem->url;
                                            $idsubitem = $menusubitem->object_id;
                                                        
                                            if ($parentsubitem == $id ): ?>   
                                                <div><a class="dropdown-item text-center my-3" href="<?php echo $urlsubitem?>"><?php echo $titlesubitem;?></a></div>
                                            <?php endif; 
                                        endforeach; ?>

                                    </div>

                                </div>
                                
                            </div>

                        <!-- Normal item -->
                        <?php else: ?>
                            <div class="text-center"><a class="nav-item nav-link d-inline-block text-center my-3 <?php echo $class ?>" href="<?php echo $url?>"><span><?php echo $title ?></span></a></div> 
                            <!-- <a class="nav-item nav-link px-3 mx-4 my-3 <?php echo $class ?>" href="<?php echo $url?>"><?php echo $title ?></a> -->
                        <?php endif; ?>
            
                    <?php endif ?> <!-- parent 0 -->
             
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <!-- Open sidebar -->
    
    <div id="open-btn-container" class="d-block d-lg-none">
        <button style="z-index:14" id="open-btn" class="navbar-toggler collapsed close-anim my-4" type="button"  data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>	
        </button>
    </div>

    <!-- Menu -->
    <div class="container p-0">

        <nav class="navbar navbar-expand-lg py-3 py-lg-4 px-0">

            <!-- Align center -->
            <div>
                <a style="margin-left: 80px" class="open-search d-block d-lg-none"><img height="17" src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/search_icon.png"></a>
            </div>

            <!-- Logo mobile -->
            <div class="d-block d-lg-none">
                <a class="mr-4" href="<?php echo home_url(); ?>"><img style="height:45px" src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/scaleup_logo.png"></a>
            </div>

            <!-- Desktop menu -->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <a class="text-center d-none d-lg-block" href="<?php echo home_url(); ?>"><img height="45" src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/scaleup_logo.png" alt="Logo"></a>
                <div class="navbar-nav w-100 mt-3 d-flex justify-content-end align-items-lg-center">

                    <?php 
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

                        $parent = $menuitem->menu_item_parent; 

                        if ($parent == 0 ): 

                            $dropdown = false;
                            foreach ($menuitems as $menusubitem):
                                $parentsubitem = $menusubitem->menu_item_parent;
                                if ($parentsubitem == $id ):
                                    $dropdown = true;
                                endif; 
                            endforeach; 

                            /* Dropdown item */
                            if ($dropdown): ?>

                                <div class="dropdown">
                                    <!-- Desktop -->
                                    <div class="custom-link mx-3 <?php echo $class ?>">
                                        <a href="<?php echo $url ?>" 
                                            class="nav-item nav-link dropdown-toggle d-inline-block text-center my-3 my-lg-2 mx-lg-2 mx-xl-3" 
                                            id="dropdownMenuButton" >
                                            <span><?php echo $title ?></span>
                                        </a>
                                        <div class="line"></div>
                                    </div>

                                    <div class="dropdown-menu m-0" aria-labelledby="dropdownMenuLink">

                                        <?php foreach ($menuitems as $menusubitem):
                                            $parentsubitem = $menusubitem->menu_item_parent;
                                            $titlesubitem = $menusubitem->title;
                                            $urlsubitem = $menusubitem->url;
                                            $idsubitem = $menusubitem->object_id;
                                                            
                                            if ($parentsubitem == $id ): ?>   
                                                <div><a class="dropdown-item my-2 my-lg-0" href="<?php echo $urlsubitem?>"><?php echo $titlesubitem;?></a></div>
                                            <?php endif; 
                                        endforeach; ?>

                                    </div>
                                </div>
                                
                            <?php else: ?>

                                <!-- Normal item -->
                                <div class="custom-link mx-3 <?php echo $class ?>">
                                    <a class="nav-item nav-link d-inline-block text-center my-3 my-lg-2 mx-lg-2 mx-xl-3" href="<?php echo $url?>">
                                        <span><?php echo $title ?></span>
                                    </a>
                                    <div class="line"></div>
                                </div>

                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>

                <a class="mt-2 mx- open-search"><img height="17" src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/search_icon.png"></a>
                <!-- <a href="#" class="mt-2 mx-3 login-btn" >Login</a> -->
                <a href="http://www.twitter.com/scaleupinst" class="ml-4 mr-2 pt-3"><i class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com/in/irene-graham-1ab87ab7" class="m-2 pt-3"><i class="fab fa-linkedin-in"></i></a>

            </div>
        </nav>
    </div>

    <!-- Search -->
    <div class="search-box bg-blue" style="display:none">
        <div class="search-content container">

            <div class="pt-5">
                <button class="close-search">
                    <img src="<?php echo get_bloginfo('template_url') ?>/assets/images/close-form.png">
                </button>

                <input id="query-search" class="w-100" type="text" placeholder="Search">

                <div id="search-results" class="d-flex flex-column pt-4">
                </div>
            </div>
                
        </div>
    </div>

</header>


    
    


