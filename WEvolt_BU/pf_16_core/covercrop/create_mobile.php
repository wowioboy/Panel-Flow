<? 
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');

$PageTitle .= ' create mobile wallpaper';
$TrackPage = 0;
include $_SERVER['DOCUMENT_ROOT'].'/includes/header_template_new.php';?>
<script type="text/javascript" src="http://www.wevolt.com/scripts/cms_wizard_functions.js"></script>

<LINK href="http://www.wevolt.com/<? echo $PFDIRECTORY;?>/css/cms_css.css" rel="stylesheet" type="text/css">
<div align="left">
    <table cellpadding="0" cellspacing="0" border="0"  width="100%">
    <tr>
    <td valign="top" style="padding:5px; color:#FFFFFF;width:60px;">
    <? include  $_SERVER['DOCUMENT_ROOT'].'/includes/site_menu_popup_inc.php';?>
    </td> 
    
    <td valign="top" align="center">
    <table width="600" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="584" align="center">       
<?php 
include 'crop_mobile_inc.php';

?></td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>
    </td>
    </tr>
    </table>
</div>
<?
include $_SERVER['DOCUMENT_ROOT'].'/includes/footer_template_new.php';?> 
