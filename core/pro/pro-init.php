<?php
/**
* CyberChimps Response Core Framework Pro Init
*
* Authors: Tyler Cunningham
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

//Define custom core functions
require_once ( get_template_directory() . '/core/pro/pro-functions.php' );

//Define the core hooks
require_once ( get_template_directory() . '/core/pro/pro-hooks.php' );

//Call actions
require_once ( get_template_directory() . '/core/pro/actions/box-actions.php' );
require_once ( get_template_directory() . '/core/pro/actions/callout-actions.php' );
require_once ( get_template_directory() . '/core/pro/actions/header-actions.php' );
require_once ( get_template_directory() . '/core/pro/actions/carousel-actions.php' );
require_once ( get_template_directory() . '/core/pro/actions/slider-actions.php' );

//Call Extras
require_once ( get_template_directory() . '/core/pro/includes/shortcodes.php' );

/**
* End
*/
		    
?>