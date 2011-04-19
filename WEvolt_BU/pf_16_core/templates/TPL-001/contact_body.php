<?php
$Title = 'Contact | '.$CreatorName;
	// Comic Header
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_header.php';?>

<?php 
//PANEL FLOW READER
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/topbar_inc.php';?>
<div class="spacer"></div>
<div align="center">
<div class="spacer"></div>
<div class="contentwrapper" align="center">
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
	<td width="489" valign="top">
	<div class="rightwrapper">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop" ></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" valign="top">
		<div id="email">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>

<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/email_db.swf','email','437','239','9');             
				  so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
				   so.addVariable('pfdirectory','<?php echo $PFDIRECTORY;?>');
				  so.addVariable('server','<?php echo $_SERVER['SERVER_NAME'];?>');
				  so.addVariable('comicid','<?php echo $ComicID;?>');
                  so.write('email'); 
</script>		
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
</div>
</td>
    </tr>
</table>
</div>
	<?php 
	// Comic Footer
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_footer.php';?>