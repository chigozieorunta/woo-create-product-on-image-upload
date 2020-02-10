<div id="wpbody" role="main">
	<style>a.clear{text-decoration: none;}</style>
    <div id="wpbody-content" aria-label="Main content" tabindex="0">
		<div id="screen-meta" class="metabox-prefs">
            <div id="contextual-help-wrap" class="hidden no-sidebar" tabindex="-1" aria-label="Contextual Help Tab">
				<div id="contextual-help-back"></div>
				<div id="contextual-help-columns">
					<div class="contextual-help-tabs">
						<ul></ul>
					</div>
                    <div class="contextual-help-tabs-wrap"></div>
				</div>
			</div>
		</div>
		<div class="wrap about-wrap full-width-layout">
		    <h1>Woo Create Image On Upload</h1>
            <p class="about-text">A simple woocommerce plugin designed to help you create products automatically by simply uploading the images into your media library.</p>
			<p>Contributors: <a class="clear" href="https://github.com/chigozieorunta">Chigozie Orunta</a></p>
            <h2 class="nav-tab-wrapper wp-clearfix">
    			<a href="#" class="nav-tab nav-tab-active">Settings</a>
		    </h2>
		    <div class="about-wrap-content">
            	<div class="feature-section four-col">
            		<div class="col">
                        <form method="post" action="options.php">
                            <?php settings_fields('wcpoiu'); ?>
                            <input type="text" id="wcpoiu_product_name" name="wcpoiu_product_name" value="<?php echo get_option('wcpoiu_product_name'); ?>" />
                            <?php submit_button(); ?>
                        </form>
            		</div>
                    
            	</div>
            </div>
        </div>
    </div>
</div>
