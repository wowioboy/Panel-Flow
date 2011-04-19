<?php 

include  $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';


$ReturnLink = $_GET['returnlink'];
$RePost = 0;
$UserID = $_SESSION['userid'];
$cid=$_REQUEST['cid'];
$ctype=$_REQUEST['ctype'];
	
$ProjectID = $_SESSION['sessionproject'];

if ($ProjectID == '' )
	$ProjectID = $_POST['ProjectID'];

$CloseWindow = 0;

$query = "SELECT p.userid, p.CreatorID, p.SafeFolder, p.title, u.username,
		  (SELECT u2.username from users as u2 where u2.encryptid=p.CreatorID) as CreatorName 
		  from projects as p 
		  join users as u on p.userid=u.encryptid
		  where p.ProjectID='$ProjectID'"; 
$ProjectArray = $InitDB->queryUniqueObject($query);
$OwnerID = $ProjectArray->userid;
$CreatorID = $ProjectArray->CreatorID;
$OwnerUsername = $ProjectArray->username;
$ProjectTitle = $ProjectArray->title; 
$SafeFolder = $ProjectArray->SafeFolder; 
$CreatorName = $ProjectArray->CreatorName; 
if (($UserID == $CreatorID) || ($UserID == $OwnerID))
	$Auth = 1;
else 
	$Auth = 0;
		
if (($_SESSION['userid'] == '') || ($Auth == 0))
	$CloseWindow = 1;

if ($_POST['save'] == 1) { 
		
		if ($_REQUEST['pid'] != '') {
		if ($_REQUEST['edit'] == 1) {
			$query ="UPDATE story_flow_entries set 
							comment='".mysql_real_escape_string($_POST['comment'])."'
							 where content_id='$cid' and page_id='".$_REQUEST['pid']."' and project_id='$ProjectID' and content_type='$cid'";
				$InitDB->execute($query);	
			
		} else {
			$query ="SELECT position from story_flow_entries WHERE position=(SELECT MAX(position) FROM story_flow_entries where project_id='$ProjectID' and page_id='".$_REQUEST['pid']."')";
			$NewPosition = $InitDB->queryUniqueValue($query);
			$NewPosition++;
				$query ="INSERT into 
								story_flow_entries (
								comment,
								project_id,
								page_id,
								content_type,
								content_id,
								position)
								values (
								'".mysql_real_escape_string($_POST['comment'])."',
								'".$ProjectID."',
								'".$_REQUEST['pid']."',
								'".$_REQUEST['ctype']."',
								'".$_REQUEST['cid']."',
								'$NewPosition')";
				$InitDB->query($query);		 
				$InitDB->close();									
			
		}
		$CloseWindow = 1;
		
		} else {
			
		$Error = 'You must select a page for this entry.';	
		}
}

if (($_REQUEST['edit'] == '1') && ($_POST['save'] != 1)) {
	$query = "SELECT distinct cp.title, cp.ThumbSm,se.* from story_flow_entries as se 
			          join comic_pages as cp on (cp.EncryptPageID=se.page_id and cp.comicid=se.project_id)
					  where se.content_id='$cid' and se.project_id='".$_SESSION['sessionproject']."' and se.content_type='$ctype'";
			$FlowArray = $InitDB->queryUniqueObject($query);
			
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<script type="text/javascript">

function submit_form(step) {
	document.modform.action ='/connectors/story_flow.php?step='+step;
	document.modform.submit();
}
</script>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<titleStory Flow</title>
<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
 <LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">

</head>
<body>
<style type="text/css">
body,html {
margin:0px;
padding:0px;

}

</style>
<div class="wizard_wrapper" align="center" style="height:500px; width:700px;">
<div class="spacer"></div>
<div align="center">
<div style="font-size:16px;">CONNECTED ENTRIES</div>
<div class="spacer"></div>

<table width="600" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="584" align="center">
                                       


<? if ($CloseWindow == 1) {?>
<script type="text/javascript">

parent.$.modal().close();

//document.location.href=document.getElementById("redirurl").value;
//parent.window.document.SaveModules.submit();
</script>
 <? } else {?>
 

<form name="modform" id="modform" method="post" action="#">

<div align="center">
Select a page from the dropdown below that you want to attach this entry to:<div class="spacer"></div>

<?
		
		$query ="SELECT distinct s.Title as SeriesTitle, e.Title as EpisodeTitle, cp.* 
		           from comic_pages as cp
				   join series as s on (s.SeriesNum=cp.SeriesNum and s.ProjectID=cp.comicid)
				   join Episodes as e on (e.EpisodeNum=cp.EpisodeNum and cp.SeriesNum=e.SeriesNum and e.ProjectID=cp.comicid)
				    where cp.comicid='$ProjectID' and cp.PageType='pages' group by cp.EncryptPageID order by cp.SeriesNum,cp.EpisodeNum,cp.EpPosition";
		$InitDB->query($query);
	
		if ($Error != '')
			echo '<div style="color:#FC0; font-size:14px;">'.$Error.'</div><div class="spacer"></div>';
		echo '<select name="pid" id="pid">';
		echo '<option value="all">Connect to ALL pages</option>';
		$LastSeriesNum = 0;
		while ($page = $InitDB->fetchNextObject()) {
				if ($LastSeriesNum != $page->SeriesNum) {
					$LastSeriesNum =$page->SeriesNum;
					
					$LastEpisodeNum=0;	
					echo '<option value="" style="background-color:#e5e5e5;">SERIES :'.$page->SeriesTitle.'</option>';
				}
					if ($LastEpisodeNum !=$page->EpisodeNum){
						echo '<option value=""  style="background-color:#39F;">--EPISODE '.$page->EpisodeNum.' - '.$page->EpisodeTitle.'</option>';
						$LastEpisodeNum =$page->EpisodeNum;
					}
					echo '<option value="'.$page->EncryptPageID.'"';
					if (($_REQUEST['pid'] == $page->EncryptPageID) || ($FlowArray->page_id == $page->EncryptPageID))
					echo 'selected';
					echo '>---->PAGE '.$page->EpPosition.' - '.$page->Title.'</option>';
				
				
		} 
		echo '</select>';
		
	?><div class="spacer"></div>
     Enter a short comment<br />
<textarea name="comment" id="comment" style="width:100%; height:50px;"><? if ($_REQUEST['comment'] != '') echo $_REQUEST['comment']; else echo $FlowArray->comment;?></textarea>
<div class="spacer"></div>


<? }


?>
</div>
<input type="hidden" name="cid" id="cid" value="<? echo $_REQUEST['cid'];?>">
<input type="hidden" name="edit" id="edit" value="<? echo $_REQUEST['edit'];?>">
<input type="hidden" name="ctype" id="ctype" value="<? echo $_REQUEST['ctype'];?>">
<input type="hidden" name="save" id="save" value="1" />
</form>

 </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>
                        <div class="spacer"></div>



<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.png" onClick="parent.$.modal().close();" class="navbuttons"/>&nbsp;&nbsp;
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.png" onclick="submit_form('<? if ($_REQUEST['edit'] == 1) echo 'save'; else echo 'finish';?>');" class="navbuttons" />



<? if ($_GET['step'] == '2'){?>
<img src="http://www.wevolt.com/images/cms/cms_grey_back_btn.png" onclick="submit_form('1');" class="navbuttons" />
<? }?></div> 
</div> 

</body>
</html>