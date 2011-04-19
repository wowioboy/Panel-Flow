
<script type="text/javascript">
function submit_comment() {
		
	document.commentform.submit();

}
</script>
<? 
//COMMENT BOX MODULE 
$CommentBoxString ='';
 $CommentBoxString ='<div id="commentbox">';
 
 
 if (((is_authed()) && ($PublicComments == 0)) || ($PublicComments == 1)) { 
	 $CommentBoxString .='<div class="modheader">Leave a Comment</div>';
     if ($Section == 'Extras') { 
     	$CommentBoxString .='<form method="POST" action="/'.$SafeFolder.'/extras/page/'.$PagePosition.'/" name="commentform" id="commentform">';
     }  else if ($Section == 'Blog') { 
     	$CommentBoxString .='<form method="POST" action="http://www.wevolt.com/'.$SafeFolder.'/blog/';
		if (isset($_GET['post']))
		$CommentBoxString .=$_GET['post'].'/';
		
		$CommentBoxString .='" name="commentform" id="commentform">';
     } else { 
    	 $CommentBoxString .=' <form method="POST" action="http://www.wevolt.com/'.$SafeFolder.'/reader/';
		 if ($_GET['episode'] != '')
		 	$CommentBoxString .='episode/'.$_GET['episode'].'/';
			
			$CommentBoxString .='page/'.$PagePosition.'/" name="commentform" id="commentform">';
     }
	
     $CommentBoxString .='<textarea rows="6" style="width:98%" name="txtFeedback" onFocus="doClear(this);toggle_arrows(\'off\');" id="txtComment">';
	 
	if ($_POST['txtFeedback']=='') {  
		$CommentBoxString .='enter a comment'; 
	} else { 
		 $CommentBoxString .=$_POST['txtFeedback'];
	}
	  

	  $CommentBoxString .='</textarea><div class="spacer"></div>';
	  
	  if (!is_authed()) 
	   $CommentBoxString .='NAME:<br/><input type="text" name="txtName" value="'.$_POST['txtName'].'"><div class="spacer"></div>';
	   
	    if (is_authed()) 
	  $CommentBoxString .='<div align="left">
             <table cellpadding="0" cellspacing="0" border="0"><tr><td><img src="/'.$PFDIRECTORY.'/captcha/CaptchaSecurityImages.php?width=100&height=40&characters=5" border=\'2\'/>'.
		'<label for="security_code"></label>'.
		'<br /></td><td style="padding-left:10px;"><input id="security_code" name="security_code" type="text" class="inputstyle" style="width:100px; background-color:#99FFFF; border:none;" onFocus="doClear(this)" value="enter code"/></td></tr></table></div>';
		 
	$CommentBoxString .='<input type="hidden" name="insert" id="insert" value="1">'.
	'<input type="hidden" name="userid" id="userid" value="'.$_SESSION['userid'].'"><input type="hidden" name="txtSection" id="txtSection" value="'.$Section.'">
	<input type="hidden" name="id" id="targetid" value="';
	if ($Section == 'Blog')
		$CommentBoxString .= $_GET['post'];
	else
		$CommentBoxString .= $PageID;
	
	
	$CommentBoxString .='">
	<input type="hidden" name="position" id="position" value="'.$PagePosition.'"><div class="spacer"></div>';
	
	if ($CommentError != '') {
	$CommentBoxString .="<font style='color:red'>".$CommentError."</font><div class='spacer'></div><script language=\"Javascript\">alert('There was an error submitting comment, please check your fields and try again');</script>";

	} 
	$CommentBoxString .='<div class="spacer"></div><span class="buttonlinks">';
	if ($Section != 'Blog') {	
	if ($CommentButtonImage != '') {
		$CommentBoxString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CommentButtonImage.'" id="CommentButtonImage" style="cursor:pointer;" alt="Submit" border="0" onclick="submit_comment();"';
 		if ($CommentButtonRolloverImage != '')
 			$CommentBoxString .= 'onMouseOver="swapimage(\'CommentButtonImage\',\''.$CommentButtonRolloverImage.'\')" onMouseOut="swapimage(\'CommentButtonImage\',\''.$CommentButtonImage.'\')"';
 		$CommentBoxString .= '/>';
		} else {
			$CommentBoxString .= '<a href="#" onclick="submit_comment();return false;">Submit Comment</a>'; 
		}
	} else {
 		if ($CommentButtonImage != '') {
			$CommentBoxString .= '<input type="image" src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CommentButtonImage.'" style="border:none;">';
		} else {
				$CommentBoxString .= '<input type="submit" value="SUBMIT COMMENT" style="border:none;">';
		}
 
 	}
		
	 $CommentBoxString .='</span></form><div class="spacer"></div>';

} else { 
	$CommentBoxString .='<div class="authornote" align="center">YOU NEED TO LOG IN TO LEAVE COMMENTS </div>';
 }
 
  $CommentBoxString .='</div>';
 
 ?>