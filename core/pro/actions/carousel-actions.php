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
		$customcategory = get_post_meta($post->ID, 'carousel_category' , true);
		$speed = get_post_meta($post->ID, 'carousel_speed' , true);
	}
	else {
		$customcategory = $options->get($themeslug.'_carousel_category');
		$speed = $options->get($themeslug.'_carousel_speed');
	}
	
/* End define variables. */	 
?>

<div class="row">
	<div id="carousel" class="es-carousel-wrapper">
		<div class="es-carousel"><?php 

/* Query posts  */

query_posts( array ('post_type' => $themeslug.'_featured_posts', 'showposts' => 50, true, 'carousel_categories' => $customcategory ));

/* End query posts based on theme/meta options */
    	
/* Establish post counter */  
  	
	if (have_posts()) :
	    $out = "
	   <ul>
	    
	    "; 
	    $i = 0;

		    $no = '50';


/* End post counter */	    	

/* Initialize slide creation */	

	while (have_posts() && $i<$no) : 

		the_post(); 

	    	/* Post-specific variables */	

	    	$image 		= get_post_meta($post->ID, 'post_image' , true);  
	    	$realtitle 		= get_the_title();  
	    	$link 		= get_post_meta($post->ID, 'post_url' , true);
	    	
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

	    	$out .= "
	    	
				<li>
	    			<a href='$link'>	
	    				<img src='$image' alt='$title'/>
	    			</a>
	    			<div class='carousel_caption'>$title</div>
	    		</li>
	    	
	    	";

	    	/* End slide markup */	

	      	$i++;
	      	endwhile;
	      	$out .= "</ul>";	 
	      	
	      	else:
	      
	      	$out .= "	
	    	<ul>
	      			<li>
	      				
	    				<img src='$default' alt='Post 1'/>
	    				
	    			</li>
					<li>
	    				<img src='$default' alt='Post 2' />
	    			</li>
					<li>
	    				<img src='$default' alt='Post 3' />
	    			</li>
					<li>
	    				<img src='$default' alt='Post 4' />
	    			</li>
					<li>
	    				<img src='$default' alt='Post 5' />
	    			</li>
	    			
	    			<li>
	    				<img src='$default' alt='Post 6' />
	    			</li>
	    			
	    			<li>
	    				<img src='$default' alt='Post 6' />
	    			</li>

					<li>
	    				<img src='$default' alt='Post 6' />
	    			</li>
		
	    	</ul>
	    				
	    				
	    			";
     
	endif; 	    
	$wp_query = $tmp_query;    

/* End slide creation */		

	    wp_reset_query(); /* Reset post query */ 

/* Begin Carousel javascript */ 
    
    $out .= <<<OUT
	<script type="text/javascript">
			 jQuery(document).ready(function ($) {
			$('#carousel').elastislide({
				imageW 		: 145,
				speed 		: $speed,
				margin		: 9,
				minItems 	: 5
			});
			});
			
		</script>
OUT;

/* End Carousel javascript */ 

echo $out;

/* END */ 
?>

		</div>
	</div>
</div> <?php

}

/**
* End
*/

?>