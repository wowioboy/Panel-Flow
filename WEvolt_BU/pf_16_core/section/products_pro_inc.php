<script type="text/javascript">
function rolloverinactive(tabid, divid) {
			if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='profiletabinactive';
			} 
	}
	function merchtab()
	{
			document.getElementById("merchdiv").style.display = '';
			document.getElementById("merchtab").className ='profiletabactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdftab").className ='profiletabinactive';
			if (document.getElementById("licensetab") != null) {
			document.getElementById("licensediv").style.display = 'none';
			document.getElementById("licensetab").className ='profiletabinactive';
			}
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookstab").className ='profiletabinactive';

			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printtab").className ='profiletabinactive';

	}
	
	function printtab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdftab").className ='profiletabinactive';
			if (document.getElementById("licensetab") != null) {
			document.getElementById("licensediv").style.display = 'none';
			document.getElementById("licensetab").className ='profiletabinactive';
			}
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookstab").className ='profiletabinactive';
		
			document.getElementById("printsdiv").style.display = '';
			document.getElementById("printtab").className ='profiletabactive';

	}
	function pdftab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = '';
			document.getElementById("pdftab").className ='profiletabactive';
			if (document.getElementById("licensetab") != null) {
			document.getElementById("licensediv").style.display = 'none';
			document.getElementById("licensetab").className ='profiletabinactive';
			}
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookstab").className ='profiletabinactive';
			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printtab").className ='profiletabinactive';


	}
<? if (in_array($_SESSION['userid'],$SiteAdmins)) { ?>
	function licensetab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdftab").className ='profiletabinactive';
			document.getElementById("licensediv").style.display = '';
			document.getElementById("licensetab").className ='profiletabactive';
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookstab").className ='profiletabinactive';

			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printtab").className ='profiletabinactive';

		
			
	}

<? }?>
	function bookstab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdftab").className ='profiletabinactive';
			if (document.getElementById("licensetab") != null) {
			document.getElementById("licensediv").style.display = 'none';
			document.getElementById("licensetab").className ='profiletabinactive';
			}
			document.getElementById("booksdiv").style.display = '';
			document.getElementById("bookstab").className ='profiletabactive';
			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printtab").className ='profiletabinactive';

		
			
	}
	function readertab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdftab").className ='profiletabinactive';
			if (document.getElementById("licensetab") != null) {
			document.getElementById("licensediv").style.display = 'none';
			document.getElementById("licensetab").className ='profiletabinactive';
			}
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookstab").className ='profiletabinactive';
			document.getElementById("readerdiv").style.display = '';
			document.getElementById("readertab").className ='profiletabactive';
			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printtab").className ='profiletabinactive';

	}
</script>
<table cellpadding="0" cellspacing="0" border="0" width="100%"> 
<tr>
<td class="profiletabactive" align="center" id='pdftab' onMouseOver="rolloveractive('pdftab','pdfdiv')" onMouseOut="rolloverinactive('pdftab','pdfdiv')" onclick="pdftab();"> PDFs</td>
<td class="profiletabinactive" align="center"  id='printtab' onMouseOver="rolloveractive('printtab','printsdiv')" onMouseOut="rolloverinactive('printtab','printsdiv')" onclick="printtab();" style="border-left:#000000 1px solid;border-right:#000000 1px solid;">PRINTS</td>
<td class="profiletabinactive" align="center" id='merchtab' onMouseOver="rolloveractive('merchtab','merchdiv')" onMouseOut="rolloverinactive('merchtab','merchdiv')" onclick="merchtab();"> MERCH</td>
<? if (in_array($_SESSION['userid'],$SiteAdmins)) { ?>
<!--<td class="profiletabinactive" align="left"  id='licensetab' onMouseOver="rolloveractive('licensetab','licensediv')" onMouseOut="rolloverinactive('licensetab','licensediv')" onclick="licensetab();" style="border-left:#000000 1px solid;border-right:#000000 1px solid;">LICENSED ART</td>-->
<? }?>
<td class="profiletabinactive" align="center"  id='bookstab' onMouseOver="rolloveractive('bookstab','booksdiv')" onMouseOut="rolloverinactive('bookstab','booksdiv')" onclick="bookstab();" style="border-left:#000000 1px solid;">BOOKS</td>
</table>

<div id="pdfdiv" align="left" style="padding-left:10px;">
<div class="spacer"></div>
<div class="warning">PDFs</div>
<div class="spacer"></div>
<? echo $PDFString;?>
</div>

<div id="merchdiv" style="display:none;padding-left:10px;">
<div class="spacer"></div>
<div class="warning">MERCHANDISE</div>
<div class="spacer"></div>
<? echo $MerchString;?>

</div>

<div id="printsdiv" style="display:none;padding-left:10px;">
<div class="spacer"></div>
<div class="warning">PRINTS</div>
<div class="spacer"></div>
<? echo $PrintString;?>
</div>

<div id="licensediv" style="display:none;padding-left:10px;">
LICENSE
</div>

<div id="booksdiv" style="display:none;padding-left:10px;">
<div class="spacer"></div>
<div class="warning">BOOKS</div>
<div class="spacer"></div>
<? echo $BookString;?>
</div>

