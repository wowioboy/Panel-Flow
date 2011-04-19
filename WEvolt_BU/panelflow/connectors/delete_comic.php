<? 
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_GET['c'];
$UserID = $_GET['u'];
$AdminUserID = $config['adminuserid'];
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'";
$ComicArray = $settings->queryUniqueObject($query);
$ComicFolder = $ComicArray->url;
$CreatorID = $ComicArray->CreatorID;

if ($UserID = $AdminUserID) {
	$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/delete_comic.php", $post_data);
	unset($post_data);
	
	if ($updateresult = md5($_POST['k']) {
		$query = "UPDATE comics SET installed=0 WHERE comiccrypt='$ComicID'";
		$PageDB->query($query);
	}

$PageDB->close();

echo 'Finished';
} else {
echo 'Can\'t Complete Request';

} 
?>