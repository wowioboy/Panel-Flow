<?
$SiteTemplateWidth = '981';
$TemplateWrapperWidth = '1058';
$RumbleRound = 'round_two';
$SiteVersion = 2;
include_once(CLASSES.'/site.php');
$Site = new site();
$_SESSION['refurl'] = curPageURL();
$_SESSION['returnlink'] = $_SESSION['refurl'];
$_SESSION['loginref'] = $_SESSION['refurl'];
$_SESSION['sharelink'] = '';
if (($_GET['sa'] =='') &&($_GET['a'] == '') &&($_POST['a'] == '')) {
	if (($_SESSION['userid'] != '') && ($TrackPage == 1))
		$User->add_string_entry($PageTitle, $TrackPage,$_SESSION['refurl'],$IsProject,$IsJob);
		
}

	 
$Site->drawHeader();


if (($MetaContentTitle == '') && ($IsProject)) {
	$MetaContentTitle = $ProjectTitle;
	$MetaDescription = stripslashes($Synopsis);
	$MetaContentType = $ProjectType;
	$SiteTitle = $ProjectTitle;
	$MetaContentType = 'article';
	if (($Section == 'Pages') || ($Section == 'Reader')) {
		$MetaThumb = 'http://www.wevolt.com/'.$CurrentPageThumb;
		//if ($InRumble == 1)
			//$MetaContentTitle .= ' - Rumble Page';
		$MetaContentTitle .= ' - '.$ReaderPageTitle;
	} else {
		$MetaThumb = 'http://www.wevolt.com'.$ProjectThumb;
		
	}
	
} else if (($MetaContentTitle == '') && ($IsJob)) { 
	$MetaContentTitle = $JobArray->title;	
	$SiteTitle = $MetaContentTitle;
	$MetaDescription = $JobArray->description;
	$MetaContentType = 'article';
	$MetaThumb = 'http://www.wevolt.com/images/we_fb_logo.jpg';	
	
} else if ($IsProfile) {
	$MetaContentTitle = $FeedOfTitle .'s page';
	$SiteTitle = $MetaContentTitle;
	$MetaDescription = $FeedOfTitle .'s page';
	$MetaContentType = 'author';
	$MetaThumb = $FeedThumb;	
	
}else if ($IsRumble) {
	$MetaContentTitle = 'The WEvolt Weekly Rumble';
	$SiteTitle = $MetaContentTitle;
	$MetaDescription = 'The best webcomics competition on the Web!';
	$MetaContentType = 'article';
	$MetaThumb = 'http://www.wevolt.com/images/rumble_title.jpg';	
	
} else {
	$MetaThumb = 'http://www.wevolt.com/images/we_fb_logo.jpg';	
}
?>	


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><? echo $PageTitle;?></title>
<meta property="og:title" content="<? echo stripslashes($MetaContentTitle);?>"/>
    <meta property="og:type" content="<? echo $MetaContentType;?>"/>
    <meta property="og:url" content="<? echo $_SESSION['refurl'];?>"/>
    <meta property="og:image" content="<? echo $MetaThumb;?>"/>
    <meta property="og:site_name" content="WEvolt"/>
    <meta property="fb:app_id" content="208229596906"/>
<meta property="fb:admins" content="660603449"/>
    <meta property="og:description"
          content="<? echo stripslashes($MetaDescription);?>"/>
<meta name="description" content="<?php if ($IsProject) echo stripslashes($Synopsis); ?><?php if ($IsJob) echo $JobArray->description; ?><? echo $Site->getGlobalDescription();?> "></meta>
<meta name="keywords" content="<?php if ($IsProject) { echo stripslashes($Creator); echo ','; echo stripslashes($Writer);  echo ','; echo stripslashes($Artist);  echo ','; echo stripslashes($Letterist);  echo ','; echo stripslashes($Colorist);  echo ','; echo stripslashes($Genre);  echo ','; echo stripslashes($Tags);} ?>,<? echo $Site->getGlobalKeywords();?> ">
 <!--CSS LIBRARIES-->
 <? $Site->drawCSS();?>

<!--[if lte IE 6]><link href="http://www.wevolt.com/css/modal-window-ie6.css" type="text/css" rel="stylesheet" /><![endif]-->

<script type="text/javascript">
 var returnlink = escape('<? echo $_SESSION['returnlink'];?>');
 var username = '<? if (trim($_SESSION['username']) == '') echo 'na'; else echo trim($_SESSION['username']);?>';
 var usermail = '<? if ($_SESSION['email'] == '') echo 'na'; else echo $_SESSION['email'];?>'; 
 var stringstart = <? if ($_SESSION['stringstart']  == '') echo '1'; else echo $_SESSION['stringstart'];?>;
 var stringx = <? if ($_SESSION['IsPro'] == 0) {?>300<? } else {?>70<? }?>;
 var stringy = <? if ($_SESSION['IsPro'] == 0) {?>127<? } else {?>79<? }?>;
 var showtips = <?  if ($_SESSION['tooltips'] == '') echo '1'; else echo $_SESSION['tooltips']; ?>;
 var homepage = <? if ($HomePage == 1) echo '1'; else echo '0';?>;
 var siteversion = <? echo $SiteVersion;?>;
</script>
<!--GLOBAL SCRIPTS -->
 <? $Site->drawGlobalScripts();?>

<!--Jquery Scripts -->
 <? $Site->drawJQueryScripts();?>
 
 <? if ($IsPageImport) {?>
	 <link rel="stylesheet" type="text/css" href="/common/common.css"/>
<link rel="stylesheet" type="text/css" href="/common/lists.css"/>


<script language="JavaScript" type="text/javascript" src="/source/org/tool-man/core.js"></script>
<script language="JavaScript" type="text/javascript" src="/source/org/tool-man/events.js"></script>
<script language="JavaScript" type="text/javascript" src="/source/org/tool-man/css.js"></script>
<script language="JavaScript" type="text/javascript" src="/source/org/tool-man/coordinates.js"></script>
<script language="JavaScript" type="text/javascript" src="/source/org/tool-man/drag.js"></script>
<script language="JavaScript" type="text/javascript" src="/source/org/tool-man/dragsort.js"></script>
<script language="JavaScript" type="text/javascript" src="/source/org/tool-man/cookies.js"></script>

<script language="JavaScript" type="text/javascript">
	var dragsort = ToolMan.dragsort()
	var junkdrawer = ToolMan.junkdrawer()

	window.onload = function() {
		junkdrawer.restoreListOrder("boxes")
		dragsort.makeListSortable(document.getElementById("boxes"),
				saveOrder)
	}
	function refreshboxes() {
		junkdrawer.restoreListOrder("boxes")
		dragsort.makeListSortable(document.getElementById("boxes"),
				saveOrder)
	}

	function verticalOnly(item) {
		item.toolManDragGroup.verticalOnly()
	}

	function speak(id, what) {
		var element = document.getElementById(id);
		element.innerHTML = 'Clicked ' + what;
	}

	function saveOrder(item) {
		var group = item.toolManDragGroup
		var list = group.element.parentNode
		var id = list.getAttribute("id")
		if (id == null) return
		group.register('dragend', function() {
			ToolMan.cookies().set("list-" + id, 
					junkdrawer.serializeList(list), 365)
		})
	}


</script>
<script type="text/javascript">
function clear_processing() {
	document.getElementById("processingdiv").style.display = 'none';
	document.getElementById("finishdiv").style.display = '';
}

function check_host() {
	 	var hosturl = document.getElementById("txtUrl").value;
		var found = 0;
		var drunkduck = hosturl.search(/drunkduck/);
		var smackjeeves = hosturl.search(/smackjeeves/);
		var comicspace = hosturl.search(/comicspace/);
		//alert('drunkduck = ' + drunkduck);
		//alert('smackjeeves = ' + smackjeeves);
		//alert('comicspace = ' + comicspace);
		if (drunkduck != -1) {
			document.PageForm.action='/comic/import/drunkduck/<? echo $_GET['id'];?>/';
			document.PageForm.submit();
		} else if (smackjeeves != -1) {
			document.PageForm.action='/comic/import/smackjeeves/<? echo $_GET['id'];?>/';
			document.PageForm.submit();
		} else if (comicspace != -1) {
			document.PageForm.action='/comic/import/comicspace/<? echo $_GET['id'];?>/';
			document.PageForm.submit();
		}
}
function clear_converting() {
	document.getElementById("converting").style.display = 'none';
}
function deleteimage(value) {
	if (confirm("Are you Sure you want to delete this Page?"))
		var Idnum = value.split("image");
		//alert(value);
		var CurrentIdString = document.getElementById("IdString").value;
		var CurrentImageString = document.getElementById("txtPages").value;
		var CurrentThumbString = document.getElementById("txtThumbs").value;
		var CurrentImages = CurrentImageString.split("||");
		var CurrentThumbs = CurrentThumbString.split(",");
		//alert( CurrentIdString);
		var CurrentIDs = CurrentIdString.split(",");
		
	//alert('current id string = ' + CurrentIdString);
	  // alert('CurrentImageString = ' + CurrentImageString);
		var NewIDString = '';
		var NewImageString = '';
		var NewThumbString = '';
		for (i=0;i<CurrentIDs.length;i++) {
	//	alert(CurrentIDs[i]);
		//alert(value);
			if (CurrentIDs[i] != value) {
				if (NewIDString == '') 
					NewIDString = CurrentIDs[i];
				else 
					NewIDString = NewIDString + ',' + CurrentIDs[i];
			} else {
				IDIndex = i;
			}
					
		}
	//alert(NewIDString);
		for (i=0;i<CurrentImages.length;i++) {
			if (IDIndex != i) {
				if (NewImageString == '') 
					NewImageString = CurrentImages[i];
				else 
					NewImageString = NewImageString + '||' + CurrentImages[i];
			}
					
		}
		
		for (i=0;i<CurrentThumbs.length;i++) {
			if (IDIndex != i) {
				if (NewThumbString == '') 
					NewThumbString = CurrentThumbs[i];
				else 
					NewThumbString = NewThumbString + ',' + CurrentThumbs[i];
			}
					
		}
		document.getElementById("IdString").value = NewIDString;
		document.getElementById("txtPages").value = NewImageString;
		document.getElementById("txtThumbs").value = NewThumbString;
		//alert(NewImageString);
		document.PageForm.action='/comic/import/<? echo $_GET['id'];?>/';
		document.PageForm.submit();
	}

</script>
	 
 <? }?>
 
<? if ($Home) {?>
<script type="text/javascript" language="javascript" src="http://www.wevolt.com/scripts/easySlider1.7.js"></script>
<? }?>

<? if ($IsProject) $Site->drawProjectScripts();?>
<? if ($Home) {
	if ($Takeover) {
	# SCOUTS HONOR
  	$BodyStyle = "background-image:url('/ads/vgm_wv_bg.jpg');background-repeat:no-repeat;background-position:top;center;background-color:#000000";
	} else {
  	$BodyStyle = 'background-image:url(http://www.wevolt.com/images/bg_new_2.jpg);background-repeat:no-repeat;background-position:top;center;background-attachment:fixed;background-color:#0077d5;';
	}
} else {
 if (($BodyStyle == '') || (($IsProject) && ((($_SESSION['overage'] == '') || (strtolower($_SESSION['overage']) == 'n')) && (($_SESSION['authage'] != 1) && ($Rating == 'a')))) || ($IsIndex))
	$BodyStyle = 'background-image:url(http://www.wevolt.com/images/bg_new_2.jpg);background-repeat:no-repeat;background-position:top;center;background-attachment:fixed;background-color:#0077d5;';
}
if (($Registration == 1) || ($NoBackground ==1))
	$BodyStyle = 'background-color:#0077d5;';
			
if  (((($_SESSION['readerstyle'] == 'flash') && ($_SESSION['currentreader'] == '')) || ($_SESSION['currentreader'] == 'flash')) && ($Section == 'Reader')) { 
		$BodyStyle ='background-color:#000000;'; 
}?>


 <!--[if IE]><style type="text/css">iframe {background: transparent;}</style><![endif]-->

<script  language="javascript">
function follow_content(contentid,type,elem) {
 
	attach_file('http://www.wevolt.com/connectors/follow_content.php?fid='+contentid+'&type='+type); 
	document.getElementById(elem).style.display = 'none';
	
}
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)))
{
<? if ($IsProject) {?>
	location.href='http://www.wevolt.com/<? echo $SafeFolder;?>/iphone/';
<? } else {?>
	location.href='http://www.wevolt.com/iphone/index.php';
<? }?>
}

</script> 
</head>
<?php flush();  ?>

<body style="<? echo $BodyStyle;?>" class="yui-skin-wevolt">

   