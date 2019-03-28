<?php

/**
 * This Admin controller file provide functionality for the Admin section of the
 * Crm Plugin
 *
 * @author LOudshoorn
 * @version 0.1
 *
 * Version history
 * 0.1 LOudshoorn Initial version
 */
class CrmPlugin_AdminController
{
    /**
     * This function will prepare all Admin functionality for the plugin
     */
    static function prepare()
    {
// Check that we are in the admin area
        if (is_admin()) :
// Add the sidebar Menu structure
            add_action('admin_menu', array('CrmPlugin_AdminController',
                'addMenus'));
        endif;
    }

    /**
     * Add the Menu structure to the Admin sidebar
     */
    static function addMenus()
    {
        add_menu_page(
        // string $page_title The text to be displayed in the title tags
        // of the page when the menu is selected
            __('CRM Plugin', 'crm-plugin'),
            // string $menu_title The text to be used for the menu
            __('CRM Plugin', 'crm-plugin'),
            // string $capability The capability required for this menu to be displayed to the user.
            'manage_options',
            // string $menu_slug The slug name to refer to this menu by (should be unique for this menu)
            'crm-plugin-admin',
            // callback $function The function to be called to output the content for this page.
            array('CrmPlugin_AdminController', 'adminMenuPage'),
            // string $icon_url The url to the icon to be used for this menu.
            // * Pass a base64-encoded SVG using a data URI, which will be colored to match the color scheme.
            // This should begin with 'data:image/svg+xml;base64,'.
            // * Pass the name of a Dashicons helper class to use a font
            'dashicons-clock'
        // * Pass 'none' to leave div.wp-menu-image empty so an icon can be added via CSS.

        // int $position The position in the menu order this one should appear
        );
        add_submenu_page (
        // string $parent_slug The slug name for the parent menu
        // (or the file name of a standard WordPress admin page)
            'crm-plugin-admin',
            // string $page_title The text to be displayed in the title tags of the page when the menu is selected
            __( 'Contactpersoon Toevoegen', 'contactpersoon', 'admin-event-types' ),
            // string $menu_title The text to be used for the menu
            __( 'Contactpersoon Toevoegen', 'contactpersoon', 'admin-event-types'),
            // string $capability The capability required for this menu to be displayed to the user.
            'manage_options',
            // string $menu_slug The slug name to refer to this menu by (should be unique for this menu)
            'crm_admin_contactpersoon',
            // callback $function The function to be called to output the content for this page.
            array( 'CrmPlugin_AdminController', 'adminSubMenuContactpersoon' )
        );
        add_submenu_page (
        // string $parent_slug The slug name for the parent menu
        // (or the file name of a standard WordPress admin page)
            'crm-plugin-admin',
            // string $page_title The text to be displayed in the title tags of the page when the menu is selected
            __( 'Bedrijven Toevoegen', 'bedrijven', 'admin-event-types' ),
            // string $menu_title The text to be used for the menu
            __( 'Bedrijven Toevoegen', 'bedrijven', 'admin-event-types'),
            // string $capability The capability required for this menu to be displayed to the user.
            'manage_options',
            // string $menu_slug The slug name to refer to this menu by (should be unique for this menu)
            'crm_admin_bedrijven',
            // callback $function The function to be called to output the content for this page.
            array( 'CrmPlugin_AdminController', 'adminSubMenuBedrijven' )
        );


    }
    /**
     * The main menu page
     */
    static function adminMenuPage() {
// Include the view for this menu page.
        include CRM_PLUGIN_PLUGIN_ADMIN_VIEWS_DIR . '/admin_main.php';
    }
    /**
     * The submenu page for the uitlening
     */
    static function adminSubMenuContactpersoon() {
        // include the view for this submenu page.
        include CRM_PLUGIN_PLUGIN_ADMIN_VIEWS_DIR .
            '/crm_admin_contactpersoon.php';

    }
    /**
     * The submenu page for the artikel
     */
    static function adminSubMenuBedrijven() {
        // include the view for this submenu page.
        include CRM_PLUGIN_PLUGIN_ADMIN_VIEWS_DIR .
            '/crm_admin_bedrijven.php';

    }


}

?>