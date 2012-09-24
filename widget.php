<?php

include_once(dirname(__FILE__) . "/optionmanager.php");

class DasOertlicheSearchWidget extends WP_Widget
{

   var $oeConfig;

   function DasOertlicheSearchWidget()
   {
      $this->_oeInit();
   }

   function _oeInit()
   {
      $this->oeConfig = new DasOertlicheSearchConfig();
      $this->WP_Widget('DasOertlicheSearchWidget', $this->oeConfig->getName(), array(
          'classname' => 'DasOertlicheSearchWidget',
          'description' => __($this->oeConfig->getWidgetDescription(), $this->oeConfig->getTextDomain())));

      $this->_registerStyle();
   }

   /**
    * prints the widget
    * @param type $args
    * @param type $instance 
    */
   function widget($args, $instance)
   {
      extract($args, EXTR_SKIP);
      $res = $before_widget;
      $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
      $entry_title = empty($instance['entry_title']) ? ' ' : apply_filters('widget_entry_title', $instance['entry_title']);
      $comments_title = empty($instance['comments_title']) ? ' ' : apply_filters('widget_comments_title', $instance['comments_title']);
      if ( ! empty($title))
      {
         $res .= $before_title . $title . $after_title;
      }

      // Identifikation des Template-ID innerhalb der Konfiguration
      $templateID = $this->oeConfig->getTemplateKey($this->getInstanceValue($instance, "searchfieldtype"));

      $res .= $this->expandTemplate($templateID, $this->oeConfig->getWidgetContainerTemplate(), $this->getInstanceValue($instance, "searchregion"), $this->getInstanceValue($instance, "accesskey"));
      $res .= $after_widget;

      echo $res;
   }

   function expandTemplate($templateID, $ContainerHTML="", $searchregion = "", $accessKey = "")
   {
      // Optionen (Adminbereich - Das �rtliche Suchfeld - Einstellungen)
      $oeOptionManager = new DasOertlicheOptionManager($this->oeConfig);
      $target = "_self";
      if ($oeOptionManager->getOption($this->oeConfig->optionPage->getResultpageFieldId()))
         $target = "_blank";
      if ($searchregion == "")
         $searchregion = 'Ort';

      $woId = $this->GetRandomID(); // Undeutig bei ContetnBannern//$this->get_field_id('wo');
      $wasId = $this->GetRandomID();

      $tmpl = str_replace("{:::TITLE:::}", $this->oeConfig->getWidgetHeadline(), $this->oeConfig->getTemplate($templateID));
      $tmpl = str_replace("{:::SEARCHTERMLABEL:::}", $this->oeConfig->getWidgetSearchtermLabel(), $tmpl);
      $tmpl = str_replace("{:::REGIONLABEL:::}", $this->oeConfig->getWidgetRegionLabel(), $tmpl);
      $tmpl = str_replace("{:::SEARCHBUTTONVALUE:::}", $this->oeConfig->getWidgetSearchbuttonValue(), $tmpl);

      $tmpl = str_replace("{:::SEARCHURL:::}", $this->oeConfig->getWidgetSearchURL(), $tmpl);
      $tmpl = str_replace("{:::VERSION:::}", $this->oeConfig->getVersion(), $tmpl);
      $tmpl = str_replace("{:::TARGET:::}", $target, $tmpl);

      $tmpl = str_replace("{:::OETB_WAS_ID:::}", $wasId, $tmpl);
      $tmpl = str_replace("{:::ACCESSKEY_WAS:::}", $accessKey, $tmpl);


      if (strpos($ContainerHTML, "{:::WIDGET:::}") === false)
      {
         $tmpl = str_replace("{:::OESEARCHREGION:::}", $searchregion, $tmpl);
         $tmpl = str_replace("{:::OETB_WO_ID:::}", $woId, $tmpl);

         return $tmpl;
      }
      else
      {
         $tmpl = str_replace("{:::WIDGET:::}", $tmpl, $ContainerHTML);
         $tmpl = str_replace("{:::OESEARCHREGION:::}", $searchregion, $tmpl);
         $tmpl = str_replace("{:::OETB_WO_ID:::}", $woId, $tmpl);
         return $tmpl;
      }
   }

   function getInstanceValue($instance, $key)
   {
      if ((isset($instance)) && (is_array($instance)) && (array_key_exists($key, $instance)))
         return $instance[$key];
      return "";
   }

   /*
     Create a Random ID
    */

   function GetRandomID()
   {
      return "oetb_" . time() . rand();  ///microtime 
   }

   /**
    * Adding style
    */
   function _registerStyle()
   {
      wp_register_style("dasoertliche_searchstyle", plugins_url("/css/default.css", __FILE__));
      wp_enqueue_style("dasoertliche_searchstyle");
   }

   /**
    * save the widget
    * @param type $newInstance
    * @param type $oldInstance
    * @return type 
    */
   function update($newInstance, $oldInstance)
   {
      $instance = $oldInstance;
      $settings = $this->oeConfig->getDefaultWidgetSettings();
      while (list($key, $val) = each($settings))
      {
         $instance[$key] = strip_tags($newInstance[$key]);
      }
      return $instance;
   }

   /**
    * prints the widgetform in backend
    * @param type $instance 
    */
   function form($instance)
   {
      $instance = wp_parse_args((array) $instance, $this->oeConfig->getDefaultWidgetSettings());
      $searchfieldType = strip_tags($instance["searchfieldtype"]);
      $searchRegion = strip_tags($instance["searchregion"]);
      $accessKey = strip_tags($instance["accesskey"]);
      $tmpl = str_replace("{:::SEARCHFIELDTYPE_LABEL:::}", $this->oeConfig->getAdminSearchfieldLabel(), $this->oeConfig->getTemplate("widget_control"));
      $tmpl = str_replace("{:::SEARCHFIELDTYPE_ID:::}", $this->get_field_id('searchfieldtype'), $tmpl);
      $tmpl = str_replace("{:::SEARCHFIELDTYPE_NAME:::}", $this->get_field_name('searchfieldtype'), $tmpl);
      $tmpl = str_replace("{:::SEARCHFIELDTYPE_OPTIONS:::}", $this->oeConfig->getAdminSearchfieldOptions($searchfieldType), $tmpl);
      $tmpl = str_replace("{:::REGIONFIELD_LABEL:::}", $this->oeConfig->getAdminRegionfieldLabel(), $tmpl);
      $tmpl = str_replace("{:::REGIONFIELD_ID:::}", $this->get_field_id('searchregion'), $tmpl);
      $tmpl = str_replace("{:::REGIONFIELD_NAME:::}", $this->get_field_name('searchregion'), $tmpl);
      $tmpl = str_replace("{:::REGIONFIELD_VALUE:::}", $searchRegion, $tmpl);
      $tmpl = str_replace("{:::ACCESSKEY_LABEL:::}", $this->oeConfig->getAdminAccesskeyfieldLabel(), $tmpl);
      $tmpl = str_replace("{:::ACCESSKEY_NAME:::}", $this->get_field_name('accesskey'), $tmpl);
      $tmpl = str_replace("{:::ACCESSKEY_VALUE:::}", $accessKey, $tmpl);

      echo $tmpl;
   }

}

?>