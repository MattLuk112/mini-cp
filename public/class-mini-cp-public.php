<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://bitterend.io
 * @since      1.0.0
 *
 * @package    Mini_Cp
 * @subpackage Mini_Cp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mini_Cp
 * @subpackage Mini_Cp/public
 * @author     Bitterend <info@bitterend.io>
 */
class Mini_Cp_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mini_Cp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mini_Cp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mini-cp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mini_Cp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mini_Cp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mini-cp-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register info route for main Control panel
	 *
	 * @return void
	 */

	public function register_info_route() {
		register_rest_route( $this->plugin_name, '/info', [
			'methods' => 'GET',
			'callback' => [$this, 'callback_info_route'],
		]);
	}

	public function callback_info_route() {
		$all_plugins = get_plugins();
		$active_plugins = get_option('active_plugins');
		foreach($all_plugins as $key => &$value) {
			if (in_array($key, $active_plugins)) {
				$value['Activated'] = true;
			} else {
				$value['Activated'] = false;
			}
		}
		return [
			'site_title' => get_bloginfo('site_title'),
			'site_url' => get_bloginfo('url'),
			'version'	=> get_bloginfo('version'),
			'plugins' => $all_plugins,
		];
	}

}
