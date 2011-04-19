<script type="text/javascript">
function customtab()
	{
			document.getElementById("customdiv").style.display = '';
			document.getElementById("customtab").className ='profiletabactive';
			document.getElementById("standarddiv").style.display = 'none';
			document.getElementById("standardtab").className ='profiletabinactive';
	}
function standardtab()
	{
			document.getElementById("customdiv").style.display = 'none';
			document.getElementById("customtab").className ='profiletabinactive';
			document.getElementById("standarddiv").style.display = '';
			document.getElementById("standardtab").className ='profiletabactive';
	}


</script>
<? if ($ContentType == 'story') {?>
<form method="post" action="/story/edit/<? echo $SafeFolder;?>/?section=settings&t=homepage&a=save" name="SaveModules" id="SaveModules">
<? } else {?>
<form method="post" action="/cms/edit/<? echo $SafeFolder;?>/?section=settings&t=homepage&a=save" name="SaveModules" id="SaveModules">
<? }?>

<table cellpadding="0" cellspacing="0" border="0" width="100%"> 
<tr>
<td class="profiletabactive" align="center" id='standardtab' onMouseOver="rolloveractive('standardtab','standarddiv')" onMouseOut="rolloverinactive('standardtab','standarddiv')" onclick="standardtab();"> STANDARD LAYOUT</td>
<td class="profiletabinactive" align="center"  id='customtab' onMouseOver="rolloveractive('customtab','customdiv')" onMouseOut="rolloverinactive('customtab','customdiv')" onclick="customtab();" style="border-left:#000000 1px solid;border-right:#000000 1px solid;">CUSTOM HTML LAYOUT</td>
</tr>
</table>
<div class="spacer"></div>
<div class="warning" align="center">
TURN ON HOMEPAGE : <input type="radio" value="1" name="HomepageActive" <? if ($HomepageActive == 1) echo 'checked';?>/>Yes&nbsp;&nbsp;<input type="radio" value="0" name="HomepageActive"  <? if (($HomepageActive == 0) || ($HomepageActive == '')) echo 'checked';?>/>No&nbsp;&nbsp;&nbsp;<div class="spacer"></div></div>
<div id="standarddiv">
<div align="center">
<div id="page">

<div class="pageheader" style="color:#ffffff;">You can drag and drop modules between columns to re-arrange the ordering. Or you can click the CUSTOM HTML LAYOUT above to manually create layout<br /><br />

When finished click save.</div><br />

<input type="hidden" value="<? echo $LeftColumnOrder;?>" name="LeftColumnOrder" id="LeftColumnOrder" />
<input type="hidden" value="<? echo $InactiveColumnOrder;?>" name="InactiveColumnOrder" id="InactiveColumnOrder" />
<input type="hidden" value="<? echo $RightColumnOrder;?>" name="RightColumnOrder" id="RightColumnOrder" />
<input type="hidden" value="<? echo $TopRowOrder;?>" name="TopRowOrder" id="TopRowOrder" />
<input type="hidden" value="<? echo $BottomRowOrder;?>" name="BottomRowOrder" id="BottomRowOrder" />
<input type="hidden" value="<? echo $SafeFolder;?>" name="SafeFolder" id="SafeFolder" />
<input type="button" onClick="getGroupOrder()" value="Save Order">

<div class="spacer"></div>
<table cellpadding="0" cellspacing="0" border="0" width="99%"><tr>
<td valign="top" style="padding-right:20px;padding-left:5px;border:#FFFFFF 2px solid;" width="200">
<? echo $InactiveModules;?>
</td><td valign="top" style="padding-left:10px;" align="center">

<table cellpadding="0" cellspacing="0" border="0" width="<? 
$HomePageWidth = 400;
echo $HomePageWidth;?>">
<tr><td colspan="3" align="center"><div class="pagereader">PAGE AREA<br/>
</div></td></tr>
<tr><td valign="top" style="padding-right:10px;">
<? echo $LeftColumnDiv;?></td><td width="10"></td>
<td valign="top"><? echo $RightColumnDiv;?></td>
</tr>
</table>
</td></tr></table>

</div>
<script type="text/javascript">
	// <![CDATA[
	Sortable.create('left',{tag:'div',dropOnEmpty: true, containment: sections,only:'homemod'});
	Sortable.create('right',{tag:'div',dropOnEmpty: true, containment: sections,only:'homemod'});
	Sortable.create('inactive',{tag:'div',dropOnEmpty: true, containment: sections,only:'homemod'});
	// ]]>
 </script>
</div>
</div>
<div id="customdiv" style="display:none;">
<div class="pageheader" style="color:#FF6600; padding-left:10px; padding-right:10px;">Below you can create your own homepage layout in HTML. To place modules just use the Module Code shown to the left.
</div>
<div class="spacer"></div>
<table cellpadding="0" cellspacing="0" border="0" width="95%">
<tr>
<td valign="top" style="color:#FFFFFF; font:Verdana, Arial, Helvetica, sans-serif; line-height:16px;font-size:12px;padding-left:10px;"><span style="font-size:14px; font-weight:bold; text-decoration:underline;">MODULE CODES</span><br/>
<b>Author Comment</b>: {authcomm}<br />
<b>Characters</b>: {characters}<br />
<b>Downloads</b>: {downloads}<br />
<b>Comic Credits</b>: {comiccredits}<br />
<b>Comic Synopsis</b>: {comicsynopsis}<br />
<b>Links</b>: {linksbox}<br />
<b>Mobile Content</b>: {mobile}<br />
<b>Products</b>: {products}<br />
<b>Other Comics</b>: {othercreatorcomics}<br />
<b>Status Box</b>: {status}<br /><br />
<span style="font-size:14px; font-weight:bold;text-decoration:underline;">PAGE READER CODES</span><br />
<b>Full Page:</b> {fullpagereader}<br /><br />
<span style="font-size:14px; font-weight:bold; text-decoration:underline;">NAVIGATION CODES</span><br/>
<b>First Page</b>: {first_page}<br />
<b>Next Page</b>: {next_page}<br />
<b>Last Page</b>: {last_page}<br />
<b>Previous Page</b>: {previous_page}<br /><br />
</td>
<td valign="top" width="550" style="padding-left:10px; color:#FFFFFF; font-size:12px;">
USE CUSTOM HTML : <input type="radio" value="custom" name="txtHomePageType" <? if ($HomePageType == 'custom') echo 'checked';?>/>Yes&nbsp;&nbsp;<input type="radio" value="standard" name="txtHomePageType"  <? if ($HomePageType == 'standard') echo 'checked';?>/>No&nbsp;&nbsp;&nbsp;<input type="button" onClick="document.SaveModules.submit();" value="Save Code"><br />
<br />

<textarea name="txtCustom" id="txtCustom" style="width:100%; height:400px;"><? echo $HomepageHTML;?></textarea>
</td></tr></table>
</div>
 </form>