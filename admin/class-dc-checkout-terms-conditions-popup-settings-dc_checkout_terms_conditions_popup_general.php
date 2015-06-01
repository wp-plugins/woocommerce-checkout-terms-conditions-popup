<?php
class DC_Checkout_Terms_Conditions_Popup_Settings_Gneral {
  /**
   * Holds the values to be used in the fields callbacks
   */
  private $options;
  
  private $tab;

  /**
   * Start up
   */
  public function __construct($tab) {
    $this->tab = $tab;
    $this->options = get_option( "dc_{$this->tab}_settings_name" );
    $this->settings_page_init();
  }
  
  /**
   * Register and add settings
   */
  public function settings_page_init() {
    global $DC_Checkout_Terms_Conditions_Popup;
    
    $settings_tab_options = array("tab" => "{$this->tab}",
                                  "ref" => &$this,
                                  "sections" => array(
                                                      "default_settings_section" => array("title" =>  __('Terms and conditions popup Settings', $DC_Checkout_Terms_Conditions_Popup->text_domain), // Section one
                                                                                         "fields" => array(                                                                                                 
                                                                                                           "is_enable" => array('title' => __('Enable', $DC_Checkout_Terms_Conditions_Popup->text_domain), 'type' => 'checkbox', 'id' => 'is_enable', 'label_for' => 'is_enable', 'name' => 'is_enable', 'value' => 'Enable', 'desc' => __('Enable the Terms and conditions Popup box.', $DC_Checkout_Terms_Conditions_Popup->text_domain)), // Checkbox
                                                                                                           "pre_text" => array('title' => __('Enter the text which will be appear in front page', $DC_Checkout_Terms_Conditions_Popup->text_domain), 'type' => 'text', 'id' => 'pre_text', 'label_for' => 'pre_text', 'name' => 'pre_text', 'value' => '', 'placeholder' => 'I’ve read and accept the', 'desc' => __('Enter your custom text which will be shown in the chaeckout page.', $DC_Checkout_Terms_Conditions_Popup->text_domain)), // Checkbox
                                                                                                           "link_text" => array('title' => __('Link Text', $DC_Checkout_Terms_Conditions_Popup->text_domain), 'type' => 'text', 'id' => 'link_text', 'label_for' => 'link_text', 'name' => 'link_text', 'value' => '', 'placeholder' => 'terms & conditions', 'desc' => __('Enable the link text .', $DC_Checkout_Terms_Conditions_Popup->text_domain)), // Checkbox
                                                                                                           "load_js_lib" => array('title' => __('External Js Lib Enable', $DC_Checkout_Terms_Conditions_Popup->text_domain), 'type' => 'checkbox', 'id' => 'load_js_lib', 'label_for' => 'load_js_lib', 'name' => 'load_js_lib', 'value' => 'Enable', 'desc' => __('If you don\'t have a jquery lib in your theme then you can enable plugin jquery.', $DC_Checkout_Terms_Conditions_Popup->text_domain)), // Checkbox
                                                                                                           "pop_up_width" => array('title' => __('Enter the popup max width (only numeric)', $DC_Checkout_Terms_Conditions_Popup->text_domain), 'type' => 'text', 'id' => 'pop_up_width', 'label_for' => 'pop_up_width', 'name' => 'pop_up_width', 'value' => '', 'placeholder' => '760', 'desc' => __('Enter the popup width in px, (just put the numeric value).', $DC_Checkout_Terms_Conditions_Popup->text_domain)), // Checkbox
                                                                                                           "pop_up_button_text" => array('title' => __('Enter the button text which will be appear in the popup window', $DC_Checkout_Terms_Conditions_Popup->text_domain), 'type' => 'text', 'id' => 'pop_up_button_text', 'label_for' => 'pop_up_button_text', 'name' => 'pop_up_button_text', 'value' => '', 'placeholder' => 'Agree'), // Checkbox
                                                                                                          
                                                                                                           )
                                                                                         )
                                                      )
                                  );
    
    $DC_Checkout_Terms_Conditions_Popup->admin->settings->settings_field_init(apply_filters("settings_{$this->tab}_tab_options", $settings_tab_options));
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function dc_dc_checkout_terms_conditions_popup_general_settings_sanitize( $input ) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $new_input = array();    
    $hasError = false;   

    if( isset( $input['is_enable'] ) )
      $new_input['is_enable'] = sanitize_text_field( $input['is_enable'] );
    if( isset( $input['pre_text'] ) )
      $new_input['pre_text'] = sanitize_text_field( $input['pre_text'] );
    if( isset( $input['link_text'] ) )
      $new_input['link_text'] = sanitize_text_field( $input['link_text'] );
    if( isset( $input['load_js_lib'] ) )
      $new_input['load_js_lib'] = sanitize_text_field( $input['load_js_lib'] );
    if(isset( $input['pop_up_width'] ) && absint( $input['pop_up_width'] ) != 0 )
      $new_input['pop_up_width'] = absint( $input['pop_up_width'] );
    if( isset( $input['pop_up_button_text'] ) )
      $new_input['pop_up_button_text'] = sanitize_text_field( $input['pop_up_button_text'] );
    
    
    
    
    
    if(!$hasError) {
      add_settings_error(
        "dc_{$this->tab}_settings_name",
        esc_attr( "dc_{$this->tab}_settings_admin_updated" ),
        __('General settings updated', $DC_Checkout_Terms_Conditions_Popup->text_domain),
        'updated'
      );
    }

    return $new_input;
  }

  /** 
   * Print the Section text
   */
  public function default_settings_section_info() {
    global $DC_Checkout_Terms_Conditions_Popup;
    _e('Cofigure the settings below', $DC_Checkout_Terms_Conditions_Popup->text_domain);
    echo "<br/>";
    _e('You must have to choose the terms and conditions page for working this plugin. you can find the settings under the woocommerce->settings->checkout', $DC_Checkout_Terms_Conditions_Popup->text_domain);
  }
  
 
  
}