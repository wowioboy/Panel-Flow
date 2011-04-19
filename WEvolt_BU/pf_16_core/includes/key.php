<? 
include_once( 'init.php');
$checkresult = @file_get_contents ('https://www.panelflow.com/processing/liscense.php?action=check&key='.$key.'&userid='.$AdminUserID.'&domain='.$_SERVER['SERVER_NAME']);
if (trim($checkresult) == 'Verified') {
	$Key = 'Verified';
} else if (trim($checkresult) == 'Not Verified') {
	$Key = 'Not Verified';
} else {
	$Key = 'Verified';
}
echo '&keycheck='.trim($Key); 
?> 