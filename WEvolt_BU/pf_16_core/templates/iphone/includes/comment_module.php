<?php if (is_authed()) { ?>
<script language="Javascript">
 <!--

 function doClear(theText) 
{
     if (theText.value == theText.defaultValue)
 {
         theText.value = ""
     }
 }
 </script>

	 <div class="authornote"><img src="images/radiobtn.jpg" />LEAVE A COMMENT</div>
     <? if ($Section == 'Extras') { ?>
     <form method="POST" action="/<? echo $SafeFolder;?>/iphone/extras/?id=<?php echo $PageID; ?>">
     <? } else { ?>
     <form method="POST" action="/<? echo $SafeFolder;?>/iphone/?id=<?php echo $PageID; ?>">
     <? }?>
	
    <textarea rows="6" style="width:98%" name="txtFeedback" onFocus="doClear(this)" id="txtComment"><? if ($_POST['txtFeedback']=='') { echo 'enter a comment'; } else { echo $_POST['txtFeedback']; }?></textarea><div class='spacer'></div><div align="left">
             <table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="/<? echo $PFDIRECTORY;?>/captcha/CaptchaSecurityImages.php?width=100&height=40&characters=5" border='2'/>
		<label for="security_code"></label>
		<br /></td><td style="padding-left:10px;"><input id="security_code" name="security_code" type="text" class='inputstyle' style='width:100px; background-color:#99FFFF; border:none;' onFocus="doClear(this)" value='enter code'/></td></tr></table>  </div> 
	<input type="hidden" name="insert" id="insert" value="1">
	<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['userid']; ?>">
	<input type="hidden" name="id" id="id" value="<?php echo $PageID; ?>"><div class="spacer"></div><? if ($CommentError != '') { echo "<font style='color:red'>".$CommentError."</font><div class='spacer'></div>"; ?><script language="Javascript">alert('There was an error submitting comment, please check your fields and try again');</script><?

	} ?>
	<input type="image" value="Submit Comment" src="../images/submit.jpg" style="border:none;" />&nbsp;&nbsp;<a href="logout.php"><img src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/logout_btn.jpg" border="0" /></a>
	</form>
	<div class="spacer"></div>
	
	
<?php } else { ?> 

<div class="authornote" align="center">YOU NEED TO LOG IN TO LEAVE COMMENTS </div>
<?php }?>