<?php
/**
* Box section actions used by the CyberChimps Response Core Framework Pro Extension
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
* Response Box Section actions
*/
add_action( 'response_box_section', 'response_box_section_content' );

/**
* Sets up the Box Section wigetized area
*
* @since 1.0
*/
function response_box_section_content() { 
	global $post; //call globals
	
	$enableboxes = get_post_meta($post->ID, 'enable_box_section' , true);
	$root = get_template_directory_uri(); ?>
	
<div class="row-fluid boxes-row">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Left") ) : ?>
			<div class="box_outer_container span4">
      <div id="box1" class="iribbon-box">
      <div class="ribbon-top">
      <div class="ribbon-top-end"></div>
				<h3 class="box-widget-title">Box Left</h3>
        <div class="ribbon-shadow"></div>
        </div><!-- ribbon top -->
				<div class="textwidget">This is the box left widgetized area.</div>
				<div class="ribbon-bottom">
        <div class="ribbon-shadow"></div>
        <div class="ribbon-bottom-end"></div>
        </div><!-- ribbon bottom -->
        </div><!-- iribbon box -->
        </div><!--end box1 -->
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Middle") ) : ?>
      <div class="box_outer_container span4">
			<div id="box2" class="iribbon-box">
        <div class="ribbon-top">
      <div class="ribbon-top-end"></div>
				<h3 class="box-widget-title">Box Middle</h3>
        <div class="ribbon-shadow"></div>
        </div><!-- ribbon top -->
				<div class="textwidget">This is the box middle widgetized area.</div>
				<div class="ribbon-bottom">
        <div class="ribbon-shadow"></div>
        <div class="ribbon-bottom-end"></div>
        </div><!-- ribbon bottom -->
        </div><!-- iribbon box -->
        </div><!--end box2-->
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Right") ) : ?>
      <div class="box_outer_container span4">
			<div id="box3" class="iribbon-box">
        <div class="ribbon-top">
      <div class="ribbon-top-end"></div>
				<h3 class="box-widget-title">Box right</h3>
        <div class="ribbon-shadow"></div>
        </div><!-- ribbon top -->
				<div class="textwidget">This is the box right widgetized area.</div>
				<div class="ribbon-bottom">
        <div class="ribbon-shadow"></div>
        <div class="ribbon-bottom-end"></div>
        </div><!-- ribbon bottom -->
        </div><!-- iribbon box -->
        </div><!--end box3-->
		<?php endif; ?>
</div><!-- fluid row -->
<?php
	}


/**
* End
*/

?>