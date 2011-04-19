<?php 
	// Comic Header
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_header.php';?>
<div class="spacer"></div>	
<div class="contentwrapper" align="center">
<div id="topbar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/topcharcontrols_db.swf','top','820','40','<?php echo '#'.$BGcolor;?>','9');                  so.addParam('allowfullscreen','true'); 
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
				  so.addVariable('pathtopf','<?php echo $PFDIRECTORY;?>');
				    so.addVariable('baseurl','<?php echo $ComicFolder;?>');
					so.addVariable('section','<?php echo $Pagetracking;?>');
                  so.write('topbar'); 
</script>
			<div class="spacer"></div>	
<div class="contentwrapper" align="center">

<table width="500" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop" ></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" valign="top">	
	<div class="episodetitle">EPISODES</div>
	<div class="spacer"></div>
<?php 

//PAGE DISPLAY
echo $episodeString; 
?>
	
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
</div>			
</div>
