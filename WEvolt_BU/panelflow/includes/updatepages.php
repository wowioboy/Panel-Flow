<?php

require_once("curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
 $post_data = array('userid' => $_GET['userid'], 'comicid' => $_GET['comicid'],'action' => 'action', 'pages'=>$_GET['pages']);
$result = $curl->send_post_data("https://www.panelflow.com/processing/updatecomic_post.php", $post_data);
 unset($post_data);
 
//$result = file_get_contents ('http://www.panelflow.com/processing/updatecomic.php?action=pages&userid='.urlencode($_GET['userid'])."&comicid=".urlencode($_GET['comicid'])."&pages=".$_GET['pages']);
?>