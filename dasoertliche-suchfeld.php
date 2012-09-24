<?php
/*
  Plugin Name: Das Örtliche Suchfeld
  Plugin URI: http://www.dasoertliche.de/downloads/wordpress-plugin/  
  Description: Das Örtliche-Suchfeld kann als Widget oder als Suchfeld im Content-Bereich eingesetzt werden.
  Version: 1.0.0
  Author: DasÖrtliche Service- und Marketinggesellschaft mbH
  Author URI: http://www.dasoertliche-marketing.de/
  License: GPL2
  License URI: license.txt
  Domain Path: /lang/
 */

include_once(dirname(__FILE__) . "/config.php");
include_once(dirname(__FILE__) . "/widget.php");

$oeConfig = new DasOertlicheSearchConfig();

// Call the Installer/Upgrader when plugin is activated
function dasoertlicheOnActivate(){
	require_once(dirname(__FILE__).'/init.php');
}
//Adding hooks
register_activation_hook(__FILE__, 'dasoertlicheOnActivate');

#wp_nonce_url
#error_log("plugin_basename(__FILE__) " . plugin_basename(__FILE__));
#load_plugin_textdomain($oeConfig->getTextDomain(), false, dirname( plugin_basename(__FILE__) ) . '/lang');

// widget
function registerDasOertlicheSearchWidget() {
	register_widget("DasOertlicheSearchWidget");
}
add_action("widgets_init", "registerDasOertlicheSearchWidget");
// / widget

// optionpage
function dasoertlicheSearchPluginOptions() {
  include_once(dirname(__FILE__) . "/optionpage.php");
}
function dasoertlicheRegisterSearchPluginSettings() {
   global $oeConfig;
   register_setting($oeConfig->optionPage->getSettingsGroupKey() , $oeConfig->optionPage->getApiFieldId());
}
function dasoertlicheAddOptionPage() {
   global $oeConfig;
	add_options_page($oeConfig->optionPage->getPageTitle(), $oeConfig->getName(), "manage_options", $oeConfig->getTextDomain(), "dasoertlicheSearchPluginOptions");
	//call register settings function
   add_action("admin_init", "dasoertlicheRegisterSearchPluginSettings");
}
// create custom plugin settings menu
add_action("admin_menu", "dasoertlicheAddOptionPage");
// / optionpage



/*add_action( 'admin_enqueue_scripts', 'add_sidebar_ids_to_widget_admin' );

function add_sidebar_ids_to_widget_admin( $current_page_hook ) {
    if( 'widgets.php' != $current_page_hook )
        return;
    wp_enqueue_script( 'dasoertlicheSearchPlugin-widget-admin', 'wp-content/plugins/dasoertliche-suchfeld/widget-admin.js', array( 'jquery' ), '1.0', true );
}
*/

if (function_exists("wp_enqueue_script")){
	 //wp_enqueue_script("widget-admin.js", "/wp-content/plugins/dasoertliche-suchfeld/js/widget-admin.js");
   //Adding javascripts
   /*
     wp_enqueue_script("jquery");
     wp_enqueue_script("jquery-ui-dialog");
     wp_enqueue_script("jquery-ui-resizable");
     wp_enqueue_script("jquery-ui-core");
     wp_enqueue_script("jquery-ui-draggable ");
     wp_enqueue_script("jquery-ui-selectable ");
     wp_enqueue_script("gsc_jsapi", "http://www.google.com/jsapi");
    */
}



/**
 *
 * Bsp. Shortcode im Artikel: [dasoertlichesuchfeld, type="Ort" region="Dortmund"]
 * s. auch http://codex.wordpress.org/Shortcode_API
 * @param array $attr
 * @return string
 */
function dasoertlichePanelExpander( $attr )
{
   $dasOertlicheSearchWidget = new DasOertlicheSearchWidget();

   $Container = "";
   $defaultSettings = $dasOertlicheSearchWidget->oeConfig->getDefaultWidgetSettings();
   $type = $defaultSettings["searchfieldtype"];
   $city = "";	
   $fixedWidth = "";
   $eingabefelder = -1;
   $width = $dasOertlicheSearchWidget->oeConfig->getSingleMinWidth();
   
   if ( isset($attr) && is_array($attr) )   
   {	   
	   if (array_key_exists("eingabefelder", $attr) )
	   {
		  $eingabefelder =	intval ($attr["eingabefelder"]);
		  if ( $eingabefelder > 1)
			$type = "combi";
	   }
	   if ( array_key_exists("ort", $attr) )
	   {
		  $city = $attr["ort"];
	   }
	   
	   if ( array_key_exists("breite", $attr) )
	   {
		  $width = intval($attr["breite"]); 
		  $fixedWidth = $width ;		  
	   }
   }	
  
   
  
   if ($fixedWidth != "")
   {
	  $fixedWidth = intval($fixedWidth) ;
	  // Minimalbreite Sicherstellen
	  if ( $fixedWidth < $dasOertlicheSearchWidget->oeConfig->getSingleMinWidth() ) 
	  	$fixedWidth = $dasOertlicheSearchWidget->oeConfig->getSingleMinWidth();
	  // Abhängig von der Breite und dem Format des Banners wird auch ein anderes Template benutzt.
	  // Normale Templates
	  if ( ($eingabefelder == 1) && ( $width > $dasOertlicheSearchWidget->oeConfig->getSingleWideSwitchWidth() ) )
	  	 $type = "single_wide";
	  else if ( ($eingabefelder > 1) && ( $width > $dasOertlicheSearchWidget->oeConfig->getCombiWideSwitchWidth() ) )
	  	 $type = "combi_wide";
	
  	  $Container = $dasOertlicheSearchWidget->oeConfig->getWidgetFixedWidthContainerTemplate();	
	  $Container =  str_replace("{:::FIXEDWIDTH:::}", $fixedWidth, $Container);	
   }

   $res = $dasOertlicheSearchWidget->expandTemplate($dasOertlicheSearchWidget->oeConfig->getTemplateKey($type), $Container, $city);

   return $res;
}
add_shortcode( 'dasoertlichesuchfeld', 'dasoertlichePanelExpander' );

?>