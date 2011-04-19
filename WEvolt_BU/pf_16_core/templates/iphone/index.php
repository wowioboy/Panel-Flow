<? 
$SafeFolder = $_GET['comic'];
$ComicName = $_GET['comic'];
$IsProject = true;
$Section = 'Pages';
$ContentURL = 'reader';
$ReaderSection = 'iphone';

include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';

$Smallbaseurl = 'http://www.wevolt.com'.$ContentSection->BaseProjectDirectory.'iphone/images/pages/320/';
$Largebaseurl = 'http://www.wevolt.com'.$ContentSection->BaseProjectDirectory.'iphone/images/pages/480/';

?>
<script type="text/javascript" language="javascript">
function maintab()
	{		
			//Activate TR
	        document.getElementById("trcredits").style.display = 'none';
			//Change Style of Tab
			document.getElementById("creditstab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trmain").style.display = '';
			//Change Style of Tab
			document.getElementById("maintab").className ='ActiveStyle';
			//DeActivate TR
			document.getElementById("trcomments").style.display = 'none';
			//Change Style of Tab
			document.getElementById("commentstab").className ='NonActiveStyle';
			//DeActivate TR
			
	}
	function commentstab()
	{		
			//Activate TR
	        document.getElementById("trcredits").style.display = 'none';
			//Change Style of Tab
			document.getElementById("creditstab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trmain").style.display = 'none';
			//Change Style of Tab
			document.getElementById("maintab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trcomments").style.display = '';
			//Change Style of Tab
			document.getElementById("commentstab").className ='ActiveStyle';
			//DeActivate TR
			
	}
	function creditstab()
	{		
			//Activate TR
	        document.getElementById("trcredits").style.display = '';
			//Change Style of Tab
			document.getElementById("creditstab").className ='ActiveStyle';
			//DeActivate TR
			document.getElementById("trmain").style.display = 'none';
			//Change Style of Tab
			document.getElementById("maintab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trcomments").style.display = 'none';
			//Change Style of Tab
			document.getElementById("commentstab").className ='NonActiveStyle';
			//DeActivate TR
			
	}
</script>

<? 
$BodyStyle = $ProjectTemplate->getBodyStyle();
include 'includes/header.php';
$Site->drawModuleCSS();
// SET PROJECT STYLE
$ProjectTemplate->drawStyle();
?>

<div id="title" align="center" style="font-size:14px;"><b><? echo $ComicTitle;?></b></div>
</div>

  <div id="page_wrapper" align="center">
<div id="content">

		<? include 'index_content_normal.php';?>
  
</div>
</div>
<? include 'includes/footer.php';?>
