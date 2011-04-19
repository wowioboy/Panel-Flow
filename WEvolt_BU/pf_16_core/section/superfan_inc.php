<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/content_functions.php';

$RePost = 0;
$UserID = $_SESSION['userid'];
$DB = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$CloseWindow = 0;
if ($_SESSION['userid'] == '')
	$CloseWindow = 1;

 
$CurrentDate = date('Y-m-d') .' 00:00:00';
if ($_POST['save'] == 1) { 
			$query = "SELECT SuperFanInvites,TempSuperFanInvites from projects where ProjectID='".$_SESSION['sessionproject']."'";
			$FanArray = $DB->queryUniqueObject($query);
			
			$SuperFanInvitesNum = $FanArray->SuperFanInvites;
			$TempSuperFanInvitesNum = $FanArray->TempSuperFanInvites;
	
			$SuperInvites = explode(',',$_POST['superinvites']);
			$TempInvites = explode(',',$_POST['tempinvites']);
			if ($SuperInvites == null)
				$SuperInvites = array();
			if ($TempInvites == null)
				$TempInvites = array();
			
				
			foreach ($SuperInvites as $user) {
					if ($user != '') {
					$query = "SELECT count(*) from fan_invitations where ProjectID='".$_SESSION['sessionproject']."' and UserID='$user'";
					$Found = $DB->queryUniqueValue($query);
					//print $query.'<br/>';
					if ($Found == 0) {
						$query = "INSERT into fan_invitations 
									(ProjectID, UserID, SenderID, IsLifetime,CreatedDate, Status) values 
									('".$_SESSION['sessionproject']."', '$user', '".$_SESSION['userid']."', 1,'$CurrentDate','active')"; 
						//print $query.'<br/>';
						$DB->execute($query);
					} else {
						$query = "UPDATE fan_invitations set Status='active', IsLifetime=1, ExpirationDate='' where ProjectID='".$_SESSION['sessionproject']."' and UserID='$user'";
						$DB->execute($query);
					//	print $query.'<br/>';
					}
					
						$SuperFanInvitesNum--;
						$query = "UPDATE projects set SuperFanInvites='$SuperFanInvitesNum' where ProjectID='".$_SESSION['sessionproject']."'";
						$DB->execute($query);
						
						$query = "SELECT username, email from users where encryptid='$user'";
						$UserArray = $DB->queryUniqueObject($query);
						$Email = $UserArray->email;
						$Username = $UserArray->username;
						
						$header = "From: NO-REPLY@wevolt.com  <NO-REPLY@wevolt.com >\n";
						$header .= "Reply-To: NO-REPLY@wevolt.com <NO-REPLY@wevolt.com>\n";
						$header .= "X-Mailer: PHP/" . phpversion() . "\n";
						$header .= "X-Priority: 1";
	
					//SEND USER EMAIL
						$PageLink = 'http://www.wevolt.com/'.$_SESSION['safefolder'].'/';
						$to = $Email;
						$subject = $_SESSION['username'].' has given you a SuperFan pass on WEvolt';
						$wesubject = $_SESSION['username'].' has given you a Temporary Month SuperFan pass';
						$body .= $_SESSION['username']." has given you a SuperFan pass on their project ".str_replace('_',' ',$_SESSION['safefolder'])."\n\nClick here to read: <a href=\"".$PageLink."\">".$PageLink."</a>"; 
						$WemailBody = $_SESSION['username']." has given you a SuperFan pass on their project ".str_replace('_',' ',$_SESSION['safefolder'])."\n\nClick here to read: <a href=\"#\" onclick=\"parent.window.location.href='".$PageLink."';\">".$PageLink."</a>"; 
						 mail($to, $subject, $body, $header);
						
						$body = mysql_real_escape_string($WemailBody);
						$DateNow = date('m-d-Y');
						$query = "INSERT into panel_panel.messages 
										(userid, sendername, senderid, subject, message, date) 
										values 
										('$user','".$_SESSION['username']."','".$_SESSION['userid']."','$wesubject','".mysql_real_escape_string($WemailBody)."','$DateNow')";
						$DB->execute($query);					
						//print $query.'<br/>';
					}
			}
			
			foreach ($TempInvites as $user) {
				if ($user != '') {
					$query = "SELECT count(*) from fan_invitations where ProjectID='".$_SESSION['sessionproject']."' and UserID='$user'";
					$Found = $DB->queryUniqueValue($query);
				//	print $query.'<br/>';
					if ($Found == 0) {
						$end = date("Y-m-d 00:00:00",strtotime("+1 months"));
						$query = "INSERT into fan_invitations 
									(ProjectID, UserID, SenderID, IsLifetime,CreatedDate, Status, ExpirationDate) values 
									('".$_SESSION['sessionproject']."', '$user', '".$_SESSION['userid']."', 0,'$CurrentDate','active','$end')"; 
						$DB->execute($query);
					//	print $query.'<br/>';
					} else {
						$query = "UPDATE fan_invitations set ExpirationDate='$end', IsLifetime=0, Status='active' where ProjectID='".$_SESSION['sessionproject']."' and UserID='$user'";
						$DB->execute($query);
						//print $query.'<br/>';
						
					}
					
						$TempSuperFanInvitesNum--;
						$query = "UPDATE projects set TempSuperFanInvites='$TempSuperFanInvitesNum' where ProjectID='".$_SESSION['sessionproject']."'";
						$DB->execute($query);
						
						$query = "SELECT username, email from users where encryptid='$user'";
						$UserArray = $DB->queryUniqueObject($query);
						$Email = $UserArray->email;
						$Username = $UserArray->username;
						
						$header = "From: NO-REPLY@wevolt.com  <NO-REPLY@wevolt.com >\n";
						$header .= "Reply-To: NO-REPLY@wevolt.com <NO-REPLY@wevolt.com>\n";
						$header .= "X-Mailer: PHP/" . phpversion() . "\n";
						$header .= "X-Priority: 1";
	
					//SEND USER EMAIL
						$PageLink = 'http://www.wevolt.com/'.$_SESSION['safefolder'].'/';
						$to = $Email;
						$subject = $_SESSION['username'].' has given you a Temporary Month SuperFan pass on WEvolt';
						$wesubject = $_SESSION['username'].' has given you a Temporary Month SuperFan pass';
						$body .= $_SESSION['username']." has given you a Temporary Month SuperFan pass on their project ".str_replace('_',' ',$_SESSION['safefolder'])."\n\nClick here to read: <a href=\"".$PageLink."\">".$PageLink."</a> in the PRO experience."; 
						$WemailBody = $_SESSION['username']." has given you a SuperFan pass on their project ".str_replace('_',' ',$_SESSION['safefolder'])."\n\nClick here to read in the pro experience: <a href=\"javascript:void(0);\" onclick=\"parent.window.location.href='".$PageLink."';\">".$PageLink."</a>"; 
						 mail($to, $subject, $body, $header);
						
						$body = mysql_real_escape_string($WemailBody);
						$DateNow = date('m-d-Y');
						$query = "INSERT into panel_panel.messages 
										(userid, sendername, senderid, subject, message, date) 
										values 
										('$user','".$_SESSION['username']."','".$_SESSION['userid']."','$wesubject','".mysql_real_escape_string($WemailBody)."','$DateNow')";
						$DB->execute($query);					
					}
			}
			$CloseWindow = 1;
}

if ($CloseWindow == 0) {
	
	$CurrentMonth = date('m');
	$CurrentYear = date('Y');
	$query = "SELECT level from users where encryptid='".$_SESSION['userid']."'";
	$Level = $DB->queryUniqueValue($query);
	
	$query = "SELECT LastRefreshMonth, LastRefreshYear, SuperFanInvites,TempSuperFanInvites from projects where ProjectID='".$_SESSION['sessionproject']."'";
	$FanArray = $DB->queryUniqueObject($query);
	
	$LastRefreshMonth = $FanArray->LastRefreshMonth;
	$LastRefreshYear = $FanArray->LastRefreshYear;
	$SuperFanInvites = $FanArray->SuperFanInvites;
	$TempSuperFanInvites = $FanArray->TempSuperFanInvites;
	
	if ((intval($LastRefreshMonth) < intval($CurrentMonth)) || ((intval($LastRefreshMonth) > intval($CurrentMonth))&&(intval($CurrentYear>$LastRefreshYear)))){
		
		$SuperFanInvites = (intval($SuperFanInvites)+$Level); 
		$TempSuperFanInvites = (5+$Level);
		
		$query = "UPDATE projects set SuperFanInvites='$SuperFanInvites',TempSuperFanInvites='$TempSuperFanInvites', LastRefreshMonth='$CurrentMonth', LastRefreshYear='$CurrentYear' where ProjectID='".$_SESSION['sessionproject']."'";
		$DB->execute($query);
	
	}

	$query = "SELECT u.username, u.avatar, f.IsLifetime, f.ExpirationDate,u.encryptid
	         from fan_invitations as f 
			 join users as u on f.UserID=u.encryptid 
			 where f.ProjectID='".$_SESSION['sessionproject']."' and ((f.ExpirationDate>'$CurrentDate' and f.Status='active') or (f.IsLifetime=1 and f.Status='active'))";
	$DB->query($query);
	//print $query;
	while ($line = $DB->fetchNextObject()) {
		//	print 'SUPER FAN '.$line->IsLifetime.'<br/>';
		if ($line->IsLifetime == 1) {
			if ($CurrentSuperFans == '')
				$CurrentSuperFans = $line->encryptid;
			else
				$CurrentSuperFans .= ','.$line->encryptid;
		
			$SuperFans .= '<img src="'.$line->avatar.'" tooltip="'.$line->username.'" vspace="5" hspace="5" style="border:1px #000000 solid;" width="50" height="50" id="super_'.$line->encryptid.'">';	
		}else {
			if ($CurrentTempSuperFans == '')
				$CurrentTempSuperFans = $line->encryptid;
			else
				$CurrentTempSuperFans .= ','.$line->encryptid;
			$TempFans .= '<img src="'.$line->avatar.'" tooltip="'.$line->username.' - expires: '.$line->ExpirationDate.'" vspace="5" hspace="5" style="border:1px #000000 solid;" width="50" height="50" id="temp_'.$line->encryptid.'">';	
		}
				
	}
	
}
if ($TempFans == '')
	$TempFans = 'You don\'t have any temporary passes handed out this month<br/>';
if ($SuperFans == '')
	$SuperFans = 'You haven\'t handed out any SuperFan passes yet. Give your loyal fans the pro experience for LIFE! (while reading your project)<br/>';	

$DB->close();

?>

<LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="http://www.wevolt.com/ajax/ajax_init.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.wevolt.com/js/jquery-1.4.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.wevolt.com/scripts/jquery.qtip-1.0.0-rc3.js"></script>

<style type="text/css">
/* <![CDATA[ */
textarea { clear: both; font-family: sans-serif; font-size: 1em; width: 275px;}
/* ]]> */
</style>

 
 
<script type="text/javascript">

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 
 document.getElementById("search_results").innerHTML=xmlHttp.responseText;
 document.getElementById('search_container').style.display='';

 } 
}
function display_data(keywords) {

    xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null) {
        alert ("Your browser does not support AJAX!");
        return;
    }
	
	
	 var content =  document.modform.txtContent.value;
    var url="/connectors/getUserResults.php";
    url=url+"?content="+content+"&keywords="+escape(keywords);
	//alert(url);
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
            document.getElementById('search_results').innerHTML=xmlhttp.responseText;
			//alert(xmlhttp.responseText);
			document.getElementById('search_container').style.display=''; 
        }
    }
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
}	
var timer = null;
function checkIt(keywords) {
	 var content =  document.modform.txtContent.value;
    if (timer) window.clearTimeout(timer); // If a timer has already been set, clear it
	if (content == 'email')
		var timeset = 8000;
	else
		var timeset = 2000;
		
    timer = window.setTimeout(display_data(keywords), timeset); // Set it for 2 seconds
    //Just leave the method and let the timer do the rest...
}
function submit_form() {
			
		document.modform.submit();

}
var itemnum = 1;
function set_user(username, avatar, type,uid) {
	var html;
	var formgood = 0;
	var userok = 1;
	itemnum = itemnum+1;
	
	var newpass = '<a href="javascript:void(0);" onclick="remove_user(\''+uid+'\',\''+type+'\',\'userselected_'+itemnum+'\');"><img src="'+avatar+'" tooltip="'+username+'" vspace="5" hspace="5" style="border:2px #ff0000 solid;" width="50" height="50" id="userselected_'+itemnum+'"></a>';
	var availsupers = document.getElementById("availsupers").value; 
	var availtemps = document.getElementById("availtemps").value; 
	var currenttemps = document.getElementById("tempinvites").value;
	var currentsupers = document.getElementById("superinvites").value;
	
	var currentsupersArray = currentsupers.split(',');
	var currenttempsArray = currenttemps.split(',');
	
	var currentsettemps = document.getElementById("currenttemps").value;
	var currentsetsupers = document.getElementById("currentsupers").value;
	var currentsetsupersArray = currentsetsupers.split(',');
	var currentsettempsArray = currentsettemps.split(',');
	
		if (type == 'temp') {

			var arLen=currentsetsupersArray.length;
			for ( var i=0, len=arLen; i<len; ++i ){
				if (uid == currentsetsupersArray[i]) {
					userok = 0;
					alert('This user is already has a SuperFan pass');
					break;	
				}
				
			}
			var arLen=currentsettempsArray.length;
			for ( var i=0, len=arLen; i<len; ++i ){
				if (uid == currentsettempsArray[i]) {
					userok = 0;
					alert('This user currently has an active Temp pass');
					break;	
				}
				
				
			}
			
			var arLen=currentsupersArray.length;
			for ( var i=0, len=arLen; i<len; ++i ){
				if (uid == currentsupersArray[i]) {
					userok = 0;
					alert('This user is already selected to get a SuperFan pass');
					break;	
				}
				
			}
			var arLen=currenttempsArray.length;
			for ( var i=0, len=arLen; i<len; ++i ){
				if (uid == currenttempsArray[i]) {
					userok = 0;
					alert('This user is already selected to get a Temp pass');
					break;	
				}
				
				
			}
			if (userok == 1) {
				if (parseInt(availtemps) > 0) {
					formgood = 1;
					availtemps = (parseInt(availtemps) - 1);
						document.getElementById("availtemps").value = availtemps; 
				html = document.getElementById("tempfans_div").innerHTML;
				
				if (currenttemps == '')
					currenttemps = uid;
				else 
					currenttemps +=','+uid;
				document.getElementById("tempinvites").value = currenttemps;	
				var divtarget = 'tempfans_div';
				document.getElementById("tempfannum").innerHTML = availtemps;	
				} else {
					alert ('Sorry you don\'t have any more temporary passes available until next month');	
				}
			}
		} else if (type == 'super') {
				
				var arLen=currentsetsupersArray.length;
				
				for ( var i=0, len=arLen; i<len; ++i ){
					if (uid == currentsetsupersArray[i]) {
						userok = 0;
						alert('This user is already has a SuperFan pass');
						break;	
					}
					
				}
				var arLen=currentsettempsArray.length;
				for ( var i=0, len=arLen; i<len; ++i ){
					if (uid == currentsettempsArray[i]) {
						var answer = confirm  ("This user currently has an active Temp pass. Would you like to upgrade them to a SuperFan?")
						if (answer){
							userok = 1;
							document.getElementById('temp_'+uid).style.display='none';
						} else {
							userok = 0;	
						}
						break;	
					}
				}
			
				var arLen=currentsupersArray.length;
				for ( var i=0, len=arLen; i<len; ++i ){
					if (uid == currentsupersArray[i]) {
						userok = 0;
						alert('This user is already selected to get a SuperFan pass');
						break;	
					}
					
				}
				var arLen=currenttempsArray.length;
				for ( var i=0, len=arLen; i<len; ++i ){
					if (uid == currenttempsArray[i]) {
						userok = 0;
						alert('This user is already selected to get a Temp pass');
						break;	
						
					}
				}
				if (userok == 1) {
					if (parseInt(availsupers) > 0) {
						formgood = 1;
						availsupers = (parseInt(availsupers) - 1);
						document.getElementById("availsupers").value = availsupers; 
						html = document.getElementById("superfans_div").innerHTML;
						
						if (currentsupers == '')
							currentsupers = uid;
						else 
							currentsupers +=','+uid;
						document.getElementById("superinvites").value = currentsupers;
						document.getElementById("superfannum").innerHTML = availsupers;	
						var divtarget = 'superfans_div';
					} else {
						alert ('Sorry you don\'t have any more SuperFan passes available until next month or Next Level');	
					}
				}
		}
		
	   if (formgood == 1) {
		    html += newpass;
			document.getElementById(divtarget).innerHTML = html;
			document.getElementById("savealert").style.display = 'block';
			document.getElementById("submit_button").style.display = '';
			
			
	   }
		
		
}
function remove_user(uid, type, element) {
	document.getElementById(element).style.display='none';
	var availsupers = document.getElementById("availsupers").value; 
	var availtemps = document.getElementById("availtemps").value; 
	var currenttemps = document.getElementById("tempinvites").value;
	var currentsupers = document.getElementById("superinvites").value;
	var currentsupersArray = currentsupers.split(',');
	var currenttempsArray = currenttemps.split(',');
	var currentsupers_temp;
	var currenttemps_temp;
	if (type == 'temp') {
			availtemps = (parseInt(availtemps) + 1);
			var arLen=currenttempsArray.length;
			for ( var i=0, len=arLen; i<len; ++i ){
				if (uid != currenttempsArray[i]) {
					if (currenttemps_temp == '')
						currenttemps_temp = currenttempsArray[i];
					else 
						currenttemps_temp +=','+currenttempsArray[i];
				}
					
			}
			document.getElementById("tempinvites").value = currenttemps_temp;
			document.getElementById("tempfannum").innerHTML = availtemps;	
			document.getElementById("availtemps").value = availtemps;	
				
	} else if (type == 'super') {
			availsupers = (parseInt(availsupers) + 1);
			var arLen=currentsupersArray.length;
			for ( var i=0, len=arLen; i<len; ++i ){
				if (uid != currentsupersArray[i]) {
					if (currentsupers_temp == '')
						currentsupers_temp = currentsupersArray[i];
					else 
						currentsupers_temp +=','+currentsupersArray[i];
				}
					
			}
			document.getElementById("superinvites").value = currenttemps_temp;
			document.getElementById("superfannum").innerHTML = availsupers;	
			document.getElementById("availsupers").value = availsupers;	
	}

}


</script>
<style type="text/css">
body,html {
margin:0px;
padding:0px;

}

</style>
  <LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>

<div class="spacer"></div>
             <div align="center">           
<? if ($CloseWindow == 1) {?>
<script type="text/javascript">
parent.window.location = '/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=tools';
</script>
 
<? } else {?>

<form name="modform" id="modform" method="post" action="#">
              
   <div>
                                          
<div style="height:10px;"></div>
<div class="sender_name">SUPER FAN INVITES</div> 
<center><div id="savealert" style="color:#ff0000;display:none; font-size:10px;">Click DONE to send passes to your selected fans<div style="height:10px;"></div></div><img src="http://www.wevolt.com/images/wizard_done_btn.png" onclick="submit_form();" class="navbuttons" id="submit_button" style="display:none;"/>     <img src="http://www.wevolt.com/images/wizard_cancel_btn.png" onclick="parent.window.location.href='/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=tools';" class="navbuttons"/><div style="height:5px;"></div></center>
<table><tr><td valign="top"> 
                                        
                                    
                                        <table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="284" align="center">
                                       

   <div class="messageinfo_warning" align="left">
SuperFan Passes Avail: <span id="superfannum"><? echo $SuperFanInvites;?></span><br />
<span class="messageinfo_white" style="font-size:10px;">SuperFan passes give your loyal readers a free pro experience while reading your project, for life. </span><br />
<div class="spacer"></div>
Temporary Pro Passes:  <span id="tempfannum"><? echo $TempSuperFanInvites;?></span><br />
<span class="messageinfo_white" style="font-size:10px;">Temporary passes allow you to hand out monthly pro subscriptions to new readers to give them an ad free experience while reading your project. </span>
</div>
<div class="spacer"></div>All passes refresh each month. Temporary passes do not accumulate, so use them each month. <div class="spacer"></div>
<div class="messageinfo_warning">Type an email or username below:</div>
<table cellpadding="0" cellspacing="0" border="0" width="98%">
<tr>
<td><input type="text" style="width:98%;" id="txtSearch" name="txtSearch" value="username or email" onFocus="doClear(this);" onBlur="setDefault(this);" onkeyup="checkIt(this.value);">
<div style="display:none;">
<div style="height:3px;"></div>
<select name="txtContent" id="txtContent" style="font-size:10px;">
<option  value="wevolt_users"> WEvolt users</option>
<option  value="email"> Search for email</option>
</select>
<div style="height:3px;"></div>
</div>

</td>
</tr>
</table>

<div id="search_container" style="display:none;"><div class="messageinfo_yellow"><strong>SEARCH RESULTS</strong></div><div style="height:3px;"></div>
<div id="search_results" style="height:220px; overflow:auto;width:98%;"></div></div>
</div>


  </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>

                        
                                        
                                        </td>
                                        <td></td>
                                        <td valign="top">
                                     
                                          <table width="330" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="314" align="center">
                                        
                                        <div class="messageinfo_warning">Super Fans</div>
                                        <div id="superfans_div" style="height:200px; width:300px; overflow:auto;">
                                        
                                        <? echo $SuperFans;?>
                                        </div>
                                        <div class="spacer"></div>
                                        
                                        <div class="messageinfo_warning">Temporary Passes</div>
                                        <div id="tempfans_div" style="height:200px; width:300px; overflow:auto;">
                                        <? echo $TempFans;?>
                                        </div>
                                        </td><td class="wizardboxcontent"></td>
                
                                        </tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
                                        <td id="wizardBox_BR"></td>
                                        </tr></tbody></table>
                                                        
                                        
                                        </td>
                                      </tr></table>

<input type="hidden" name="delete" value="0" />
<input type="hidden" name="save" value="1" />
<input type="hidden" name="superinvites" id="superinvites" value="" />
<input type="hidden" name="tempinvites" id="tempinvites" value="" />
<input type="hidden" name="availsupers" id="availsupers" value="<? echo $SuperFanInvites;?>" />
<input type="hidden" name="availtemps" id="availtemps" value="<? echo $TempSuperFanInvites;?>" />
<input type="hidden" name="currentsupers" id="currentsupers" value="<? echo $CurrentSuperFans;?>" />
<input type="hidden" name="currenttemps" id="currenttemps" value="<? echo $CurrentTempSuperFans;?>" />
</div>

</form>

<? }?>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('*[tooltip]').each(function() {
		var position = $(this).attr('tooltip_position');
		switch (position) {
			case 'right':
				tip = 'leftMiddle';
				target = 'rightMiddle';
				break;
			case 'left':
				tip = 'rightMiddle';
				target = 'leftMiddle';
				break;
			case 'top':
				tip = 'bottomMiddle';
				target = 'topMiddle';
				break;
			case 'bottom':
				tip = 'topMiddle';
				target = 'bottomMiddle';
				break;
			case 'topleft':
				tip = 'bottomRight';
				target = 'topLeft';
				break;
			case 'bottomleft':
				tip = 'topRight';
				target = 'bottomLeft';
				break;
			case 'bottomright':
				tip = 'topLeft';
				target = 'bottomRight';
				break;
			case 'topright':
			default:
				tip = 'bottomLeft';
				target = 'topRight';
		}
		$(this).qtip({
			content: $(this).attr('tooltip'),
			style: {
				name: 'blue',
				tip: tip,
				border: {
			width: 1,
	         radius: 2,
	         color: '#3a3a3a'
				}
			},
			position: {
		       corner: {
			   	   target: target,
			   	   tooltip: tip,
			   	   adjust: {
					  screen: true
			   	   }
	  	 	   }
			} 
		});
	});
});
</script> 

</script>
</body>
</html>