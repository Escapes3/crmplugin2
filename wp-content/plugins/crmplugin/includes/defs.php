<?php
/**
 * Definitions needed in the plugin
 *
 * @author
 * @version 0.1
 *
 * Version history
 * 0.1 Initial version
 */
// De versie moet gelijk zijn met het versie nummer in de my-eventorganiser.php header
define( 'CRM_PLUGIN_VERSION', '0.0.1' );
// Minimum required Wordpress version for this plugin
define( 'CRM_PLUGIN_REQUIRED_WP_VERSION', '4.0' );
define( 'CRM_PLUGIN_PLUGIN_BASENAME', plugin_basename(CRM_PLUGIN_PLUGIN ) );
define( 'CRM_PLUGIN_PLUGIN_NAME', trim( dirname(CRM_PLUGIN_PLUGIN_BASENAME ), '/' ) );
// Folder structure
define( 'CRM_PLUGIN_PLUGIN_DIR', untrailingslashit( dirname(CRM_PLUGIN_PLUGIN ) ) );
define( 'CRM_PLUGIN_PLUGIN_INCLUDES_DIR', CRM_PLUGIN_PLUGIN_DIR . '/includes' );
define( 'CRM_PLUGIN_PLUGIN_MODEL_DIR', CRM_PLUGIN_PLUGIN_INCLUDES_DIR . '/model' );
define( 'CRM_PLUGIN_PLUGIN_ADMIN_DIR', CRM_PLUGIN_PLUGIN_DIR . '/admin' );
define( 'CRM_PLUGIN_PLUGIN_ADMIN_VIEWS_DIR', CRM_PLUGIN_PLUGIN_ADMIN_DIR . '/views' );
define(	'CRM_PLUGIN_PLUGIN_INCLUDES_VIEWS_DIR', CRM_PLUGIN_PLUGIN_INCLUDES_DIR	.'/views');

?>
