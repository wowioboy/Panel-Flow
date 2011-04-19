<? 
include_once ('includes/init.php');
if ($_POST['editaccount'] == 1){
 $d = new DB();
	$Notify = $_POST['notify'];
	$Comments = $_POST['profilecomments'];
	$ReaderStyle = $_POST['txtReaderStyle'];
	$FlashPages = $_POST['txtFlashPages'];
	$ToolTips = $_POST['tooltips'];
	
	$Welcome = $_POST['txtWelcome'];
	
	
	$query = "UPDATE users_settings SET NotifySystemUpdates='$Notify', CommentNotify='".$_POST['CommentNotify']."',ToolTips='$ToolTips',AllowComments='$Comments',ReaderStyle='$ReaderStyle', FlashPages='$FlashPages', ShowWelcome='$Welcome' WHERE UserID='".$_SESSION['userid']."'";
	$d->execute($query);
	

$d->close();
header("Location:http://users.wevolt.com/".$_SESSION['username']."/");
}
?>
 