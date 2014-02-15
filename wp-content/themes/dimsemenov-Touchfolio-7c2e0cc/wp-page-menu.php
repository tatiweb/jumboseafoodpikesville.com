<?php

<div id="navigation" class="clearfix">
<?php 
    $args = array(
        'show_home'   => true,
        'depth'        => 0,
        'child_of'     => 0,
        'title_li'     => '',
        'echo'         => 1,
        'sort_column'  => 'menu_order, post_title',
        'link_before'  => '',
        'link_after'   => ''
        );
         
    wp_page_menu( $args );
?>       
</div>	

?>