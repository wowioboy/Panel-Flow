<? 
////ACCOUNT SETTINGS
if ($IsOwner) {
		
		$query ="SELECT * from pf_subscriptions where UserID='".$_SESSION['userid']."' and Status='active'";	 
		$InitDB->query($query);
		
		while ($purchase = $InitDB->fetchNextObject()) {
			$TypeID= $purchase->TypeID;
			if ($purchase->SubscriptionType == 'hosted')
				$SubType = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=payments%40wowio%2ecom">[cancel]</a>&nbsp;&nbsp;Pro Account - $5/month';
			else if ($purchase->SubscriptionType == 'store')
				$SubType = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=payments%40wowio%2ecom">[cancel]</a>&nbsp;&nbsp;Store Component - $2/month';
			$purchaseString .='<div>'.$SubType.'</div>';
			
		}
		
		$query = "SELECT * from purchases where UserID='".$_SESSION['userid']."' and Completed = 0";	 
		$InitDB->query($query);
		while ($purchase = $InitDB->fetchNextObject()) { 
			$unfinishedpurchaseString .='<div>Purchase Type: '.$purchase->Type.' | Started Date = '.$purchase->Start.'</div>';
		}
		
		
		$query = "SELECT * from pf_subscription_types where ID='$TypeID'";
		$SubArray = $InitDB->queryUniqueObject($query);
		$SubscriptionName = $SubArray->Name;
		$SubDescription = $SubArray->Description;
		$SubPrice = $SubArray->Price;
		
		$query = "SELECT * from users_settings where UserID='".$_SESSION['userid']."'";
		$USettingsArray = $InitDB->queryUniqueObject($query);
		
		
?>


<form method="post" action="/save_settings.php" style="margin:0px; padding:0px;"><div class="spacer"></div>
<input type="image"  style="border:none;background:none;" src="http://www.wevolt.com/images/blue_save_box.png" /><div class="spacer"></div>
<table><tr><td valign="top">
<table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="334" align="left">
                                        

<div class="messageinfo_warning"><strong>WEvolt Site Settings</strong></div><div class="spacer"></div>
<input type="hidden" name="editaccount" value="1" style="border:none;"/><strong>Notify me of WEvolt updates</strong><br /><input type="radio" value="1" name="notify" style="border:none; background-color:#e5e5e5;" <? if ($USettingsArray->NotifySystemUpdates == 1) echo 'checked';?>/>&nbsp;&nbsp;YES&nbsp;&nbsp;<input type="radio" value="0" name="notify" style="border:none;background-color:#ffffff;" <? if ($USettingsArray->NotifySystemUpdates == 0) echo 'checked';?>/>&nbsp;&nbsp;NO



<div class="spacer"></div>
Comment Notification<br />

<select name="CommentNotify" id="CommentNotify"> 
<option value="both" <? if ($USettingsArray->CommentNotify == 'both') echo 'selected';?>>Both (Email and WEmail)</option>
<option value="email" <? if ($USettingsArray->CommentNotify == 'email') echo 'selected';?>>Email</option>
<option value="pfbox" <? if ($USettingsArray->CommentNotify == 'pfbox') echo 'selected';?>>WEmail</option>
<option value="none" <? if ($USettingsArray->CommentNotify == 'none') echo 'selected';?>>Don't Notify</option>
</select>

<div class="medspacer"></div><strong>Show Tooltips</strong><br />

<input type="radio" value="1" name="tooltips" style="border:none;background-color:#e5e5e5;"<? if ($USettingsArray->ToolTips == 1) echo 'checked';?>/>&nbsp;&nbsp;YES&nbsp;&nbsp;<input type="radio" value="0" name="tooltips" style="border:none;background-color:#ffffff;"<? if ($USettingsArray->ToolTips == 0) echo 'checked';?>/>&nbsp;&nbsp;NO
<div class='spacer'></div>

<div class="messageinfo_warning"><strong>Subscriptions / Purchases</strong></div><div class="spacer"></div>

<? if ($purchaseString != '') { ?>
<strong>Your Subscriptions</strong>:<br />
<? echo $purchaseString;}?><div class='spacer'></div>


<div class="messageinfo_warning"><strong>Reader Options</strong></div><div class="spacer"></div>
<strong>Preferred Reader</strong><br />
<input type="radio" name="txtReaderStyle" value="flash"  <? if (($USettingsArray->ReaderStyle == 'flash')||($USettingsArray->ReaderStyle == '')) echo 'checked';?>>&nbsp;&nbsp;Flash Reader&nbsp;&nbsp;<input type="radio" name="txtReaderStyle" value="html" <? if ($USettingsArray->ReaderStyle == 'html') echo 'checked';?>>&nbsp;&nbsp;HTML (standard)<br>
<br>
<strong>Flash Reader Options</strong><br>
<input type="radio" name="txtFlashPages" value="2" <? if (($USettingsArray->FlashPages == '2')||($USettingsArray->FlashPages == '')) echo 'checked';?>>&nbsp;&nbsp;Show two pages at a time&nbsp;&nbsp;<input type="radio" name="txtFlashPages" value="1"  <? if ($USettingsArray->FlashPages == '1') echo 'checked';?>>&nbsp;&nbsp;One Page
<div class="spacer"></div>

<div class="messageinfo_warning"><strong>Login Options</strong></div><div class="spacer"></div>
<strong>Welcome Screen&nbsp;&nbsp;</strong><br />
<input type="radio" name="txtWelcome" value="1"  <? if (($USettingsArray->ShowWelcome == '')||($USettingsArray->ShowWelcome == '1')) echo 'checked';?>>&nbsp;&nbsp;Show Welcome Screen on login<br />
<input type="radio" name="txtWelcome" value="0" <? if ($USettingsArray->ShowWelcome == '0') echo 'checked';?>>&nbsp;&nbsp;Turn off Welcome (takes you to myvolt on login)<br>
<br />
<div class="messageinfo_warning"><strong>My Account</strong></div><div class="spacer"></div>
<strong>Change Password&nbsp;&nbsp;</strong><br />
<iframe src="http://www.wevolt.com/connectors/change_pass.php" style="width:300px;height:150px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>

</td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>
                        </td><td valign="top" width="10"></td><td valign="top">
     <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="334" align="left">  
                            <div class="messageinfo_warning"><strong>Avatar</strong></div><div class="spacer"></div><em>Image will be resized to 100x100</em>
                             <iframe src="http://www.wevolt.com/connectors/change_avatar.php" allowtransparency="true" frameborder="0" scrolling="no" height="60px;"></iframe>
                             <div class="spacer"></div>
                        
                             <div class="messageinfo_warning"><strong>SuperFan Subscriptions</strong></div><div class="spacer"></div>
      <?                        
	$query = "SELECT ProjectID from projects where userid='".$_SESSION['userid']."' or CreatorID='".$_SESSION['userid']."'";
	$InitDB->query($query);
	$ProjectList = array();
	while ($project = $InitDB->fetchNextObject()) { 
		$ProjectList[] = $project->ProjectID;	
	}
	$LastProject='';
	foreach ($ProjectList as $project) {
			$query = "SELECT s.user_id, u.username,p.title, (SELECT count(*) from subscription_shares as ss where s.user_id=ss.user_id) as TotalShares
				  from subscription_shares as s
				  join users as u on s.user_id=u.encryptid
				  join projects as p on p.ProjectID=s.project_id
				  where s.project_id='$project' and s.status ='active'";
			$InitDB->query($query);
			
			while ($subshare = $InitDB->fetchNextObject()) {
				
				if ($LastProject != $subshare->title) {
					echo '<div><b>'.$subshare->title.'</b></div>';
					$LastProject = $subshare->title;
				}
				echo '<table>';
				
						echo '<tr>';
						echo '<td width="200">'.$subshare->username.'</td>';
						echo '<td>Share: ';
						if ($subshare->TotalShares == 1) {
							echo '$1.00';
							$Total = $Total + 1.00;
						} else if ($subshare->TotalShares == 2) {
							echo '$.50';
							$Total = $Total + .50;
						}
						echo '</td>';
						echo '</tr>'; 
				
				echo '</table>'; 
			}
	
	if ($Total != 0)
		echo '<b>Total</b>: $'. $Total;
	$Total = 0;
	
	}
					
?>
</td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>
                        </td></tr></table></form><? } else {?>
						<script type="text/javascript">
						window.location.href="/<? echo $FeedOfTitle;?>/";
						
						
						</script> 	
						<? }?>