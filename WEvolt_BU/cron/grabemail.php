<?
/**
 * Author:   Ernest Wojciuk
 * Web Site: www.imap.pl
 * Email:    ernest@moldo.pl
 * Comments: EMAIL TO DB:: EXAMPLE 1
 */ 
$path = "/var/www/httpdocs/cron/"; 
$file = dirname($path);
//echo 'MY FILE = ' . $file;
include_once($file."/classes/class.emailtodb_v0.9.php");
include_once($file."/classes/defineThis.php");
$cfg["db_host"] = PANELDBHOST;
$cfg["db_user"] = 'panel_email';
$cfg["db_pass"] = PANELDBPASS; 
$cfg["db_name"] = PANELDBUSER;
$randName = md5(rand() * time());
$mysql_pconnect = mysql_pconnect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
if(!$mysql_pconnect){echo "Connection Failed"; exit; }
$db = mysql_select_db($cfg["db_name"], $mysql_pconnect);
if(!$db){echo"DB Select Failed"; exit;}


$edb = new EMAIL_TO_DB($randName);
$edb->connect('imap.gmail.com', '/imap:993/ssl', 'pages@wevolt.com', 'tlov.10',$randName);
$edb->do_action();

?>