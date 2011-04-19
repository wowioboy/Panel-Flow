</div>	
<div class="legal" align="center">All Content &copy; <?php echo $Copyright ?></div>
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
if ($Section == 'Pages') {
$Count = 0;
foreach($AstArray as $HotSpot) {
$ASArray = explode(',',$HotSpot);
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

echo '<map name="hotmap">';
$Count=0;
foreach($MapArray as $HotSpot) {
echo '<area shape ="rect" coords ="'.$HotSpot.'" href="#" onmouseover="showToolTip(event,\''.addslashes($PopupCodeArray[$Count]).'\');return false;" onmouseout="hideToolTip();">';
$Count++;
}
echo '</map>';
	
 } ?>

<div id="bubble_tooltip" >
</div>

</body>
</html>
