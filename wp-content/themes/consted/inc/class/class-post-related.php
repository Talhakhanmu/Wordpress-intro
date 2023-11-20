<?php
/**
 * All POST Related Function 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Consted
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Consted_Post_Related {
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		
		if( !is_admin()  )
		{
			add_action( 'consted_site_content_type', array( $this,'site_loop_heading' ), 21 ); 
			add_action( 'consted_site_content_type', array( $this,'site_content_type' ), 30 ); 
		}
		
		add_action( 'consted_posts_blog_media', array( $this, 'render_thumbnail' ) ); 
		
		
		add_action( 'consted_loop_navigation', array( $this,'site_loop_navigation' ) );
		
		
		add_filter( 'the_content_more_link', array( $this,'content_read_more_link' ));
		//add_filter( 'excerpt_more', array( $this,'excerpt_read_more_link' ) );
		
		add_filter( 'comment_form_fields', array( $this,'move_comment_field_to_bottom' ) );
		
		add_filter( 'excerpt_length', array( $this,'excerpt_length' ) );
		
		add_action( 'consted_post_navigation', array( $this,'single_post_navigation' ),10 );

		
	}
	

	/**
	 * Web Site heading
	 *
	 * @since 1.0.0
	 */
	public function site_loop_heading( $meta = array() ) {
		
		if( is_page() || in_array('title',$meta ) ) return;
		if ( is_singular() ) :
			the_title( '<h3 class="entry-title">', '</h3>' );
		else :
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h4>' );
		endif;
		
		
	}
	
	function excerpt_length( $length ) {
		$excerpt_length = consted_get_option( 'excerpt_length_blog' );
		if( is_admin() ){
			 return $length;
		}else{
			if ( absint( $excerpt_length ) > 0 && !is_admin() ) {
				$length = absint( $excerpt_length );
			}
		}

        return $length;
	}


    /**
     * @since  Blog Expert 1.0.0
     *
     * @param null
     */
    function site_content_type( ){
		
		$type = apply_filters( 'consted_content_type_filter', consted_get_option( 'blog_loop_content_type') );
		
		echo '<div class="content-wrap">';
		
			if( ! is_single() && !is_page()):
			
				if ( $type == 'content' ) 
				{
					the_content();
					
				}else
				{
					echo wp_kses_post( get_the_excerpt() );
				}
				
			else:
			
				the_content();
				
			endif;
			
		echo '</div>';

    }
	
	
	
	/**
	* Adds custom Read More link the_content().
	* add_filter( 'the_content_more_link', array( $this,'content_read_more_link' ));
	* @param string $more "Read more" excerpt string.
	* @return string (Maybe) modified "read more" excerpt string.
	*/
	public function content_read_more_link( $more  ) {
		if ( is_admin() ) return $more;
		return sprintf( '<div class="more-link">
             <a href="%1$s" class="btn  theme-btn"><span>%2$s </span><i class="icofont-thin-double-right"></i></a>
        </div>',
            esc_url( get_permalink( get_the_ID() ) ),
		    esc_html( consted_get_option( 'read_more_text' ) )
        );
		
	}
	
	/**
	* Filter the "read more" excerpt string link to the post.
	* //add_filter( 'excerpt_more', array( $this,'excerpt_read_more_link' ) );
	* @param string $more "Read more" excerpt string.
	* @return string (Maybe) modified "read more" excerpt string.
	*/
	public function excerpt_read_more_link( $more ) {
		if ( is_admin() ) return $more;
		if ( ! is_single() ) {
			$more = sprintf( '<div class="more-link">
				 <a href="%1$s" class="btn theme-btn"><span>%2$s </span><i class="icofont-thin-double-right"></i></a>
			</div>',
				esc_url( get_permalink( get_the_ID() ) ),
				esc_html( consted_get_option( 'read_more_text' ) )
			);
			
		}
		return $more;
	}

	/**
	 * Post Posts Loop Navigation
	 * add_action( 'consted_loop_navigation', $array( $this,'site_loop_navigation' ) ); 
	 * @since 1.0.0
	 */
	function site_loop_navigation( $type = '' ) {
		
		if( $type == '' ){
			$type = apply_filters( 'consted_loop_navigation_filter', get_theme_mod( 'consted_loop_navigation', 'list' ) );
		}
		
		if( $type == 'default' ):
		
			the_posts_navigation(
				array(
					'prev_text' => '<span>'.esc_html__('Previous Posts', 'consted').'<i class="icofont-rounded-double-right"></i></span>',
					'next_text' => '<span><i class="icofont-rounded-double-left"></i>'.esc_html__('Next Posts', 'consted').'</span>',
					'screen_reader_text' => __('Posts navigation', 'consted')
				)
			);
			echo '<div class="clearfix"></div>';
		
		else:
		
			echo '<div class="clearfix"></div><div class="pagination col-xl-12 col-lg-12">';
			the_posts_pagination( array(
				'type' => 'list',
				'mid_size' => 2,
				'prev_text' => '<i class="icofont-double-left"></i>',
				'next_text' => '<i class="icofont-double-right"></i>',
				'screen_reader_text' => esc_html__( '&nbsp;', 'consted' ),
			) );
		echo '</div>';
		endif;
		
		
	}
	
	
	/**
	 * Change Comment fields location
	 * @since 1.0.0
	 * @ add_filter( 'comment_form_fields', array( $this,'move_comment_field_to_bottom' ) );
	 */
	function move_comment_field_to_bottom( $fields ) {
		
		$comment_field = $fields['comment'];
		$cookies_field = $fields['cookies'];
		
		unset( $fields['comment'] );
		unset( $fields['cookies'] );
		
		$fields['comment'] = $comment_field;
		$fields['cookies'] = $cookies_field;
		
		return $fields;
	}
	
	
	
	/**
	 * Render post type thumbnail.
	 *
	 * @param $formats = string.
	 */
	public function render_thumbnail( $formats = '') {
		
		if( empty( $formats ) ) { $formats = get_post_format( get_the_ID() ); }
		
		
		switch ( $formats ) {
			default:
				$this->get_image_thumbnail();
			break;
			case 'gallery':
				$this->get_gallery_thumbnail();
			break;
			case 'audio':
				$this->get_audio_thumbnail();
			break;
			case 'video':
				$this->get_video_thumbnail();
			break;
		} 
	
	}
	
	
	/**
	 * Post formats audio.
	 *
	 * @since 1.0.0
	 */
	public function get_gallery_thumbnail(){
		
		global $post;
		$html = '';
		if( has_block('gallery', $post->post_content) ): 
			$html = '<div class="part-img">';
			$post_blocks = parse_blocks( $post->post_content );
			
			if( !empty( $post_blocks ) ):
				
				$html .= '<div class="gallery-media wp-block-gallery owlGallery">';
				foreach ( $post_blocks as $row  ):
					if( $row['blockName']=='core/gallery' )
					$html .= $row['innerHTML'];
				endforeach;
				$html .= '</div>';
			endif;
			$html .= '</div>';
		elseif ( get_post_gallery() ) :
			$html = '<div class="part-img">';
			
			$html .= '<figure class="gallery-media owlGallery">';
			
				$gallery = get_post_gallery( $post, false );
				
				$ids     = !empty( $gallery['ids'] ) ? explode( ",", $gallery['ids'] ) : array();
				
				if( !empty( $ids  )) {
					foreach( $ids as $id ) {
					   $link   = wp_get_attachment_url( $id );
					
					   $html  .= '<div class="item"><img src="' . esc_url( $link ) . '"  class="img-responsive" alt="' .esc_attr( get_the_title() ). '" title="' .esc_attr( get_the_title() ). '"  /></div>';
					
					} 
				}
				
			$html .= '</figure>';
			$html .= '</div>';
		else: 
			
			$html .= $this->get_image_thumbnail();
			
		endif;	
		
		
		
		$html =  apply_filters( 'consted_shop_gallery_thumbnail', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
	}
	/**
	 * Post formats audio.
	 *
	 * @since 1.0.0
	 */
	public function get_audio_thumbnail(){
		
		$content 		= apply_filters( 'the_content', get_the_content() );
		$audio			= false;
		$html 		 	= '';
		$post_thumbnail_url 	= '';
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio 		= get_media_embedded_in_content( $content, array( 'audio' ) );
		}
		
		if ( has_post_thumbnail() ) :
		
			$post_thumbnail_id 		= get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url 	= wp_get_attachment_url( $post_thumbnail_id );
		
		endif;
			
			
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) )
		{	 $i = 0;
			
			$html  = '<div class="part-img">';
			
			foreach ( $audio as $audio_html ) : $i++;
			
				if( $post_thumbnail_url != "" )
				{
					$html .= '<figure style="background: url(\''.esc_url( $post_thumbnail_url ).'\') no-repeat center center; background-size:cover;" class="entry-audio embed-responsive embed-responsive-16by9"><div class="audio-center">';
					
					$html .= wp_kses( $audio_html, $this->alowed_tags() );
					
					$html .= '</div></figure>';
					
				}else{
					
					$html .= wp_kses( $audio_html, $this->alowed_tags() );
					
				}
			
				if( $i == 1 ){ break; }
					
			endforeach;
			$html .= '</div>';
		}else {
			$html .= $this->get_image_thumbnail();
		}
		
		
		
		
		$html =  apply_filters( 'consted_shop_audio_thumbnail', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
	}
	
	
	/**
	 * Post formats video.
	 *
	 * @since 1.0.0
	 */
	public function get_video_thumbnail(){
		
		$content	 = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video 	  	 = false;
		$html 		 = '';
		
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
        
		if ( ! empty( $video ) ) 
		{	
			$html = '<div class="part-img">';
			$i = 0;
			
			foreach ( $video as $video_html ) {  $i++;
			
				$html  .=  '<div class="entry-video embed-responsive embed-responsive-16by9">';
				$html .= wp_kses( $video_html, $this->alowed_tags() );
				$html  .=  '</div>';
				
				if( $i == 1 ){ break; }
			}
			$html .= '</div>';
		}else
		{ 
			$html .= $this->get_image_thumbnail();
		}
		
		
		
		$html =  apply_filters( 'consted_shop_video_thumbnail', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
	}
	
	
	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	public function get_image_thumbnail(){
		$html = '';
		
		if ( has_post_thumbnail() ) :

			$html = '<div class="part-img">';
			$post_thumbnail_id  = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			
			
			
			if ( is_singular() )
			{
				$html  .=  '<a href="'.esc_url( $post_thumbnail_url ).'" class="image-popup thickbox">';
			} else
			{
				$html  .= '<a href="'.esc_url( get_permalink(get_the_ID()) ).'" class="image-link">';
			}
			
        	$html .= get_the_post_thumbnail( get_the_ID(), 'full' );
			$html .='</a>';
			$html .= '</div>';
        endif;
		

		
		
	
		$html =  apply_filters( 'consted_shop_image_thumbnail', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
	}
	
	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function single_post_navigation( ) {
		
		//if( empty(startup_shop_get_option('__single_post_nav')) ){ return false; }
		
		$html ='<div class="single-prev-next"><div class="row align-items-center">';
		$prevPost = get_previous_post();
		if( $prevPost ) :
			$html .= '<div class="col-md-6 col-sm-6"><div class="row align-items-center">';
			
				$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(60,60) );
				
				if( $prevthumbnail ){
					$html .= '<div class="col-md-3">'. get_previous_post_link('%link',$prevthumbnail). '</div>'; 
				}
				
				$html .='<div class="col-md-9"><h5>'.esc_html__('Previous Article','consted').'</h5>';
					$html .=get_previous_post_link('%link',"<span>%title</span>"); 
				$html .='</div>';
				
			$html .= '</div></div>';
			
		endif;
		$nextPost = get_next_post();
		if( $nextPost ) : 
			$html .= '<div class="col-md-6 col-sm-6"><div class="row align-items-center">';
			
				$html .='<div class="col-md-9 ml-auto align-right"><h5>'.esc_html__('Next Article','consted').'</h5>';
					$html .=get_next_post_link('%link',"<span>%title</span>");
				$html .='</div>';
				
				$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(60,60) );
			
				if( !empty( $nextthumbnail ) ){
					$html .= '<div class="col-md-3 align-right">'. get_previous_post_link('%link',$nextthumbnail). '</div>'; 
				}
				
			$html .= '</div></div>';
			
		endif;
		$html .='</div></div>';
		
		$html  	 = apply_filters( 'consted_single_post_navigation_filter', $html );
			
		echo wp_kses( $html, $this->alowed_tags() );
		
	} 
	
	
	private function alowed_tags(){
		
		if( function_exists('consted_alowed_tags') ){ 
			return consted_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
	
}

$consted_post_related_class = new Consted_Post_Related();