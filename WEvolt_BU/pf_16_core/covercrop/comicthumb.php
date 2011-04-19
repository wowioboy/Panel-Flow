<?php include '../includes/init.php';
if (!is_authed()) {
header('Location: /'.$PFDIRECTORY.'/index.php'); 	
}?>
<? $SafeFolder = $_GET['comic'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/lib/prototype.js"></script>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/lib/scriptaculous.js"></script>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/lib/init_wait.js"></script>

<meta name="description" content="Flash Web Comic Content Management System"></meta>
<meta name="keywords" content="Webcomics, Comics, Flash"></meta>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PANEL FLOW - COMIC THUMB CREATOR</title>

<?php include 'header.php';?>
<?php 
include 'crop_cover_inc.php';
include 'footer.php';
?>

</body>
</html>
