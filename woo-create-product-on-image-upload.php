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
        add_action('admin_menu', array(get_called_class(), 'registerMenu'));
		add_action("admin_init", array(get_called_class(), 'wcpoiu_fields'));
		add_action('add_attachment', array($this, 'createProductOnImageUpload'), 10, 1);
    }
	
	/**
	 *
     * @access public 
	 * @since  1.0.0
	 */
    public static function createProductOnImageUpload($attachment_id) {
		//Prepare Product
		$attachment = get_post($attachment_id);
		$product = array(
			'post_title' => $attachment->post_title,
			'post_content' => '',
			'post_status' => 'publish',
			'post_type' => 'product',
		);

		//Create Product
		$post_id = wp_insert_post($product);
		
		//Set Image for Product
		set_post_thumbnail($post_id, $attachment_id);

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
	
	/**
	 * Register Menu Method
	 *
     * @access public 
	 * @since  1.0.0
	 */
    public static function registerMenu() {
        add_menu_page(
            'Woo Create Product', 
            'Woo Create Product', 
            'manage_options', 
            'Woo Create Product', 
            array(get_called_class(), 'registerHTML')
        );
    }
	
	/**
	 * Register HTML Method
	 *
     * @access public
	 * @since  1.0.0
	 */
    public static function registerHTML() {
        require_once('woo-create-product-on-image-upload-html.php');
    }
	
	/**
	 * Fields Method
	 *
     * @access public 
	 * @since  1.0.0
	 */
	public static function wcpoiu_fields() {
		add_settings_section("wcpoiu", "Settings", null, "wcpoiu-options");
		add_settings_field("wcpoiu_product_name", "Product Name", "wcpoiu_product_name", "wcpoiu-options", "wcpoiu");
		register_setting("wcpoiu", "wcpoiu_product_name");
	}

	public function wcpoiu_product_name() {
	?>
		<input type="text" id="wcpoiu_product_name" name="wcpoiu_product_name" value="<?php echo get_option('wcpoiu_product_name'); ?>" />
	<?php
	}
}
?>