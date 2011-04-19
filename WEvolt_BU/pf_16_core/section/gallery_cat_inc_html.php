<div class="spacer"></div>
<div align="right" style="width:720px;"><table width="100%"><tr><td width="150" class="cms_links"><b>Total Categories: </b><? echo $TotalCats;?></td><td align="right" class="cms_links">&nbsp;&nbsp; <? echo $pagination->displayPaging();?></td></tr></table>
</div>
<div class="spacer"></div>
<? if ($TotalCats == 0)
	echo '<div class="warning" style="padding-top:50px;">There are currently no galleries for this project.</div><div class="spacer"></div><div align="center"><a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?a=new&sub=cat"><img src="/'.$_SESSION['pfdirectory'].'/images/create_new_category.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $CatString;?>
