<?php include '../includes/init.php';
$db = new DB($db_database,$db_host, $db_user, $db_pass);
	$SafeFolder = $_GET['comic'];
	$query = "SELECT comiccrypt from comics where SafeFolder ='$SafeFolder'";
	$ComicID = $db->queryUniqueValue($query);
$db->close();
	
if (!is_authed()) {
header('Location: /'.$PFDIRECTORY.'/index.php'); 	
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/prototype.js"></script>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/lib/scriptaculous.js"></script>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/lib/init_wait.js"></script>

<meta name="description" content="Flash Web Comic Content Management System"></meta>
<meta name="keywords" content="Webcomics, Comics, Flash"></meta>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PANEL FLOW - CREATOR AVATAR</title>
<?php include 'header.php';?>
<?php 
include 'crop_avatar_inc.php';
include 'footer.php';
?>

</body>
</html>
