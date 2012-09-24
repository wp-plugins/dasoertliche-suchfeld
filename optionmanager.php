<?php
/**
 * options handler
 */
class DasOertlicheOptionManager
{
   /** DasOertlicheOptionPageConfig */
   var $config;
   var $method;

   /**
    * Constructor
    * @param DasOertlicheOptionPageConfig $config 
    * @param String $formMethod [optional] post or get. default: post
    */
   function DasOertlicheOptionManager($config, $formMethod="post")
   {
      $this->config = $config;
      $this->method = strtolower($formMethod);
   }
   /**
    * returns the current form method
    * @return string post or get 
    */
   function getMethod()
   {
      return $this->method;
   }
   /**
    * Returns the option value for the given key, or false
    * @see wp get_option
    * @param string $key option key
    * @return mixed value for the given key 
    */
   function getOption($key)
   {
      return get_option($key);
   }
   
   /**
    * saves all inputs of the option page
    * @return boolean true when done, or false if the the api-field-key not exists 
    */
   function onUpdateForm()
   {
      $params = $this->method == "get" ? $_GET : $_POST;
      #var_dump($params);
      if (is_array($params))
      {
         if (array_key_exists($this->config->optionPage->getApiFieldId(), $params))
         {
            $this->_updateOption($this->config->optionPage->getApiFieldId(), htmlentities(trim($params[$this->config->optionPage->getApiFieldId()])));
            $this->_updateOption($this->config->optionPage->getResultpageFieldId(), $params[$this->config->optionPage->getResultpageFieldId()]);
            
            return true;
         }
      }

      return false;
   }
   /*
    * wp update_option wrapper
    */
   function _updateOption($option, $value)
   {
      update_option($option, $value);
   }

}

?>
