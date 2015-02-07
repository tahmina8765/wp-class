<?php
while(have_posts()){
    the_post();
    the_title();


    echo $meta = get_post_meta(get_the_ID(), '_cmb2_post_select', true);

    echo "<br>";
}