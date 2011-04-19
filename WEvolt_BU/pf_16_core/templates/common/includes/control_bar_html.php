<table cellpadding="0" cellspacing="0" border="0" width="<? echo $Width;?>"><tr><td class='controlbar' align="left">
<div class='pagelinks'>
<a href='index.php'>Home</a>&nbsp;|&nbsp;<a href='creator.php'>Creator</a>
<? if ($Characters == 1) {?>
&nbsp;|&nbsp;<a href='characters.php'>Characters</a>
<? } ?>
<? if ($Downloads == 1) {?>
&nbsp;|&nbsp;<a href='downloads.php'>Downloads</a>
<? } ?>
<? if ($Extras == 1) {?>
&nbsp;|&nbsp;<a href='extras.php'>Extras</a>
<? } ?> 
 <? if (($loggedin == 1) ||($loggedin == 2)) {?>
 <? if (($Extras == 1) || ($Downloads == 1) ||  ($Characters == 1)) {?>
 		&nbsp;|&nbsp;
 <? } ?>
        <a href='logout.php'>Logout</a>
	<? } else { ?>
     <a href='login.php'>Login</a>
    <? }?>		
</div>
</td><td align="right" class='controlbar'>
<div class='pagelinks'>
<? if ($CurrentIndex != 0) {?>
<a href='index.php?id=<? echo $firstpage;?>'>First Page</a>&nbsp;|&nbsp;
<a href='index.php?id=<? echo $PrevPage;?>'>Previous Page</a>

<? } ?>

<? if (($CurrentIndex != ($TotalPages-1)) && ($CurrentIndex != 0)) {?>
&nbsp;|&nbsp;
<? }?>

<? if ($CurrentIndex != ($TotalPages-1)) {?>
<a href='index.php?id=<? echo $NextPage;?>'>Next Page</a>&nbsp;|&nbsp;<a href='index.php?id=<? echo $lastpage;?>'>Last Page</a><? }?>
</div>
</td>
</tr>
</table>