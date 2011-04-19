
<div id="pagelisting" align="center">

<div class="pagelinksright"><font color="#FFFFFF">SHOW # [<a href="/cms/edit/<? echo $SafeFolder;?>/?section=blog&sub=cat">7</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=blog&c=10">10</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=blog&sub=cat&c=20">20</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=blog&sub=cat&c=50">50</a>]&nbsp;&nbsp<b>Total Categories: </b><? echo $CatCount;?></font> &nbsp;&nbsp; <? echo $pagination->displayPaging();?></div>
<div class="spacer"></div>
<? if ($CatCount == 0)
	echo '<div class="warning" style="padding-top:50px;">There are currently no categories for this blog.</div><div class="spacer"></div><div align="center"><a href="/cms/edit/'.$SafeFolder.'/?section='.$Section.'&sub=cat&a=new"><img src="/'.$PFDIRECTORY.'/images/create_new.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $CatString;?>
<div  class="pagelinksright" >Pages: <? echo $pagination->displayPaging();?></div>
</div>