<?php
/**
 *	Description	of	view_shortcodes.php
 *
 *	@author	loudshoorn
 */
//	Add	the	main	view	shortcode
add_shortcode('crm_main_view','load_main_view');
function load_main_view( $atts, $content = NULL){
    // Include the main view
    include CRM_PLUGIN_PLUGIN_INCLUDES_VIEWS_DIR.
        '/crm_main_view.php';
}