<?php
class DC_Checkout_Terms_Conditions_Popup_Settings {
  
  private $tabs = array();
  
  private $options;
  
  /**
   * Start up
   */
  public function __construct() {
    // Admin menu
   
    //add_action( 'admin_init', array( $this, 'settings_page_init' ) );
    add_action( 'admin_enqueue_scripts', array($this,'terms_conditions_add_color_picker') );
    add_filter( 'woocommerce_settings_tabs_array', array($this, 'add_conditions_popup_settings_tab' ),50 );
    add_action( 'woocommerce_settings_tabs_conditions_popup_settings_tab', array($this, 'terms_settings_tab') );
    add_action( 'woocommerce_update_options_conditions_popup_settings_tab', array($this,'update_settings') );
    
    // Settings tabs
    //add_action('settings_page_dc_checkout_terms_conditions_popup_general_tab_init', array(&$this, 'general_tab_init'), 10, 1);
    
  }
  
  
  function terms_conditions_add_color_picker( $hook ) {
	 
			if( is_admin() ) {			 
					// Add the color picker css file      
					wp_enqueue_style( 'wp-color-picker' );					 
					wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
			}
	}
  
  
  /**
   *Add woocommerce Setting tabs.
   *
   */
  public function add_conditions_popup_settings_tab($settings_tabs) {
  	global $DC_Checkout_Terms_Conditions_Popup;
  	$settings_tabs['conditions_popup_settings_tab'] = __( 'Terms Conditions Popup Settings', $DC_Checkout_Terms_Conditions_Popup->text_domain );
  	return $settings_tabs;  	
  }
  
  
  /**
   *
   *
   */
  public function terms_settings_tab() {
  	global $DC_Checkout_Terms_Conditions_Popup;
  	woocommerce_admin_fields( $this->get_settings() );  	
  }
  
  public function get_settings() {
  	global $DC_Checkout_Terms_Conditions_Popup;
  	
  	?>
  	<script type="text/javascript">
				(function( $ ) {		 
				// Add Color Picker to all inputs that have 'color-field' class
				$(function() {
						$('.color-field').wpColorPicker();
				});
				 
		})( jQuery );		
		</script>
  	
  	<?php
  	 $settings = array(  	 	 
		'section_title' => array(
		'name' => __( 'Terms and Conditions popup settings', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'title',
		'desc' => '',
		'id' => 'wc_settings_tab_demo_section_title'
		),
		
		'terms_conditions_popup_is_enable' => array(
		'name' => __( 'Is Enable', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'checkbox',
		'desc' => __( 'Enable the functionality', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_is_enable'
		),
		
		'terms_conditions_popup_pre_text' => array(
		'name' => __( 'Enter the text which will be appear in front page', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'desc' => __( 'Enter your custom text which will be shown in the chaeckout page.', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_pre_text'
		),
		
		'terms_conditions_popup_link_text' => array(
		'name' => __( 'Link Text', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'desc' => __( 'Enter your custom Link Text which will be shown in the chaeckout page.', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_link_text'
		),
		
		'terms_conditions_popup_js_enable' => array(
		'name' => __( 'External Js Lib Enable', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'checkbox',
		'desc' => __( "If you don't have a jquery lib in your theme then you can enable plugin jquery.", $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_js_enable'
		),
		
		
		
		'terms_conditions_popup_heading' => array(
		'name' => __( 'Popup Custom Heading', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',		
		'desc' => __( 'Popup Title instead of Terms and condition title', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_heading'
		),
		
		'terms_conditions_popup_agree_enable' => array(
		'name' => __( 'Is Agree Button in popup', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'checkbox',
		'desc' => __( "Is Agree Button in popup.", $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_agree_enable'
		),
		
		
		
		'terms_conditions_popup_button_width' => array(
		'name' => __( 'Enter the button width', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'desc' => __( 'Enter the button width in px, (just put the numeric value).', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_width'
		),
		
		'terms_conditions_popup_button_height' => array(
		'name' => __( 'Enter the button height', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'desc' => __( 'Enter the button height in px, (just put the numeric value).', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_height'
		),
		
		'terms_conditions_popup_button_text' => array(
		'name' => __( 'Enter the button text which will be appear in the popup window', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'desc' => __( 'Enter the button text which will be appear in the popup window.', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_text'
		),
		
		'terms_conditions_popup_button_border_color' => array(
		'name' => __( 'Button Border Color', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'class' => 'color-field',
		'desc' => __( 'Choose button border color', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_border_color'
		),
		
		'terms_conditions_popup_button_background_color' => array(
		'name' => __( 'Button Background Color', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'class' => 'color-field',
		'desc' => __( 'Choose button background color', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_background_color'
		),		
		
		'terms_conditions_popup_button_text_color' => array(
		'name' => __( 'Button Text Color', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'class' => 'color-field',
		'desc' => __( 'Choose button text color', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_text_color'
		),
		
		
		'terms_conditions_button_font_size' => array(
		'name' => __( 'Button Font Size', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',		
		'desc' => __( 'Enter Button Font Size in px please do not enter suffix px just numeric', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_button_font_size'
		),
		'terms_conditions_button_padding' => array(
		'name' => __( 'Button Padding', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',		
		'desc' => __( 'Enter Button Padding in px please do not enter suffix px just numeric', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_button_padding'
		),
		
		'terms_conditions_button_border_size' => array(
		'name' => __( 'Button Border Size', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',		
		'desc' => __( 'Enter Button Border Size in px please do not enter suffix px just numeric', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_button_border_size'
		),
		
		'terms_conditions_button_border_redius' => array(
		'name' => __( 'Button Border Redius', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',		
		'desc' => __( 'Enter Button Border Redius in px please do not enter suffix px just numeric', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_button_border_redius'
		),
		
		'terms_conditions_popup_button_background_color_hover' => array(
		'name' => __( 'Button Background Color Hover', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'class' => 'color-field',
		'desc' => __( 'Choose button background color hover', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_background_color_hover'
		),
		
		'terms_conditions_popup_button_text_color_hover' => array(
		'name' => __( 'Button Text Color Hover', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'class' => 'color-field',
		'desc' => __( 'Choose button text color hover', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_button_text_color_hover'
		),
		
		
		'section_end' => array(
		'type' => 'sectionend',
		'id' => 'wc_settings_tab_demo_section_end'
		)
		);
		return apply_filters( 'wc_settings_tab_conditions_popup_settings_tab', $settings );   	
  	
  }
  
 
	public function update_settings() {
	woocommerce_update_options( $this->get_settings() );
	} 
  
  
  
  
  
 
  

  
  
 
  
  
  
  
  
}