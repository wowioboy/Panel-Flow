<? if ($ReaderType == 'flash') {?>


<div id="topbar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/topcontrols_db.swf','top','<?php echo $Width;?>','40','<?php echo '#'.$BGcolor;?>','9');                  so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
                  so.addVariable('usertype','<?php echo $_SESSION['usertype'];?>');
				  so.addVariable('backID','<?php echo $PrevPage;?>');
				  so.addVariable('nextID','<?php echo $NextPage;?>');
				   so.addVariable('comicid','<?php echo $ComicID;?>');
				  so.addVariable('currentindex','<?php echo $CurrentIndex;?>');
				  so.addVariable('totalpages','<?php echo  $TotalPages;?>');
			      so.addVariable('barcolor','<?php echo $BarColor;?>');
				  so.addVariable('textcolor','<?php echo $TextColor;?>');
				  so.addVariable('moviecolor','<?php echo $MovieColor;?>');
				  so.addVariable('buttoncolor','<?php echo $ButtonColor;?>');
				  so.addVariable('arrowcolor','<?php echo $ArrowColor;?>');
				  so.addVariable('loggedin','<?php echo $loggedin;?>');
				  so.addVariable('extras','<?php echo $Extras;?>');
				  so.addVariable('characters','<?php echo $Characters;?>');
				  so.addVariable('downloads','<?php echo $Downloads;?>');
				  so.addVariable('biosetting','<?php echo $ShowBio;?>');
				   so.addVariable('section','<?php echo $Pagetracking;?>');
				   so.addVariable('pathtopf','<?php echo $PFDIRECTORY;?>');
				    so.addVariable('baseurl','<?php echo $ComicFolder;?>');
					so.addVariable('pageid','<?php echo $_GET['id'];?>');
				
                  so.write('topbar'); 
</script>

<div id="reader">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>

<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/pf_reader_dbpro_v1-5.swf','pfreader','<?php echo $Width;?>','<?php echo $Height;?>','9');             so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
                  so.addVariable('id','<?php echo $PageID;?>');
				  so.addVariable('currentindex','<?php echo $CurrentIndex;?>');
				  so.addVariable('pageimage','<?php echo $Image;?>');
				  <? if ($Section == 'Extras') { ?>
				  so.addVariable('baseurl','<?php echo 'images/extras/';?>');
				  <? } else { ?> 
				  so.addVariable('baseurl','<?php echo 'images/pages/';?>');
				  <? } ?>
				  so.addVariable('pagetitle','<?php echo addslashes($Title);?>');
				  so.addVariable('totalpages','<?php echo  $TotalPages;?>');
				  so.addVariable('ControlXML','<?php echo  $ControlXML;?>');
				  so.addVariable('usertype','<?php echo $_SESSION['usertype'];?>');
				  so.addVariable('barcolor','<?php echo $BarColor;?>');
				  so.addVariable('textcolor','<?php echo $TextColor;?>');
				  so.addVariable('moviecolor','<?php echo $MovieColor;?>');
				  so.addVariable('currentday','<?php echo $CurrentDay;?>');
				  so.addVariable('currentmonth','<?php echo $CurrentMonth;?>');
				  so.addVariable('currentyear','<?php echo $CurrentYear;?>');
				  so.addVariable('section','<?php echo $Pagetracking;?>');
                  so.write('reader'); 
</script>

<div id="bottombar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/bottomcontrols_db.swf','bottom','<?php echo $Width;?>','40','<?php echo '#'.$BGcolor;?>','9');                  
					so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
                  so.addVariable('id','<?php echo $PageID;?>');
				  so.addVariable('currentindex','<?php echo $CurrentIndex;?>');
				   so.addVariable('pagetitle','<?php echo addslashes($Title);?>');
				  so.addVariable('totalpages','<?php echo  $TotalPages;?>');
				  so.addVariable('baseurl','<?php echo $ComicFolder;?>');
				  so.addVariable('barcolor','<?php echo $BarColor;?>');
				  so.addVariable('textcolor','<?php echo $TextColor;?>');
				  so.addVariable('moviecolor','<?php echo $MovieColor;?>');
				  so.addVariable('buttoncolor','<?php echo $ButtonColor;?>');
				    so.addVariable('arrowcolor','<?php echo $ArrowColor;?>');
					so.addVariable('currentday','<?php echo $CurrentDay;?>');
				  so.addVariable('currentmonth','<?php echo $CurrentMonth;?>');
				  so.addVariable('currentyear','<?php echo $CurrentYear;?>');
				  so.addVariable('ControlXML','<?php echo  $ControlXML;?>');
				  so.addVariable('section','<?php echo $Pagetracking;?>');
	
                  so.write('bottombar'); 
</script>

<? } else if  ($ReaderType == 'html') { 
	include 'control_bar_html.php';
?>
  <? if ($Section == 'Extras') { ?>
				  <img src="<?php echo 'images/extras/'.$Image;?>" />
				  <? } else { ?> 
				  <img src="<?php echo 'images/pages/'.$Image;?>" />
				  <? } ?>
<? include 'control_bar_html.php';

} else if  ($ReaderType == 'java') { 
include 'control_bar_java.php';?>
<div id="fadeBlock">
  <? if ($Section == 'Extras') { ?>
				  <img src="<?php echo 'images/extras/'.$Image;?>" id='pageimage'/>
				  <? } else { ?> 
				  <img src="<?php echo 'images/pages/'.$Image;?>" id='pageimage'/>
				  <? } ?>
</div>
<? include 'control_bar_java.php';

} ?>