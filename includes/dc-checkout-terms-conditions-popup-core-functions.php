<?php
if(!function_exists('get_checkout_terms_conditions_popup_settings')) {
  function get_checkout_terms_conditions_popup_settings($name = '', $tab = '') {
    if(empty($tab) && empty($name)) return '';
    if(empty($tab)) return get_option($name);
    if(empty($name)) return get_option("dc_{$tab}_settings_name");
    $settings = get_option("dc_{$tab}_settings_name");
    if(!isset($settings[$name])) return '';
    return $settings[$name];
  }
}
if(!function_exists('woocommerce_terms_conditions_alert_notice')) { 
	function woocommerce_terms_conditions_alert_notice() {
	?>
	<div id="message" class="error">
      <p><?php printf( __( '%sWoocommerce Checkout Terms & Conditions popup is inactive.%s The %sWooCommerce plugin%s must be active for the Woocommerce Checkout Terms & Conditions popup to work. Please %sinstall & activate WooCommerce%s', DC_CHECKOUT_TERMS_CONDITIONS_POPUP_TEXT_DOMAIN ), '<strong>', '</strong>', '<a target="_blank" href="http://wordpress.org/extend/plugins/woocommerce/">', '</a>', '<a href="' . admin_url( 'plugins.php' ) . '">', '&nbsp;&raquo;</a>' ); ?></p>
    </div>
    <?php 	
  }
}

?>
