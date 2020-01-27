<?php
/**
 * Plugin Name: Woo Create Product On Image Upload
 * Plugin URI:  https://github.com/chigozieorunta/woo-create-product-on-image-upload
 * Description: A simple woocommerce plugin designed to help you create products automatically by simply uploading the images into your media library.
 * Version:     1.0.0
 * Author:      Chigozie Orunta
 * Author URI:  https://github.com/chigozieorunta
 * License:     MIT
 * Text Domain: woo-create-product-on-image-upload
 * Domain Path: ./
 */

//Define Plugin Path
define("WCPOIU", plugin_dir_path(__FILE__));

wooCreateProductOnImageUpload::getInstance();

/**
 * Class wooCreateProductOnImageUpload
 */
class wooCreateProductOnImageUpload {
    /**
	 * Constructor
	 *
	 * @since  1.0.0
	 */
    public function __construct() {
		add_action('plugins_loaded', array($this, 'createProductOnImageUpload'));
    }
    
    /**
	 * Load only when pluggable.php is ready
	 *
     * @access public 
	 * @since  1.0.0
	 */
    public static function createProductOnImageUpload() {
		$user = wp_get_current_user();
		if(isset($user->roles[0]) && $user->roles[0] == 'vendor') {
			add_action('admin_enqueue_scripts', array(get_called_class(), 'registerScripts'));
		}
    }

    /**
	 * Register Scripts Method
	 *
     * @access public 
	 * @since  1.0.0
	 */
    public static function registerScripts() {
		wp_register_style('woo-create-product-on-image-upload', plugin_dir_url(__FILE__).'css/woo-create-product-on-image-upload.css');
		wp_enqueue_style('woo-create-product-on-image-upload');
    }

    /**
	 * Points the class, singleton.
	 *
	 * @access public
	 * @since  1.0.0
	 */
    public static function getInstance() {
        static $instance;
        if($instance === null) $instance = new self();
        return $instance;
    }
}

?>