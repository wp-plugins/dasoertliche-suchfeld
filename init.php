<?php
include_once(dirname(__FILE__).'/config.php');

if(! isset($oeConfig)){
   $oeConfig = new DasOertlicheSearchConfig();
}

add_option($oeConfig->optionPage->getApiFieldId());
add_option($oeConfig->optionPage->getResultpageFieldId());

?>