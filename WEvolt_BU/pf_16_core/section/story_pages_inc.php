<div id="pagelisting" align="center">
<div class="pagelinksright"><font color="#FFFFFF">SHOW # [<a href="/story/edit/<? echo $SafeFolder;?>/?section=pages">7</a>]&nbsp;[<a href="/story/edit/<? echo $SafeFolder;?>/?section=pages&c=10">10</a>]&nbsp;[<a href="/story/edit/<? echo $SafeFolder;?>/?section=pages&c=20">20</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=blog&c=50">50</a>]&nbsp;&nbsp<b>Total Pages: </b><? echo $TotalPages;?></font> &nbsp;&nbsp; <? echo $pagination->displayPaging();?></div>
<div class="spacer"></div>
<? if ($TotalPages == 0)
	echo '<div class="warning" style="padding-top:50px;">There are currently no pages for this story.</div><div class="spacer"></div><div align="center"><a href="/story/edit/'.$SafeFolder.'/?section='.$Section.'&a=new"><img src="/'.$PFDIRECTORY.'/images/create_new.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $PageString;?>
<div  class="pagelinksright" >Pages: <? echo $pagination->displayPaging();?></div>
</div>