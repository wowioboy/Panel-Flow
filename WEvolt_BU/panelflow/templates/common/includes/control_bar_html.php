<table cellpadding="0" cellspacing="0" border="0" width="<? echo $Width;?>">
<tr>
<td>

<div id='ControlBar'>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td>
<div class='pagelinks'>

<span id='HomeButton'><a href='index.php'><? if ($HomeButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $HomeButtonImage;?>' id='HomeButtonImage' alt='Home'/><? } else {?>Home<? } ?></a>&nbsp;|&nbsp;</span>

<span id='CreatorButton'><a href='about.php'><? if ($CreatorButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $CreatorButtonImage;?>' id='CreatorButtonImage' alt='Creator'/><? } else {?>Creator<? } ?></a>&nbsp;|&nbsp;</span>

<? if ($Characters == 1) {?>
<span id='CharactersButton'><a href='characters.php'><? if ($CharactersButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $CharactersButtonImage;?>' id='CharactersButtonImage' alt='Characters'/><? } else {?>Characters<? } ?></a>&nbsp;|&nbsp;</span>
<? } ?>

<? if ($Downloads == 1) {?>
<span id='DownloadsButton'><a href='downloads.php'><? if ($DownloadsButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $DownloadsButtonImage;?>' id='DownloadsButtonImage' alt='Downloads'/><? } else {?>Downloads<? } ?></a>&nbsp;|&nbsp;</span>
<? } ?>

<? if ($Extras == 1) {?>
<span id='ExtrasButton'><a href='extras.php'><? if ($ExtrasButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $ExtrasButtonImage;?>' id='ExtrasButtonImage' alt='Extras'/><? } else {?>Extras<? } ?></a>&nbsp;|&nbsp;</span>
<? } ?>

<? if (($loggedin == 1) ||($loggedin == 2)) {?>
<span id='LogoutButton' class='GlobalButton'><a href='/<? echo $PFDIRECTORY;?>/logout.php'><? if ($LogoutButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $LogoutButtonImage;?>' id='LogoutButtonImage' alt='Login'/><? } else {?>Logout<? } ?></a>&nbsp;|&nbsp;</span>
<? } else { ?>
<span id='LoginButton' class='GlobalButton'><a href='/<? echo $PFDIRECTORY;?>/login.php'><? if ($LoginButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $LoginButtonImage;?>' id='LoginButtonImage' alt='Login'/><? } else {?>Login<? } ?></a>&nbsp;|&nbsp;</span>
<? }?>		
</div>
</td>

<td align="right">
<div class='pagelinks'>
<? if ($CurrentIndex != 0) {?>

<span id='FirstButton'>
<a href='index.php?id=<? echo $firstpage;?>'><? if ($FirstButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $FirstButtonImage;?>' id='FirstButtonImage' alt='First Page'/><? } else {?>First Page<? } ?></a>&nbsp;|&nbsp;
</span>

<span id='PreviousButton'>
<a href='index.php?id=<? echo $PrevPage;?>'><? if ($PreviousButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $PreviousButtonImage;?>' id='PreviousButtonImage' alt='Previous Page'/><? } else {?>Previous Page<? } ?></a>&nbsp;&nbsp;
</span>

<? } ?>

<? if ($CurrentIndex != ($TotalPages-1)) {?>
<span id='NextButton'>
<a href='index.php?id=<? echo $NextPage;?>'><? if ($NextButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $NextButtonImage;?>' id='NextButtonImage' alt='Next Page'/><? } else {?>Next Page<? } ?></a>&nbsp;|&nbsp;
</span>

<span id='LastButton'>
<a href='index.php?id=<? echo $lastpage;?>'><? if ($LastButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $LastButtonImage;?>' id='LastButtonImage' alt='Last Page'/><? } else {?>Last Page<? } ?></a>
</span>
<? }?>
</div>
</td>
</tr>
</table>
</div>
</td></tr></table>