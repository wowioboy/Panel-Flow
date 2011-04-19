<? 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include_once($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/classes/pagination.php");  // include main class filw which creates pages
$ProjectID = $_SESSION['sessionproject'];
$UserID = $_SESSION['userid'];
$PathtoPF = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory'];
$PathToProject = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder'];
$NumItemsPerPage = $_GET['c'];
if ($NumItemsPerPage == '')
	$NumItemsPerPage = 5;
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/includes/connect_functions.php');
include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/processing/links_app_functions_inc.php';
?>
<LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<LINK href="http://www.wevolt.com/<? echo $_SESSION['pfdirectory'];?>/css/cms_css.css" rel="stylesheet" type="text/css">
<body style="width:98%;"> 

<div align="right">
 <table width="96%" cellspacing="3">
                         <tr>
                         
                         <td></td>
                         
                         <td>
                         
                         <table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
                                        <div style="float:left">Links</div><div style="float:right;">edit or add new links to share.</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
                        
                        <div class="spacer"></div>
                               

                        </td></tr>
                        
                        
                        
                         <tr>
                         
                         <td valign="top" align="left">
                
                         <div class="<? if($_GET['a'] != '') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="spacer"></div><? if($_GET['a'] != '') {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/links_inc.php'><? }?>List Links<? if($_GET['a'] != '') {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                           <div class="<? if($_GET['a'] != 'new') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="spacer"></div><? if($_GET['a'] == 'new') {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/links_inc.php?a=new'><? }?>New Link<? if($_GET['a'] == 'new') {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                
                        </td>
                        
                        
                        <td valign="top">

<?							
if ($_GET['a'] == '') {
		include $PathtoPF.'/section/links_inc_html.php';
} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'new')) {
			include $PathtoPF.'/section/links_edit_inc.php';
} else if ($_GET['a'] == 'delete') {
			include $PathtoPF.'/section/links_delete_inc.php';
}
						
?>
  </td>
                        </tr>
                        </table>
</body>