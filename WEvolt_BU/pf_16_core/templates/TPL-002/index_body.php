<?php 

$BoxWidth = 340;
$ContentWidth =  $BoxWidth - 22;
$CommentBoxWidth = $Width;
$CommentContentWidth =  $CommentBoxWidth - 22;

	// Comic Header
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_header.php';?>
<div align="center">

<table cellpadding="0" cellspacing="0" border="0" width="900"><tr><td colspan="2" style="padding-left:10px;">
<? if ($HeaderImage != "" ) {?><div class="header"><img src="images/<?php echo $HeaderImage;?>" /></div><? }?>
</td></tr>

<tr>
<td width="710" valign="top" style="padding-left:10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<td valign="top" align="center">

<?php 
//PANEL FLOW READER
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/reader_inc.php';?>
</td>
<? if ($PositionThree == 1) { ?>
<td valign="top" align="center" <?  if ($PositionFour == 1) echo 'rowspan="2"';?>>
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
<? if ($CommentSetting == 1) { ?>
<div class="spacer"></div>

<table width="<? echo $CommentBoxWidth;?>" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop"></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="<? echo $CommentContentWidth;?>" valign="top">	
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
<? } ?>
</td>
<td width="<? echo $BoxWidth+25;?>"  valign="top" align="right" style="padding-left:15px;">

<!-- AUTHOR COMMENT MODULE -->
<table width="<? echo $BoxWidth;?>" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td <? echo $ContentWidth;?> id="modtop"></td>
	<td id="modtopright"></td>
</tr>
	
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="<? echo $ContentWidth;?>" valign="top">	
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
<!-- COMIC INFO MODULE  -->
<table width="<? echo $BoxWidth;?>" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td <? echo $ContentWidth;?> id="modtop" ></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="<? echo $ContentWidth;?>" valign="top">	
		<?php 
	// Comic Info Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_module.php';?>
	<div class="spacer"></div>
    <!-- USER CONTROL MODULE  -->
		<?php 
	// User Control Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/user_module.php';?>	
	
<!-- END MODULE  -->
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
<table width="<? echo $BoxWidth;?>" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop" ></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="<? echo $ContentWidth;?>" valign="top">	
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
<table width="<? echo $BoxWidth;?>" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop"></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" width="<? echo $ContentWidth;?>" valign="top">	
		<?php 
	//Comments Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comment_module.php';?>			
	<div class="spacer"></div></td>
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
<!-- LOGIN  -->
<?php 
	// Login Module
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/login_inc.php';?>		
<!-- END MODULE  -->
</td></tr></table>
<? if ($PositionFive == 1) { ?>
<div align="center">
	<? echo $PositionFiveAdCode;?>
</div>
<? }?>
</div>
	<?php 
	// Comic Footer
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_footer.php';?>