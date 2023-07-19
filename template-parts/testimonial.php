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
    <div class="testimonial swiper slider2">
       
       <div class=" swiper-wrapper">
            <?php
            while($query -> have_posts()){
                $query -> the_post();
                
                
                if(function_exists('get_field')){
                    ?>            
                        <figure class="swiper-slide">         
                            <blockquote >
                                <?php 
                                if(get_field('testimonial_content')){
                                echo the_field ('testimonial_content');
                                
                                }
                                ?>
                            </blockquote>
                            <figcaption>
                                <?php 
                                if(get_field('testimonial_author')){
                                    echo the_field('testimonial_author'); 
                                }
                                ?>
                            </figcaption>
                         </figure> 
                   
                    <?php

                } 
            
            }?>
        </div>
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
                 
                <figure class="testimonial">         
                    <blockquote >
                        <?php 
                        if(get_field('testimonial_content')){
                           echo the_field ('testimonial_content');
                          
                        }
                        ?>
                    </blockquote>
                    <figcaption>
                        <?php 
                        if(get_field('testimonial_author')){
                            echo the_field('testimonial_author'); 
                        }
                        ?>
                    </figcaption>
                </figure> 
                                        
          
            <?php

        } 


    }
   
}