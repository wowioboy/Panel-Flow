<script type="text/javascript">
function submit_template(step, task, type) {

var formaction = '/cms/edit/<? echo $SafeFolder;?>/?tab=design&section='+type+'&sa='+task+'&step='+step;

	document.templateform.action = formaction;
	document.templateform.submit();

}
/*
function switch_tab(value)
	{

		if (value == 'template') {
		document.getElementById("template_list").style.display = '';
		document.getElementById("template_tab").className ='profiletabactive';
		document.getElementById("skin_settings").style.display = 'none';
		document.getElementById("skins_tab").className ='profiletabinactive';
		
		} else {
		document.getElementById("template_list").style.display = 'none';
		document.getElementById("template_tab").className ='profiletabinactive';
		document.getElementById("skin_settings").style.display = '';
		document.getElementById("skins_tab").className ='profiletabactive';
		
		}
			
}
*/
</script>
<? /*
<table cellpadding="0" cellspacing="0" border="0" width="80%"> 
<tr>
<td class="profiletabinactive" align="left" id='template_tab' onMouseOver="rolloveractive('template_tab','template_list')" onMouseOut="rolloverinactive('template_tab','template_list')" onclick="switch_tab('template');"> TEMPLATE</td>
<td width="5"></td>
<td class="profiletabactive" align="left" id='skins_tab' onMouseOver="rolloveractive('skins_tab','skin_settings')" onMouseOut="rolloverinactive('skins_tab','skin_settings')" onclick="switch_tab('skins');"> SKINS</td>
</tr>
</table> 

<div id="template_list" style="display:none;">
<form name="templateform" id="templateform" method="post">

<div align="center">
<? 
$db = new DB($db_database,$db_host, $db_user, $db_pass);

$query = "SELECT * from templates where IsPublic=1";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
while ($line = $db->FetchNextObject()) {
$ImageCount++;
	echo '<td align="center" width="60"><img src="/'.$line->Image.'" border="1" style="border:#fffff solid 1px;" vspace="5" hspace="5" width="150"><br/><input type="radio" name="txtTemplate" value="'.$line->TemplateCode.'"';
	if ($line->TemplateCode == $TemplateCode)
	echo ' checked ';
	
	
	echo ' onchange="alert_template_change();">SELECT<div style="height:5px;"></div></td>';
	if ($ImageCount == 5) {
		echo '</tr><tr>';
		$ImageCount = 0;
	}
	
}
if (($ImageCount < 5) && ($ImageCount != 0)) {
	while ($ImageCount < 5) {
		echo '<td></td>';
		$ImageCount++;
	}
}
echo '</tr></table>';
$db->close();



?>
<input type="button" onClick="submit_template('title','new','themes');" value="SAVE SETTINGS">
</div>



</form>
</div>
 */?>
<div id="skin_settings" >
<? include 'skin_edit_inc.php';?>
</div>