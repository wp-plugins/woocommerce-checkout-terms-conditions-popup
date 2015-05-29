<?php
class DC_Checkout_Terms_Conditions_Popup_Settings {
  
  private $tabs = array();
  
  private $options;
  
  /**
   * Start up
   */
  public function __construct() {
    // Admin menu
   
    add_action( 'admin_init', array( $this, 'settings_page_init' ) );
    add_action( 'admin_enqueue_scripts', array($this,'terms_conditions_add_color_picker') );
    add_filter( 'woocommerce_settings_tabs_array', array($this, 'add_conditions_popup_settings_tab' ),50 );
    add_action( 'woocommerce_settings_tabs_conditions_popup_settings_tab', array($this, 'terms_settings_tab') );
    add_action( 'woocommerce_update_options_conditions_popup_settings_tab', array($this,'update_settings') );
    
    // Settings tabs
    add_action('settings_page_dc_checkout_terms_conditions_popup_general_tab_init', array(&$this, 'general_tab_init'), 10, 1);
    
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
		
		'terms_conditions_popup_pop_up_width' => array(
		'name' => __( 'Enter the popup width', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'desc' => __( 'Enter the popup width in px, (just put the numeric value).', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_pop_up_width'
		),
		
		
		
		'terms_conditions_popup_pop_up_height' => array(
		'name' => __( 'Enter the popup height', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'type' => 'text',
		'desc' => __( 'Enter the popup height in px, (just put the numeric value).', $DC_Checkout_Terms_Conditions_Popup->text_domain ),
		'id' => 'terms_conditions_popup_pop_up_height'
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
  
  
  
  /**
   * Add options page
   */
  public function add_settings_page() {
    global $DC_Checkout_Terms_Conditions_Popup;
    
    add_submenu_page( 'options-general.php',  __('Terms Conditions Popup Settings', $DC_Checkout_Terms_Conditions_Popup->text_domain), __('Terms Conditions Popup Settings', $DC_Checkout_Terms_Conditions_Popup->text_domain), 'manage_options', 'dc-checkout-terms-conditions-popup-setting-admin', array( $this, 'create_dc_checkout_terms_conditions_popup_settings' ) );
    
    /*add_menu_page(
        __('Checkout Terms Conditions Popup Settings', $DC_Checkout_Terms_Conditions_Popup->text_domain), 
        __('Checkout Terms Conditions Popup Settings', $DC_Checkout_Terms_Conditions_Popup->text_domain), 
        'manage_options', 
        'dc-checkout-terms-conditions-popup-setting-admin', 
        array( $this, 'create_dc_checkout_terms_conditions_popup_settings' ),
        $DC_Checkout_Terms_Conditions_Popup->plugin_url . 'assets/images/dualcube.png'
    );*/
    
    $this->tabs = $this->get_dc_settings_tabs();
  }
  
  function get_dc_settings_tabs() {
    global $DC_Checkout_Terms_Conditions_Popup;
    $tabs = apply_filters('dc_checkout_terms_conditions_popup_tabs', array(
      'dc_checkout_terms_conditions_popup_general' => __('Checkout Terms Conditions Popup General', $DC_Checkout_Terms_Conditions_Popup->text_domain)
    ));
    return $tabs;
  }
  
  function dc_settings_tabs( $current = 'dc_checkout_terms_conditions_popup_general' ) {
    if ( isset ( $_GET['tab'] ) ) :
      $current = $_GET['tab'];
    else:
      $current = 'dc_checkout_terms_conditions_popup_general';
    endif;
    
    $links = array();
    foreach( $this->tabs as $tab => $name ) :
      if ( $tab == $current ) :
        $links[] = "<a class='nav-tab nav-tab-active' href='?page=dc-checkout-terms-conditions-popup-setting-admin&tab=$tab'>$name</a>";
      else :
        $links[] = "<a class='nav-tab' href='?page=dc-checkout-terms-conditions-popup-setting-admin&tab=$tab'>$name</a>";
      endif;
    endforeach;
    echo '<div class="icon32" id="dualcube_menu_ico"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $links as $link )
      echo $link;
    echo '</h2>';
    
    foreach( $this->tabs as $tab => $name ) :
      if ( $tab == $current ) :
        echo "<h2>$name Settings</h2>";
      endif;
    endforeach;
  }

  /**
   * Options page callback
   */
  public function create_dc_checkout_terms_conditions_popup_settings() {
    global $DC_Checkout_Terms_Conditions_Popup;
    ?>
    <div class="wrap">
      <?php $this->dc_settings_tabs(); ?>
      <?php
      $tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'dc_checkout_terms_conditions_popup_general' );
      $this->options = get_option( "dc_{$tab}_settings_name" );
      //print_r($this->options);
      
      // This prints out all hidden setting errors
      settings_errors("dc_{$tab}_settings_name");
      ?>
      <form method="post" action="options.php">
      <?php
        // This prints out all hidden setting fields
        settings_fields( "dc_{$tab}_settings_group" );   
        do_settings_sections( "dc-{$tab}-settings-admin" );
        submit_button(); 
      ?>
      </form>
    </div>
    <?php
    do_action('dc_checkout_terms_conditions_popup_dualcube_admin_footer');
  }

  /**
   * Register and add settings
   */
  public function settings_page_init() { 
    do_action('befor_settings_page_init');
    
    // Register each tab settings
    foreach( $this->tabs as $tab => $name ) :
      do_action("settings_page_{$tab}_tab_init", $tab);
    endforeach;
    
    do_action('after_settings_page_init');
  }
  
  /**
   * Register and add settings fields
   */
  public function settings_field_init($tab_options) {
    global $DC_Checkout_Terms_Conditions_Popup;
    
    if(!empty($tab_options) && isset($tab_options['tab']) && isset($tab_options['ref']) && isset($tab_options['sections'])) {
      // Register tab options
      register_setting(
        "dc_{$tab_options['tab']}_settings_group", // Option group
        "dc_{$tab_options['tab']}_settings_name", // Option name
        array( $tab_options['ref'], "dc_{$tab_options['tab']}_settings_sanitize" ) // Sanitize
      );
      
      foreach($tab_options['sections'] as $sectionID => $section) {
        // Register section
        add_settings_section(
          $sectionID, // ID
          $section['title'], // Title
          array( $tab_options['ref'], "{$sectionID}_info" ), // Callback
          "dc-{$tab_options['tab']}-settings-admin" // Page
        );
        
        // Register fields
        if(isset($section['fields'])) {
          foreach($section['fields'] as $fieldID => $field) {
            if(isset($field['type'])) {
              $field = $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->check_field_id_name($fieldID, $field);
              $field['tab'] = $tab_options['tab'];
              $callbak = $this->get_field_callback_type($field['type']);
              if(!empty($callbak)) {
                add_settings_field(
                  $fieldID,
                  $field['title'],
                  array( $this, $callbak ),
                  "dc-{$tab_options['tab']}-settings-admin",
                  $sectionID,
                  $field
                );
              }
            }
          }
        }
      }
    }
  }
  
  function general_tab_init($tab) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $DC_Checkout_Terms_Conditions_Popup->admin->load_class("settings-{$tab}", $DC_Checkout_Terms_Conditions_Popup->plugin_path, $DC_Checkout_Terms_Conditions_Popup->token);
    new DC_Checkout_Terms_Conditions_Popup_Settings_Gneral($tab);
  }
  
  function get_field_callback_type($fieldType) {
    $callBack = '';
    switch($fieldType) {
      case 'input':
      case 'text':
      case 'email':
      case 'number':
      case 'file':
      case 'url':
        $callBack = 'text_field_callback';
        break;
        
      case 'hidden':
        $callBack = 'hidden_field_callback';
        break;
        
      case 'textarea':
        $callBack = 'textarea_field_callback';
        break;
        
      case 'wpeditor':
        $callBack = 'wpeditor_field_callback';
        break;
        
      case 'checkbox':
        $callBack = 'checkbox_field_callback';
        break;
        
      case 'radio':
        $callBack = 'radio_field_callback';
        break;
        
      case 'select':
        $callBack = 'select_field_callback';
        break;
        
      case 'upload':
        $callBack = 'upload_field_callback';
        break;
        
      case 'colorpicker':
        $callBack = 'colorpicker_field_callback';
        break;
        
      case 'datepicker':
        $callBack = 'datepicker_field_callback';
        break;
        
      case 'multiinput':
        $callBack = 'multiinput_callback';
        break;
        
      default:
        $callBack = '';
        break;
    }
    
    return $callBack;
  }
  
  /** 
   * Get the hidden field display
   */
  public function hidden_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->hidden_input($field);
  }
  
  /** 
   * Get the text field display
   */
  public function text_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->text_input($field);
  }
  
  /** 
   * Get the text area display
   */
  public function textarea_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_textarea( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_textarea( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->textarea_input($field);
  }
  
  /** 
   * Get the wpeditor display
   */
  public function wpeditor_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? ( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? ( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->wpeditor_input($field);
  }
  
  /** 
   * Get the checkbox field display
   */
  public function checkbox_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['dfvalue'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : '';
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->checkbox_input($field);
  }
  
  /** 
   * Get the checkbox field display
   */
  public function radio_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->radio_input($field);
  }
  
  /** 
   * Get the select field display
   */
  public function select_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_textarea( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_textarea( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->select_input($field);
  }
  
  /** 
   * Get the upload field display
   */
  public function upload_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->upload_input($field);
  }
  
  /** 
   * Get the multiinput field display
   */
  public function multiinput_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? $field['value'] : array();
    $field['value'] = isset( $this->options[$field['name']] ) ? $this->options[$field['name']] : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->multi_input($field);
  }
  
  /** 
   * Get the colorpicker field display
   */
  public function colorpicker_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->colorpicker_input($field);
  }
  
  /** 
   * Get the datepicker field display
   */
  public function datepicker_field_callback($field) {
    global $DC_Checkout_Terms_Conditions_Popup;
    $field['value'] = isset( $field['value'] ) ? esc_attr( $field['value'] ) : '';
    $field['value'] = isset( $this->options[$field['name']] ) ? esc_attr( $this->options[$field['name']] ) : $field['value'];
    $field['name'] = "dc_{$field['tab']}_settings_name[{$field['name']}]";
    $DC_Checkout_Terms_Conditions_Popup->dc_wp_fields->datepicker_input($field);
  }
  
}