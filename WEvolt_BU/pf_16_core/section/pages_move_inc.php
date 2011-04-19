<script type="text/javascript">
	
	function submitpage() {
	
			document.pageform.submit();

	}
</script>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?a=move" method="post" name="pageform" id="pageform">
<table cellpadding="0" cellspacing="0" border="0"><tr>
<td width="400" align="center" valign="top" style="padding:5px;">
SELECT WHICH PAGES YOU WANT TO MOVE<br /><? echo $PageSelect;?>
</td>

<td width="400" valign="top" style="padding-left:10px;">

SELECT WHICH EPISODE YOU WANT TO MOVE THE PAGES TO<br /><? echo $EpisodeSelect;?>

</td>


<input type="hidden" value="move" name="txtAction" />
</td></tr></table> <center>

<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?series=<? echo $_GET['series'];?>';" class="navbuttons" /><div style="height:5px;"></div></center><div class="spacer"></div> </form>
 