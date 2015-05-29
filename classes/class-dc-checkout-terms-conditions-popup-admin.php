<?php
class DC_Checkout_Terms_Conditions_Popup_Admin {
  
  public $settings;

	public function __construct() {
		//admin script and style
		add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_script'));
		
		add_action('dc_checkout_terms_conditions_popup_dualcube_admin_footer', array(&$this, 'dualcube_admin_footer_for_dc_checkout_terms_conditions_popup'));

		$this->load_class('settings');
		$this->settings = new DC_Checkout_Terms_Conditions_Popup_Settings();
	}

	function load_class($class_name = '') {
	  global $DC_Checkout_Terms_Conditions_Popup;
		if ('' != $class_name) {
			require_once ($DC_Checkout_Terms_Conditions_Popup->plugin_path . '/admin/class-' . esc_attr($DC_Checkout_Terms_Conditions_Popup->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()
	
	function dualcube_admin_footer_for_dc_checkout_terms_conditions_popup() {
    global $DC_Checkout_Terms_Conditions_Popup;
    ?>
    <div style="clear: both"></div>
    <div id="dc_admin_footer">
      <?php _e('Powered by', $DC_Checkout_Terms_Conditions_Popup->text_domain); ?> <a href="http://dualcube.com" target="_blank"><img src="<?php echo $DC_Checkout_Terms_Conditions_Popup->plugin_url.'/assets/images/dualcube.png'; ?>"></a><?php _e('Dualcube', $DC_Checkout_Terms_Conditions_Popup->text_domain); ?> &copy; <?php echo date('Y');?>
    </div>
    <?php
	}

	/**
	 * Admin Scripts
	 */

	public function enqueue_admin_script() {
		global $DC_Checkout_Terms_Conditions_Popup;
		$screen = get_current_screen();
		
		// Enqueue admin script and stylesheet from here
		if (in_array( $screen->id, array( 'toplevel_page_dc-checkout-terms-conditions-popup-setting-admin' ))) :   
		  $DC_Checkout_Terms_Conditions_Popup->library->load_qtip_lib();
		  $DC_Checkout_Terms_Conditions_Popup->library->load_upload_lib();
		  $DC_Checkout_Terms_Conditions_Popup->library->load_colorpicker_lib();
		  $DC_Checkout_Terms_Conditions_Popup->library->load_datepicker_lib();
		  wp_enqueue_script('admin_js', $DC_Checkout_Terms_Conditions_Popup->plugin_url.'assets/admin/js/admin.js', array('jquery'), $DC_Checkout_Terms_Conditions_Popup->version, true);
		  wp_enqueue_style('admin_css',  $DC_Checkout_Terms_Conditions_Popup->plugin_url.'assets/admin/css/admin.css', array(), $DC_Checkout_Terms_Conditions_Popup->version);
	  endif;
	}
}