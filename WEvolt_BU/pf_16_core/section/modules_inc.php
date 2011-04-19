<script type="text/javascript">
function edit_custom() {
	if (document.getElementById("custommoddiv").style.display == '')
		document.getElementById("custommoddiv").style.display = 'none';
	else 
		document.getElementById("custommoddiv").style.display = '';
	
}

</script>

<div align="center">
<div id="page">

<div class="pageheader" style="color:#FF6600;">You can drag and drop modules between columns to re-arrange the ordering. <br /><br />

When finished click save.</div><br />
<? if ($ContentType != 'story') {?>
<form method="post" action="/cms/edit/<? echo $SafeFolder;?>/?section=modules&a=save" name="SaveModules" id="SaveModules">
<? } else {?>
<form method="post" action="/story/edit/<? echo $SafeFolder;?>/?section=modules&a=save" name="SaveModules" id="SaveModules">


<? }?>
<input type="hidden" value="<? echo $LeftColumnOrder;?>" name="LeftColumnOrder" id="LeftColumnOrder" />
<input type="hidden" value="<? echo $RightColumnOrder;?>" name="RightColumnOrder" id="RightColumnOrder" />
<input type="hidden" value="<? echo $SafeFolder;?>" name="SafeFolder" id="SafeFolder" />
<input type="button" onClick="getGroupOrder()" value="Save Order">

<div class="spacer"></div>
<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="250" align="center">
<div id="custommoddiv" style="display:none;"><div class="warning">CUSTOM MODULE CODE</div><textarea name="custommodHTML"  style="width:200px;height:400px; border:#ff9900 2px solid;"><? echo $CustomModCode;?></textarea></div>
</td><td>
<? if ($Template == 'TPL-001') {?>
<table cellpadding="0" cellspacing="0" border="0" width="400">
<tr><td colspan="3"><div class="pagereader">PAGE AREA</div></td></tr>
<tr><td valign="top" style="padding-right:10px;">
<? echo $LeftColumnDiv;?></td><td width="10"></td>
<td valign="top"><? echo $RightColumnDiv;?></td>
</tr>
</table>
<? } else if ($Template == 'TPL-002') {?>
<table cellpadding="0" cellspacing="0" border="0" width="400">
<tr><td valign="top" style="padding-right:10px;"><div class="pagereader">PAGE AREA</div><div class='spacer'></div><? echo $LeftColumnDiv;?></td>
<td width="10"></td>
<td valign="top" style="padding-right:10px;"><? echo $RightColumnDiv;?></td>
</tr>
</table>
<? } else if ($Template == 'TPL-003') {?>
<table cellpadding="0" cellspacing="0" border="0" width="400">
<tr><td valign="top" style="padding-right:10px;"><? echo $LeftColumnDiv;?></td>
<td width="10"></td>
<td valign="top" style="padding-right:10px;"><div class="pagereader">PAGE AREA</div><div class='spacer'></div><? echo $RightColumnDiv;?></td>
</tr>
</table>

<? }?>
</td></tr></table>
 </form>
</div>
<script type="text/javascript">
	// <![CDATA[
	Sortable.create('left',{tag:'div',dropOnEmpty: true, containment: sections,only:'lineitem'});
	Sortable.create('right',{tag:'div',dropOnEmpty: true, containment: sections,only:'lineitem'});
	Sortable.create('page',{tag:'div',only:'section',handle:'handle'});
	// ]]>
 </script>
</div>