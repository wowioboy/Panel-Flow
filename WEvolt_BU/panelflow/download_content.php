<? 
//ini_set('display_errors', 1);
//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
//error_reporting(E_ALL);
set_time_limit(0);
session_start();
ob_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
include_once(INCLUDES.'/db.class.php');
 
require_once(INCLUDES . '/class.mime.php');	
require_once(INCLUDES . '/download_content_functions.php');

$ContentID= $_GET['id'];
$Section = $_GET['s'];
$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
if ($Section == 'rumble') {
	   $query = "select p.title, p.thumb, p.cover, p.SafeFolder, re.preview_file, re.project_id from 
	   				rumble_entries as re 
					join projects as p on re.project_id=p.ProjectID
					where re.project_id='$ContentID'";
					
		$DownloadArray = $db->queryUniqueObject($query);	
	$Filename = $_SERVER['DOCUMENT_ROOT'].'/'.$DownloadArray->preview_file;
			$Filearray = explode('/',$DownloadArray->preview_file);
			$DlName = $Filearray[1];
		
	
	
} else {
$query="SELECT * from comic_downloads as d
		left join projects as c on c.ProjectID=d.ProjectID
	where d.EncryptID='$ContentID'";
	
	$DownloadArray = $db->queryUniqueObject($query);

	$DlType = $DownloadArray->DlType;
	$ComicDir = substr(trim($DownloadArray->SafeFolder), 0, 1); 
	$ComicFolder = $DownloadArray->SafeFolder; 
	$DLName = $ComicFolder;
	
	if ($DownloadArray->SiteDL == 1) {
		
		$ext = $Filearray[1];	
		$DlName = 'WV_'.$DownloadArray->Name.'.zip';
		$Filename = $_SERVER['DOCUMENT_ROOT'].'/site_downloads/'.str_replace(" ","_",$DownloadArray->Filename);
		
	} else {
		
			$Filename = $_SERVER['DOCUMENT_ROOT'].'/'.$DownloadArray->ProjectDirectory.'/'.$ComicDir.'/'.$ComicFolder.'/'. $DownloadArray->Image;
			$Filearray = explode('.',$DownloadArray->Image);
		
		$ext = $Filearray[1];	
		$DlName = 'WV_'.$ComicFolder.'_'.$DlType.'_'.$ContentID.'.'.$ext;	
	}
}
	
	//print 'FIE = ' . $Filename;
	
	$mime = new MIMETypes();
	$MineType = $mime->getMimeType($Filename);
	
	$file_path=$Filename;
	$Remote = $_SERVER['REMOTE_ADDR'];
	$UserID = $_SESSION['userid'];
	$query = "INSERT into download_log (IPAddress, UserID, ContentID) values ('$Remote', '$UserID', '$ContentID')";
	$db->execute($query);
	
	output_file($Filename, $DlName, $MineType);
	$db->close();
?>
