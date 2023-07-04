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
$args = array (
    'post_type'      => 'whi-testimonial',
    'posts_per_page' => 1,
);

$query = new WP_Query ($args);
if ($query -> have_posts()){
    while($query -> have_posts()){
        $query -> the_post();
        if(function_exists('get_field')){
            ?>
            <blockquote>
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
    wp_reset_postdata();
}