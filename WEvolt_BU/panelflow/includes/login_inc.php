<?php if (!is_authed()) {?>
<table width="340" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td width="318" id="modtop"></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" valign="top" align="center">	

<div class="infotext">Use your email associated with your Panel Flow account to log in. Or Register for a FREE account. </div>			
   <div id="login">YOU NEED TO TURN ON JAVASCRIPT and have <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Flash Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('../flash/loginmod.swf','mpl','171','77','9');                  
	    so.addVariable('loggedin','<?php echo $loggedin;?>');
		so.addVariable('comicid','<?php echo $ComicID;?>');
		so.write("login");
</script>
</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td> 
	<td id="modbottomright"></td>
</tr>
</table>
<?php }?>