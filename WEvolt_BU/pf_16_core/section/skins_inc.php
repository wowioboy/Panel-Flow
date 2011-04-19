
<div id="pagelisting">
<div class="pagelinksright" align="right"><font color="#FFFFFF">SHOW # [<a href="/cms/edit/<? echo $SafeFolder;?>/?section=skins">20</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=design&section=skins&c=40">40</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=design&section=skins&c=60">60</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=design&section=skins&c=100">100</a>]&nbsp;&nbsp<b>Total Pages: </b><? echo $TotalSkins;?></font> &nbsp;&nbsp; <? echo $pagination->displayPaging();?></div>
<div class="spacer"></div>
<? 
if ($TotalSkins == 0)
	echo '<div class="warning" style="height:250px; padding-top:15px;">There are currently No Community Skins available</div>';
else 

	echo '<div class="warning">To change the look of your project, you can edit your Skin to customize nearly everything. Just select the Blue Box to edit the current skin for <font color="white">'.$Comictitle.'</font>. Or check out skins in the community, or even create your own.</div><div class="spacer"></div><div align="center">'.$UserSkinString."</div>";
	
	?>
<div  class="pagelinksright" align="right">Pages: <? echo $pagination->displayPaging();?></div>
</div>