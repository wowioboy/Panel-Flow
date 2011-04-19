<div align="center">
<div style="height:25px;"></div>
<div style="padding:15px; height:300px; padding-top:10px;" align="center" id='processingdiv'>
	<div class="pageheader" align="center" style="color:#FF9900;">
   Please wait while your new skin is installed and set on your Panel Flow application, depending on the number of images and size of the skin, this could take a couple minutes.
    </div> 
    
	<div class='spacer'></div>
	<div align="center">
		<img src="/<? echo $PFDIRECTORY;?>/images/processingbar.gif" />
		<div class="spacer"></div>
		<div style="font-size:14px; color:#FFFFFF;">
		<b>Number of Images Processed</b>: [<span id='imagesprocessed' style='color:#339900;'>0</span>]
		</div>
	</div>
</div>

<div id='debug' style="color:#FFFFFF;">
<? 

require_once("includes/curl_http_client.php");
require_once("includes/create_key_func.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$SkinCode = $_GET['skincode'];
$base_path = "templates/skins/".$SkinCode.'/images/';

$updateDB = new DB($db_database,$db_host, $db_user, $db_pass);

$query = "UPDATE comic_settings set Skin='$SkinCode' where ComicID='$ComicID'";
$updateDB->query($query);

$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
$AppInstallID= $updateDB->queryUniqueValue($query);

$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
$SettingArray= $updateDB->queryUniqueObject($query);

$query = "SELECT * from Applications where ID ='$AppInstallID'";
$ApplicationArray = $updateDB->queryUniqueObject($query);

$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
$ConnectKey = createKey();
$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
$updateDB->query($query);

$Result = file_get_contents($ApplicationLink.'connectors/update_skins.php?k='.$ConnectKey.'&u='.$_SESSION['userid'].'&c='.$ComicID.'&s='.$SkinCode.'&a=assign');
 //print 'MY DATA RESULT = ' . $Result.'<br/>';
$ConnectKey = createKey();
$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
$updateDB->query($query);
 //print '<b>MY KEY RESULT = ' . $ConnectKey.'</b><br/>';
$query = "SELECT * from template_skins where SkinCode='$SkinCode'";
$SkinArray = $updateDB->queryUniqueObject($query);
$BaseDirectory = '../templates/skins/'.$SkinCode.'/images/';
foreach ($SkinArray as $SkinRow) {

	$SkinFileName = @explode('.',$SkinRow);
		if (strlen($SkinFileName[1]) == 3) {
			$SkinType = $SkinFileName[0];
		
			$Result = file_get_contents($ApplicationLink.'connectors/update_skins.php?k='.$ConnectKey.'&u='.$_SESSION['userid'].'&c='.$ComicID.'&s='.$SkinCode.'&a=install&t='.$SkinType);
			//print 'MY IMAGE LINK = ' . $ApplicationLink.'connectors/update_skins.php?k='.$ConnectKey.'&u='.$_SESSION['userid'].'&c='.$ComicID.'&s='.$SkinCode.'&a=install&t='.$SkinType."<br/><br/>";
		// print 'MY IMAGE RESULT = ' . $Result.'<br/><br/><br/>';?>
		    <script type="text/javascript" language="javascript">
			  document.getElementById("imagesprocessed").innerHTML ='<? echo $Count;?>';
		    </script>
   		    <?
		    $Count++;
  		}
		ob_flush();
        flush();
}?>
</div>
<script type="text/javascript" language="javascript">
	window.location = '/cms/edit/<? echo $SafeFolder;?>/?section=skins';
</script>
</div>