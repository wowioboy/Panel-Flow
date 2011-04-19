</div>	
<div class="legal" align="center">All Content <?php  if ($CopyRight == '') echo 'copywritten by its creator'; else echo '&copy'. $CopyRight; ?></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-4728151-9");
pageTracker._trackPageview();
} catch(err) {}</script>

<? 
//DRAW HOT SOPTS
if ($Section == 'Pages') {
	$Count = 0;
	if ($HotSpots == null)
		$HotSpots = array();
	foreach($HotSpots as $HotSpot) {
			if ($HotSpot['AsterickCoords'] != '') {
		   	$ASArray = explode(',',$HotSpot['AsterickCoords']);
			$ASTop =$ASArray[0];
			$ASLeft =  $ASArray[1];
	?>
	<script type="text/javascript">
		var at='<? echo $ASTop;?>';
		var al='<? echo $ASLeft;?>';
		create_spot(at,al,'<? echo $Count;?>');

	</script>
	<? 
		$Count++;
		}
	}
 
	echo '<map name="hotmap">';
	$Count=0;
	
	foreach($HotSpots as $HotSpot) {
	if ($HotSpot['AsterickCoords'] != '') {
		echo '<area shape ="rect" coords ="'.$HotSpot['MapCoords'].'" href="javascript:void(0)" ';

		//if (($BubbleArray['Open'] == 'mouseover') || ($BubbleArray['Open'] == ''))
 			//echo 'onmouseover="showToolTip(event,\''.addslashes($HotSpot['Content']).'\');';
		echo 'tooltip="'.$HotSpot['Content'].'"';
		//if ($BubbleOpen == 'click')
			// echo 'onclick="showToolTip(event,\''.addslashes($HotSpot['Content']).'\');'; 
 
 		//echo 'return false;"';
 
 		//if (($BubbleArray['Close'] == 'mouseout') || ($BubbleArray['Close'] == ''))
  			//echo 'onmouseout="hideToolTip();"';
  
 		echo ' style="cursor:help;">';
		$Count++;
		}
	}
	echo '</map>';?>
    <div id="bubble_tooltip">
    <div class="bubble_top"><span></span></div>
        <div class="bubble_middle"><span id="bubble_tooltip_content"></span><br/><center><? if ($BubbleArray['Close'] == 'click') {?><span class="pagelinks"><a href="#" onclick="hideToolTip();">CLOSE</a></span><? }?></center></div>
        <div class="bubble_bottom"></div>
    </div>	
<? } ?>


<? if ($Twittername != '') {?>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<? echo $Twittername;?>.json?callback=twitterCallback2&amp;count=5"></script>
<? }?>
<!-- Start Quantcast tag -->
<script type="text/javascript">
_qoptions={
qacct:"p-6fyMZKpQakqes"
};
</script>
<script type="text/javascript" src="http://edge.quantserve.com/quant.js"></script>
<noscript>
<img src="http://pixel.quantserve.com/pixel/p-6fyMZKpQakqes.gif" style="display: none;" border="0" height="1" width="1" alt="Quantcast"/>
</noscript>
<!-- End Quantcast tag -->
<input type="hidden" name="arrowsstate" id="arrowsstate" value=""/>
</body>
</html>
