<?php
/**
 * Template Name: Movie page
 */
get_header();
?>

<?php
//while ( have_posts() ) {
//    the_post();
//    the_content();
//
//}

$movies = get_latest_cpt('movies', 2);
if($movies){
    foreach($movies as $post){
        setup_postdata($post);
        $meta = get_post_meta(get_the_ID());
        $style = '';
        if($meta['_cmb2_featured'][0]){
            $style = 'style="color: #ff6600"';
        }
        ?>

        <h2 <?php echo $style; ?> ><php get_the_title();?></h2>

<?php
        if(has_post_thumbnail()){
            the_post_thumbnail("thumbnail");
        }
    }
}

get_footer("movie");