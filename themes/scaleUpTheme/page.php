<?php
get_header(); ?>

    <main>

        <div class="container my-5">
            <?php  
                $my_postid = get_the_ID(); 
                $content_post = get_post($my_postid);
                $content = $content_post->post_content;
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]&gt;', $content);
                echo $content;
            ?>
        </div>
        
    </main>

<?php
get_footer();
?>

