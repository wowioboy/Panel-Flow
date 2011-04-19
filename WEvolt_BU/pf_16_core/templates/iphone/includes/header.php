
<?
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/site.php');
$Site = new site();
?>
<? $MainImage = '/'.$ProjectDirectory.'/'.$ComicFolder.'/images/pages/'.$ContentSection->Image;?>
<meta name="description" content="<?php if ($IsProject) echo $Synopsis; ?><? echo $Site->getGlobalDescription();?> "></meta>
<meta name="keywords" content="<?php if ($IsProject) { echo $Creator; echo ','; echo $Writer;  echo ','; echo $Artist;  echo ','; echo $Letterist;  echo ','; echo $Colorist;  echo ','; echo $Genre;  echo ','; echo $Tags;} ?>,<? echo $Site->getGlobalKeywords();?> "></meta>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><? echo $PageTitle;?> - <? echo $ComicTitle;?> - <? echo $ReaderPageTitle;?></title>


<? if ($IsProject) $Site->drawProjectScripts();?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="/<? echo $PFDIRECTORY;?>/templates/iphone/apple-touch-icon.png" rel="apple-touch-icon" />
<link href="/<? echo $PFDIRECTORY;?>/templates/iphone/style.css" rel="stylesheet" type="text/css" />
<meta name="description" content="<?php echo $Synopsis ?>"></meta>
<meta name="keywords" content="Panel Flow, Flash Webcomic Content Management System, <?php echo $Genre;?>, <?php echo $Tags;?>, <?php echo $Creator;?>, <?php echo $Writer;?>, <?php echo $Letterist;?>, <?php echo $Artist;?>, <?php echo $Colorist;?>"></meta>
<script src="/<? echo $PFDIRECTORY;?>/templates/iphone/effects.js" type="text/javascript"></script>
<script src="/<? echo $PFDIRECTORY;?>/templates/iphone/slide.js" type="text/javascript"></script>
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=2.6667, user-scalable=yes" name="viewport" />
	<script type="text/javascript">
window.onload = function initialLoad(){
		updateOrientation();
	}
	function updateOrientation(){
		var contentType = "show_";
		switch(window.orientation){
			case 0:
			contentType += "normal";
			PageImage.src = '<? echo $Smallbaseurl.$ContentSection->Image;?>';
			break;
			
			case -90:
			contentType += "right";
			PageImage.src = '<? echo $Largebaseurl.$ContentSection->Image;?>';
			break;
			
			case 90:
			contentType += "left";
			PageImage.src = '<? echo $Largebaseurl.$ContentSection->Image;?>';
			break;
			
			case 180:
			contentType += "flipped";
			PageImage.src = '<? echo $Smallbaseurl.$ContentSection->Image;?>';
			break;
		}
	document.getElementById("page_wrapper").setAttribute("class", contentType);
	}
	</script>
	<script type="text/javascript">
		window.addEventListener("load", function() { setTimeout(loaded, 100) }, false);
	
		function loaded() {
			document.getElementById("page_wrapper").style.visibility = "visible";
			window.scrollTo(0, 1); // pan to the bottom, hides the location bar
		}

  
	</script>
<title><?php echo $ComicTitle; ?> - <?php echo $ReaderPageTitle; ?></title>
</head>
<body onorientationchange="updateOrientation();" style="<? echo $BodyStyle;?>">
