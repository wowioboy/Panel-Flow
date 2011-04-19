<table cellpadding="0" cellspacing="0" border="0" width="<? echo $Width;?>">
<tr>
<td>

<div id='ControlBar'>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td>
<div class='pagelinks'>

<span id='HomeButton'><a href='index.php'><? if ($HomeButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $HomeButtonImage;?>' id='HomeButtonImage' alt='Home' <? if ($HomeButtonImageRollover != '') {?>onMouseOver="swapimage('HomeButtonImage','<? echo $HomeButtonImageRollover;?>')" onMouseOut="swapimage('HomeButtonImage','<? echo $HomeButtonImage;?>')" <? }?>/><? } else {?>Home<? } ?></a>&nbsp;|&nbsp;</span>

<span id='CreatorButton'><a href='about.php'><? if ($CreatorButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $CreatorButtonImage;?>' id='CreatorButtonImage' alt='Creator' <? if ($CreatorButtonImageRollover != '') {?>onMouseOver="swapimage('CreatorButtonImage','<? echo $CreatorButtonImageRollover;?>')" onMouseOut="swapimage('CreatorButtonImage','<? echo $CreatorButtonImage;?>')" <? }?>/><? } else {?>Creator<? } ?></a>&nbsp;|&nbsp;</span>

<? if ($Characters == 1) {?>
<span id='CharactersButton'><a href='characters.php'><? if ($CharactersButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $CharactersButtonImage;?>' id='CharactersButtonImage' alt='Characters' <? if ($CharactersButtonImageRollover != '') {?>onMouseOver="swapimage('CharactersButtonImage','<? echo $CharactersButtonImageRollover;?>')" onMouseOut="swapimage('CharactersButtonImage','<? echo $CharactersButtonImage;?>')" <? }?>/><? } else {?>Characters<? } ?></a>&nbsp;|&nbsp;</span>
<? } ?>

<? if ($Downloads == 1) {?>
<span id='DownloadsButton'><a href='downloads.php'><? if ($DownloadsButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $DownloadsButtonImage;?>' id='DownloadsButtonImage' alt='Downloads' <? if ($DownloadsButtonImageRollover != '') {?>onMouseOver="swapimage('DownloadsButtonImage','<? echo $DownloadsButtonImageRollover;?>')" onMouseOut="swapimage('DownloadsButtonImage','<? echo $DownloadsButtonImage;?>')" <? }?>/><? } else {?>Downloads<? } ?></a>&nbsp;|&nbsp;</span>
<? } ?>

<? if ($Extras == 1) {?>
<span id='ExtrasButton'><a href='extras.php'><? if ($ExtrasButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $ExtrasButtonImage;?>' id='ExtrasButtonImage' alt='Extras' <? if ($ExtrasButtonImageRollover != '') {?>onMouseOver="swapimage('ExtrasButtonImage','<? echo $ExtrasButtonImageRollover;?>')" onMouseOut="swapimage('ExtrasButtonImage','<? echo $ExtrasButtonImage;?>')" <? }?>/><? } else {?>Extras<? } ?></a>&nbsp;|&nbsp;</span>
<? } ?>

<? if (($loggedin == 1) ||($loggedin == 2)) {?>
<span id='LogoutButton' class='GlobalButton'><a href='/<? echo $PFDIRECTORY;?>/logout.php'><? if ($LogoutButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $LogoutButtonImage;?>' id='LogoutButtonImage' alt='Logout' <? if ($LogoutButtonImageRollover != '') {?>onMouseOver="swapimage('LogoutButtonImage','<? echo $LogoutButtonImageRollover;?>')" onMouseOut="swapimage('LogoutButtonImage','<? echo $LogoutButtonImage;?>')" <? }?>/><? } else {?>Logout<? } ?></a>&nbsp;|&nbsp;</span>
<? } else { ?>
<span id='LoginButton' class='GlobalButton'><a href='/<? echo $PFDIRECTORY;?>/login.php'><? if ($LoginButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $LoginButtonImage;?>' id='LoginButtonImage' alt='Login' <? if ($LoginButtonImageRollover != '') {?>onMouseOver="swapimage('LoginButtonImage','<? echo $LoginButtonImageRollover;?>')" onMouseOut="swapimage('LoginButtonImage','<? echo $LoginButtonImage;?>')" <? }?>/><? } else {?>Login<? } ?></a>&nbsp;|&nbsp;</span>
<? }?>		
</div>
</td>

<td align="right">
<div class='pagelinks'>
<? if ($CurrentIndex != 0) {?>

<span id='FirstButton'>
<a href='index.php?id=<? echo $firstpage;?>' ><? if ($FirstButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $FirstButtonImage;?>' id='FirstButtonImage' alt='First Page' <? if ($FirstButtonImageRollover != '') {?>onMouseOver="swapimage('FirstButtonImage','<? echo $FirstButtonImageRollover;?>')" onMouseOut="swapimage('FirstButtonImage','<? echo $FirstButtonImage;?>')" <? }?>/><? } else {?>First Page<? } ?></a>&nbsp;|&nbsp;
</span>

<span id='PreviousButton'>
<a href='index.php?id=<? echo $PrevPage;?>'><? if ($PreviousButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $PreviousButtonImage;?>' id='PreviousButtonImage' alt='Previous Page' <? if ($PreviousButtonImageRollover != '') {?>onMouseOver="swapimage('PreviousButtonImage','<? echo $PreviousButtonImageRollover;?>')" onMouseOut="swapimage('PreviousButtonImage','<? echo $PreviousButtonImage;?>')" <? }?>/><? } else {?>Previous Page<? } ?></a>&nbsp;&nbsp;
</span>

<? } ?>

<? if ($CurrentIndex != ($TotalPages-1)) {?>
<span id='NextButton'>
<a href='index.php?id=<? echo $NextPage;?>'><? if ($NextButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $NextButtonImage;?>' id='NextButtonImage' alt='Next Page' <? if ($NextButtonImageRollover != '') {?>onMouseOver="swapimage('NextButtonImage','<? echo $NextButtonImageRollover;?>')" onMouseOut="swapimage('NextButtonImage','<? echo $NextButtonImage;?>')" <? }?>/><? } else {?>Next Page<? } ?></a>&nbsp;|&nbsp;
</span>

<span id='LastButton'>
<a href='index.php?id=<? echo $lastpage;?>'><? if ($LastButtonImage != '') {?><img src='/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $Skin;?>/images/<? echo $LastButtonImage;?>' id='LastButtonImage' alt='Last Page' <? if ($LastButtonImageRollover != '') {?>onMouseOver="swapimage('LastButtonImage','<? echo $LastButtonImageRollover;?>')" onMouseOut="swapimage('LastButtonImage','<? echo $LastButtonImage;?>')" <? }?>/><? } else {?>Last Page<? } ?></a>
</span>
<? }?>
</div>
</td>
</tr>
</table>
</div>
</td></tr></table>