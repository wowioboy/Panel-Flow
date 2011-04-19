<?
session_start();
if ($MenuID == "") 
$MenuID = $_GET['id'];
$ComicID = $_GET['comic'];
$Action = 'delete';
include '../../includes/db.class.php';
$DB = new DB();
//print 'USERID = ' . $_SESSION['userid'];
			$query = "DELETE from menu_links where EncryptID='$MenuID' and ComicID='$ComicID'";
			$DB->execute($query);
				
			$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
			$AppInstallID= $DB->queryUniqueValue($query);
			$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
			$SettingArray= $DB->queryUniqueObject($query);
			$query = "SELECT * from Applications where ID ='$AppInstallID'";
			$ApplicationArray = $DB->queryUniqueObject($query);
			$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$DB->query($query);
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 'm' => $MenuID, 'a'=>$_POST['action']);
			$updateresult = $curl->send_post_data($ApplicationLink."/connectors/update_menus.php", $post_data);
			unset($post_data);
		//	print 'MY RESULT = ' . $updateresult;
				
				$query = "select * from menu_links where ComicID='$ComicID' and MenuParent=1 ORDER BY Parent, Position ASC";

			$comicsDB->query($query);
            $NumLinks = $DB->numRows();
			$menuString = "<div class=\'pagetitleLarge\' style=\'border-bottom:solid 1px #FF9900; padding-right:10px;\'>Menu One</div>";
$menuString .= "<table width=\'100%\' cellpadding=\'0\' cellspacing=\'0\' border=\'0\'><tr><td class=\'tableheader\'>TITLE</td><td class=\'tableheader\'>URL</td><td class=\'tableheader\'>LINK TYPE</td><td class=\'tableheader\'>ACTIONS</td></tr><tr><td colspan=\'4\'>&nbsp;</td></tr>";

				while ($line = $DB->fetchNextObject()) { 
					$menuString .= "<tr><td class=\'listcell\'>".addslashes($line->Title)."</td><td class=\'listcell\'>".$line->Url;

				$menuString .= "</td><td class=\'listcell\'>".$line->LinkType."</td><td class=\'submenu_blue\'>[<a href=\'#\' onclick=\"menulink(\'edit\',\'".$line->EncryptID."\');\">EDIT</a>]&nbsp;&nbsp;[<a href=\'#\' onclick=\"menulink(\'delete\',\'".$line->EncryptID."\');\">DELETE</a>]</td></tr>";

	}

	

$menuString .= "</table><div class=\'spacer\'></div>";

$query = "select * from menu_links where ComicID='$ComicID' and MenuParent=2 ORDER BY Parent, Position ASC";

			$DB->query($query);
            $NumLinks .= $DB->numRows();
			$menuString .= "<div class=\'pagetitleLarge\' style=\'border-bottom:solid 1px #FF9900; padding-right:10px;\'>Menu Two</div>";
$menuString .= "<table width=\'100%\' cellpadding=\'0\' cellspacing=\'0\' border=\'0\'><tr><td class=\'tableheader\'>TITLE</td><td class=\'tableheader\'>URL</td><td class=\'tableheader\'>LINK TYPE</td><td class=\'tableheader\'>ACTIONS</td></tr><tr><td colspan=\'4\'>&nbsp;</td></tr>";

				while ($line = $DB->fetchNextObject()) { 
					$menuString .= "<tr><td class=\'listcell\'>".addslashes($line->Title)."</td><td class=\'listcell\'>".$line->Url;

				$menuString .= "</td><td class=\'listcell\'>".$line->LinkType."</td><td class=\'submenu_blue\'>[<a href=\'#\' onclick=\"menulink(\'edit\',\'".$line->EncryptID."\');\">EDIT</a>]&nbsp;&nbsp;[<a href=\'#\' onclick=\"menulink(\'delete\',\'".$line->EncryptID."\');\">DELETE</a>]</td></tr>";

	}

	

$menuString .= "</table>";
		$DB->close();	
		?>
            
            <script type="text/javascript">
			document.getElementById('menulist').innerHTML = '<? echo $menuString;?>';
			//parent.hideModal('scriptModal');
			</script>
            
     