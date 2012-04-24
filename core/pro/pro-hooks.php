<?php
/**
* Initializes the CyberChimps Response Core Framework Pro Extension 
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
* Box Section
*/
function response_box_section() {
	do_action ('response_box_section');
}

/** 
* Callout Section
*/
function response_callout_section() {
	do_action ('response_callout_section');
}

/** 
* Carousel Section
*/
function response_index_carousel_section() {
	do_action ('response_index_carousel_section');
}

function response_carousel_section() {
	do_action ('response_carousel_section');
}

/** 
* Entry 
*/
function response_pro_before_entry() {
	do_action('response_pro_before_entry');
}

function response_pro_entry() {
	do_action('response_pro_entry');
}

/** 
* Slider
*/
function response_blog_slider() {
	do_action ('response_blog_slider');
}
function response_blog_content_slider() {
	do_action ('response_blog_content_slider');
}
function response_page_slider() {
	do_action ('response_page_slider');
}
function response_page_content_slider() {
	do_action ('response_page_content_slider');
}

function response_blog_nivoslider() {
	do_action ('response_blog_nivoslider');
}

function response_page_nivoslider() {
	do_action ('response_page_nivoslider');
}

/** 
* Header Elements
*/
function response_header_contact_area() {
	do_action('response_header_contact_area');
}

function response_logo_contact() {
	do_action('response_logo_contact');
}

function response_description_icons() {
	do_action('response_description_icons');
}

function response_logo_menu() {
	do_action('response_logo_menu');
}

function response_logo_description() {
	do_action('response_logo_description');
}

/**
* End
*/
		    
?>