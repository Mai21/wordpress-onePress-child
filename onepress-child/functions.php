<?php
/**
 * onePress-child functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage onePress-child
 * @since onePress-child 1.0
 */

/**
 * Table of Contents:
 * Theme Setting
 * Add shortcode [mypage]
 * 
 */


/* Theme Setting */

/* set css, add light box css */
add_action( 'wp_enqueue_scripts', 'onepress_child_enqueue_styles', 15 );
function onepress_child_enqueue_styles() {
    wp_enqueue_style( 'onepress-child-style', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'lightbox-style', get_stylesheet_directory_uri() . '/assets/css/lightbox.min.css',"",'20200701');
}

/* custormize logo, customizer, header */
add_action( 'after_setup_theme', 'override_functions' );
function override_functions() {
   /* remove setting from parent theme */
   remove_action('customize_register', 'onepress_customize_register');
   remove_action( 'get_custom_logo', 'onepress_add_retina_logo');
   remove_action( 'onepress_site_start', 'onepress_site_header' );

   /* add setting */
   require get_stylesheet_directory() . '/inc/template-tags.php';
   require get_stylesheet_directory() . '/inc/customizer.php';
  }

/* add web font */
add_action ('wp_head','add_wp_head',2);
function add_wp_head (){
   echo '<link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet">';
 }
 
/* Add lightbox js */
add_action('wp_enqueue_scripts', 'add_script');
function add_script() {
   wp_register_script( 'lightbox', get_stylesheet_directory_uri() . '/assets/js/lightbox.min.js', array( 'jquery' ), '', false);
   wp_enqueue_script('lightbox');
}

/* queue index.js*/
add_action( 'wp_enqueue_scripts', 'onepress_child_register_scripts' );
function onepress_child_register_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	if ((! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ){
    	wp_enqueue_script( 'comment-reply' );
   }
	wp_enqueue_script( 'onepress-theme-child-js', get_stylesheet_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'onepress-theme-child-js', 'async', true );
}

/* -----------------------------------------------------------------------------
short code for inserting the other page to the page
[mypage page_id=123(required) title=yes(option)]
-------------------------------------------------------------------------------- */
add_shortcode("mypage", "insert_page");
function insert_page($atts) {
   extract(shortcode_atts(array(
           "page_id" => '1',
           "title" =>''
   ), $atts));
   $content = get_post($page_id);
   $rtn = $content->post_content;
   $rtn_title = $content->post_title;
   // if it's blank only in the content, return no tag
   $search = array('<!-- wp:paragraph -->','<p>','</p>','<!-- /wp:paragraph -->');
   $replace = array('','','','');

   if(trim(str_replace($search,$replace,$rtn)) == ''){
      return;
   }else{
      $content_tag = apply_filters('the_content', $rtn);
   }
   // if title include, add title
   if($title){
      $title_tag = '<h2>' . $rtn_title . '</h2>';
   }else{
      $title_tag = '';
   }
   return $title_tag . $content_tag ;
}

/* insert default block-templage in post */
add_action( 'init', 'myplugin_register_template' );
function myplugin_register_template() {
    $post_type_object = get_post_type_object( 'post' );
    $post_type_object->template = array(
        array( 'core/image' ),
    );
}

/* meta box for portfolio */
add_filter( 'rwmb_meta_boxes', 'portfolio_register_meta_boxes' );
function portfolio_register_meta_boxes( $meta_boxes ) {
    $prefix = 'prefix-';
    $meta_boxes[] = [
        'title'      => esc_html__( 'Gallery', 'online-generator' ),
        'id'         => 'gallery',
        'post_types' => ['page'],
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => [
         [
             'type'       => 'image_advanced',
             'id'         => $prefix . 'image_photo_portrait',
             'name'       => esc_html__( 'Image Photo Portrait', 'online-generator' ),
             'max_status' => false,
         ],
         [
             'type'       => 'image_advanced',
             'id'         => $prefix . 'image_photo_landscape',
             'name'       => esc_html__( 'Image Photo Landscape', 'online-generator' ),
             'max_status' => false,
         ],
         [
             'type'       => 'image_advanced',
             'id'         => $prefix . 'image_photo_table',
             'name'       => esc_html__( 'Image Photo Table', 'online-generator' ),
             'max_status' => false,
         ],
         [
             'type'       => 'oembed',
             'id'         => $prefix . 'oembed_video_event',
             'name'       => esc_html__( 'oEmbed Video Event', 'online-generator' ),
             'max_status' => false,
         ],
         [
            'type'       => 'oembed',
            'id'         => $prefix . 'oembed_video_online',
            'name'       => esc_html__( 'oEmbed Video Online Lesson', 'online-generator' ),
            'max_status' => false,
        ],
        [
            'type'       => 'oembed',
            'id'         => $prefix . 'oembed_video_promo',
            'name'       => esc_html__( 'oEmbed Video Promotion', 'online-generator' ),
            'max_status' => false,
         ],
         [
             'type'       => 'image_advanced',
             'id'         => $prefix . 'image_web',
             'name'       => esc_html__( 'Image Web', 'online-generator' ),
             'max_status' => false,
         ],
         [
             'type'       => 'image_advanced',
             'id'         => $prefix . 'image_design_card',
             'name'       => esc_html__( 'Image Design Cards', 'online-generator' ),
             'max_status' => false,
         ],
         [
            'type'       => 'image_advanced',
            'id'         => $prefix . 'image_design_bro',
            'name'       => esc_html__( 'Image Design Brochure', 'online-generator' ),
            'max_status' => false,
        ],
        [
            'type'       => 'image_advanced',
            'id'         => $prefix . 'image_design_banner',
            'name'       => esc_html__( 'Image Design Banner', 'online-generator' ),
            'max_status' => false,
         ],
      ],
   ];
    return $meta_boxes;
}


/* admin page */
/* add css to admin page */
 add_action('admin_head', 'my_custom_design');
 /** this is for changing a place of custom field from the middle to bottom */
 function my_custom_design() {
      echo '<style>
   .post-type-page .edit-post-layout__metaboxes{
      height: 30vh;
   }
   
   .post-type-page .editor-styles-wrapper{
      height: initial !important;
   }
   
   .post-type-page .block-editor-writing-flow__click-redirect{
      min-height: initial !important;
   }
      </style>';
 }

 /* add javascript to admin head */
add_action('admin_head', 'my_custom_script');
function my_custom_script() {
   echo '<script src="' . get_stylesheet_directory_uri() . '/assets/js/admin.js"></script>';
}
 /* admin page */