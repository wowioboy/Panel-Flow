<?  
$IsCMS = true;
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php'; 
$_SESSION['usertype'] = 2;
$Pagetracking = 'Admin'; 
if ($_SESSION['IsPro'] == 1)
	$_SESSION['noads'] = 1;
else 
	$_SESSION['noads'] = 0;
$_SESSION['contentwidth'] = '1000';
$UserID = $_SESSION['userid'];
if ($_SESSION['userid'] == '')
	header("location:/login.php?ref=/cms/admin/");
$SessionAdminUserID = $UserID;
$SessionEmail = $_SESSION['email'];
$NumItemsPerPage = $_GET['c'];
if ($NumItemsPerPage == '')
	$NumItemsPerPage = 7; 
if ($_GET['t'] != 'project')
	$_SESSION['sessionproject'] = '';
	
include 'includes/admin_date_inc.php'; 



if (($_POST['deleteconfirm']==1) && ($_SESSION['username'] == $AdminUser)) {
	$DeleteID = $_POST['txtComic'];
	$query ="DELETE from projects where ProjectID ='$DeleteID'";
	$InitDB->query($query);
	$query ="DELETE from comics where comiccrypt ='$DeleteID'";
	$InitDB->query($query);
	header("location:/cms/admin/");

}


$IsAdmin = true;
$CMSAdmin = 1;
$PageTitle .= 'cms';
$Section = $_GET['section'];

if (($_GET['a'] != '') || ($_GET['sa'] != ''))
	$TrackPage = 0;
else 
	$TrackPage = 1;
	
if ($ComicTitle != '')
	$PageTitle .= ' - '.$ComicTitle;

if ($Section == '') {
	if ($ComicTitle != '') {
		if ($_GET['tab'] == '')
			$PageTitle .= ' - dashboard';
		else
			$PageTitle .= ' - '.$_GET['tab'];
	} else {
		if ($_GET['t'] == '') 
			$PageTitle .= ' - projects list';
		else
			$PageTitle .= ' - '.$_GET['t'];
	}
} else {
	$PageTitle .= ' - '.$_GET['section'];
}
	
include 'includes/info_app_inc.php';
include 'processing/section_list_app_inc.php';
include 'includes/mobile_app_inc.php';
include 'includes/skin_app_inc.php';
include 'includes/theme_list_app_inc.php';
include 'processing/menu_app_functions_inc.php';
//include 'includes/ads_app_inc.php';
//include 'includes/modules_app_inc.php';
include 'includes/settings_app_inc.php';
//include 'includes/rsg_app_inc.php';
include 'includes/creator_app_inc.php';
//include 'includes/blog_app_inc.php';
include 'includes/products_app_inc.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/pagetop_inc.php';?>
<script type="text/javascript" src="http://www.wevolt.com/scripts/cms_wizard_functions.js"></script>

<LINK href="http://www.wevolt.com/<? echo $PFDIRECTORY;?>/css/cms_css.css" rel="stylesheet" type="text/css">
<style type="text/css">
.main_tab_active {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/main_tab_active.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}

.main_tab_inactive {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/main_tab_inactive.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}
.sub_tab_active {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/sub_tab_active.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}

.sub_tab_inactive {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/sub_tab_inactive.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}

.sub_tab_inactive a{
	color:#ffffff;
}
.sub_tab_inactive a:link{
	color:#ffffff;
}
.sub_tab_inactive a:hover{
	color:#c6b450;
	text-decoration:underline;
}
.sub_tab_inactive a:visited{
	color:#ffffff;
}

.main_tab_inactive a{
	color:#ffffff;
}
.main_tab_inactive a:link{
	color:#ffffff;
	
}
.main_tab_inactive a:hover{
	color:#c6b450;
	text-decoration:underline;
}
.main_tab_inactive a:visited{
	color:#ffffff;
}

.sub_menu {
	background-color:#8c8c8c;	
}


</style>
<? if (($_GET['id'] == '') && (($_GET['t'] == '') || ($_GET['t'] == 'projects'))) {?>
<script type="text/javascript">
function delete_project(value) {
	var answer = confirm  ("Are you sure you want to delete this project? This cannot be undone")
	if (answer) {
		document.getElementById("deleteconfirm").value = 1;
		document.getElementById("txtComic").value = value;
		document.deleteform.submit();
	}

}

</script>

<? }?>
    
<div align="center">
<table cellpadding="0" cellspacing="0" border="0" width="<? echo $TemplateWrapperWidth;?>">
  <tr>
    <td valign="top" align="center">
    <div class="content_bg">
		<? if ($_SESSION['userid'] != '') {?>
            <div id="controlnav">
                <?php $Site->drawControlPanel(); ?>
            </div>
        <? }?>
        <? if ($_SESSION['noads'] != 1) {?>
            <div id="ad_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;" align="center">
                <iframe src="" allowtransparency="true" width="728" height="90" frameborder="0" scrolling="no" name="top_ads" id="top_ads"></iframe>
            </div>
        <?  }?>
       
       
        <div id="header_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;">
           <? $Site->drawHeaderWide();?>
        </div>
    </div>
    
     <div class="shadow_bg">
        	 <? $Site->drawSiteNavWide();?>
    </div>
    
     <div id="content_wrapper">
 
    
   			       
          
            <table cellspacing="0" cellpadding="0" width="<? echo $_SESSION['contentwidth'];?>">
            <tr>
            <td style="width:7px; height:7px; background-image:url(http://www.wevolt.com/images/cms/TL_grey_corner.png); background-repeat:no-repeat;"></td>
            <td style="background-color:#535353; height:7px;width:<? echo ($_SESSION['contentwidth']-14);?>px;"></td>
            <td style="width:7px; height:7px; background-image:url(http://www.wevolt.com/images/cms/TR_grey_corner.png); background-repeat:no-repeat;"></td>
            </tr>
            <tr><td colspan="3" style="background-color:#535353;padding-left:3px; padding-right:3px;" class="messageinfo_white" valign="bottom">
            
            
            
            <table width="100%" cellpadding="0" cellspacing="0"><tr><td width="400">&nbsp;&nbsp;<? echo strtoupper($_SESSION['username']);?>'s REvolt</td><td align="right">
            <table cellpadding="0" cellspacing="0"><tr>
            <? if (($_GET['t'] != '') && ($_GET['t'] != 'projects') && ($_GET['id']=='') || ($_GET['t'] == 'project')) {?><td class="main_tab_inactive"><a href='/r3volt/admin/'>Projects</a></td><? } else {?><td class="main_tab_active">Projects</td><? }?><td width="3"></td>
            <? /*
            <? if ($_GET['t'] != 'media') {?><td class="main_tab_inactive"><a href='/r3volt/admin/?t=media'>Media</a></td><? } else {?><td class="main_tab_active">Media</td><? }?><td width="3"></td>
            <? if ($_GET['t'] != 'themes') {?><td class="main_tab_inactive"><a href='/r3volt/admin/?t=themes'>Themes</a></td><? } else {?><td class="main_tab_active">Themes</td><? }?><td width="3"></td>
            <?if (in_array($_SESSION['userid'],$SiteAdmins)) {if ($_GET['t'] != 'settings') {?><td class="main_tab_inactive"><a href='/r3volt/admin/?t=settings'>Settings</a></td><? } else {?><td class="main_tab_active">Settings</td><? }} */?>
            </tr></table>
            </td></tr></table>
            
            <div class="sub_menu" style="padding-top:2px;">
            <!--Projects SubMenu-->
            <? if (($_GET['t'] == '') ||(($_GET['t'] == 'projects') && ($_GET['id']==''))){?>
            <table width="100%" cellpadding="0" cellspacing="0"><tr><td width="100">&nbsp;&nbsp;</td><td align="right">
            <table cellpadding="2" cellspacing="0"><tr>
            <? if ((($_GET['s'] != '') && ($_GET['s'] != 'my')) || ($_GET['a'] !='')) {?><td class="sub_tab_inactive"><a href='/r3volt/admin/?t=projects&s=my'>My</a></td>
            <? } else {?><td class="sub_tab_active">My</td><? }?>
            <td width="3"></td>
            <? if ($_GET['s'] != 'assist') {?><td class="sub_tab_inactive"><a href='/r3volt/admin/?t=projects&s=assist'>Assistant</a></td>
            <? } else {?><td class="sub_tab_active">Assistant</td><? }?>
            <td width="3"></td>
            <? if (($CreateComic) || (in_array($_SESSION['userid'],$SiteAdmins))) { ?>
            <? if ($_GET['a'] != 'new') {?><td class="sub_tab_inactive"><a href='/r3volt/admin/?t=projects&a=new'>Create</a></td>
            <? } else {?><td class="sub_tab_active">Create</td><? }?>
            <td width="3"></td>
            <? }?>
            </tr></table>
            </td></tr></table>
            <? } ?>
            
            <!--Editing Project SubMenu-->
            <? if ($_GET['t'] == 'project'){?>
            <table width="100%" cellpadding="0" cellspacing="0"><tr><td width="450">&nbsp;&nbsp;EDITING: <span class="messageinfo_warning"><? echo $ComicTitle;?></span></td><td align="right">
            <table cellpadding="2" cellspacing="0"><tr>
            <td class="sub_tab_inactive"><a href='http://www.wevolt.com/<? echo $SafeFolder;?>/' target="_blank">View</a></td>
            <td width="3"></td>
             <td class="sub_tab_inactive"><a href='http://www.wevolt.com/cms/edit/<? echo $SafeFolder;?>/' >Dash</a></td>
            <td width="3"></td>
            <?  if ($_GET['tab'] != 'analytics') {?><td class="sub_tab_inactive"><a href='/cms/edit/<? echo $SafeFolder;?>/?tab=analytics'>Analytics</a></td>
            <? } else {?><td class="sub_tab_active">Analytics</td><? }?>
            <td width="3"></td>
            <? if ($_GET['tab'] != 'design'){?><td class="sub_tab_inactive"><a href='/cms/edit/<? echo $SafeFolder;?>/?tab=design'>Design</a></td>
            <? } else {?><td class="sub_tab_active">Design</td><? }?>
            <td width="3"></td>
            <? if ($_GET['tab'] != 'content'){?><td class="sub_tab_inactive"><a href='/cms/edit/<? echo $SafeFolder;?>/?tab=content'>Content</a></td>
            <? } else {?><td class="sub_tab_active"><a href='/cms/edit/<? echo $SafeFolder;?>/?tab=content'>Content</a></td><? }?>
            <td width="3"></td>
            <? if ($_GET['tab'] != 'tools'){?><td class="sub_tab_inactive"><a href='/cms/edit/<? echo $SafeFolder;?>/?tab=tools'>Tools</a></td>
            <? } else {?><td class="sub_tab_active">Tools</td><? }?>
            <td width="3"></td>
            <? if ($_GET['tab'] != 'settings'){?><td class="sub_tab_inactive"><a href='/cms/edit/<? echo $SafeFolder;?>/?tab=settings'>Settings</a></td>
            <? } else {?><td class="sub_tab_active">Settings</td><? }?>
            <td width="3"></td>
            </tr></table>
            </td></tr></table>
            <? } ?>
            
            </div>
            
            
            </td></tr>
            </table>
            
            <div style="background-color:#535353;padding-left:3px; padding-right:3px;width:<? echo ($_SESSION['contentwidth']-6);?>px;" align="center">
               
                <table style="width:100%" cellpadding="0" cellspacing="0">
                <tr>
                <td style="background-color:#fcfcfc; padding-top:10px; padding-bottom:10px;" valign="top" align="center">
                  
                  
                  
                   <div style="width:<? echo ($_SESSION['contentwidth']-26);?>px;padding-top:10px; padding-bottom:10px;" class="cms_wrappercontent" align="center">
                                    <? if ($_GET['id']=='') { ?>
											<? if (($_GET['t'] == '') || ($_GET['t'] == 'projects')) {?>
                                                <div id="comic_div"  align="center">
                                                
                                                                 
                                                 <? if ($_GET['a'] == '') {?>
                                                    <?  if ((sizeof($CreatorProjects) > 0) || (sizeof($AssistantProjects) > 0 ))  { ?>
                                                        <? if ($_SESSION['IsPro'] == 0) {?>
                                                                <div class="spacer"></div>
                                                                <div class="pagelinks" style="color:#000000;">[<a href="/upgrade.php">Upgrade your account to create more REvolts</a>]</div>
                                                                <div class="spacer"></div>
                                                          <? }?>
                                                            
                                                    <? } else {?>
                                                          <div class="messageinfo_black"><div class="spacer"></div>You currently don't have any available REvolts. <div class="spacer"></div>To get started on a new one just click the NEW button in the bar above!</div>
                                                    <? }?>
                                                 <? }?>
                                            
                                            <? if (($_GET['s'] == 'my') || (($_GET['s'] == '') && ($_GET['a'] == ''))){?>
                                            <table width="694" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="678" align="left">
                                        My Projects
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table> 

                        <? echo $CMS->drawCreatorProjectsList();
						}?>
                            
                                            <? if (($_GET['s'] == 'assist') && (sizeof($AssistantProjects) > 0 )) { ?>
                                             <table width="694" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="678" align="left">
                                        Projects I Assist
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
                                               
                                            <? echo $CMS->drawAssistantProjectsList();}?>
                                            
                                            <? if ($_GET['a'] == 'new') {?>
                                            <iframe name="createframe" id="createframe" frameborder="0" style="width:100%;height:693px;" allowtransparency="true" scrolling="no" src="/<? echo $PFDIRECTORY;?>/create_new_project.php?type=<? echo $_GET['type'];?>"></iframe>                       
                                            <? }?>
                                            </div>
                                            
                                            <? } else if ($_GET['t'] == 'themes'){?>
                                                <div id="themes_div">
                                                   
                                                  <? if (($_GET['section'] == 'themes') || ($_GET['section'] == '')) {
                                                    
                                                        if ($_GET['sub'] == '') {
                                                            if ($_GET['sa'] == '') {
                                                                    include 'section/theme_list_inc.php';
                                                            } else if (($_GET['sa'] == 'new') || ($_GET['sa'] == 'finish')) {
                                                                include 'section/theme_new_inc.php';
                                                    
                                                            } else if ($_GET['sa'] == 'edit') {
                                                                include 'section/theme_edit_inc.php';
                                                        
                                                            }
                                                        } else if ($_GET['sub'] == 'template') {
                                                            include 'section/theme_settings_inc.php';
                                                         
                                                        }
                                                    } else if ($_GET['section'] == 'menu') {
                                                    
                                                            if ($_GET['sa'] == '') {
                                                                    include 'section/menu_list_inc.php';
                                                            } else if ($_GET['sa'] == 'new') {
                                                                include 'section/menu_new_inc.php';
                                                    
                                                            } else if ($_GET['sa'] == 'edit') {
                                                                include 'section/menu_edit_inc.php';
                                                        
                                                            }
                                                
                                                    } else if ($_GET['section'] == 'skins') { 
                                                        if (!isset($_GET['a'])) {
                                                            include 'section/skins_inc.php'; 
                                                        } else if ($_GET['a'] == 'edit') {
                                                            include 'section/skin_edit_inc.php';
                                                        } else if ($_GET['a'] == 'create') { 
                                                            include 'section/skin_create_inc.php';
                                                        }else if ($_GET['a'] == 'assign') {
                                                            include 'section/skin_assign_inc.php';
                                                        }
                                                    } ?>
                                                 </div>
                                            <? }?>
                                    
                                    <? } else { ?>
                                        <div id='admindiv'> 
                  
                                       <div id='submenu' class='submenu'>
                                                      <? if ($_GET['section'] == 'skins') {?>
                        
                                       
                                       <? } else if ($_GET['section'] == 'products') {
                                        if (in_array($_SESSION['userid'],$SiteAdmins)) {
                                       
                                       ?>
                                     <a href='/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>'>PRODUCTS LIST</a>&nbsp;&nbsp;  <a href='/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>&a=new'>NEW PRODUCT</a>&nbsp;&nbsp;  <a href='/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>&a=seller'>MY SELLER INFO</a>
                                       <? }} else if ($_GET['section'] == 'rsg') {?>
                                     <a href='/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>'>RG ENTRIES</a>&nbsp;&nbsp;  <a href='/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>&a=new'>NEW ENTRY</a>&nbsp;&nbsp;<a href="/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>&sub=map">VIEW MAPS</a>&nbsp;&nbsp;<a href="/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>&sub=timeline">VIEW TIMELINE</a>
                                       <? } else if ($_GET['section'] == 'blog') {?>
                                   
                                       <? } ?>
                                       </div>
            
                                        <?  if ($_GET['tab'] == ''){
                                    include 'section/dash_inc.php';
                            } else {
                                    if ($_GET['tab'] == 'design') {?>
            
                                         
                            <?  if (($_GET['section'] == '') && ($_GET['sa'] == '') && ($_GET['st'] == '')) {
                                    include 'section/design_dash_inc.php';
                                } else if ($_GET['sa'] == 'edit') {
                                    include 'section/theme_edit_inc.php';
                                
                                } else if ($_GET['section'] == 'themes') {
                                        
                                        if ($_GET['sub'] == '') {
                                            if ($_GET['sa'] == '') {
                                                    include 'section/theme_list_inc.php';
                                            } else if (($_GET['sa'] == 'new') || ($_GET['sa'] == 'finish')) {
                                                include 'section/theme_new_inc.php';
                                    
                                            } else if ($_GET['sa'] == 'edit') {
                                                include 'section/theme_edit_inc.php';
                                        
                                            }
                                        } else if ($_GET['sub'] == 'template') {
                                            include 'section/theme_settings_inc.php';
                                         
                                        }
                                 } else if ($_GET['section'] == 'menu') {
                                        
                                        if ($_GET['sa'] == '') {
                                                include 'section/menu_list_inc.php';
                                        } else if ($_GET['sa'] == 'new') {
                                            include 'section/menu_new_inc.php';
                                
                                        } else if ($_GET['sa'] == 'edit') {
                                            include 'section/menu_edit_inc.php';
                                    
                                        }
                                    
                                } else if ($_GET['section'] == 'skins') { 
                                    if (!isset($_GET['a'])) {
                                        include 'section/skins_inc.php'; 
                                    } else if ($_GET['a'] == 'edit') {
                                        include 'section/skin_edit_inc.php';
                                    } else if ($_GET['a'] == 'create') { 
                                        include 'section/skin_create_inc.php';
                                    }else if ($_GET['a'] == 'assign') {
                                        include 'section/skin_assign_inc.php';
                                    }
                                }
                                    } else if ($_GET['tab'] == 'themes') {
                                
                                            if ($_GET['sa'] == 'edit') {
                                    //	print 'GOT HERE';
                                        include 'section/theme_edit_inc.php';
                                
                                } else if ($_GET['section'] == 'themes') {
                                        
                                        if ($_GET['sub'] == '') {
                                            if ($_GET['sa'] == '') {
                                                    include 'section/theme_list_inc.php';
                                            } else if (($_GET['sa'] == 'new') || ($_GET['sa'] == 'finish')) {
                                                include 'section/theme_new_inc.php';
                                    
                                            } else if ($_GET['sa'] == 'edit') {
                                                include 'section/theme_edit_inc.php';
                                        
                                            }
                                        } else if ($_GET['sub'] == 'template') {
                                            include 'section/theme_settings_inc.php';
                                         
                                        }
                                 } else if ($_GET['section'] == 'menu') {
                                        
                                        if ($_GET['sa'] == '') {
                                                include 'section/menu_list_inc.php';
                                        } else if ($_GET['sa'] == 'new') {
                                            include 'section/menu_new_inc.php';
                                
                                        } else if ($_GET['sa'] == 'edit') {
                                            include 'section/menu_edit_inc.php';
                                    
                                        }
                                    
                                } else if ($_GET['section'] == 'skins') { 
                                    if (!isset($_GET['a'])) {
                                        include 'section/skins_inc.php'; 
                                    } else if ($_GET['a'] == 'edit') {
                                        include 'section/skin_edit_inc.php';
                                    } else if ($_GET['a'] == 'create') { 
                                        include 'section/skin_create_inc.php';
                                    }else if ($_GET['a'] == 'assign') {
                                        include 'section/skin_assign_inc.php';
                                    }
                                }
                                    } else if ($_GET['tab'] == 'content') {
                                        //START CONTENT
                                        if (($_GET['section'] == '') && ($_GET['sa'] == '')) {
                                            include 'section/section_list_inc.php';
                                        
                                        } else if (($_GET['sa'] == 'edit')||($_GET['sa'] == 'new')) {
                                            include 'section/content_section_edit_inc.php';
                                        
                                        } else if ($_GET['section'] == 'info') {
                                                include 'section/comic_info_inc.php';
                                        } else if ($_GET['section'] == 'creator') { 
                                                include 'section/creator_info_inc.php';
                                        } else if ($_GET['section'] == 'pages') { 
                                            ?>
                                          <center>
                                            <iframe src="/<? echo $PFDIRECTORY;?>/section/pages_inc.php?a=<? echo $_GET['a'];?>&project=<? echo $_SESSION['safefolder'];?><? if ($_GET['ep'] != '') echo '&ep='.$_GET['ep'];?><? if ($_GET['series'] != '') echo '&series='.$_GET['series'];?><? if ($_GET['pageid'] != '') echo '&pageid='.$_GET['pageid'];?>" frameborder="0" height="750" width="<? echo ($_SESSION['contentwidth']-6);?>" scrolling="no"></iframe>
                                            </center>  
                                            <?
                                        } else if ($_GET['section'] == 'characters') { 
                                        if ($_SESSION['IsPro'] == 1) {?>
                                        <center>
                                            <iframe src="/<? echo $PFDIRECTORY;?>/section/characters_inc.php?a=<? echo $_GET['a'];?>&project=<? echo $_SESSION['safefolder'];?>"  frameborder="0" height="708" width="<? echo ($_SESSION['contentwidth']-6);?>" scrolling="no"></iframe>
                                            </center>
                                        <?
                                        } else {
                                            include 'section/upgrade_inc.php';	
                                        }
                                    }  else if ($_GET['section'] == 'downloads') { 
                                            if ($_SESSION['IsPro'] == 1) {?>
                                            <center>
                                                <iframe src="/<? echo $PFDIRECTORY;?>/section/downloads_inc.php?a=<? echo $_GET['a'];?>&project=<? echo $_SESSION['safefolder'];?>" frameborder="0" height="708" width="<? echo ($_SESSION['contentwidth']-6);?>" scrolling="no"></iframe>
                                                </center>
                                            <?
                                            } else {
                                                include 'section/upgrade_inc.php';	
                                            }
                                        } else if ($_GET['section'] == 'links') { ?>
                                            <center>
                                            <iframe src="/<? echo $PFDIRECTORY;?>/section/links_inc.php?a=<? echo $_GET['a'];?>&project=<? echo $_SESSION['safefolder'];?>"  frameborder="0" height="708" width="<? echo ($_SESSION['contentwidth']-6);?>" scrolling="no"></iframe>
                                            </center>
                                        <? }else if ($_GET['section'] == 'gallery') { ?>
                                            <center>
                                            <iframe src="/<? echo $PFDIRECTORY;?>/section/gallery_inc.php?a=<? echo $_GET['a'];?>&sub=<? echo $_GET['sub'];?>&project=<? echo $_SESSION['safefolder'];?>"  frameborder="0" height="708" width="<? echo ($_SESSION['contentwidth']-6);?>" scrolling="no"></iframe>
                                            </center>
                                        <? }  else if ($_GET['section'] == 'extras') { 
                                            if ($_SESSION['IsPro'] == 1) {
                                                if (!isset($_GET['a'])) {
                                                    include 'section/pages_inc.php'; 
                                                } else if ($_GET['a'] == 'edit') {
                                                    include 'section/pages_edit_inc.php';
                                                } else if ($_GET['a'] == 'new') {
                                                    include 'section/pages_new_inc.php';
                                                } else if ($_GET['a'] == 'delete') {
                                                    include 'section/pages_delete_inc.php';
                                                }
                                            } else {
                                                include 'section/upgrade_inc.php';	
                                            }
                                        }  else if ($_GET['section'] == 'rsg') { 
                                            if (in_array($_SESSION['userid'],$SiteAdmins)) {
                                                    if (!isset($_GET['a'])) {
                                                        include 'section/rsg_inc.php'; 
                                                    } else if ($_GET['a'] == 'edit') {
                                                        include 'section/rsg_edit_inc.php';
                                                    } else if ($_GET['a'] == 'new') {
                                                        include 'section/rsg_new_inc.php';
                                                    } else if ($_GET['a'] == 'delete') {
                                                        include 'section/rsg_delete_inc.php';
                                                    }
                                            
                                            } else {
                                                echo '<div align="center"><img src="/'.$PFDIRECTORY.'/images/rsg_promo.jpg"></div>';
                                            
                                            }
                                            
                                        }  else if ($_GET['section'] == 'mobile') { 
                                            if ($_SESSION['IsPro'] == 1) {?>
                                            <center>
                                                <iframe src="/<? echo $PFDIRECTORY;?>/section/mobile_inc.php?a=<? echo $_GET['a'];?>&project=<? echo $_SESSION['safefolder'];?>" frameborder="0" height="708" width="<? echo ($_SESSION['contentwidth']-6);?>" scrolling="no"></iframe>
                                                </center>
                                            <?
                                            } else {
                                                include 'section/upgrade_inc.php';	
                                            }
                                        } else if ($_GET['section'] == 'products') { 
                                            if ($StoreActive == 1) {
                                                    if ($InfoRequired == 0) {
                                                        if (!isset($_GET['a'])) {
                                                            include 'section/products_pro_inc.php'; 
                                                        } else if ($_GET['a'] == 'edit') {
                                                                if ($_GET['sub'] == 'ebook') 
                                                                    include 'includes/products_edit_ebook_inc.php';
                                                                if ($_GET['sub'] == 'selfprint') 
                                                                    include 'includes/products_edit_selfprint_inc.php';
                                                                else if ($_GET['sub'] == 'podprint') 
                                                                    include 'includes/products_edit_podprint_inc.php';
                                                                else if ($_GET['sub'] == 'selfmerch') 
                                                                    include 'includes/products_edit_selfmerch_inc.php';
                                                                else if ($_GET['sub'] == 'podmerch') 
                                                                    include 'includes/products_edit_podmerch_inc.php';
                                                                else if ($_GET['sub'] == 'selfbook') 
                                                                    include 'includes/products_edit_selfbook_inc.php';
                                                                else if ($_GET['sub'] == 'podbook') 
                                                                    include 'includes/products_edit_podbook_inc.php';
                                                                else if ($_GET['sub'] == 'dlicense') 
                                                                    include 'includes/products_edit_dlicense_inc.php';
                                                                else if ($_GET['sub'] == 'plicense') 
                                                                    include 'includes/products_edit_plicense_inc.php';
                                                                else if ($_GET['sub'] == 'dplicense') 
                                                                    include 'includes/products_edit_dplicense_inc.php';
                                                        } else if ($_GET['a'] == 'new') {
                                                                if ($_GET['sub'] == 'ebook') 
                                                                    include 'includes/products_new_ebook_inc.php';
                                                                else if ($_GET['sub'] == 'selfprint') 
                                                                    include 'includes/products_new_selfprint_inc.php';
                                                                else if ($_GET['sub'] == 'podprint') 
                                                                    include 'includes/products_new_podprint_inc.php';
                                                                else if ($_GET['sub'] == 'selfmerch') 
                                                                    include 'includes/products_new_selfmerch_inc.php';
                                                                else if ($_GET['sub'] == 'podmerch') 
                                                                    include 'includes/products_new_podmerch_inc.php';
                                                                else if ($_GET['sub'] == 'selfbook') 
                                                                    include 'includes/products_new_selfbook_inc.php';
                                                                else if ($_GET['sub'] == 'podbook') 
                                                                    include 'includes/products_new_podbook_inc.php';
                                                                else if ($_GET['sub'] == 'dlicense') 
                                                                    include 'includes/products_new_dlicense_inc.php';
                                                                else if ($_GET['sub'] == 'plicense') 
                                                                    include 'includes/products_new_plicense_inc.php';
                                                                else if ($_GET['sub'] == 'dplicense') 
                                                                    include 'includes/products_new_dplicense_inc.php';
                                                                else 
                                                                    include 'section/products_new_inc.php';
                                                        } else if ($_GET['a'] == 'seller') {
                                                                include 'includes/products_seller_inc.php';
                                                        } 
                                                } else {
                                                    include 'includes/products_seller_inc.php';
                                                }
                                            } else {
                                                include 'section/products_inc.php';
                                            }
                                        
                                        } else if ($_GET['section'] == 'blog') { ?>
                                            <center>
                                            <iframe src="/<? echo $PFDIRECTORY;?>/section/blog_inc.php?a=<? echo $_GET['a'];?>&sub=<? echo $_GET['sub'];?>&project=<? echo $_SESSION['safefolder'];?>"  frameborder="0" height="708" width="<? echo ($_SESSION['contentwidth']-6);?>" scrolling="no"></iframe>
                                            </center>
                                        <? }  else {?>
                                        
                                            Below are all your current content sections. To edit a section just click the EDIT button, to Create a new Section select 'NEW' and to add content to a section just click upload.
                                        
                                        <? }
                                        //END CONTENT
                                    } else if ($_GET['tab'] == 'settings') {?>
                                    <center>
                                    <iframe src="/<? echo $PFDIRECTORY;?>/section/settings_inc.php?a=<? echo $_GET['a'];?>&sub=<? echo $_GET['sub'];?>"  frameborder="0" height="715" width="<? echo ($_SESSION['contentwidth']-24);?>" scrolling="auto"></iframe>
                                    </center>
                                        <? 
                                    
                                    }  else if ($_GET['tab'] == 'analytics') {?>
                                    <center>                    
                                    <iframe src="/<? echo $PFDIRECTORY;?>/section/analytics_inc.php"  frameborder="0" height="708" width="<? echo ($_SESSION['contentwidth']-24);?>" scrolling="auto"></iframe>
                                     </center>
                            <? } else if ($_GET['tab'] == 'tools') {
                                
                                            if ($_GET['section'] == 'embed') { 
                                            if ($_SESSION['IsPro'] == 1) {
                                                include 'section/embed_inc.php';
                                            } else {
                                                include 'section/upgrade_inc.php';	
                                            }
                        
                                        } else if ($_GET['section'] == 'ads') { 
                                            if ($_SESSION['IsPro'] == 1) {
                                                if (!isset($_GET['a'])) {
                                                    include 'section/ads_inc.php'; 
                                                } else if ($_GET['a'] == 'edit') {
                                                    include 'section/ads_edit_inc.php';
                                                }
                                            } else {
                                                include 'section/upgrade_inc.php';	
                                            }
                                        } else if ($_GET['section'] == 'superfans') {?>
                                            <center>
                                            <iframe src="/<? echo $PFDIRECTORY;?>/section/superfan_inc.php"  frameborder="0" height="708" width="<? echo $_SESSION['contentwidth'];?>" scrolling="no"></iframe>
                                         
                                        <? } else {
                                                
                                            include 'section/tools_dash_inc.php';	
                                        }
                        
                                }
                    
                            }?>
                                     </div>
                
                                    <? }?>
            
                                    <? if ($_GET['t'] == 'media') {?>
            <div id="media_div" style="height:570px; width:675px; overflow:auto;">
            <? 
            $db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
            
            $query = "SELECT * from pf_media where UploadBy='".$_SESSION['userid']."'  and FileType='image' order by UploadDate DESC";
            $db->query($query);
            $TotalImages = $db->numRows();
            $ImageCount = 0;
            echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
            while ($line = $db->FetchNextObject()) {
            
            $ImageCount++;
            if ($line->Server == '') 
                $Server = 'http://www.wevolt.com';
            else 
            $Server = 'http://'.$line->Server;
            
            echo '<td align="center" width="60"><img src="'.$Server.'/'.$line->Thumb.'" id="thumb_'.$line->ID.'" border="1" style="border:#fffff solid 1px;" vspace="2" hspace="2" width="50"><br/>[<a href="'.$Server.'/'.$line->Filename.'" class="pirobox">VIEW</a>]<div style="height:5px;"></div></td>';
                if ($ImageCount == 11) {
                    echo '</tr><tr>';
                    $ImageCount = 0;
                }
                }
            
            
            if (($ImageCount < 11) && ($ImageCount != 0)) {
                while ($ImageCount <11) {
                    echo '<td></td>';
                    $ImageCount++;
                }
            }
            echo '</tr></table>';
            if ($TotalImages == 0) 
                echo '<div class="med_blue" align="center">You have not uploaded any media to WEvolt yet.</div>';
            $db->close();
            ?>
            
            </div>
            <? }?>			
            
            <div class="spacer"></div><div class="spacer"></div>
            
              </div>
            
             <? /*
             </td><td class="cms_wrapper_R_no"  width="9"></td>
            
                                    </tr><tr><td id="cms_wrapper_BL_no"></td><td id="cms_wrapper_B_no"></td>
                                    <td id="cms_wrapper_BR_no"></td>
                                    </tr></tbody></table>*/?>
                                  
                </td>
                </tr>
                </table>
              </div>  
            </td>
            </tr>
            </table>
    </div>

	</td>
  </tr>
 
</table>
</div>
  
<?php require_once( $_SERVER['DOCUMENT_ROOT'].'/includes/pagefooter_inc.php'); ?>

<?

$InitDB->close();
?> 
