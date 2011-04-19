<?php
if ($_GET['name'] == 'facebook') 
	header("location:/facebook/index.php");
	
if (($_GET['name'] == 'mattjacobs') ||($_GET['name'] == 'matthewjacobs') ||($_GET['name'] == 'panelflow')||($_GET['name'] == 'mattj')||($_GET['name'] == 'mjacobs')||($_GET['name'] == 'theunlisted'))
	header("location:/matteblack/");

if (($_GET['name'] == 'jasonb') ||($_GET['name'] == 'jbadower') ||($_GET['name'] == 'grael23'))
	header("location:/jasonbadower/");

include 'includes/init.php';
include 'includes/message_functions.php';
include 'includes/shout_box_functions.php';
include 'includes/module_functions.php'; 
include 'classes/social.php';

$Name = $_GET['name'];
$ProjectType = $_GET['type'];
$IsProfile = true;

$query = "select * from users where username='$Name'"; 
$ItemArray = $InitDB->queryUniqueObject($query);
$UserID = $ItemArray->encryptid;
$Email =   $ItemArray->email;
$FeedOfTitle = $ItemArray->username;
$FeedThumb = $ItemArray->avatar;
$DefaultView = $ItemArray->DefaultView;

$query = "SELECT * from users_data where UserID='$UserID'";
$UDataArray = $InitDB->queryUniqueObject($query);

if ($ItemArray->IsPublisher == 1)
	$UserType = 'publisher';
else
	$UserType='user';
	
//GET FEED ARRAY
$query = "SELECT f.Title as FeedTitle, f.Thumb as FeedThumb, ft.HtmlLayout, f.EncryptID from feed as f 
			  join feed_settings as fs on f.EncryptID=fs.FeedID
			  join feed_templates as ft on ft.ID=fs.TemplateID 
			  where f.UserID='$UserID' and f.FeedType='w3'";
$FeedArray = $InitDB->queryUniqueObject($query);
$FeedID = $FeedArray->EncryptID;

//GET RELATIONSHIPS
$Social = new social();
$RelArray = $Social->getRelationship($UserID,$_SESSION['userid']);
$IsFriend = $RelArray['Friend'];
$Requested =  $RelArray['Requested'];
$IsFan = $RelArray['Fan'];


$NetworkArray = $Social->getNetworks($UserID);
$GroupArray = $Social->getUserGroups($UserID);

if ($_GET['s'] == 'portfolio'){
	include_once('classes/gallery.php');
	$Gallery = new gallery();
	$PortfolioID = $Gallery->getPortfolioID($UserID);
}

if (($FeedID == '') && ($_SESSION['username'] == trim($_GET['name']))) {
	$NOW = date('Y-m-d h:i:s');
		$query = "INSERT into feed (Title, UserID, IsPublic, IsActive, CreatedDate, FeedType) values ('WEvolt page', '".$_SESSION['userid']."', 0, 1, '$NOW', 'w3')";
		$InitDB->execute($query);
		$query ="SELECT ID from feed WHERE UserID='".$_SESSION['userid']."' and CreatedDate='$NOW'";
		$NewID = $InitDB->queryUniqueValue($query);
		$Encryptid = substr(md5($NewID), 0, 12).dechex($NewID);
		$query = "UPDATE feed SET EncryptID='$Encryptid' WHERE ID='$NewID' and UserID='".$_SESSION['userid']."'";
		$InitDB->execute($query);
		$query = "INSERT into feed_settings (FeedID, TemplateID, Module1Title, Module2Title, Module3Title, Module4Title) values ('$Encryptid', '1', 'Window 1', 'Window 2','Window 3','Window 4')";
		$InitDB->execute($query);
		$query = "SELECT f.Title as FeedTitle, f.Thumb as FeedThumb, ft.HtmlLayout, f.EncryptID from feed as f 
			  join feed_settings as fs on f.EncryptID=fs.FeedID
			  join feed_templates as ft on ft.ID=fs.TemplateID 
			  where f.UserID='$UserID' and f.FeedType='w3'";
		$FeedArray = $InitDB->queryUniqueObject($query);

    	$FeedID = $FeedArray->EncryptID;	
}

//SET RELATIONSHIP STATUS
if ($UserID == $_SESSION['userid'])
	$IsOwner = true;
else 
	$IsOwner = false;
if (($IsFriend == 0) || ($IsFriend == '')) {
	$IsFriend = false;
} else {
	$IsFriend = true;
}

if (($IsFan == 0) || ($IsFan == '')) {
	$IsFan = false;
} else {
	$IsFan = true;
}


//INSERT COMMENT
if ($_POST['insert'] == '1'){
	$Comment = new comment();
	if(($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] )) || ($_SESSION['userid'] == '')) {
		unset($_SESSION['security_code']);
		setcookie("seccode", "", time()+60*60*24*100, "/");
		if ($_POST['txtFeedback'] == ''){
			$_SESSION['commenterror'] = 'You need to enter a comment';
		} else if (($_SESSION['userid'] == '') && ($_POST['txtName'] == '')){
			$_SESSION['commenterror'] = 'Please enter a name';
		} else {
			if ($_SESSION['userid'] == '')
				$CommentUserID = 'none';
			else 
				$CommentUserID = trim($_SESSION['userid']);
			
			$CommentUsername = addslashes($_POST['txtName']);
		
			
				$Comment->blogComment($Section,$ProjectID, $_POST['targetid'], $CommentUserID, $_POST['txtFeedback'],$CommentUsername);?>
       
                 <script type="text/javascript">
					window.parent.location = 'http://users.wevolt.com/<? echo $_GET['name'];?>/?t=blog&post=<? echo $_GET['post'];?>';
                    </script>
		<?
			
		}
   } else {
		$_SESSION['commenterror'] = 'invalid security code. Try Again.';
   }
}

if (($_GET['tab'] == 'profile') || (($DefaultView=='profile') && ($_GET['tab'] == '')) || (($DefaultView=='') && ($_GET['tab'] == ''))) {
	if ($DefaultView == '')
		$DefaultView = 'profile';
            
	if ($_POST['edit'] == 1) {
		include 'includes/myvolt_profile_save_inc.php';
	}

	
}

//GET USER PROFILE INFO
include 'includes/user_profile_select_inc.php';


if ($_GET['tab'] == '')
	$SubTitle = 'Homepage';
else 
	$SubTitle = $_GET['tab'];

if ($_GET['s'] != '')
	
	$SubTitle .= ' - '.$_GET['s'];
	
$PageTitle .= $FeedOfTitle.' - '.$SubTitle;

$TrackPage = 1;

if ($IsFriend)
	$FriendStatus = 'Friend';
else if ($IsFan)
	$FriendStatus = 'Following';
else if ($Requested > 0)
	$FriendStatus = 'Requested';
else if (!$IsOwner)
	$FriendStatus = 'Add';
else 
	$FriendStatus = '';


if ($DefaultView == '')
	$DefaultView = 'profile';
?>

<?php include_once('includes/pagetop_inc.php');
$Tracker = new tracker();
$Remote = $_SERVER['REMOTE_ADDR'];
$IsUser = true;
$Referal = urlencode(substr($_SERVER['HTTP_REFERER'],7,strlen($_SERVER['HTTP_REFERER'])-1));
$Tracker->insertPageView($UserID,$Pagetracking,$Remote,$_SESSION['userid'],$Referal,$_SESSION['returnlink'],$_SESSION['IsPro'],$IsCMS,$IsUser);	
?>
<script 
  src="http://www.wevolt.com/scripts/twitterjs.js"
  type="text/javascript">
</script>

<script type="text/javascript">

function mod_tab(value) {
	//alert(value);
   //GRAB CURRENT GROUP ID OF SELECTED DROPDOWN
	var moduletarget= value.split('-');
	var ModuleParent = moduletarget[0];
	
	var SelectedModule = moduletarget[1];
	//document.getElementById(ModuleParent+'_menu').innerHTML = document.getElementById(SelectedModule+'_menu_wrapper').innerHTML;
	
	var ModuleList = document.getElementById(ModuleParent+'_tabs').value;
	var TabArray = ModuleList.split(',');
	
		for(i=0; i<TabArray.length; i++){
			//alert('MODULE ID' + TabArray[i]);
			
			if (TabArray[i] != SelectedModule) {
				document.getElementById(TabArray[i]+'_div').style.display = 'none';
				document.getElementById(TabArray[i]+'_star').style.display = 'none';
				
			} else{
				document.getElementById(SelectedModule+'_div').style.display = '';
				document.getElementById(SelectedModule+'_star').style.display = '';
				
			}
			
		}

}

function show_menu(value) {
	document.getElementById(value).style.display = '';
			
}
function follow(ProjectID,UserID,Type) {
 
	attach_file('http://www.wevolt.com/connectors/follow_content.php?fid='+ProjectID+'&type='+Type); 
	document.getElementById("follow_project_div").innerHTML = '<img src="<? echo $_SESSION['avatar'];?>" width="50" height="50" border="2">';
	
}
<? if (($_GET['tab'] == 'network') && ($_GET['s'] == 'groups')) {?>

delete_group(value) {
	
	var answer = confirm('Are you sure you want to delete this group?');
	if (answer) {
		
		attach_file('http://www.wevolt.com/connectors/delete_user_group.php?gid='+value);
		document.location.href='/<? echo $_SESSION['username'];?>/?tab=network&s=groups';
	}	
	
}
<? }?>

<? if (($IsOwner) && ($_GET['tab'] == 'profile')) {?>
	function save_profile() {
		
	document.getElementById("edit").value=1;
	document.profileform.submit();
		
	}
<? }?>

</script>
<style type="text/css">


#myvolt_content {
	background-color:#FFF;
	 min-height:600px;
  height:auto;

}

</style>
<div align="left">
<? if ($_SESSION['userid'] != '') {?>
            <div id="controlnav">
                <? $Site->drawControlPanel('100%');?>
            </div>
        <? }?>
 <?  if ((($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1) || ($_SESSION['IsSuperFan'] == 1)) && ($_SESSION['sidebar'] == 'closed')) {?>
 <div id="pronav">
                <? $Site->drawProNav('100%');?>
 </div>
 <? }?>       

	<table cellpadding="0" cellspacing="0" border="0" id="container" width="100%">

	<tr><? if (($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)) {
				$_SESSION['noads'] = 1;
			$FlashHeight = 1;
	} else {
			$_SESSION['noads'] = 0;
			$FlashHeight = 90;	
	} 
		?> 
        <? if ($_SESSION['sidebar'] == 'open') {?>
		<td valign="top" id="sidebar">
			<?  include 'includes/sidebar_inc.php';?>
		</td> 

        <? }?>
        <td  valign="top" align="<? if ($_SESSION['sidebar'] == 'open') {?>left<? } else {?>center<? }?>"  <? if ($_SESSION['sidebar'] == 'open') {?>rowspan="2"<? }?> valign="top">
        
        
		 <? 
	 if ($_SESSION['noads'] == 0) {?>

				  <iframe src="" allowtransparency="true" width="728" height="90" frameborder="0" scrolling="no" name="top_ads" id="top_ads"></iframe>
           <? }?>
           <div class="spacer"></div>
           
           
          
         <table width="<? echo $_SESSION['contentwidth'];?>" cellpadding="0" cellspacing="0">
         	<tr>
                 <td colspan="2" bgcolor="#fff" >
               
                 <table width="100%">
                 <tr>
                     <td width="80" align="center">
                       <img src="<? echo $FeedThumb;?>" width="67" height="67"/>
                     </td>
                     <td width="250" class="blue_text" valign="top">
                     <div class="spacer"></div>
                     <span style="font-size:14px; font-weight:bold"><? echo $FeedOfTitle;?></span><br/>
                     Level: <? echo $ItemArray->level;?><br/>
                     Last Login: <? echo date('m-d-Y @ h:i:s',strtotime($ItemArray->LastLogin));?>
                     </td>
                    <td align="left">&nbsp;</td>
                    <td width="50" align="right">
                            <img src="http://www.wevolt.com/images/excite_header.png" /><br />
                            <div class="small_blue_links">
                            <a href="/<? echo $FeedOfTitle;?>/?tab=excites">archives</a>
                            <? if ($IsOwner) { ?><a href="javascript:void(0)" onclick="update_excite('');">edit</a><? }?>
                            </div>
                     </td>
                     <td width="280">
                            <? include 'modules/excite_single.php';?>
                     </td>
                     <td width=<? if ($IsOwner) {?>"40"<? } else {?>"72"<? }?> valign="top">
                     	<table>
                        	<tr>
                            	<td>
                   
                               <a href="http://www.wevolt.com/w3forum/<? echo $FeedOfTitle;?>/"><img src="http://www.wevolt.com/images/forum_button.png" class="navbuttons"  tooltip="Personal Forum"/></a>
                                  </td>
                                <td>
                                  <? if ((!$IsOwner) && ($_SESSION['userid'] != '')) {
									if (!$IsFriend) {?>
									<img src="http://www.wevolt.com/images/friend_button.png" onclick="network_wizard('<? echo $FeedOfTitle;?>','<? echo $_SESSION['userid'];?>','');" class="navbuttons" tooltip="Add as Friend"/>
						
									<? } } ?>
                                </td>
                                
                                </tr>
                                <tr>
                                
                                <td>
                                 <? if ($_SESSION['userid'] != '') {?>
                                    <a href="/<? echo $_SESSION['username'];?>/?tab=wemail"> <img src="http://www.wevolt.com/images/wemail_button.png"  class="navbuttons" tooltip="WEmail Inbox"></a>
                                     <? }?>
                                </td>
                                <td>
                                 <? if ((!$IsOwner) && ($_SESSION['userid'] != '')) {
									if (!$IsFan) {?>
									<img src="http://www.wevolt.com/images/follow_button_icon.png" onclick="follow('<? echo $UserID;?>','<? echo $_SESSION['userid'];?>','user');" class="navbuttons" tooltip="Follow user"/>
									<? } else {
										echo 'Fan';	
									}} ?>
                                </td>
                            </tr>
                        </table>
                     </td>
                     
                 </tr>
                 </table>
                 
                 <? $Site->drawMyvoltNav($_SESSION['contentwidth'],$FeedOfTitle,$FeedThumb,$IsOwner);?>
                   <div style="padding:10px;">
                    <table width="100%">
                        <tr>
                            <td width="100" valign="top">
                       
                               <? if (($_GET['tab'] == 'profile') || (($_GET['tab'] == '') && ($DefaultView=='profile'))) 
                            			include 'includes/myvolt_about_menu.php';?>
                               
                                <? if (($_GET['tab'] == 'network') || (($_GET['tab'] == '') && ($DefaultView=='network'))) 
                            			include 'includes/myvolt_network_menu.php';?>
                                
                                 <? if (($_GET['tab'] == 'home') || ($_GET['tab'] == 'shout') || (($_GET['tab'] == '') && ($DefaultView=='home'))) 
                            			include 'includes/myvolt_shout_menu.php';?>
                                        
                                  <? if ($_GET['tab'] == 'projects')
                            			include 'includes/myvolt_projects_menu.php';?>
                                        
                                   <? if ($_GET['tab'] == 'feed') {?>
                                    <img src="http://www.wevolt.com/images/feed_header.png" />
                                    <? }?>
                                    
                                     <? if (($_GET['tab'] == '') && ($_GET['s'] =='')) {?>
                                    <img src="http://www.wevolt.com/images/home_header.png" />
                                    <? }?>
                                    
                                     <? if ($_GET['tab'] == 'volts') {?>
                                    <img src="http://www.wevolt.com/images/volts_title.png" />
                                    <? }?>
                                        
                 
                            </td>
                           <td valign="top">
                           
                          <div id="save_alert" style="display:none;"><img src="http://www.wevolt.com/images/save_yellow_box.png" class="navbuttons" onclick="save_profile();"/></div>
                           
                             <!-- MY VOLT SECTION -->
					<div id="myvolt_content">
                     <? if (($_GET['tab'] == 'profile') || (($_GET['tab'] == '') && ($DefaultView=='profile'))) {
                                     if ($_GET['a'] == 'fbsync') {?>
                                     <center>
									 	<iframe src="http://www.wevolt.com/facebook/sync.php" frameborder="0" width="700" height="680" scrolling="no"></iframe>
                                        </center>
									<? } else {
								    	include 'includes/myvolt_about_inc.php';
										?>
                                        
                                        
                                        <?
									 }
                      } else if (($_GET['tab'] == 'home') || ($_GET['tab'] == 'shout') ||(($_GET['tab'] == '') && ($DefaultView=='home'))) {
						  
								if (($_GET['s'] == '') || ($_GET['s'] == 'home'))
									echo get_modules($UserID,$UserType='user',$ModuleWidths);
								else if ($_GET['s'] == 'feed')
									include 'includes/myvolt_social_inc.php';
								else if ($_GET['s'] == 'calendar')
									include 'includes/myvolt_calendar_inc.php';

		

                                   
                      }else if (($_GET['tab'] == 'network') || (($_GET['tab'] == '') && ($DefaultView=='network'))) {
                        include 'includes/myvolt_network_inc.php';        
					  }else if ($_GET['tab'] == 'settings') {
                        include 'includes/account_settings_inc.php';        
					  } else if ($_GET['tab'] == 'feed') {
						  $query = "SELECT f.*,p.title,p.thumb,p.SafeFolder 
						                   from follows as f 
										   join projects as p on f.follow_id=p.ProjectID
										   where f.user_id='".$_SESSION['userid']."' and f.type='project' order by p.title ASC" ;
						$InitDB->query($query);
						echo '<div align="center" style="padding:25px;">';
						echo 'Below are the projects that you are currently following. This section will be updated to include a full searchable list of the updates for each project soon.<div class="spacer"></div>';
						while ($line = $InitDB->fetchNextObject()) {
								echo '<a href="http://www.wevolt.com/'.$line->SafeFolder.'/"><img src="http://www.wevolt.com'.$line->thumb.'" border="2" hspace="5" vspace="5" tooltip="'.$line->title.'" width="100" height="100" style="border:2px #000 solid;"></a>';	
							
						}
						
           
                     
                      echo '</div>';
                      
                        //include 'updates.php';
						  
					  } else if ($_GET['tab'] == 'volts') {?>
                      <div align="center" style="padding:25px;">
                      <!--<img src="http://www.wevolt.com/images/volts_coming.png" />-->
                      </div>
                      <? 
                        //include 'updates.php';
						  
					  } else if ($_GET['tab'] == 'projects') {?>
                      <div style="padding-left:10px;">
						 <? 
                        $User->getUserProjects($UserID);  
						?>
                        </div>
                        <?     
					  } else if ($_GET['tab'] == 'wemail') {?>

    <iframe src="/mailbox.php" width="<? echo ($_SESSION['contentwidth'] - 160)?>" height="650" frameborder="0" scrolling="no" allowtransparency="yes"></iframe>			
   
						  
					  <? } else if ($_GET['tab'] == 'excites') {
						  
								 $User->getExcites($UserID);  
					  }
					  
					  ?>
                    </div>
                    <!-- END MY VOLT CONTENT-->  
                           
                           
                           </td>
                        </tr>
                    </table>
    
                  </div>
                </td>
        	</tr>
            <tr>
                <td class="white_foot_left">&nbsp;</td>
                <td class="white_foot_right">&nbsp;</td>
            </tr>
        </table>
        
        
		</td>
        
	</tr>
    
     <? if ($_SESSION['sidebar'] == 'open') {?><tr>
    <td id="sidebar_footer"></td>
  </tr>
  <? }?>
  
</table>

</div>

<?php include 'includes/pagefooter_inc.php';

$InitDB->close();

?>



