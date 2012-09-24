<?php
include_once(dirname(__FILE__) . "/templates.php");

class DasOertlicheSearchConfig
{
   var $_textDomain = "dasoertliche-suchfeld";
   var $_version = "0.0.1";
   var $_rootUrl = "http://www.dasoertliche.de";
   /** default language */
   var $_language = "DE";
   /** current language */
   var $language;
   var $_resources = array(
       "SEARCHBOXBACKGROUNDIMG" => "img/oe_searchbox.gif"
   );
   var $_languagePack = array(
       "DE" => array(
           "NAME" => "Das Örtliche Suchfeld",
           "WIDGET" => array(
               "HEADLINE" => "Das Örtliche Telefonbuch",
               "SEARCHTERMLABEL" => "Wen/Was",
               "REGIONLABEL" => "Wo",
               "SEARCHBUTTONVALUE" => "Finden",
			   "SEARCHURL" => "http://services.dasoertliche.de/addons/search/" //"http://services.dasoertliche.de/addons/" //"http://affiliate.oe.wipe.de/validate/"
		   ),		   	   
           "WIDGET_ADMIN" => array(
               "MENU_TITLE" => "Das Örtliche Suchfeld",
               /* @TODO Beschreibung anpassen */
               "DESCRIPTION" => "Erweitert Ihre Seite um die Suchfunktionalität von Das Örtliche.",
               "SEARCHFIELD_LABEL" => "Format",
               "REGIONFIELD_LABEL" => "Suchort vorbelegen",
               "SINGLE_SEARCHFIELDTEXT" => "Ein Eingabefeld",
               "COMBI_SEARCHFIELDTEXT" => "Zwei Eingabefelder Was/Wo",
			   "MINI_SEARCHFIELDTEXT" => "Mini-Suchfeld",
			   "ACCESSKEY_LABEL" => "(Optional) Tastaturk&uuml;rzel zuordnen (SHIFT+ALT)+"
           ),
           "OPTIONPAGE" => array(
               "PAGETITLE" => "Das Örtliche Suchfeld - Einstellungen",
               "API_KEY" => "API key",
               "API_KEY_LINK_TEXT" => "(API key von Das Örtliche erwerben)",
               "API_KEY_INFO" => "Tragen Sie hier Ihren API-Key von Das Örtliche ein.",
               "RESULT_PAGE" => "Ergebnisse im selben Fenster anzeigen",
               "RESULT_PAGE_INFO" => "(Wenn nicht ausgewählt werden die Ergebnisse in einem neuen Fenster angezeigt)",
               // hier html = Nicht schön
               "SAVE_HINT" =>"Änderungen übernommen!"
               )
       )
   );
   var $_defaultWidgetSettings = array(
       "searchfieldtype" => "single",
       "searchregion" => "",
	   "accesskey" => ""
   );

   var $_optionPageSettings = array(
       "SETTINGS_GROUPNAME" => "dasoertliche-settings-group",
       "API_KEY_FIELD_ID" => "dasoertliche_api_id",
       "RESULT_PAGE_FIELD_ID" => "dasoertliche_resultpage_id"
       );
   /** Config object for option-page */
   var $optionPage;
   /**  */
   var $_searchfieldType = array("single", "combi", "mini", "single_wide", "combi_wide");

   /* Minimale Breiten der Banner im Content-Bereich */
   var $_singleMinWidth = 190;	
   var $_combiMinWidth = 190;	
   
    /* Breiten der Banner im Content-Bereich bei denen ein Automatischer Template wächsel stattfindet. */
   var $_singleWideSwitchWidth = 290;	
   var $_combiWideSwitchWidth = 290;	
   
   /** html-snippets */
   var $_templates;

   /**
    * Constructor
    * @param string $language [optional] default: "DE"
    */
   function DasOertlicheSearchConfig($language = NULL)
   {
      $this->init($language);
   }

   function init($language)
   {
      $this->_setLanguage($language);
      $this->_registerTemplates();
      $this->optionPage = new DasOertlicheOptionPageConfig($this, $this->_optionPageSettings, $this->_getTitles("OPTIONPAGE"));
   }

   function _registerTemplates()
   {
      $this->_templates = array(
          "WIDGET_SINGLE" => (defined("DASOERTLICHE_WIDGET_SINGLE") ? DASOERTLICHE_WIDGET_SINGLE : ""),
		  "WIDGET_COMBI" => (defined("DASOERTLICHE_WIDGET_COMBI") ? DASOERTLICHE_WIDGET_COMBI : ""),
		  "WIDGET_MINI" => (defined("DASOERTLICHE_WIDGET_MINI") ? DASOERTLICHE_WIDGET_MINI : ""),
		  "WIDGET_SINGLE_WIDE" => (defined("DASOERTLICHE_WIDGET_SINGLE_WIDE") ? DASOERTLICHE_WIDGET_SINGLE_WIDE : ""),
		  "WIDGET_COMBI_WIDE" => (defined("DASOERTLICHE_WIDGET_COMBI_WIDE") ? DASOERTLICHE_WIDGET_COMBI_WIDE : ""),		  
		  "WIDGET_CONTAINER" => (defined("DASOERTLICHE_WIDGET_CONTAINER") ? DASOERTLICHE_WIDGET_CONTAINER : ""),
		  "WIDGET_FIXEDWIDTH_CONTAINER" => (defined("DASOERTLICHE_WIDGET_FIXEDWIDTH_CONTAINER") ? DASOERTLICHE_WIDGET_FIXEDWIDTH_CONTAINER : ""),
          "WIDGET_CONTROL" => (defined("DASOERTLICHE_WIDGET_CONTROL") ? DASOERTLICHE_WIDGET_CONTROL : "")
      );
   }

   function getTemplate($key)
   {	
      $key = strtoupper($key);
      return (array_key_exists($key, $this->_templates) ? $this->_templates[$key] : "");
   }
   
   function getWidgetContainerTemplate()
   {	      
      return (array_key_exists("WIDGET_CONTAINER", $this->_templates) ? $this->_templates["WIDGET_CONTAINER"] : "");
   }
   
   function getWidgetFixedWidthContainerTemplate()
   {	      
      return (array_key_exists("WIDGET_FIXEDWIDTH_CONTAINER", $this->_templates) ? $this->_templates["WIDGET_FIXEDWIDTH_CONTAINER"] : "");
   }
    
   function getTemplateKey($searchfieldtype)
   {
      if (isset($searchfieldtype)) 
	  {
		  if (in_array($searchfieldtype, $this->_searchfieldType))
		  	return "WIDGET_".strtoupper($searchfieldtype);
	  }
	  
	  return "WIDGET_".strtoupper($this->_defaultWidgetSettings["searchfieldtype"]);
   }
   
   /**
    * 
    * @param string $language [Optional] default: "DE"
    */
   function _setLanguage($language)
   {
      $this->language = $language == NULL ? $this->_language : strtoupper($language);
      // Fallback
      if ( ! array_key_exists($this->language, $this->_languagePack))
      {
         $this->language = $this->_language;
      }
   }
   function setLanguage($language){
      $this->init($language);
   }

   /**
    * Add a custom language pack
    * @see member $_languagePack for values-properties
    * @param string $key
    * @param array $values 
    */
   function addLanguage($key, $values)
   {
      if ( ! array_key_exists($key, $this->_languagePack))
      {
         $this->_languagePack[$key] = $values;
      }
   }

   function getTextDomain()
   {
      return $this->_textDomain;
   }

   /**
    * Private function
    * @param string $context Plugin-Context
    * @param string $key Key of the given context
    * @return string A title. Empty String if not exists 
    */
   function _getTitle($context, $key)
   {
      $context = strtoupper($context);
      $key = strtoupper($key);

      if ( ! array_key_exists($context, $this->_languagePack[$this->language])
              || ! array_key_exists($key, $this->_languagePack[$this->language][$context]))
      {
         return "";
      }

      return $this->_languagePack[$this->language][$context][$key];
   }
   function _getTitles($context)
   {
      $context = strtoupper($context);

      if (! array_key_exists($context, $this->_languagePack[$this->language]))
      {
         return "";
      }
      return $this->_languagePack[$this->language][$context];
   }
    /**
    * 
    * @return string 
    */
	function getVersion()
	{
		return $this->_version;
	}
	
   /**
    * 
    * @return string 
    */
   function getWidgetDescription()
   {
      return $this->_getTitle("WIDGET_ADMIN", "DESCRIPTION");
   }

   /**
    *
    * @return string Plugin-Name 
    */
   function getName()
   {
      return $this->_languagePack[$this->language]["NAME"];
   }

   /**
    * @return string 
    */
   function getWidgetHeadline()
   {
      return $this->_getTitle("WIDGET", "HEADLINE");
   }

   function getWidgetSearchtermLabel()
   {
      return $this->_getTitle("WIDGET", "SEARCHTERMLABEL");
   }

   function getWidgetRegionLabel()
   {
      return $this->_getTitle("WIDGET", "REGIONLABEL");
   }

   function getWidgetSearchbuttonValue()
   {
      return $this->_getTitle("WIDGET", "SEARCHBUTTONVALUE");
   }
   
   function getWidgetSearchURL()
   {
	  return $this->_getTitle("WIDGET", "SEARCHURL");   
   }

   function getDefaultWidgetSettings()
   {
      reset($this->_defaultWidgetSettings);
      return $this->_defaultWidgetSettings;
   }

   function getAdminSearchfieldLabel()
   {
      return $this->_getTitle("WIDGET_ADMIN", "SEARCHFIELD_LABEL");
   }

   function getAdminSearchfieldOptions($selected)
   {
      $res = "";
      foreach ($this->_searchfieldType as $key)
      {
         $res .= '<option value="' . $key . '"' . ($key == $selected ? ' selected="selected"' : '')
                 . '>' . $this->_getTitle("WIDGET_ADMIN", strtoupper($key . "_SEARCHFIELDTEXT")) . '</option>';
      }

      return $res;
   }

   function getAdminRegionfieldLabel()
   {
      return $this->_getTitle("WIDGET_ADMIN", "REGIONFIELD_LABEL");
   }
   
   function getAdminAccesskeyfieldLabel()
   {
      return $this->_getTitle("WIDGET_ADMIN", "ACCESSKEY_LABEL");
   }
   
   function getOptionPagePageTitle(){
      return $this->_getTitle("OPTIONPAGE", "PAGETITLE");
   }   
   function getSingleMinWidth()
   {
	   return $this->_singleMinWidth;
   }
   function getCombiMinWidth()
   {
	   return $this->_combiMinWidth;
   }
   function getSingleWideSwitchWidth()
   {
	   return $this->_singleWideSwitchWidth;
   }
   function getCombiWideSwitchWidth()
   {
	   return $this->_combiWideSwitchWidth;
   }
}

/**
 * 
 */
class DasOertlicheOptionPageConfig{
   var $_config;
   var $_options;
   var $_titles;
   function DasOertlicheOptionPageConfig($conf, $options, $titles)
   {
      $this->_config = $conf;
      $this->_options = is_array($options) ? $options : array();
      $this->_titles = is_array($titles) ? $titles : array();
   }
   
   function getSettingsGroupKey()
   {
      return $this->_getOption("SETTINGS_GROUPNAME");
   }
   function getApiFieldId()
   {
      return $this->_getOption("API_KEY_FIELD_ID");
   }
   function getResultpageFieldId()
   {
      return $this->_getOption("RESULT_PAGE_FIELD_ID");
   }
   
   function getPageTitle()
   {
      return $this->_getTitle("PAGETITLE");
   }
   function getApiFieldTitle()
   {
      return $this->_getTitle("API_KEY");
   }
   function getApiKeyInfo()
   {
      return $this->_getTitle("API_KEY_INFO");
   }
   function getResultpageFieldTitle()
   {
      return $this->_getTitle("RESULT_PAGE");
   }
   function getResultpageFieldInfo()
   {
      return $this->_getTitle("RESULT_PAGE_INFO");
   }
   function getSaveHint(){
      return '<div id="message" class="updated"><p><strong>' . $this->_getTitle("SAVE_HINT") . '</strong></p></div>';
   }
   function _getTitle($key){
      return $this->_getValue($key, $this->_titles);
   }
   function _getOption($key){
      return $this->_getValue($key, $this->_options);
   }
   function _getValue($key, $array){
      return array_key_exists($key, $array) ? $array[$key] : "";
   }
}
?>