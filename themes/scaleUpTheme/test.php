<?php
/*
Template Name: Test
*/
?>

<?php get_header(); ?>


<div class="container" style="height:100vh">

    <?php 

        $angles = "><<><";
        solution($angles);

        function solution($angles){
            
            $chars = str_split($angles);
            $matching_chars = array();

            //Create array with -1

            for($i = 0; $i < count($chars); ++$i) {
                array_push($matching_chars, -1);
            }
            
            for($i = 0; $i < count($chars); ++$i) {
                
                //Mira si hay alguien detras
                if ($chars[$i] == ">") {
                    $prev = $i - 1;
                    for ($j = 0; $j < $prev; ++$j) {

                        if ($chars[$j] == "<" &&   $matching_chars[$j] == -1) {
                            $matching_chars[$i] = $j;
                            $matching_chars[$j] = $i;
                        }
                    }
                }

                //Mira si hay alguien delante
                if ($chars[$i] == "<") {
                    $next = $i + 1;
                    for ($x = $next; $x < count($chars); ++$x) {

                        if ($chars[$x] == ">" &&   $matching_chars[$x] == -1) {
                            $matching_chars[$i] = $x;
                            $matching_chars[$x] = $i;
                        }
                    }
                }

            }

    
            $start = "";
            $end = "";
            for($i = 0; $i < count($chars); ++$i) {
                
                if ($matching_chars[$i] == -1) {

                    if ($chars[$i] == ">") {
                        $start = $start . "<";
                    }

                    if ($chars[$i] == "<") {
                        $end = $end . ">";
                    } 
                }
            }
            $new_angles = $start . $angles . $end;
            return $new_angles;
        }

        /*
        $nums = [1,4,3,4,2,5];
        $k = 3;
        solution($nums, $k);

        function solution($numbers, $k) {
            rsort($numbers);
            $pos = $k - 1;
            $result = $numbers[$pos];
            return $result;
        } */
        
    ?>
</div>

<?php get_footer(); ?>