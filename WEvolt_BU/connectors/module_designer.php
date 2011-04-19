<?php 

include  $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';


$ReturnLink = $_GET['returnlink'];
$RePost = 0;
$UserID = $_SESSION['userid'];

	
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
//print_r($_POST);

if (($_POST['save'] == 1)) { 
		
		$ModuleTemplate = $_REQUEST['mid'];	
		
		$query ="SELECT cs.Skin, tsk.* from comic_settings as cs join project_skins as tsk on tsk.SkinCode=cs.Skin where cs.ComicID='$ProjectID'";
		$SkinArray = $InitDB->queryUniqueObject($query);		
		//print $query;
		
		$query ="SELECT * from pf_modules_templates where id='$ModuleTemplate'";
		$ModArray = $InitDB->queryUniqueObject($query);
		
		
		
		
		
		
		
		
		
		
		//print 'TARGET = ' . $_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetTR;
		if ($ModArray->tr_bg != '') {
			$TargetTR = "ModTopRightImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->tr_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetTR);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetTR,0777);	
		}
		if ($ModArray->tl_bg != '') {
			$TargetTL = "ModTopLeftImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->tl_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetTL);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetTL,0777);	
		}
		if ($ModArray->br_bg != '') {
			$TargetBR = "ModBottomRightImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->br_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetBR);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetBR,0777);	
		}
		if ($ModArray->bl_bg != '') {
			$TargetBL = "ModBottomLeftImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->bl_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetBL);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetBL,0777);	
		}
		if ($ModArray->l_bg != '') {
			$TargetL = "ModLeftSideImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->l_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetL);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetL,0777);	
		}
		if ($ModArray->r_bg != '') {
			$TargetR = "ModRightSideImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->r_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetR);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetR,0777);	
		}
		if ($ModArray->b_bg != '') {
			$TargetB = "ModBottomImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->b_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetB);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetB,0777);	
		}
		if ($ModArray->t_bg != '') {
			$TargetT = "ModTopImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->t_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetT);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetT,0777);	
		}
		
		if ($ModArray->c_bg != '') {
			$TargetC = "ContentBoxImage_".$ModArray->id.".png";
			copy($_SERVER['DOCUMENT_ROOT']."".$ModArray->t_bg,$_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetC);
			chmod($_SERVER['DOCUMENT_ROOT']."/templates/skins/".$SkinArray->Skin."/images/".$TargetC,0777);	
		}
		
		
		
		

		$query ="UPDATE project_skins set ".
						"ModTopRightImage='$TargetTR',".
						"ModTopRightBGColor='".substr($ModArray->tr_bgc,1,6)."',".
						"ModTopLeftImage='$TargetTL',".
						"ModTopLeftBGColor='".substr($ModArray->tl_bgc,1,6)."',".
						"ModBottomRightImage='$TargetBR',".
						"ModBottomRightBGColor='".substr($ModArray->br_bgc,1,6)."',".
						"ModBottomLeftImage='$TargetBL',".
						"ModBottomLeftBGColor='".substr($ModArray->bl_bgc,1,6)."',".
						"ModLeftSideImage='$TargetL',".
						"ModLeftSideBGColor='".substr($ModArray->l_bgc,1,6)."',".
						"ModRightSideImage='$TargetR',".
						"ModRightSideBGColor='".substr($ModArray->r_bgc,1,6)."',".
						"ModBottomImage='$TargetB',".
						"ModBottomBGColor='".substr($ModArray->b_bgc,1,6)."',".
						"ModTopImage='$TargetT',".
						"ModTopBGColor='".substr($ModArray->t_bgc,1,6)."',".
						"ContentBoxImage='$TargetC',".
						"ContentBoxBGColor='".substr($ModArray->c_bgc,1,6)."',".
						"ContentBoxImageRepeat='".$ModArray->c_bg_r."'".
						"where SkinCode='".$SkinArray->Skin."'";
		$InitDB->execute($query);
		//print $query.'<br/>';
		?>
        <script type="text/javascript">
			alert('Your module design has been loaded, the BOX PREVIEW in the CMS will refresh next time you load the section, but the new Module design is live on your site.');
			window.parent.document.getElementById("ModTopRightImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetTR;?>')";
			window.parent.document.getElementById("ModTopRightImage").style.height = '<? echo $ModArray->tr_height;?>px';
			window.parent.document.getElementById("ModTopRightImage").style.width = '<? echo $ModArray->tr_width;?>px';
			
			window.parent.document.getElementById("ModTopLeftImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetTL;?>')";
			window.parent.document.getElementById("ModTopLeftImage").style.height = '<? echo $ModArray->tl_height;?>px';
			window.parent.document.getElementById("ModTopLeftImage").style.width = '<? echo $ModArray->tl_width;?>px';
			
			window.parent.document.getElementById("ModBottomRightImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetBR;?>')";
			window.parent.document.getElementById("ModBottomRightImage").style.height = '<? echo $ModArray->br_height;?>px';
			window.parent.document.getElementById("ModBottomRightImage").style.width = '<? echo $ModArray->br_width;?>px';
			
			window.parent.document.getElementById("ModBottomLeftImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetBL;?>')";
			window.parent.document.getElementById("ModBottomLeftImage").style.height = '<? echo $ModArray->bl_height;?>px';
			window.parent.document.getElementById("ModBottomLeftImage").style.width = '<? echo $ModArray->bl_width;?>px';
			
			window.parent.document.getElementById("ModBottomImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetB;?>')";

			
			window.parent.document.getElementById("ModTopImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetT;?>')";

			
			window.parent.document.getElementById("ModRightSideImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetR;?>')";
			window.parent.document.getElementById("ModRightSideImage").style.width = '<? echo $ModArray->r_width;?>px';
			
			window.parent.document.getElementById("ModLeftSideImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetL;?>')";
			window.parent.document.getElementById("ModLeftSideImage").style.width = '<? echo $ModArray->l_width;?>px';
			
			window.parent.document.getElementById("ContentBoxImage").style.backgroundImage = "url('/templates/skins/<? echo $SkinArray->Skin;?>/images/<? echo $TargetC;?>')";
		
		</script>
        
        
        <?
		$CloseWindow = 1;
}
	 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<script type="text/javascript">

function load_module(value) {
	var answer = confirm('Are you sure you want to install this module design? This will replace your current module box design');
	
	if (answer) {
		document.getElementById("mid").value = value;
		document.getElementById("save").value = 1;
		document.modform.action = '/connectors/module_designer.php';
		document.modform.submit();
	}

	//document.modform.submit();
}
</script>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Edit Module</title>
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
<img src="http://www.wevolt.com/images/edit_modules.png" />
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
SELECT WHICH MODULE DESIGN YOU WOULD LIKE TO LOAD
<div class="spacer"></div>

<?
$query ="SELECT * from pf_modules_templates order by Title";
$InitDB->query($query);
$count = 1;
echo '<table width="100%"><tr>'; 
 while ($line = $InitDB->fetchNextObject()) {
	 echo '<td align="center">';
	 echo $line->title;
	 
	 echo '<div onclick="load_module(\''.$line->id.'\');" class="navbuttons" style="width:100px;">';
	 echo '<table width="100" cellpadding="0" cellspacing="0"><tr>';
	 
	 echo '<td style="';
	 if ($line->tl_bg != '') 
	 	echo 'background-image:url('.$line->tl_bg.'); background-position:top left;'; 
	 if ($line->tl_bgc != '') 
	 	echo 'background-color:'.$line->tl_bgc.';';
	if ($line->tl_width != '') 
	 	echo 'width:'.$line->tl_width.'px;';
	if ($line->tl_height != '') 
	 	echo 'height:'.$line->tl_height.'px;';	 
	 echo '"></td>';
	 
	 echo '<td style="';
	 if ($line->t_bg != '') 
	 	echo 'background-image:url('.$line->t_bg.'); background-position:top; background-repeat-x;'; 
	 if ($line->t_bgc != '') 
	 	echo 'background-color:'.$line->t_bgc.';';
	echo 'width:'.(100-($line->tl_width+$line->tl_height)).'px;';
	 echo '"></td>';
	 
	  echo '<td style="';
	 if ($line->tr_bg != '') 
	 	echo 'background-image:url('.$line->tr_bg.'); background-position:top right;'; 
	 if ($line->tr_bgc != '') 
	 	echo 'background-color:'.$line->tr_bgc.';';
	if ($line->tr_width != '') 
	 	echo 'width'.$line->tr_width.'px;';
	if ($line->tl_height != '') 
	 	echo 'height'.$line->tr_height.'px;';	 
	 echo '"></td>';
	 echo '</tr><tr>';
	
	 echo '<td style="';
	 if ($line->l_bg != '') 
	 	echo 'background-image:url('.$line->l_bg.');background-repeat:repeat-y;'; 
	 if ($line->l_bgc != '') 
	 	echo 'background-color:'.$line->l_bgc.';';
	echo 'width:'.$line->tl_width.'px;';
	echo '"></td>';
	
	echo '<td style="';
	 if ($line->c_bg != '') 
	 	echo 'background-image:url('.$line->c_bg.');background-repeat:'.$line->c_bg_r.';'; 
	 if ($line->c_bgc != '') 
	 	echo 'background-color:'.$line->c_bgc.';';
	echo 'height:80px;"></td>';
	
	 echo '<td style="';
	 if ($line->r_bg != '') 
	 	echo 'background-image:url('.$line->r_bg.');background-repeat:repeat-y;'; 
	 if ($line->r_bgc != '') 
	 	echo 'background-color:'.$line->r_bgc.';';
	echo 'width:'.$line->tr_width.'px;';
	echo '"></td>';
	echo '</tr><tr>';
	 echo '<td style="';
	 if ($line->bl_bg != '') 
	 	echo 'background-image:url('.$line->bl_bg.'); background-position:bottom left;'; 
	 if ($line->bl_bgc != '') 
	 	echo 'background-color:'.$line->bl_bgc.';';
	if ($line->bl_width != '') 
	 	echo 'width:'.$line->bl_width.'px;';
	if ($line->bl_height != '') 
	 	echo 'height:'.$line->bl_height.'px;';	 
	 echo '"></td>';
	 
	 echo '<td style="';
	 if ($line->b_bg != '') 
	 	echo 'background-image:url('.$line->b_bg.'); background-position:bottom; background-repeat-x;'; 
	 if ($line->b_bgc != '') 
	 	echo 'background-color:'.$line->b_bgc.';';
	 echo '"></td>';
	 
	  echo '<td style="';
	 if ($line->br_bg != '') 
	 	echo 'background-image:url('.$line->br_bg.'); background-position:bottom right;'; 
	 if ($line->tr_bgc != '') 
	 	echo 'background-color:'.$line->br_bgc.';';
	if ($line->br_width != '') 
	 	echo 'width:'.$line->br_width.'px;';
	if ($line->bl_height != '') 
	 	echo 'height:'.$line->br_height.'px;';	 
	 echo '"></td>';
	 echo '</tr></table></div>';
	 
	 echo '</td>';
	 
	 $count++;
	 
	 if ($count ==6) {
		 $count=1;
	 	echo '</tr><tr>';
	 }
 }
 echo '</table>';
 }
?>
<input type="hidden" name="mid" id="mid">
<input type="hidden" name="save" id="save">
</form>

 </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>
                        <div class="spacer"></div>

<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.png" onclick="parent.$.modal().close();" class="navbuttons"/></div> 
</div> 

</body>
</html>