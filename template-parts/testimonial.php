<?php
/**
 * Template part for displaying testimonial
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Whistler_Cabins
 */

?>
<?php
$args = array(
    'post_type'      => 'whi-testimonial',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'related_product',
            'value'   => '"' . get_the_ID() . '"',
            'compare' => 'LIKE'
        )
    )
);

$query = new WP_Query ($args);
if ($query -> have_posts()){
    ?>
    <div class="swiper">
       
       <div class="swiper-wrapper">
            <?php
            while($query -> have_posts()){
                $query -> the_post();
                
                
                if(function_exists('get_field')){
                    ?>            
                        <blockquote class="swiper-slide">
                            
                                <?php 
                                if(get_field('testimonial_content')){
                                    echo '<p>'. the_field ('testimonial_content') . '</p>';
                                    
                                }
                                if(get_field('testimonial_author')){
                                    echo '<p>' . the_field('testimonial_author') . '</p>'; 
                                }
                                ?>
                            
                        </blockquote>
                                                
                  
                    <?php

                } 
            
            }?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>  
    </div>
    <?php 
    
    wp_reset_postdata();
}else{

    $args = array(
        'post_type'      => 'whi-testimonial',
        'posts_per_page' => 1,
        'post__in'       => array(361),
    );

    $query = new WP_Query ($args);
    while($query -> have_posts()){
        $query -> the_post();

        if(function_exists('get_field')){
            ?>            
                <blockquote class="swiper-slide">
                    
                        <?php 
                        if(get_field('testimonial_content')){
                            echo '<p>'. the_field ('testimonial_content') . '</p>';
                            
                        }
                        if(get_field('testimonial_author')){
                            echo '<p>' . the_field('testimonial_author') . '</p>'; 
                        }
                        ?>
                    
                </blockquote>
                                        
          
            <?php

        } 


    }
   
}