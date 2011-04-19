<?  
$ComicID = $_GET['comicid'];
$SeriesNum = $_GET['series'];
$PageSelect = $_GET['pageselect'];
if ($PageSelect == '')
	$PageSelect = 'last';

include_once($_SERVER['DOCUMENT_ROOT']."/includes/init.php"); 
$query = "SELECT * from projects as c 
			  JOIN comic_settings as cs on c.ProjectID=cs.ComicID 
			  JOIN project_skins as ts on cs.Skin=ts.SkinCode 
			  where c.SafeFolder ='$ComicID'";
$GetPageDB = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$GetPageDB->query($query);
while ($setting = $GetPageDB->fetchNextObject()) { 
	$BarColor = '0x'.$setting->ControlBarBGColor;
	$ComicID = $setting->ProjectID; 
	$TextColor= '0x'.$setting->ControlBarTextColor;
	$MovieColor= '0x'.$setting->GlobalSiteBGColor;
	$ButtonColor= '0x'.$setting->ReaderButtonBGColor;
	$ArrowColor= '0x'.$setting->ReaderAccentColor;
	$ComicTitle = $setting->title;
	$Creator = $setting->creator;
	$Writer = $setting->writer;
	$Thumb = $setting->thumb;
	$Artist = $setting->artist;
	$Colorist = $setting->colorist;
	$Letterist = $setting->letterist;
	$Synopsis = $setting->synopsis;
	$Tags = $setting->tags;
	$Genre = $setting->genre;
	$Copyright = $setting->Copyright;
	$HeaderImage = $setting->Header;
	$ComicFolder = $setting->url;
	$Hosted = 1;
	$HostedUrlArray = explode('/',$Thumb);
//	print 'THUMB = ' . $Thumb;
	//print 'HOSTED URL '.$HostedUrlArray[0];
	//$ComicFolderArray =  explode('/',$HostedUrlArray[0]);
	$HostedUrl = $HostedUrlArray[1].'/'.$HostedUrlArray[2].'/'.$HostedUrlArray[3];
} 
$story_array = array();
//	print $query;
$counter = 0;
$CurrentDate = date('Y-m-d 00:00:00');
if ($SeriesNum != '')
 $where = 'and SeriesNum='.$SeriesNum;
 
 if ($PageSelect == 'last') 
$query = "select * from comic_pages where ComicID = '$ComicID' and PageType='pages' and PublishDate<='$CurrentDate' $where order by SeriesNum DESC, EpisodeNum DESC, EpPosition DESC";
else
$query = "select * from comic_pages where ComicID = '$ComicID' and PageType='pages' and PublishDate<='$CurrentDate' $where order by SeriesNum ASC, EpisodeNum ASC, EpPosition ASC";

$LatestPageArray = $GetPageDB->queryUniqueObject($query);

$query = "select count(*) from comic_pages where ComicID = '$ComicID' and PageType='pages' and PublishDate<='$CurrentDate' $where order by SeriesNum DESC, EpisodeNum DESC, EpPosition DESC";
$TotalPages = $GetPageDB->queryUniqueValue($query);
$GetPageDB->close();

$LastPage = '';

if (($SeriesNum != 1) && ($SeriesNum != ''))
$LastPage ='series/'.$LatestPageArray->SeriesNum.'/';
$LastPage .= 'episode/'.$LatestPageArray->EpisodeNum.'/page/'.$LatestPageArray->EpPosition;

if (($SeriesNum != 1) && ($SeriesNum != ''))
$FirstPage ='series/'.$SeriesNum.'/';
$FirstPage .= 'episode/1/page/1';

echo "&pageimage=".$LatestPageArray->Image."&pagetitle=".$LatestPageArray->Title."&emailinfo=".$Email."&barcolor=".$BarColor."&textcolor=".$TextColor."&moviecolor=".$MovieColor."&arrowcolor=".$ArrowColor."&buttoncolor=".$ButtonColor."&totalpages=".$TotalPages."&firstpage=".$FirstPage."&lastpage=".$LastPage."&hosted=".$Hosted."&hostedurl=".$HostedUrl.'/';
?>

