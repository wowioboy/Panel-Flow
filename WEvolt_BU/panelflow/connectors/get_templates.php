<?php
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from templates order by Title DESC";
$settings->query($query);
$Count=0;
$TemplateString = '';
while ($template = $settings->fetchNextObject()) { 
	if ($Count ==0) {
		$TemplateString = $template->TemplateCode;
	} else {
		$TemplateString .= ','.$template->TemplateCode;
	}
	$Count++;
		
} 
echo $TemplateString;
?>