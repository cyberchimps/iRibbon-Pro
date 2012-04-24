<?php
/**
* CyberChimps Response Core Framework Pro Extension functions
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

/**
* Load jQuery and register additional scripts.
*/ 
function response_pro_scripts() {	
	$path =  get_template_directory_uri() ."/core/pro/library/";
	
	wp_register_script( 'easing' ,$path.'js/jquery.easing.1.3.js');
	wp_register_script( 'elastislide' ,$path.'js/jquery.elastislide.js');
	wp_register_script( 'nivoslider' ,$path.'js/jquery.nivo.slider.js');

	
	wp_enqueue_script ('easing');
	wp_enqueue_script ('elastislide');
	wp_enqueue_script ('nivoslider');
}
add_action('wp_enqueue_scripts', 'response_pro_scripts');	

/**
* End
*/
		    
?>