<?php

/**
 * The settings of the plugin.
 *
 * @link       http://progressreporter.com
 * @since      1.0.0
 *
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/admin
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */
class Progress_Reporter_Admin_Settings {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * This function introduces the theme options into the 'Appearance' menu and into a top-level
     * 'WPPB Demo' menu.
     */
    public function setup_plugin_options_menu() {

        add_submenu_page(
            'progress-report',
            'Settings',
            'Settings',
            'manage_options',
            'progress-report-settings',
            array( $this, 'render_settings_page_content'),
            ''
        );
    }

    /**
     * Renders a simple page to display for the theme menu defined above.
     */
    public function render_settings_page_content() {
        include_once 'partials/progress-reporter-settings-display.php';
    }

}


