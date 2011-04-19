
<table cellpadding="0" cellspacing="0" border="0" width="<? echo $Width;?>">
<tr>
<td>

<div id='ControlBar' align="center">

<table cellpadding="0" cellspacing="0" border="0">
<tr>
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