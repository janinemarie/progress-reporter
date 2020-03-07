<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://criticalhit.dev
 * @since      1.0.0
 *
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/admin
 * @author     Janine M. Paris <janine@criticalhit.dev>
 */
class Progress_Reporter_Admin {

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
     * Load the required dependencies for the Admin facing functionality.
     *
     * Include the following files that make up the plugin:
     *
     * - Progress_Reporter_Settings. Registers the admin settings and page.
     *
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/class-progress-reporter-admin.php';

        /**
         * The class responsible for defining all settings that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-progress-reporter-settings.php';

        /**
         * The class responsible for defining the custom taxonomy used by the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'include/class-progress-reporter-custom-taxonomy.php';

    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Progress_Reporter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Progress_Reporter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/progress-reporter-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Progress_Reporter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Progress_Reporter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/progress-reporter-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * This function introduces the top-level plugin menu item.
     */
    public function setup_plugin_top_menu()
    {

        //Add a top-level menu item for the plugin settings and display
        add_menu_page(
            'Progress Report',
            'Progress Report',
            'manage_options',
            'progress-report',
            array($this, 'render_progress_report_page_content'),
            'dashicons-networking',
            6
        );

    }

    /**
     * Renders a simple page to display for the theme menu defined above.
     */
    public function render_progress_report_page_content() {
        include_once 'partials/progress-reporter-admin-display.php';
    }


}