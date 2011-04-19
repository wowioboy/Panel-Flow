<div style="font-size:16px; color:#ffffff;" align="center">EDIT AD SPACE: POSITION <? echo $_GET['p'];?></div>
<div align="center">
<form action="/<? echo $PFDIRECTORY;?>/includes/write_ad.php" method="post">
<div>
<input type="submit" value="SAVE">&nbsp;&nbsp;<input type="button" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=ads'" value="CANCEL"><div class="spacer"></div>
<div style="font-size:12px; color:#ffffff;" align="center">
<b>AD SPACE STATUS</b> <input type="radio" value="1" name='txtPublished' <? if ($SpacePublished == 1) echo 'checked';?>> ON <input type="radio" value="0" name='txtPublished' <? if ($SpacePublished == 0) echo 'checked';?>> OFF 
</div>
</div>
<div class="spacer"></div>
<div style="font-size:16px; color:#FF6600;" align="center">PASTE YOUR AD CODE FROM PROJECT WONDERFUL OR OTHER AD SERVERS BELOW<br><br>

  YOU CAN ALSO PLACE STRAIGHT HTML CODE IN THIS BOX FOR CUSTOM ADS</div><div class="spacer"></div>
<textarea name="txtAdCode"  style="width:600px; height:400px;"><? echo $AdCode;?></textarea>
<input type="hidden" name="txtComic" value="<? echo $ComicID;?>">
<input type="hidden" name="txtStory" value="<? echo $StoryID;?>">
<input type="hidden" name="txtTemplate" value="<? echo $Template;?>">
<input type="hidden" name="txtPosition" value="<? echo $_GET['p'];?>">
<input type="hidden" name="txtSafeFolder" value="<? echo $SafeFolder;?>">

</form>
<div class="spacer"></div>
</div>