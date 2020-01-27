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
		add_filter('wp_handle_upload', 'customUploadFilter');
	}
	
	/**
	 * Load only when pluggable.php is ready
	 *
     * @access public 
	 * @since  1.0.0
	 */
    public static function customUploadFilter($file) {
		$product = array(
			'post_title' => $file['name'],
			'post_content' => '',
			'post_status' => 'publish',
			'post_type' => "product",
		);

		//Create Product
		$post_id = wp_insert_post($product);

		//Set Terms
		wp_set_object_terms($post_id, 'simple', 'product_type');

		//Set Post Meta values...
		update_post_meta( $post_id, '_visibility', 'visible' );
		update_post_meta( $post_id, '_stock_status', 'instock');
		update_post_meta( $post_id, 'total_sales', '0' );
		update_post_meta( $post_id, '_downloadable', 'no' );
		update_post_meta( $post_id, '_virtual', 'yes' );
		update_post_meta( $post_id, '_regular_price', '' );
		update_post_meta( $post_id, '_sale_price', '' );
		update_post_meta( $post_id, '_purchase_note', '' );
		update_post_meta( $post_id, '_featured', 'no' );
		update_post_meta( $post_id, '_weight', '' );
		update_post_meta( $post_id, '_length', '' );
		update_post_meta( $post_id, '_width', '' );
		update_post_meta( $post_id, '_height', '' );
		update_post_meta( $post_id, '_sku', '' );
		update_post_meta( $post_id, '_product_attributes', array() );
		update_post_meta( $post_id, '_sale_price_dates_from', '' );
		update_post_meta( $post_id, '_sale_price_dates_to', '' );
		update_post_meta( $post_id, '_price', '' );
		update_post_meta( $post_id, '_sold_individually', '' );
		update_post_meta( $post_id, '_manage_stock', 'no' );
		update_post_meta( $post_id, '_backorders', 'no' );
		update_post_meta( $post_id, '_stock', '' );
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