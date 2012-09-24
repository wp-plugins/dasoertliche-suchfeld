<?php
include_once(dirname(__FILE__) . "/config.php");
include_once(dirname(__FILE__) . "/optionmanager.php");

if(! isset($oeConfig)){
   $oeConfig = new DasOertlicheSearchConfig();
}
$oeOptionManager = new DasOertlicheOptionManager($oeConfig);

?>
<h3><?php echo $oeConfig->optionPage->getPageTitle() ?></h3>

<?php if($oeOptionManager->onUpdateForm()){ echo $oeConfig->optionPage->getSaveHint(); } ?>
<form name="rssForm" method="<?php echo $oeOptionManager->getMethod() ?>" action="admin.php?page=<?php echo $oeConfig->getTextDomain() ?>">
<?php settings_fields($oeConfig->optionPage->getSettingsGroupKey()) ?>
   
   <table class="form-table">
    <tr valign="top">
      <th scope="row"><?php echo $oeConfig->optionPage->getResultpageFieldTitle() ?></th>
      <td><input name="<?php echo $oeConfig->optionPage->getResultpageFieldId() ?>" type="checkbox" value="yes"  <?php if( $oeOptionManager->getOption($oeConfig->optionPage->getResultpageFieldId()) == "yes"){echo "checked";} ?> />
      <?php echo $oeConfig->optionPage->getResultpageFieldInfo() ?></td>
    </tr>
  </table>
   
  <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e("Save Changes") ?>" />
  </p>
</form>