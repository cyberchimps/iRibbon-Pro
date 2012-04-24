<?php
/**
* Header section actions used by the CyberChimps Response Core Framework Pro Extension
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

remove_action( 'response_after_head_tag', 'response_font' );
add_action( 'response_after_head_tag', 'response_pro_font' );

add_action( 'response_header_contact_area', 'response_header_contact_area_content' );
add_action( 'response_logo_contact', 'response_logo_contact_content');
add_action( 'response_description_icons', 'response_description_icons_content');
add_action( 'response_logo_menu', 'response_logo_menu_content');
add_action( 'response_logo_description', 'response_logo_description_content');

/**
* Establishes the Pro theme font family.
*
* @since 1.0
*/
function response_pro_font() {
	global $themeslug, $options; //Call global variables
	$family = apply_filters( 'response_default_font_family', 'Helvetica, sans-serif' );
	
	if ($options->get($themeslug.'_font') == "" AND $options->get($themeslug.'_custom_font') == "") {
		$font = apply_filters( 'response_default_font', 'Arial' );
	}		
	elseif ($options->get($themeslug.'_custom_font') != "" && $options->get($themeslug.'_font') == 'custom') {
		$font = $options->get($themeslug.'_custom_font');	
	}	
	else {
		$font = $options->get($themeslug.'_font'); 
	} ?>
	
	<body style="font-family:'<?php echo ereg_replace("[^A-Za-z0-9]", " ", $font ); ?>', <?php echo $family; ?>" <?php body_class(); ?> > <?php
}

/**
* Sets up the header contact area
*
* @since 1.0
*/
function response_header_contact_area_content() { 
	global $themeslug, $options; 
	$contactdefault = apply_filters( 'response_header_contact_default_text', 'Enter Contact Information Here' ); 
	
	if ($options->get($themeslug.'_header_contact') == '' ) {
		echo "<div id='header_contact'>";
			printf( __( $contactdefault, 'response' )); 
		echo "</div>";
	}
	if ($options->get($themeslug.'_header_contact') != 'hide' ) {
		echo "<div id='header_contact1'>";
		echo stripslashes ($options->get($themeslug.'_header_contact')); 
		echo "</div>";
	}	
	if ($options->get($themeslug.'_header_contact') == 'hide' ) {
		echo "<div style ='height: 10%;'>&nbsp;</div> ";
	}
}

/**
* Sitename/Contact
*
* @since 1.0
*/
function response_sitename_contact_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="five columns">
			
			<!-- Begin @Core header contact area hook -->
			<?php response_header_contact_area(); ?>
		<!-- End @Core header contact area hook -->
						
			</div>	
		</div><!--end row-->
	</div>
	
<?php
}

/**
* Description/Icons
*
* @since 1.0
*/
function response_description_icons_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="five columns">
				
			<!-- Begin @Core header description hook -->
				<?php response_header_site_description(); ?> 
			<!-- End @Core header description hook -->
			
				
			</div>	
			
			<div class="seven columns">
			
			<!-- Begin @Core header social icon hook -->
				<?php response_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
						
			</div>	
		</div><!--end row-->
	</div>	

<?php
}

/**
* Description/Icons
*
* @since 3.0
*/
function response_logo_menu_content() {
?>
	
	<div class="container">
		<div class="row">	
			
			<div class="five columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
			</div>	
			
			<div class="seven columns">
			<div id="halfnav">
			<?php wp_nav_menu( array(
		    'theme_location' => 'sub-menu' // Setting up the location for the main-menu, Main Navigation.
			    )
			);
	    	?>
			</div>					
			</div>	
		
		</div><!--end row-->
	</div>
<?php
}

/**
* Logo/Description
*
* @since 3.0
*/
function response_logo_description_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
			<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
			<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="five columns" style="text-align: right;">
			
			<!-- Begin @Core header description hook -->
				<?php response_header_site_description(); ?> 
			<!-- End @Core header description hook -->
						
			</div>	
		</div><!--end row-->
	</div>	

<?php
}

/**
* End
*/

?>