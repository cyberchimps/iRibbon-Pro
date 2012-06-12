<?php
/**
* Carousel section actions used by the CyberChimps Response Core Framework Pro Extension
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Pro
* @since 1.0
*/

add_action( 'response_index_carousel_section', 'response_carousel_section_content' );
add_action( 'response_carousel_section', 'response_carousel_section_content' );

function response_carousel_section_content() {

/* Call globals. */	

	global $themename, $themeslug, $options, $post, $wp_query;

/* End globals. */	

/* Define variables. */	

    $tmp_query = $wp_query;
	$root = get_template_directory_uri(); 
	$default = "$root/images/pro/carousel.jpg";
	
	if (is_page()) {
		$customcategory = get_post_meta($post->ID, $themeslug.'_carousel_category' , true);
		$speed = get_post_meta($post->ID, $themeslug.'_carousel_speed' , true);
	}
	else {
		$customcategory = $options->get($themeslug.'_carousel_category');
		$speed = $options->get($themeslug.'_carousel_speed');
	}
	
/* End define variables. */	 
?>
<div class="row-margin">
<div class="row-fluid">
	<div id="carousel" class="es-carousel-wrapper">
		<div class="es-carousel">
<?php 

/* Query posts  */

query_posts( array ('post_type' => $themeslug.'_featured_posts', 'showposts' => 50, true, 'carousel_categories' => $customcategory ));

/* End query posts based on theme/meta options */
    	
/* Establish post counter */  
  	
	if (have_posts()) : 
?>
	   <ul>
<?php
	    $i = 0;
	    $no = '50';
	    
/* End post counter */	    	

/* Initialize carousel markup */	

	while (have_posts() && $i<$no) : 

		the_post(); 

	    	/* Post-specific variables */	

	    	$image 		= get_post_meta($post->ID, $themeslug.'_post_image' , true);  
	    	$realtitle 		= get_the_title();  
	    	$link 		= get_post_meta($post->ID, $themeslug.'_post_url' , true);
	    	
	    	if ($realtitle != "Untitled") {
				$title = get_the_title();
			}
			else {
				$title =  '';
			}
			
			if ($image == '') {
				$image = $default;
			}
			/* End variables */	

	     	/* Markup for carousel */

?>	    	
			<li>
				<a href='$link' class='image-container'><img src='<?php echo $image; ?>' alt='$title'/></a>
	    		<div class='carousel_caption'><?php echo $title; ?></div>
	    	</li>
<?php
	    	/* End carousel markup */	

	      	$i++;
	      	endwhile; 
?>
		</ul>
		
<?php else: ?>
 		
 		<ul>
<?php	
	$i = 1;
	while ($i<9) :
?>	
	      	<li>
	      		<a href='#' class='image-container'><img src='<?php echo $default; ?>' alt='Post <?php echo $i;?>'/></a>
	      		<div class='carousel_caption'>Title <?php echo $i; ?></div>
	    	</li>
<?php
	$i++;
	endwhile;
?>
		</ul>
<?php
	endif; 	    
	$wp_query = $tmp_query;    

/* End slide creation */		

	wp_reset_query(); /* Reset post query */ ?>
	      
	<script type="text/javascript">
			 jQuery(document).ready(function ($) {
			$('#carousel').elastislide({
				imageW 		: 140,
				speed 		: <?php echo $speed;?>,
				margin		: 8,
				minItems 	: 5
			});
			});
			
		</script>


		</div>
	</div>
</div>
</div>
<?php
}

/**
* End
*/

?>