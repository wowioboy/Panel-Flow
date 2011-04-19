<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language=javascript>
<!--
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)))
{
location.href='iphone/index.php';
}
-->
</script> 
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/scripts/swfobject.js"></script>
<meta name="description" content="<?php echo $Synopsis ?>"></meta>
<meta name="keywords" content="Panel Flow, Flash Webcomic Content Management System, <?php echo $Genre;?>, <?php echo $Tags;?>, <?php echo $Creator;?>, <?php echo $Writer;?>, <?php echo $Letterist;?>, <?php echo $Artist;?>, <?php echo $Colorist;?>"></meta>
<LINK href="/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/css/pf_css.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $ComicTitle; ?> - <?php echo $Title; ?></title>
<style type="text/css">
<!--
#modrightside {
width: 11px;
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/right_side.jpg);
background-repeat:repeat-y;

}

#modleftside {
width: 11px;
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/left_side.jpg);
background-repeat:repeat-y;

}

#modtop {
height:13px;
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/mod_top.png);
background-repeat:repeat-x;
}

.boxcontent {
color:#000000;
background-color:#FFFFFF;
}

#modbottom {
height:13px;
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/mod_bottom.png);
background-repeat:repeat-x;

}

#modbottomleft{
width:11px;
height:13px; 
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/mod_bottom_left.png);
background-repeat:no-repeat;
}

#modtopleft{
width:11px;
height:13px; 
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/mod_top_left.png);
background-repeat:no-repeat;
}

#modtopright{
width:11px;
height:13px; 
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/mod_top_right.png);
background-repeat:no-repeat;
}

#modbottomright{
width:11px;
height:13px; 
background-image:url(/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/mod_bottom_right.png);
background-repeat:no-repeat;
}
-->
.controlbar{
padding:5px;
background-color:#<?php echo substr($BarColor, 2, 6);?>;
}

.pagelinks {
	color:#<?php echo substr($TextColor, 2, 6);?>;
}
.pagelinks a{
	color:#<?php echo substr($TextColor, 2, 6);?>;
}
.pagelinks a:link{
	color:#<?php echo substr($TextColor, 2, 6);?>;
}
.pagelinks a:visited{
	color:#<?php echo substr($TextColor, 2, 6);?>;
}
.pagelinks a:hover{
text-decoration:underline;
}
</style>

<? if ($ReaderType == 'java') {?>
<script language=javascript>
var TimeToFade = 1000.0;

function fade(eid)
{
  var element = document.getElementById(eid);
  if(element == null)
    return;
   
  if(element.FadeState == null)
  {
    if(element.style.opacity == null
        || element.style.opacity == ''
        || element.style.opacity == '1')
    {
      element.FadeState = 2;
    }
    else
    {
      element.FadeState = -2;
    }
  }
   
  if(element.FadeState == 1 || element.FadeState == -1)
  {
    element.FadeState = element.FadeState == 1 ? -1 : 1;
    element.FadeTimeLeft = TimeToFade - element.FadeTimeLeft;
  }
  else
  {
    element.FadeState = element.FadeState == 2 ? -1 : 1;
    element.FadeTimeLeft = TimeToFade;
    setTimeout("animateFade(" + new Date().getTime() + ",'" + eid + "')", 33);
  }  
}
function preloader() 
{
     var i = 0;
     imageObj = new Image();
     images = new Array();
     images[0]= '<? echo $FirstPageImage;?>';
     images[1]= '<? echo $NextPageImage;?>';
     images[2]= '<? echo $FirstPageImage;?>';
     images[3]= '<? echo $FirstPageImage;?>';
     // start preloading
     for(i=0; i<=3; i++) 
     {
          imageObj.src=images[i];
     }
} 


</script>

<? }?>

</head>
<? $Text = substr($TextColor, 2, 6); ?>
<body bgcolor="<?php echo '#'.$BGcolor;?>" style="color:#<? echo $Text; ?>;">