<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="apple-touch-icon.png" rel="apple-touch-icon" />
<link href="style.css" rel="stylesheet" type="text/css" />
<meta name="description" content="<?php echo $Synopsis ?>"></meta>
<meta name="keywords" content="Panel Flow, Flash Webcomic Content Management System, <?php echo $Genre;?>, <?php echo $Tags;?>, <?php echo $Creator;?>, <?php echo $Writer;?>, <?php echo $Letterist;?>, <?php echo $Artist;?>, <?php echo $Colorist;?>"></meta>
<script src="effects.js" type="text/javascript"></script>
<script src="slide.js" type="text/javascript"></script>
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
	<script type="text/javascript">
window.onload = function initialLoad(){
		updateOrientation();
	}
	function updateOrientation(){
		var contentType = "show_";
		switch(window.orientation){
			case 0:
			contentType += "normal";
			PageImage.src = '<? echo $Smallbaseurl.$Image;?>';
			break;
			
			case -90:
			contentType += "right";
			PageImage.src = '<? echo $Largebaseurl.$Image;?>';
			break;
			
			case 90:
			contentType += "left";
			PageImage.src = '<? echo $Largebaseurl.$Image;?>';
			break;
			
			case 180:
			contentType += "flipped";
			PageImage.src = '<? echo $Smallbaseurl.$Image;?>';
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
<title><?php echo $ComicTitle; ?> - <?php echo $Title; ?></title>
</head>
<body onorientationchange="updateOrientation();" bgcolor="<?php echo '#'.$BGcolor;?>">
<? $Text = substr($TextColor, 2, 6); ?>

