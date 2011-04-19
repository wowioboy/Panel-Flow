<? 
include_once( 'init.php');
$checkresult = file_get_contents ('https://www.panelflow.com/processing/liscense.php?action=check&key='.$key.'&userid='.$AdminUserID.'&domain='.$_SERVER['SERVER_NAME']);
if (trim($checkresult) == 'Verified') {
	$Key = 1;
} else {
	$Key = 0;
}
?>