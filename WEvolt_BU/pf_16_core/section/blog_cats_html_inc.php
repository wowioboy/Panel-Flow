<div align="center">
<div class="navlinks" align="right"><b>Total Categories: </b><? echo $PostCount;?></font> &nbsp;&nbsp; <? echo $pagination->displayPaging();?></div>
<div class="spacer"></div>
<? if ($PostCount == 0)
	echo '<div class="messageinfo_black" style="padding-top:50px;">There are currently no blog categories for this project.</div><div class="spacer"></div><div class="spacer"></div><div class="spacer"></div><div align="center"><a href="/'.$_SESSION['pfdirectory'].'/section/blog_inc.php?a=new&sub=cat"><img src="/images/cms/create_btn.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $PostString;?>
</div>
