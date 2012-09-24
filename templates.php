<?php
$DASOERTLICHE_WIDGET_SINGLE = <<<DASOE
	<div class="oetbreset oetb_single">
	  <form accept-charset="ISO-8859-1" target="{:::TARGET:::}" onsubmit="if (was_und_wo && was_und_wo.value && was_und_wo.value=='Suchwort und/oder Ort') was_und_wo.value='';" method="get" action="{:::SEARCHURL:::}">
	    <input type="hidden" name="version" value="{:::VERSION:::}">  
		<input type="hidden" name="source" value="partner">
		<input type="hidden" name="sourceid" value="WordPress Plugin">
		<div class="oetbblue">
		  <div class="oetbwhite">
			<a target="_blank" href="http://www.dasoertliche.de">
			  <img width="178" height="63" alt="Das Örtliche - Die Auskunft für Ihren Ort" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_logo.gif">
			</a>
		  </div>
		  <div class="oetbslogan">Die Auskunft für Ihren Ort</div>
		  <div class="oetbentry">
			<label accesskey="{:::ACCESSKEY_WAS:::}" for="{:::OETB_WAS_ID:::}">Suchwort und/oder Ort</label>
			<input type="text" value="Suchwort und/oder Ort" onfocus="if (this.value=='Suchwort und/oder Ort') {this.value=''; this.style.color='#000000';} return true;" onblur="if (this.value == ''){ this.value = 'Suchwort und/oder Ort';this.style.color='#999999';} return true;" name="was" id="{:::OETB_WAS_ID:::}">
			<input type="image" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_search.gif" name="{:::SEARCHBUTTONVALUE:::}" alt="{:::SEARCHBUTTONVALUE:::}">
		  </div>
		</div>
	  </form>
	</div>
DASOE;
define("DASOERTLICHE_WIDGET_SINGLE", $DASOERTLICHE_WIDGET_SINGLE);

$DASOERTLICHE_WIDGET_COMBI = <<<DASOE
	<div class="oetbreset oetb_combi">
	  <form accept-charset="ISO-8859-1" target="{:::TARGET:::}" onsubmit="if (was && was.value && was.value=='Suchwort') was.value='';" method="get" action="{:::SEARCHURL:::}">
		<input type="hidden" name="version" value="{:::VERSION:::}">    	
    	<input type="hidden" name="source" value="partner">
		<input type="hidden" name="sourceid" value="WordPress Plugin">
		<div class="oetbblue">
		  <div class="oetbwhite">
			<a target="_blank" href="http://www.dasoertliche.de" >
			  <img width="178" height="63" alt="Das Örtliche - Die Auskunft für Ihren Ort" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_logo.gif">
			</a>
		  </div>
		  <div class="oetbslogan">Die Auskunft für Ihren Ort</div>
		  <div class="oetbentry">
			<label accesskey="{:::ACCESSKEY_WAS:::}" for="{:::OETB_WAS_ID:::}">Suchwort</label>
			<input type="text" value="Suchwort" onfocus="if (this.value=='Suchwort') {this.value=''; this.style.color='#000000';} return true;" onblur="if (this.value == '') {this.value = 'Suchwort';this.style.color='#999999';} return true;"  name="was" id="{:::OETB_WAS_ID:::}"><br />
			<label for="{:::OETB_WO_ID:::}">Ort</label>
			<input type="text" value="{:::OESEARCHREGION:::}" onfocus="if ( (this.value=='{:::OESEARCHREGION:::}') || (this.value=='Ort') ) { this.value=''; this.style.color='#000000';} return true;" onblur="if (this.value == '') { if (std_{:::OETB_WO_ID:::} != '') {this.value=std_{:::OETB_WO_ID:::}; } else {this.value = 'Ort';}; this.style.color='#999999';} return true;"  name="wo" id="{:::OETB_WO_ID:::}" class="{:::OESEARCHREGION:::}">
			<input type="image" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_search.gif" name="{:::SEARCHBUTTONVALUE:::}" alt="{:::SEARCHBUTTONVALUE:::}">
		  </div>
		</div>
	  </form>
	</div>  
DASOE;
define("DASOERTLICHE_WIDGET_COMBI", $DASOERTLICHE_WIDGET_COMBI);

$DASOERTLICHE_WIDGET_COMBI_WIDE = <<<DASOE
<div class="oetbreset oetb_combi_wide">
  <form accept-charset="ISO-8859-1" target="{:::TARGET:::}" onsubmit="if (was && was.value && was.value=='Suchwort') was.value='';" method="get" action="{:::SEARCHURL:::}">
    <input type="hidden" name="version" value="{:::VERSION:::}">
    <input type="hidden" name="source" value="partner">
    <input type="hidden" name="sourceid" value="WordPress Plugin">
    <div class="oetbblue">
      <div class="oetbwhite">
		<a target="_blank" href="http://www.dasoertliche.de" > 
			<img width="178" height="63" alt="Das Örtliche - Die Auskunft für Ihren Ort" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_logo.gif">
		</a>
	  </div>
      <div class="oetbslogan">Die Auskunft für Ihren Ort</div>
      <div class="oetbentry">
        <table>
          <tr>
            <td class="oetb_cell01">
			  <label accesskey="{:::ACCESSKEY_WAS:::}" for="{:::OETB_WAS_ID:::}">Suchwort</label>
              <input type="text" value="Suchwort" onfocus="if (this.value=='Suchwort') {this.value=''; this.style.color='#000000';} return true;" onblur="if (this.value == '') {this.value = 'Suchwort';this.style.color='#999999';} return true;" name="was" id="{:::OETB_WAS_ID:::}"></td>
            <td class="oetb_cell02" >
			  <label for="{:::OETB_WO_ID:::}">Ort</label>
              <input type="text" value="{:::OESEARCHREGION:::}" onfocus="if ( (this.value=='{:::OESEARCHREGION:::}') || (this.value=='Ort') ) { this.value=''; this.style.color='#000000';} return true;" onblur="if (this.value == '') { if (std_{:::OETB_WO_ID:::} != '') {this.value=std_{:::OETB_WO_ID:::}; } else {this.value = 'Ort';}; this.style.color='#999999';} return true;" name="wo" id="{:::OETB_WO_ID:::}"></td>
            <td class="oetb_cell03"><input type="image" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_search.gif" name="{:::SEARCHBUTTONVALUE:::}" alt="{:::SEARCHBUTTONVALUE:::}"></td>
          </tr>
        </table>
      </div>
    </div>
  </form>
</div>
DASOE;
define("DASOERTLICHE_WIDGET_COMBI_WIDE", $DASOERTLICHE_WIDGET_COMBI_WIDE);


$DASOERTLICHE_WIDGET_SINGLE_WIDE = <<<DASOE
	<div class="oetbreset oetb_single_wide">
	  <form accept-charset="ISO-8859-1" target="{:::TARGET:::}" onsubmit="if (was_und_wo && was_und_wo.value && was_und_wo.value=='Suchwort und/oder Ort') was_und_wo.value='';" method="get" action="{:::SEARCHURL:::}">
	    <input type="hidden" name="version" value="{:::VERSION:::}">  
		<input type="hidden" name="source" value="partner">
		<input type="hidden" name="sourceid" value="WordPress Plugin">
		<div class="oetbblue">
		  <div class="oetbwhite">
			<a target="_blank" href="http://www.dasoertliche.de" >
			  <img width="178" height="63" alt="Das Örtliche - Die Auskunft für Ihren Ort" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_logo.gif">
			</a>
		  </div>
		  <div class="oetbslogan">Die Auskunft für Ihren Ort</div>
		  <div class="oetbentry">
			<table>
				<tr>
					<td class="oetb_cell01">
						<label accesskey="{:::ACCESSKEY_WAS:::}" for="{:::OETB_WAS_ID:::}">Suchwort und/oder Ort</label>
						<input type="text" value="Suchwort und/oder Ort" onfocus="if (this.value=='Suchwort und/oder Ort') {this.value=''; this.style.color='#000000';} return true;" onblur="if (this.value == ''){ this.value = 'Suchwort und/oder Ort';this.style.color='#999999';} return true;" name="was" id="{:::OETB_WAS_ID:::}">
					</td>
					<td class="oetb_cell03">
						<input type="image" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_search.gif" name="{:::SEARCHBUTTONVALUE:::}" alt="{:::SEARCHBUTTONVALUE:::}">
					</td>
				</tr>
			</table>
		  </div>
		</div>
	  </form>
	</div>
DASOE;
define("DASOERTLICHE_WIDGET_SINGLE_WIDE", $DASOERTLICHE_WIDGET_SINGLE_WIDE);


$DASOERTLICHE_WIDGET_MINI = <<<DASOE
<div class="oetbreset oetb_mini">
 <form accept-charset="ISO-8859-1" target="{:::TARGET:::}" onsubmit="if (was && was.value && was.value=='Suchwort') was.value='';" method="get" action="{:::SEARCHURL:::}">
 	<input type="hidden" name="version" value="{:::VERSION:::}">  
	<input type="hidden" name="source" value="partner">
	<input type="hidden" name="sourceid" value="WordPress Plugin">
	<table>
		<tr>
			<td class="oetb_cell01">
				<label accesskey="{:::ACCESSKEY_WAS:::}" for="{:::OETB_WAS_ID:::}">Suchwort und/oder Ort</label>
				<input id="{:::OETB_WAS_ID:::}" type="text" name="was" value="" class="was_und_wo_oe_editfeld" onfocus="this.style.backgroundPosition = '0 -30px'; return true;" onblur="if (this.value == '') this.style.backgroundPosition = '0 0'; return true;" />
			</td>
			<td class="oetb_cell03">
				<input type="image" src="wp-content/plugins/dasoertliche-suchfeld/img/185x250_oe_search.gif" name="{:::SEARCHBUTTONVALUE:::}" alt="{:::SEARCHBUTTONVALUE:::}" />
			</td>
		</tr>
	</table>
  </form>
  </div>
DASOE;
define("DASOERTLICHE_WIDGET_MINI", $DASOERTLICHE_WIDGET_MINI);

$DASOERTLICHE_WIDGET_CONTAINER = <<<DASOE
<!-- Das Örtliche Suchfeld - BEGIN -->
<script type='text/javascript'>var std_{:::OETB_WO_ID:::}="{:::OESEARCHREGION:::}"</script>
<div  class="widget-container widget_search">
{:::WIDGET:::}
</div>
<!-- Das Örtliche Suchfeld - END -->
DASOE;
define("DASOERTLICHE_WIDGET_CONTAINER", $DASOERTLICHE_WIDGET_CONTAINER);

$DASOERTLICHE_WIDGET_FIXEDWIDTH_CONTAINER = <<<DASOE
<!-- Das Örtliche Suchfeld - BEGIN -->
<script type='text/javascript'>var std_{:::OETB_WO_ID:::}="{:::OESEARCHREGION:::}"</script>
<div style="width:{:::FIXEDWIDTH:::}px;">
{:::WIDGET:::}
</div>
<!-- Das Örtliche Suchfeld - END -->
DASOE;
define("DASOERTLICHE_WIDGET_FIXEDWIDTH_CONTAINER", $DASOERTLICHE_WIDGET_FIXEDWIDTH_CONTAINER);


$DASOERTLICHE_WIDGET_CONTROL = <<<DASOE
	<p>
		<script>
			jQuery(document).ready(function ($) {
				if ( $('#{:::SEARCHFIELDTYPE_ID:::} option:selected').index() != 1)
				{
					$('#{:::REGIONFIELD_ID:::}').css("visibility", "hidden");	
					$('.{:::REGIONFIELD_ID:::}').css("visibility", "hidden");					
				}
				else
				{
					$('#{:::REGIONFIELD_ID:::}').css("visibility", "visible");	
					$('.{:::REGIONFIELD_ID:::}').css("visibility", "visible");					
				}
				
			});
        </script>
		<label for="{:::SEARCHFIELDTYPE_ID:::}">{:::SEARCHFIELDTYPE_LABEL:::}</label> 
		<select id="{:::SEARCHFIELDTYPE_ID:::}" name="{:::SEARCHFIELDTYPE_NAME:::}" class="widefat" onchange=" if (this.options.selectedIndex != 1) { document.getElementById('{:::REGIONFIELD_ID:::}').style.visibility  = 'hidden'; document.getElementsByClassName('{:::REGIONFIELD_ID:::}')[0].style.visibility  = 'hidden'; } else {document.getElementById('{:::REGIONFIELD_ID:::}').style.visibility = 'visible'; document.getElementsByClassName('{:::REGIONFIELD_ID:::}')[0].style.visibility  = 'visible'; } ">
			{:::SEARCHFIELDTYPE_OPTIONS:::}
		</select>
        
	</p>
	<p>
	  <label for="{:::REGIONFIELD_ID:::}" class="{:::REGIONFIELD_ID:::}">{:::REGIONFIELD_LABEL:::}</label>
	  <input id="{:::REGIONFIELD_ID:::}" name="{:::REGIONFIELD_NAME:::}" type="text" value="{:::REGIONFIELD_VALUE:::}" class="widefat" />
	</p>
    <p>
    	<label for="{:::ACCESSKEY_ID:::}">{:::ACCESSKEY_LABEL:::}</label> 
        <input id="{:::ACCESSKEY_ID:::}" name="{:::ACCESSKEY_NAME:::}" type="text" value="{:::ACCESSKEY_VALUE:::}"  maxlength="1" pattern="[A-z]{1}" size="1" />
    </p>
DASOE;
define("DASOERTLICHE_WIDGET_CONTROL", $DASOERTLICHE_WIDGET_CONTROL);

?>
