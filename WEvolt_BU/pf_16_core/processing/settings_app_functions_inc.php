<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/includes/email_functions.php');

if (!function_exists('randomPrefix')) {
		   function randomPrefix($length){
					$random= "";
		
					srand((double)microtime()*1000000);
		
					$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
					$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
					$data .= "0FGH45OP89";
		
					for($i = 0; $i < $length; $i++) {
						$random .= substr($data, (rand()%(strlen($data))), 1);
					}
		
					return $random;
		}
	
} 
if (($_POST['action'] == 'save') && ($_GET['sub'] == '')){

	$Contact = $_POST['txtContact'];
	$Comments = $_POST['txtComments'];
	$PublicComments = $_POST['txtPublicComments'];
	
	$Archive = $_POST['txtArchive'];
	$Transfer = $_POST['txtTransfer'];
	$Chapter = $_POST['txtChapter'];
	$Episode = $_POST['txtEpisode'];
	$Calendar = $_POST['txtCalendar'];
	$EmailPost = $_POST['txtEmailPost'];
	$EmailPostAsst = $_POST['txtEmailPostAsst'];
	
	
	$ShowSchedule = $_POST['txtShowSchedule'];
	if ($ShowSchedule == '')
		$ShowSchedule = 1;
	$AssOne = $_POST['txtAssOne'];
	$AssTwo = $_POST['txtAssTwo'];
	$AssThree = $_POST['txtAssThree'];
	
	$ReaderType = $_POST['txtReaderType'];
	
	$SettingsTable = 'comic_settings';
	$TargetTable = 'comics';
	$TargetName = 'ComicID';
	$DefaultPage = $_POST['txtDefaultPage'];

	$query = "SELECT PostCode from ".$SettingsTable." where ".$TargetName."='$TargetID'";
	$PostCode = $InitDB->queryUniqueValue($query);
	
	if (($PostCode == '') && ($EmailPost == 1)){
		$PostCode = randomPrefix(4); 
		SendPostCode($_SESSION['sessionproject'], $PostCode);
	}
	if (($PostCode == '') && ($EmailPost == 1)){
		$PostCode = randomPrefix(4); 
		SendPostCode($_SESSION['sessionproject'], $PostCode);
	}
	 $query = "UPDATE comic_settings SET Contact='$Contact', AllowComments='$Comments', ShowArchive='$Archive', ShowChapter='$Chapter', ShowEpisode='$Episode', ShowSchedule='$ShowSchedule',ShowCalendar='$Calendar', BioSetting = '$BioSetting', Assistant1='$AssOne', Assistant2='$AssTwo', Assistant3='$AssThree', ReaderType='$ReaderType', EmailPost='$EmailPost', EmailPostAsst='$EmailPostAsst', PostCode='$PostCode', AllowPublicComents='$PublicComments',PageDefault='$DefaultPage',wowio_link='".$_POST['wowio_link']."' where ComicID='".$_SESSION['sessionproject']."'";
	$InitDB->execute($query);

	
} else if (($_GET['a'] == 'edit') && ($_GET['sub'] == '')){ 
		$query ="SELECT * from comic_settings where ProjectID='".$_SESSION['sessionproject']."'";
		$SettingsArray = $InitDB->queryUniqueObject($query);
		
	
}else if (($_POST['action'] == 'save') && ($_GET['sub'] == 'info')){

	$Creator = mysql_real_escape_string($_POST['txtCreator']);
	$Writer = mysql_real_escape_string($_POST['txtWriter']);
	$Artist = mysql_real_escape_string($_POST['txtArtist']);
	$Colorist = mysql_real_escape_string($_POST['txtColorist']);
	$Inker = mysql_real_escape_string($_POST['txtInker']);
	$Letterist = mysql_real_escape_string($_POST['txtLetterist']);
	$Synopsis = mysql_real_escape_string($_POST['txtSynopsis']);
	$Tags = mysql_real_escape_string($_POST['txtTags']);
	$Copyright = mysql_real_escape_string($_POST['txtCopyright']);
	$superfan_pitch = mysql_real_escape_string($_POST['superfan_pitch']);
	$superfan_link = $_POST['superfan_link'];
	$CreatorOne = $_GET['txtCreator1'];
$CreatorTwo = $_GET['txtCreator2'];
$CreatorThree = $_GET['txtCreator3'];

	$Genres = "";
		for ($i=1; $i< 17; $i++){
	 		if (isset($_POST['g'.$i])){
 				if ($Genres != "" ) {
 					$Genres .=",";
				} 
			$Genres .= $_POST['g'.$i];
			}

		}
	
	$query = "UPDATE projects SET genre='$Genres', tags='$Tags', writer='$Writer',superfan_pitch='$superfan_pitch', superfan_link='$superfan_link', creator='$Creator',inker='$Inker', artist='$Artist', colorist='$Colorist', letterist='$Letterist', synopsis='$Synopsis'  WHERE ProjectID='".$_SESSION['sessionproject']."'";
	$InitDB->execute($query);
	
	$query = "UPDATE comic_settings set CreatorOne='$CreatorOne', CreatorTwo='$CreatorTwo',CreatorThree='$CreatorThree', Copyright='$Copyright' where ComicID='".$_SESSION['sessionproject']."'";
	$InitDB->execute($query);


	
	
}else if (($_GET['a'] == 'edit') && ($_GET['sub'] == 'info')){ 
		$query ="SELECT p.*,cs.* from projects as p
				join comic_settings as cs on p.ProjectID=cs.ComicID
				 where p.ProjectID='".$_SESSION['sessionproject']."'";
		$SettingArray = $InitDB->queryUniqueObject($query);
		
	
}

if (($_GET['a'] != 'edit') && ($_GET['a'] != '') || ($_POST['action'] != '')) 
	header("location:/".$_SESSION['pfdirectory']."/section/settings_inc.php");

?>
