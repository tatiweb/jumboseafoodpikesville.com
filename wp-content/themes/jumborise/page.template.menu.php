<?php 
/*
 * Template Name: Menu Page
 */
get_header(); ?>



<?php //$temp_query = $wp_query; ?>

<!-- begin main -->
<section class="main menulist block grid4 clearfix">
	
	



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<header>
		<h2 class="post-title"><?php the_title(); ?></h2>
	</header>

	<div class="post-content">
		<?php the_content() ?>
	</div>

	<?php endwhile; endif;?>

    


	<?php

// get initial categories
$categories = get_terms( 'menus', array( 'orderby' => 'name', 'order' => 'ASC', 'hierarchical'  => true, 'parent'=>0, 'hide_empty'    => false, ) );


foreach ( $categories as $category ) {

// we don't want child categories now, and since get_categories does not support 'depth' parameter, we use ->parent check
if ( $category->parent > 0 ) {
    continue;   
}

$i = 0;
echo '<h2 class="menu-title level-1">' . $category->name . '</h2>';
query_posts(
    array(
        'menus' => $category->slug,
        'post_type'=> 'menu-item',
        //'orderby'=> 'menu_order',
        'posts_per_page' => -1
    )
);


if ( have_posts() ) : while (have_posts()): the_post(); global $post;

    // let's make sure that the post is not also in any of child categories, if it is, skip it ( we don't want to display it twice )
    $child_categories = get_term_children( $category->term_id, 'menus' );

    //if ( $child_categories && in_category( $child_categories, $post->ID ) ) {
    if ( $child_categories && !is_object_in_term( $post->ID, 'menus', $category->name ) ) {
        continue;
    }

    echo 0 === $i ? '' : '';
   	//include 'part.menuitem.php';
    get_template_part( 'part.menuitem' );
    $i++;


endwhile;
//wp_reset_query();
endif;

echo '';

// now, after we listed all the posts, we query for child categories
$categories2 = get_terms(
	'menus',
    array(
        'parent' => $category->term_id,
        'hierarchical'  => true,
    )
);


foreach ( $categories2 as $category ) {

    $j = 0;
    echo '<h2 class="menu-title level-2">' . $category->name . '</h2>';
    $posts2 = query_posts(
        array(
            'menus' => $category->slug,
            'post_type'=> 'menu-item',
            'posts_per_page' => -1
        )
    );

    if ( have_posts() ) :while (have_posts()): the_post(); global $post;

        echo 0 === $j ? '' : '';
        //include 'part.menuitem.php';
        get_template_part( 'part.menuitem' );
        $j++;
    endwhile;
	//wp_reset_query();
	endif;

    echo null === $posts2 ? '' : '';

}

echo null === $posts ? '' : '';

}

?>





	
</section>
<!-- end main -->


<?php //$wp_query = $temp_query; ?>


<?php get_footer(); ?>