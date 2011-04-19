<?php 
	// Comic Header
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_header.php';?>

<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<? if ($PositionTwo == 1) { ?>
<td valign="top" <?  if ($PositionFour == 1) echo 'rowspan="2"';?> align="center">
	<? echo '<div>'.$PositionTwoAdCode."</div>";?>
</td>
<? }?>

<td valign="top" align="center">

<?php 
//PANEL FLOW READER
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/reader_inc.php';?>
</td>
<? if ($PositionThree == 1) { ?>
<td valign="top" align="center" <? if ($PositionFour == 1) echo 'rowspan="2"';?>>
	<? echo '<div>'.$PositionThreeAdCode."</div>";?>
</td>
<? }?>

</tr>
<? if ($PositionFour == 1) { ?>
<td valign="top" align="center" >
	<? echo '<div>'.$PositionFourAdCode."</div>";?>
</td>
<? }?>
</table>

<div class="spacer"></div>	
<div class="contentwrapper" align="center">

<table width="706">
<tr>
<td width="340" height="229" valign="top">
	
<!-- AUTHOR COMMENT MODULE -->
<table width="340" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td width="318" id="modtop"></td>
	<td id="modtopright"></td>
</tr>
	
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="318" valign="top">	
	<?php 
	//AUTHOR COMMENT MODULE
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/author_comment_module.php';?>

	</td>
	<td id="modrightside"></td>
</tr>
	
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
<!-- END MODULE  -->
<? if ($CommentSetting == 1) { ?>
<!-- PAGE COMMENT MODULE -->
<table width="340" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td width="318" id="modtop"></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="318" valign="top">	
	
		<?php 
	// Page Comments Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/page_comments_module.php';?>
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
<!-- END MODULE  -->		
<? } ?>
</td>	
<!-- END OF LEFT COLUM  -->		
<td width="10">&nbsp;</td>		
<td width="340" valign="top">

<!-- USER CONTROL MODULE  -->
<table width="340" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td width="318" id="modtop" ></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="318" valign="top">	
				
		<?php 
	// User Control Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/user_module.php';?>	
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td  id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
<!-- END MODULE  -->
		

<!-- COMIC INFO MODULE  -->
<table width="340" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td width="318" id="modtop" ></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="318" valign="top">	
		<?php 
	// Comic Info Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_module.php';?>
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
<!-- END MODULE  -->

<!-- COMIC SYNOPSIS MODULE  -->
<table width="340" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop" ></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="318" valign="top">	
		<?php 
	// Synopsis Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_synopsis_module.php';?>				
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
<!-- END MODULE  -->
<? if ($CommentSetting == 1) { ?>
<!-- COMMENT FORM MODULE  -->
<table width="340" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop"></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="318" valign="top">	
		<?php 
	//Comments Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comment_module.php';?>			
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
<!-- END MODULE  -->
<? } ?>
<!-- USER LOGIN MODULE  -->

	<?php 
	// Login Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/login_inc.php';?>
	
<!-- END MODULE  -->
		
</td>
</tr>
</table>
<? if ($PositionFive == 1) { ?>
<div align="center">
	<? echo '<div>'.$PositionFiveAdCode."</div>";?>
</div>
<? }?>
</div>			
	<?php 
	// Comic Footer
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_footer.php';?>