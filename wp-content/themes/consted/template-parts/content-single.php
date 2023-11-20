<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package consted
 */

    /**
    * Hook - consted_posts_blog_media.
    *
    * @hooked consted_posts_formats_thumbnail - 10
    */
    do_action( 'consted_posts_blog_media' );
    ?>
   <div class="part-txt">
               
		<?php
        /**
        * Hook - shoper_site_content_type.
        *
		* @hooked site_loop_heading - 10
        * @hooked render_meta_list	- 20
		* @hooked site_content_type - 30
        */
		
		$meta = array();
		
		if( consted_get_option('signle_meta_hide') != true ){
				
			$meta = array( 'author', 'date','category','comments','title');
		}else{
			$meta = array( 'title');
		}
		 
	
		
		 do_action( 'consted_site_content_type', $meta  );
        ?>
      
       
    </div>
    
    <?php 
	 do_action( 'consted_do_tags' );
	 ?>
  
 <!-- #post-<?php the_ID(); ?> -->
