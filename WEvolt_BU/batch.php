<? 
$IsCMS = true;
$TrackPage=0;
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php'; 
ini_set('max_execution_time', 300); //300 seconds = 5 minutes  
$Today = date("m-d-Y");
$_SESSION['usertype'] = 2;
$Pagetracking = 'Admin'; 
$UserID = $_SESSION['userid'];
if ($_SESSION['userid'] == '')
	header("location:/login.php?ref=/cms/admin/");
$SessionAdminUserID = $UserID;
$SessionEmail = $_SESSION['email'];
$PageTitle .=' Batch Page Upload';
$query = "SELECT * from Episodes where ProjectID ='".$_SESSION['sessionproject']."'  and SeriesNum='".$_GET['series']."' order by EpisodeNum ASC";
	$InitDB->query($query);  
	$HasEp = 0;
	$EpisodeSelect = '<select name="txtEpisode">';
	while ($line = $InitDB->fetchNextObject()) {
	$HasEp = 1;
	//	print 'EPISODE = ' . $EpisodeNum.'<br/>';
		//print 'EPISODE = ' .$line->EpisodeNum.'<br/>';
			$EpisodeSelect .= '<option value="'.$line->EpisodeNum.'"';
			if ($_GET['ep'] == $line->EpisodeNum)
				$EpisodeSelect .= ' selected ';
			$EpisodeSelect .='>'.$line->Title.'</option>';
	}
	if ($HasEp == 0)
		$EpisodeSelect .= '<option value="">Start New Episode</option>';
	$EpisodeSelect .= '</select>';
	
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();

?>

<script language="JavaScript">


function addslot(numslots)
	{   
		var container = document.getElementById('uploadcontainer');
		var numfiles = document.getElementById('numfiles').value;
		
		for (i=0;i<numslots;i++)
			{			
		numfiles++;
		var new_element = document.createElement('div');
		document.getElementById('numfiles').value = numfiles;
		var html = '<table width=\"592\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td id=\"wizardBox_TL\"></td><td id=\"wizardBox_T\"></td><td id=\"wizardBox_TR\"></td></tr><tr><td class=\"wizardboxcontent\"></td><td class=\"wizardboxcontent\" valign=\"top\" width=\"576\" align=\"left\">';
		
		html += '<div style=\"height:10px;\"></div><font style=\"font-size:16px;font-weight:bold;\">PAGE '+numfiles+'</font> <div style=\"padding:5px;\">PAGE TITLE:<input type=\"text\" name=\"title'+(numfiles-1)+'\" style=\"width:98%;\"><br>PAGE COMMENT:<br><textarea name=\"comment'+(numfiles-1)+'\" style=\"width:98%; height:50px;\"></textarea>CHOOSE FILE: <input type=\"file\" name=\"images[]\" style=\"width:100%;\"><div style=\"height:5px;\"></div>START DATE: <input name=\"date'+(numfiles-1)+'\" type=\"text\" id=\"date'+(numfiles-1)+'\" size=\"10\" value=\"<? echo $Today;?>\">&nbsp;<img src=\"/<? echo $_SESSION['pfdirectory'];?>/images/cal.gif\" onClick=\"displayDatePicker(\'date'+(numfiles-1)+'\',false,\'mdy\',\'-\');\" class=\"calpick\">&nbsp;&nbsp;<input type=\"checkbox\" name=\"chapter'+(numfiles-1)+'\" value=\"1\" style=\"border:none;background-color:#fdd8b3;\"/>Chapter Start</div>';
		
		html += '</td><td class=\"wizardboxcontent\"></td></tr><tr><td id=\"wizardBox_BL\"></td><td id=\"wizardBox_B\"></td><td id=\"wizardBox_BR\"></td></tr></tbody></table>';
		new_element.innerHTML =html;
		new_element.className ='uploadbox';
		container.appendChild(new_element); 
			}
		
	}	
	function submitform()
	{
		var numberofpages = document.getElementById('numfiles').value;
		document.getElementById('progressbar').style.display = '';
	
		document.getElementById('numberofpages').innerHTML = numberofpages;
	//alert('got here');
		document.getElementById('uploadform').style.display = 'none';
  		document.pageupload.submit();
	}
</script>
<LINK href="http://www.wevolt.com/<? echo $PFDIRECTORY;?>/css/cms_css.css" rel="stylesheet" type="text/css">

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
    
     <div class="content_bg" id="content_wrapper">
         <!--Content Begin -->
         <div class="spacer"></div>
         <div style="padding:10px;">
<div id='progressbar' class="messageinfo_warning" style="display:none; padding-right:25px; padding-left:25px;padding-top:50px;padding-bottom:100px;" align="center"><strong>Please wait...</strong><div class='spacer'></div>
<div class="messageinfo_white" >Your (<span id='numberofpages'></span>) pages are being uploaded and processed. </div><div class='spacer'></div>This could take several minutes depending on the number of pages and size of images.
<div class='spacer'></div><img src='/images/progressBarLong.gif'></div>

<div class="wrapper" align="center">

<div id='uploadform'>
<div style="padding-left:60px;" align="left">

<div class='messageinfo_white'><strong>BATCH PAGE UPLOAD NEW</strong></div><div style="height:10px;"></div>

<img src="http://www.wevolt.com/images/wizard_cancel_btn.png" onclick="window.location='/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=content&section=pages';" class="navbuttons"/>

<form method='post' action='/pf_16_core/process_batch.php?section=<? echo $_GET['section'];?>&series=<? echo $_GET['series'];?>' enctype='multipart/form-data' name='pageupload'>

<input type='button' value='ADD SLOT' onClick="addslot('1')">&nbsp;<input type='button' value='ADD 5 SLOTS' onClick="addslot('5')">&nbsp;<input type='button' value='START UPLOAD' style="background-color:#FFCC00;" onclick="submitform();">
<div style="height:10px;"></div>
<div class="messageinfo_warning">Episode:<? echo $EpisodeSelect;?></div>
<div style="height:10px;"></div>
  <div id='uploadcontainer' style="width:600px;">
  <div class='uploadbox' align="left">
 
  <table width="592" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="576" align="left">
  <font style="font-size:16px;font-weight:bold;">PAGE 1</font>

  <div style="padding:5px;">
PAGE TITLE: 
  <input type="text" name='title0' style="width:98%;" />
  <br>
PAGE COMMENT:<br>
<textarea name='comment0' style="width:98%; height:50px;"></textarea>
CHOOSE FILE: <input type='file' name='images[]' style="width:98%;">
<div style="height:5px;"></div>
START DATE: <input name="date0" type="text" id='date0' size="10" value="<? echo $Today;?>">&nbsp;<img src="/<? echo $_SESSION['pfdirectory'];?>/images/cal.gif" onClick="displayDatePicker('date0',false,'mdy','-');" class='calpick'>&nbsp;&nbsp;<input type='checkbox' name='chapter0' value='1' style="border:none;background-color:#fdd8b3;"/>Chapter Start

</div>


 </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>
                        


</div> 

<div style="height:10px;"></div>

<input type='button' value='ADD SLOT' onClick="addslot('1')">&nbsp;<input type='button' value='ADD 5 SLOTS' onClick="addslot('5')">&nbsp;<input type='button' value='START UPLOAD' style="background-color:#FFCC00;" onclick="submitform();">
<input type='hidden' value='1' id='numfiles'>
</form>
</div>

</div>
    
    <!--Content End -->
    </div>

	</td>
  </tr>
  <tr>
      <td style="background-image:url(http://www.wevolt.com/images/bottom_frame_no_blue.png); background-repeat:no-repeat;width:1058px;height:12px;">
      </td>
  </tr>
</table>
</div>
  
<?php require_once('includes/pagefooter_inc.php'); ?>


