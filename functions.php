<?php
/*
	Functions
	Author: Tyler Cunningham
	Establishes the core theme functions.
	Copyright (C) 2011 CyberChimps
	Version 3.0
*/

/**
* Define global theme functions.
*/ 
	$themename = 'iribbon';
	$themenamefull = 'iRibbon Pro';
	$themeslug = 'ir';
	$pagedocs = 'http://cyberchimps.com/question/using-the-response-pro-page-options/';
	$sliderdocs = 'http://cyberchimps.com/question/how-to-use-the-feature-slider-in-response-pro/';
	$root = get_template_directory_uri(); 
	
/**
* Assign new default font.
*/ 
function ribbon_default_font( $font ) {
	$font = 'Georgia';
	return $font;
}
add_filter( 'iribbon_default_font', 'ribbon_default_font' );

	
/**
* Basic theme setup.
*/ 
function iribbon_theme_setup() {
	global $content_width;
	
	if ( ! isset( $content_width ) ) $content_width = 580; //Set content width
	
	add_theme_support(
		'post-formats',
		array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);

	add_theme_support( 'post-thumbnails' );
	add_theme_support('automatic-feed-links');
	add_editor_style();
	
	if ( function_exists('get_custom_header')) {
        add_theme_support('custom-background');
	} 
	else {
       	add_custom_background(); //For WP 3.3 and below.	
	}
}
add_action( 'after_setup_theme', 'iribbon_theme_setup' );

/**
* Redirect user to theme options page after activation.
*/ 
if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
	wp_redirect( 'themes.php?page=iribbon' );
}

/**
* Add link to theme options in Admin bar.
*/ 
function iribbon_admin_link() {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'iRibbon', 'title' => 'iRibbon Pro Options', 'href' => admin_url('themes.php?page=iribbon')  ) ); 
}
add_action( 'admin_bar_menu', 'iribbon_admin_link', 113 );

/**
* Custom markup for gallery posts in main blog index.
*/ 
function iribbon_custom_gallery_post_format( $content ) {
	global $options, $themeslug, $post;
	$root = get_template_directory_uri(); 
	
	ob_start();?>
			<div class="ribbon-top">
      <div class="ribbon-more">
      </div>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <div class="ribbon-shadow"></div><!-- ribbon shadow -->
         </div><!-- ribbon top -->
			<article class="post_container">
      <div class="ribbon-shadow"></div><!-- ribbon shadow -->
		<?php if ($options->get($themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/gallery.png" />
			</div><!--end format-icon-->
		<?php endif;?>
					<!--Call @Core Meta hook-->
			<?php response_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' && !is_single() ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
				
				<?php if (!is_single()): ?>
				<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>

				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					<br /><br />
					This gallery contains <?php echo $total_images ; ?> images
					<?php endif;?>
				</figure><!-- .gallery-thumb -->
				<?php endif;?>
				
				<?php if (is_single()): ?>
					<?php the_content(); ?>
				<?php endif;?>
				</div><!--end entry-->
				
        </article><!--end post container-->
				<div class="clear">&nbsp;</div>
	<?php	
	$content = ob_get_clean();
	
	return $content;
}
add_filter('iribbon_post_formats_gallery_content', 'iribbon_custom_gallery_post_format' ); 
	
/**
* Set custom post excerpt link text based on theme option.
*/ 
function iribbon_excerpt_link($more) {

	global $themename, $themeslug, $options, $post;
    
    	if ($options->get($themeslug.'_excerpt_link_text') == '') {
    		$linktext = '(Read More...)';
   		}
    	else {
    		$linktext = $options->get($themeslug.'_excerpt_link_text');
   		}

	return '<a href="'. get_permalink($post->ID) . '"> <br /><br /> '.$linktext.'</a>';
}
add_filter('excerpt_more', 'iribbon_excerpt_link');

/**
* Set custom post excerpt length based on theme option.
*/ 
function iribbon_excerpt_length($length) {

	global $themename, $themeslug, $options;
	
		if ($options->get($themeslug.'_excerpt_length') == '') {
    		$length = '55';
    	}
    	else {
    		$length = $options->get($themeslug.'_excerpt_length');
    	}
    	
	return $length;
}
add_filter('excerpt_length', 'iribbon_excerpt_length');

/**
* Custom featured image size based on theme options.
*/ 
function iribbon_featured_image() {	
	if ( function_exists( 'add_theme_support' ) ) {
	
	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_featured_image_height') == '') {
		$featureheight = '100';
	}		
	else {
		$featureheight = $options->get($themeslug.'_featured_image_height'); 
	}
	if ($options->get($themeslug.'_featured_image_width') == "") {
			$featurewidth = '100';
	}		
	else {
		$featurewidth = $options->get($themeslug.'_featured_image_width'); 
	} 
	set_post_thumbnail_size( $featurewidth, $featureheight, true );
	}	
}
add_action( 'init', 'iribbon_featured_image', 11);	

/**
* Attach CSS3PIE behavior to elements
*/   
function iribbon_pie() { ?>
	
	<style type="text/css" media="screen">
		#wrapper input, textarea, #twitterbar, input[type=submit], input[type=reset], #imenu, .searchform, .post_container, .postformats, .postbar, .post-edit-link, .widget-container, .widget-title, .footer-widget-title, .comments_container, ol.commentlist li.even, ol.commentlist li.odd, .slider_nav, ul.metabox-tabs li, .tab-content, .list_item, .section-info, #of_container #header, .menu ul li a, .submit input, #of_container textarea, #of_container input, #of_container select, #of_container .screenshot img, #of_container .of_admin_bar, #of_container .subsection > h3, .subsection, #of_container #content .outersection .section, #carousel_list, #calloutwrap, #calloutbutton, .box1, .box2, .box3, .es-carousel-wrapper, #halfnav ul li a, #halfnav ul li a:hover, #halfnav li.current_page_item a, #halfnav li.current_page_item ul li a, .pagination span, .pagination a, .pagination a:hover, .pagination .current, #nav, .nav-shadow, .sd_left_sidebar div.ribbon-top, .sd_left_sidebar div.ribbon-shadow, .sd_left_sidebar div.ribbon-more, .sd_right_sidebar div.ribbon-top, .sd_right_sidebar div.ribbon-more, .sd_right_sidebar div.ribbon-extra, .sd_right_sidebar div.ribbon-shadow, .ribbon-bottom, .ribbon-bottom-end, .ribbon-bg-blue, .ribbon-bg-blue .ribbon-shadow, .ribbon-left-blue, .ribbon-right-blue, .searchform .iRibbon-search
  		
  	{
  		behavior: url('<?php echo get_template_directory_uri();  ?>/core/library/pie/PIE.php');
	}
	</style>
<?php
}

add_action('wp_head', 'iribbon_pie', 8);

/**
* Custom post types for Slider, Carousel.
*/ 
function iribbon_create_post_type() {

	global $themename, $themeslug, $options, $root;
	
	register_post_type( $themeslug.'_custom_slides',
		array(
			'labels' => array(
				'name' => __( 'Feature Slides' ),
				'singular_name' => __( 'Slides' )
			),
			'public' => true,
			'show_ui' => true, 
			'exclude_from_search' => true,
			'supports' => array('custom-fields', 'title'),
			'taxonomies' => array( 'slide_categories'),
			'has_archive' => true,
			'menu_icon' => "$root/images/pro/slider.png",
			'rewrite' => array('slug' => 'slides')
		)
	);
	
	register_post_type( $themeslug.'_featured_posts',
		array(
			'labels' => array(
				'name' => __( 'Carousel' ),
				'singular_name' => __( 'Posts' )
			),
			'public' => true,
			'show_ui' => true, 
			'exclude_from_search' => true,
			'supports' => array('custom-fields'),
			'taxonomies' => array( 'carousel_categories'),
			'has_archive' => true,
			'menu_icon' => "$root/images/pro/carousel.png",
			'rewrite' => array('slug' => 'slides')
		)
	);
}
add_action( 'init', 'iribbon_create_post_type' );

/**
* Custom taxonomies for Slider, Carousel.
*/ 
function iribbon_custom_taxonomies() {

	global $themename, $themeslug, $options;
	
	register_taxonomy(
		'slide_categories',		
		$themeslug.'_custom_slides',		
		array(
			'hierarchical' => true,
			'label' => 'Slide Categories',	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'slide_categories' ),	
		)
	);
	register_taxonomy(
		'carousel_categories',		
		$themeslug.'_carousel_categories',		
		array(
			'hierarchical' => true,
			'label' => 'Carousel Categories',	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'carousel_categories' ),	
		)
	);
}
add_action('init', 'iribbon_custom_taxonomies', 0);

/**
* Assign default category for Slider, Carousel posts.
*/ 
function iribbon_custom_taxonomy_default( $post_id, $post ) {

	global $themename, $themeslug, $options;	

	if( 'publish' === $post->post_status ) {

		$defaults = array(

			'slide_categories' => array( 'default' ), 'carousel_categories' => array( 'default' ),

			);

		$taxonomies = get_object_taxonomies( $post->post_type );

		foreach( (array) $taxonomies as $taxonomy ) {

			$terms = wp_get_post_terms( $post_id, $taxonomy );

			if( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {

				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );

			}
		}
	}
}

add_action( 'save_post', 'iribbon_custom_taxonomy_default', 100, 2 );

/**
* Add TypeKit support based on theme option.
*/ 
function iribbon_typekit_support() {
	global $themename, $themeslug, $options;
	
	$embed = $options->get($themeslug.'_typekit');
	
	echo stripslashes($embed);

}
add_action('wp_head', 'iribbon_typekit_support');

/**
* Add Google Analytics support based on theme option.
*/ 
function iribbon_google_analytics() {
	global $themename, $themeslug, $options;
	
	echo stripslashes ($options->get($themeslug.'_ga_code'));

}
add_action('wp_head', 'iribbon_google_analytics');

/**
* Add custom header scripts support based on theme option.
*/ 
function iribbon_custom_scripts() {
	global $themename, $themeslug, $options;
	
	echo stripslashes ($options->get($themeslug.'_custom_header_scripts'));

}
add_action('wp_head', 'iribbon_custom_scripts');

	
/**
* Register custom menus for header, footer.
*/ 
function iribbon_register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu' ), 'footer-menu' => __( 'Footer Menu' ), 'sub-menu' => __( 'Sub Menu' ), 'mobile-menu' => __( 'Mobile Menu' ) )
	);
}
add_action( 'init', 'iribbon_register_menus' );
	
/**
* Menu fallback if custom menu not used.
*/ 
function iribbon_menu_fallback() {
	global $post; ?>
	
  <div id="nav">
	<ul id="nav_menu">
		<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul>
	</div><?php
}
/**
* Register widgets.
*/ 
function iribbon_widgets_init() {
    register_sidebar(array(
    	'name' => 'Full Sidebar',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the full sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container"><div class="ribbon-cut-blue"></div><div class="ribbon-bg-blue"><div class="ribbon-left-blue"></div><div class="ribbon-shadow"></div><div class="ribbon-right-blue"></div></div>',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));
    register_sidebar(array(
    	'name' => 'Left Half Sidebar',
    	'id'   => 'sidebar-left',
    	'description'   => 'These are widgets for the left half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container"><div class="ribbon-cut-blue"></div><div class="ribbon-bg-blue"><div class="ribbon-left-blue"></div><div class="ribbon-shadow"></div><div class="ribbon-right-blue"></div></div>',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));    	
    register_sidebar(array(
    	'name' => 'Right Half Sidebar',
    	'id'   => 'sidebar-right',
    	'description'   => 'These are widgets for the right half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container"><div class="ribbon-cut-blue"></div><div class="ribbon-bg-blue"><div class="ribbon-left-blue"></div><div class="ribbon-shadow"></div><div class="ribbon-right-blue"></div></div>',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
   	));
    	
    register_sidebar(array(
		'name' => 'Box Left',
		'id' => 'box-left',
		'description' => 'This is the left widget of the three-box section',
		'before_widget' => '<div class="box_outer_container span4"><div id="box1" class="iribbon-box">',
		'after_widget' => '<div class="ribbon-bottom"><div class="ribbon-shadow"></div><div class="ribbon-bottom-end"></div></div></div></div>',
		'before_title' => '<div class="ribbon-top"><div class="ribbon-top-end"></div><h3 class="box-widget-title">',
		'after_title' => '</h3><div class="ribbon-shadow"></div></div>',
	));
	register_sidebar(array(
		'name' => 'Box Middle',
		'id' => 'box-middle',
		'description' => 'This is the middle widget of the three-box section',
		'before_widget' => '<div class="box_outer_container span4"><div id="box2" class="iribbon-box">',
		'after_widget' => '<div class="ribbon-bottom"><div class="ribbon-shadow"></div><div class="ribbon-bottom-end"></div></div></div></div>',
		'before_title' => '<div class="ribbon-top"><div class="ribbon-top-end"></div><h3 class="box-widget-title">',
		'after_title' => '</h3><div class="ribbon-shadow"></div></div>',
	));
	register_sidebar(array(
		'name' => 'Box Right',
		'id' => 'box-right',
		'description' => 'This is the right widget of the three-box section',
		'before_widget' => '<div class="box_outer_container span4"><div id="box3" class="iribbon-box">',
		'after_widget' => '<div class="ribbon-bottom"><div class="ribbon-shadow"></div><div class="ribbon-bottom-end"></div></div></div></div>',
		'before_title' => '<div class="ribbon-top"><div class="ribbon-top-end"></div><h3 class="box-widget-title">',
		'after_title' => '</h3><div class="ribbon-shadow"></div></div>',
	));
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer-widgets',
		'description' => 'These are the footer widgets',
		'before_widget' => '<div class="span3 footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action ('widgets_init', 'iribbon_widgets_init');

/**
* Returning whether any of the Post meta is turned on. Allowing for styling to be turned on and off
*/

function iRibbon_post_meta()
{
	global $options, $themeslug; //call globals.  
	if (is_single()) {
		$hidden = $options->get($themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($themeslug.'_hide_byline'); 
	}
	$link_pages = wp_link_pages( array( 'echo' => 0 ) );
	
	if( $hidden[$themeslug.'_hide_comments'] != '0' ||
			$link_pages != '' ||
			$hidden[$themeslug.'_hide_tags'] != 0 && has_tag()
		)
		{
			return 1;
		}
		else {
			return 0;
		}
}

/**
* Initialize response Core Framework and Pro Extension.
*/ 
require_once ( get_template_directory() . '/core/core-init.php' );
require_once ( get_template_directory() . '/core/pro/pro-init.php' );

/**
* Call additional files required by theme.
*/ 
require_once ( get_template_directory() . '/includes/classy-options-init.php' ); // Theme options markup.
require_once ( get_template_directory() . '/includes/options-functions.php' ); // Custom functions based on theme options.
require_once ( get_template_directory() . '/includes/meta-box.php' ); // Meta options markup.
require_once ( get_template_directory() . '/includes/update.php' ); // Notify user of theme update on "Updates" page in Dashboard.

// Presstrends
function presstrends() {

// Add your PressTrends and Theme API Keys
$api_key = 'zwhgyc1lnt56hki8cpwobb47bblas4er226b';
$auth = 'ulc38mkshvmycifb7lzmvsz6354gi18zg';

// NO NEED TO EDIT BELOW
$data = get_transient( 'presstrends_data' );
if (!$data || $data == ''){
$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
$url = $api_base . $auth . '/api/' . $api_key . '/';
$data = array();
$count_posts = wp_count_posts();
$count_pages = wp_count_posts('page');
$comments_count = wp_count_comments();
if ( function_exists('get_custom_header')) {
	$theme_data = wp_get_theme();
	} 
else {
	$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');	
}

$plugin_count = count(get_option('active_plugins'));
$all_plugins = get_plugins();
foreach($all_plugins as $plugin_file => $plugin_data) {
$plugin_name .= $plugin_data['Name'];
$plugin_name .= '&';
}
$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
$data['posts'] = $count_posts->publish;
$data['pages'] = $count_pages->publish;
$data['comments'] = $comments_count->total_comments;
$data['approved'] = $comments_count->approved;
$data['spam'] = $comments_count->spam;
$data['theme_version'] = $theme_data['Version'];
$data['theme_name'] = $theme_data['Name'];
$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
$data['plugins'] = $plugin_count;
$data['plugin'] = urlencode($plugin_name);
$data['wpversion'] = get_bloginfo('version');
foreach ( $data as $k => $v ) {
$url .= $k . '/' . $v . '/';
}
$response = wp_remote_get( $url );
set_transient('presstrends_data', $data, 60*60*24);
}}
add_action('admin_init', 'presstrends');

/**
* End
*/

?>