<div class="scaleup-review">

    <!-- Banner -->
    <div class="bg-black top-banner py-4">
        <div class="container ">
            <div class="row">
            
                <div class="col-4">
                    <div class="d-flex align-items-center h-100">
                        <div>
                            <p class="title">Explore the ScaleUp Annual Review 2019</p>
                            <p>Select a section to expand and explore this years review.</p>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <img style="height:300px" src="<?php echo get_bloginfo('template_url')?>/assets/images/review.png">
                </div>

            </div>
        </div>
    </div>

    <!-- Content -->
    <?php 
        $args = array(
            'post_type' => 'articles',
            'posts_per_page' => -1,
        );
        $articles = get_posts($args);
    ?>

    <div class="bg-light_gray">
        <div class="container">

            <div class="row">
                <div class="col-3">
                    
                    <div class="menu static-menu py-5">

                        <h5>CONTENTS</h5>

                        <?php 
                        $chapters = get_terms( array(
                            'taxonomy' => 'chapter',
                            'hide_empty' => false,
                            'orderby' => 'slug',
                            'order' => 'ASC'
                        ) );

                        foreach ($chapters as $chapter):

                            $title = $chapter->name;
                            $description = $chapter->description;
                            $term_id = $chapter->term_id;
                            $taxonomy = $chapter->taxonomy;
                            $ref = $taxonomy . '_' . $term_id;
                            $highlight_colour = get_field('highlight_colour', $ref);

                            if ($highlight_colour == "#DDE3E8"){
                                $class_colour = "colour-dark";
                            }
                            else {
                                $class_colour = "";
                            }

                            $args = array(
                                'post_type' => 'articles',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'chapter',
                                        'field' => 'term_id',
                                        'terms' => $term_id,
                                    )
                                )
                            );
                            $articles = get_posts($args);

                        ?>
                            <div class="chapter <?php echo $class_colour ?>" data-chapter="<?php echo $article_id ?>"
                                style="background-color:<?php echo $highlight_colour?>">
                                
                                <!-- Header -->
                                <div class="d-flex py-2 px-2 header" data-toggle="collapse" data-target="#collapse<?php echo $term_id?>" aria-expanded="false" aria-controls="collapse<?php echo $term_id?>">
                                    <div style="margin-top:1px">
                                        <img class="arrow-down" src="<?php echo get_bloginfo('template_url')?>/assets/images/chevron.png">
                                    </div>

                                    <div>
                                        <p class="title"><?php echo $title ?></p>
                                        <p><?php echo $description?></p> 
                                    </div>
                                </div>

                                <!-- Articles -->
                                <div class="collapse" id="collapse<?php echo $term_id?>">
                                    <div class="d-flex flex-column py-2" style="margin-left:42px">
                                        <?php foreach ($articles as $article): 
                                            $article_id = $article->ID;
                                            $title = get_the_title($article_id); ?>
                                            <a class="load-chapter" data-article="<?php echo $article_id?>"><?php echo $title ?></a>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                
                            </div>

                        <?php endforeach; ?>

                    </div>

                    
                </div>

                <div class="col-9">
                    
                    <div id="response-chapter" class="py-5 mt-3"></div>

                </div>
            </div>
        </div>
    </div>


    <div class="fixed-menu" style="position:fixed; top: 0; width: 100%; height: 100%; ">
        <div class="container">


            <div class="row">

                <div class="col-3">

                    <div class="menu py-5">

                        <h5>CONTENTS</h5>


                        <?php 
                        $chapters = get_terms( array(
                            'taxonomy' => 'chapter',
                            'hide_empty' => false,
                            'orderby' => 'slug',
                            'order' => 'ASC'
                        ) );

                        foreach ($chapters as $chapter):

                            $title = $chapter->name;
                            $description = $chapter->description;
                            $term_id = $chapter->term_id;
                            $taxonomy = $chapter->taxonomy;
                            $ref = $taxonomy . '_' . $term_id;
                            $highlight_colour = get_field('highlight_colour', $ref);

                            if ($highlight_colour == "#DDE3E8"){
                                $class_colour = "colour-dark";
                            }
                            else {
                                $class_colour = "";
                            }

                            $args = array(
                                'post_type' => 'articles',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'chapter',
                                        'field' => 'term_id',
                                        'terms' => $term_id,
                                    )
                                )
                            );
                            $articles = get_posts($args);
                        ?>

                            <div class="chapter <?php echo $class_colour ?>" data-chapter="<?php echo $article_id ?>"
                                style="background-color:<?php echo $highlight_colour?>">
                                
                                <!-- Header -->
                                <div class="d-flex py-2 px-2 header" data-toggle="collapse" data-target="#collapse<?php echo $term_id?>" aria-expanded="false" aria-controls="collapse<?php echo $term_id?>">
                                    <div style="margin-top:1px">
                                        <img class="arrow-down" src="<?php echo get_bloginfo('template_url')?>/assets/images/chevron.png">
                                    </div>

                                    <div>
                                        <p class="title"><?php echo $title ?></p>
                                        <p><?php echo $description?></p> 
                                    </div>
                                </div>

                                <!-- Articles -->
                                <div class="collapse" id="collapse<?php echo $term_id?>">
                                    <div class="d-flex flex-column py-2" style="margin-left:42px">
                                        <?php foreach ($articles as $article): 
                                            $article_id = $article->ID;
                                            $title = get_the_title($article_id); ?>
                                            <a class="load-chapter" data-article="<?php echo $article_id?>"><?php echo $title ?></a>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                
                            </div>

                        <?php endforeach; ?>

                        <?php 
                        /*
                        foreach ($articles as $article):
                            $article_id = $article->ID;
                            $title = get_the_title($article_id); 
                            $all_fields = get_fields($article_id);

                            if ($all_fields['highlight_colour'] == "#FDB03C"){
                                $class_colour = "colour-dark";
                            }
                            else {
                                $class_colour = "";
                            }
                            
                        endforeach; */ ?>
                                                

                    </div>
                    
                </div>
                
                
            </div>

        </div>
    </div> 
    

</div>