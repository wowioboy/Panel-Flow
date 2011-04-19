<div class='pagetitleLarge'><b>TITLE:</b><br />
<input type="text" name="txtTitle" value="<? echo stripslashes($Title);?>"  style="width:325px; border: 1px #666666 solid;"/>
<div class="spacer"></div><b>DESCRIPTION</b><br />
<textarea name="txtDescription" style="width:325px;height:100px; border: 1px #666666 solid;"><? echo stripslashes($Description);?></textarea>
<div class="spacer"></div>
<? if ($_GET['a'] != 'create') {?>
<input type="checkbox" name="txtPublished" value="1" <? if ($Published == 1) echo 'checked';?>/>
Published
<input type="checkbox" name="txtPostCommunity" value="1" <? if ($PostCommunity == 1) echo 'checked';?> onchange="alert_post();"/>
Post to Community<br />

<? }?>

</div> 