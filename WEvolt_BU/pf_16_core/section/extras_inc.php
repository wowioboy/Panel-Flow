<div id="pagelisting">
<div class="pagelinks"><font color="#FFFFFF">SHOW # [<a href="/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>">7</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>&c=10">10</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=pages&c=20">20</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=<? echo $Section;?>&c=50">50</a>]&nbsp;&nbsp<b>Total Pages: </b><? echo $TotalPages;?></font> &nbsp;&nbsp; <? echo $pagination->displayPaging();?></div>
<div class="spacer"></div>
<? if ($TotalPages == 0)
	echo '<div class="warning" style="height:250px; padding-top:15px;">There are currently no EXTRA pages for this comic.</div>';
else echo $PageString;?>
<div  class="pagelinks" >Pages: <? echo $pagination->displayPaging();?></div>
</div>