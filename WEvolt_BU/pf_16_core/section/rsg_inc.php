<div id="pagelisting" align="center">
<div class="pagelinks">
<? 
$query = 'SELECT * from pf_rg_entry_types order by Title';
$comicsDB->query($query);
$TotalTypes = $comicsDB->numRows();
$TCount = 1;
while ($type = $comicsDB->FetchNextObject()){
echo '<a href="/cms/edit/'.$SafeFolder.'/?section=rsg&type='.$type->Title.'">'.strtoupper($type->Title).'</a>&nbsp';
if ($TCount != $TotalTypes)
echo '|&nbsp;';
$TCount++;
}
?>
</div>
<div class="spacer"></div>

<div class="pagelinksright">
<? if (isset($_GET['type'])) {?>
<font color="#FFFFFF">SHOW # [<a href="/cms/edit/<? echo $SafeFolder;?>/?section=rsg">7</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=rsg&c=10">10</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=rsg&c=20">20</a>]&nbsp;[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=rsg&c=50">50</a>]&nbsp;&nbsp<b>Total Pages: </b><? echo $TotalPages;?></font> &nbsp;&nbsp; <? echo $pagination->displayPaging();?></div><? }?>
<div class="spacer"></div>
<? if ($TotalPages == 0)
	echo '<div class="warning" style="padding-top:50px;">There are currently no entries of this type.</div><div class="spacer"></div><div align="center"><a href="/cms/edit/'.$SafeFolder.'/?section='.$Section.'&a=new"><img src="/'.$PFDIRECTORY.'/images/create_entry.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $PageString;?>
<div  class="pagelinksright" >Entries: <? echo $pagination->displayPaging();?></div>
</div>