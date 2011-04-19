<script type="text/javascript">
function set_size(value) {
		if (value != 'custom') {
			var sizearray = value.split('x');	
			document.getElementById("customdiv").style.display='none';
			document.getElementById("width").value = sizearray[0];
			document.getElementById("height").value = sizearray[1];
				document.getElementById("iscustom").value=0;
		} else {
			document.getElementById("customdiv").style.display='block';
			document.getElementById("iscustom").value=1;
			document.getElementById("embeddiv").style.display='none';
			
		}
		document.getElementById("getcode").style.display='';
	
}

function getembed() {
	var Custom = document.getElementById("iscustom").value;
	var index = document.getElementById("SeriesSelect").selectedIndex;
	var SeriesNum = document.getElementById("SeriesSelect").options[index].value;
	
	var pindex = document.getElementById("PageSelect").selectedIndex;
	var PageSelect = document.getElementById("PageSelect").options[pindex].value;
	
	if (Custom == 1) {
		var width = document.getElementById("txtCustomWidth").value;
		var height = document.getElementById("txtCustomHeight").value;
		if ((width == '')|| (height == '')) 
			alert('Please enter your custom width and height');
	} else {
		var width = document.getElementById("width").value;
		var height = document.getElementById("height").value;
		
		}
	
	if ((width != '') && (height != '')) {
	document.getElementById("embeddiv").style.display='';
	
	var html ='<embed src="http://www.wevolt.com/panelflow/pf_bot_16.swf" width="'+width+'" height="'+height+'" flashvars="systemurl=www.wevolt.com/panelflow/&comicurl=www.wevolt.com/<? echo $SafeFolder;?>/&comicid=<? echo $SafeFolder;?>&series='+SeriesNum+'&pageselect='+PageSelect+'" allowscriptaccess="always" allowfullscreen="true" />';
	
	document.getElementById("embedcode").value = html;
	}

}

</script>
<center>
<? $query = "SELECT * from series where ProjectID ='".$_SESSION['sessionproject']."'  order by SeriesNum ASC";
	$InitDB->query($query);
	$TotalSeries = $InitDB->numRows();
	if ($TotalSeries == 0) {
			$query = "INSERT into series (Title, SeriesNum,ProjectID) values ('".str_replace('_',' ',$_SESSION['safefolder'])."',1,'".$_SESSION['sessionproject']."')"; 
			$InitDB->execute($query);
			$query = "SELECT * from series where ProjectID ='".$_SESSION['sessionproject']."'  order by SeriesNum ASC";
			$InitDB->query($query);
	}
	$SeriesSelect = '<select name="SeriesSelect" id="SeriesSelect" style="width:150px;">';
	while ($line = $InitDB->fetchNextObject()) {
			$SeriesSelect .= '<option value="'.$line->SeriesNum.'"';
			if ($SeriesNum == $line->SeriesNum)
				$SeriesSelect .= ' selected';
			$SeriesSelect .='>'.$line->Title.'</option>';
	}
	$SeriesSelect .= '</select>';?>
    
<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=tools">BACK TO TOOLS DASH</a>&nbsp;&nbsp;<div class="spacer"></div><div class="spacer"></div>
<div class="sender_name">CREATE EMBED WIDGET</div><div class="spacer"></div>
<table width="608" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="592" align="center">
                                      <div class="messageinfo_white">1. <strong>Select the desired size of the embed </strong></div><div class="spacer"></div><input type="radio" value="800x600" name="txtSize" onchange="set_size(this.value);"/>800x600&nbsp;&nbsp;<input type="radio" name="txtSize" value="850x675" onchange="set_size(this.value);"/>850x675&nbsp;&nbsp;<input name="txtSize" type="radio" value="800x300" onchange="set_size(this.value);"/>800x300 (strips)&nbsp;&nbsp;<input name="txtSize" type="radio" value="400x400" onchange="set_size(this.value);"/>400x400 (One Panel)&nbsp;&nbsp;<input type="radio" name="txtSize" value="custom" onchange="set_size(this.value);"/>Custom size&nbsp;&nbsp;
                                      <div id="customdiv" style="display:none;">
                                      <div class="spacer"></div>
                                      <strong>Enter your custom width and height below:</strong><br />
Width:<input type="text" name="txtCustomWidth" id="txtCustomWidth" size="3" maxlength="4"/>&nbsp;&nbsp;Height:<input type="text" name="txtCustomHeight" id="txtCustomHeight" size="3" maxlength="4"/>&nbsp;&nbsp;
                                      </div>
                                       <div class="spacer"></div>
                                         <div class="messageinfo_white">2. <strong>Select the series </strong></div>
                                       <? echo $SeriesSelect;?>
                                        <div class="messageinfo_white">3. <strong>Select which page should show </strong></div>
                                        <select name="PageSelect" id="PageSelect" style="width:150px;">
                                        <option value="last" selected>Most Recent Page</option>
                                        <option value="first">First Page in Series</option>
                                        </select>
                                   
                                      <div id="getcode" style="display:none;">
                                      <input type="button" value="GET CODE" onclick="getembed();" />
                                      </div> <div class="spacer"></div>
                                      <div id="embeddiv" style="display:none;">
                                      Copy the code below and paste it into any webpage to show the latest page on your project.
                                      <textarea id="embedcode" style="width:100%; height:100px;"/></textarea>
                                      </div>
 </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>
                        
                        </center>
                        
                        <input type="hidden" id="width" value=""/>
                         <input type="hidden" id="height" value=""/>
                         <input type="hidden" id="iscustom" value=""/>