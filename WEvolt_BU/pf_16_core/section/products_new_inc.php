<script type="text/javascript">
function rolloverinactive(tabid, divid) {
			if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='profiletabinactive';
			} 
	}
	function reset_select()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchcell").style.display = '';
			//document.getElementById("merchtab").className ='profiletabactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdfcell").style.display = '';
			//document.getElementById("pdftab").className ='profiletabinactive';
			if (document.getElementById("licensecell") != null) {
			//document.getElementById("licensediv").style.display = 'none';
			//document.getElementById("licensecell").style.display = '';
			}
			//document.getElementById("licensetab").className ='profiletabinactive';
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookcell").style.display = '';
			//document.getElementById("bookstab").className ='profiletabinactive';

			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printcell").style.display = '';
			//document.getElementById("printtab").className ='profiletabinactive';

	}
	
	function merchtab()
	{
			document.getElementById("merchdiv").style.display = '';
			document.getElementById("merchcell").style.display = '';
			//document.getElementById("merchtab").className ='profiletabactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdfcell").style.display = 'none';
			//document.getElementById("pdftab").className ='profiletabinactive';
				if (document.getElementById("licensecell") != null) {
			//document.getElementById("licensediv").style.display = 'none';
			//document.getElementById("licensecell").style.display = 'none';
			}
			//document.getElementById("licensetab").className ='profiletabinactive';
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookcell").style.display = 'none';
			//document.getElementById("bookstab").className ='profiletabinactive';

			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printcell").style.display = 'none';
			//document.getElementById("printtab").className ='profiletabinactive';

	}
	
	function printstab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchcell").style.display = 'none';
			//document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdfcell").style.display = 'none';
			//document.getElementById("pdftab").className ='profiletabinactive';
				if (document.getElementById("licensecell") != null) {
			//document.getElementById("licensediv").style.display = 'none';
			//document.getElementById("licensecell").style.display = 'none';
			}
			///document.getElementById("licensetab").className ='profiletabinactive';
			document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookcell").style.display = 'none';
			//document.getElementById("bookstab").className ='profiletabinactive';
		    document.getElementById("printcell").style.display = '';
			document.getElementById("printsdiv").style.display = '';
			//document.getElementById("printtab").className ='profiletabactive';

	}
	function pdftab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchcell").style.display = 'none';
			
		//	document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = '';
			document.getElementById("pdfcell").style.display = '';
			//document.getElementById("pdftab").className ='profiletabactive';
				if (document.getElementById("licensecell") != null) {
			//document.getElementById("licensediv").style.display = 'none';
			//document.getElementById("licensecell").style.display = 'none';
			}
			//document.getElementById("licensetab").className ='profiletabinactive';
		document.getElementById("booksdiv").style.display = 'none';
		document.getElementById("bookcell").style.display = 'none';
			//document.getElementById("bookstab").className ='profiletabinactive';
			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printcell").style.display = 'none';
			//document.getElementById("printtab").className ='profiletabinactive';


	}
<? if (in_array($_SESSION['userid'],$SiteAdmins)) { ?>
	function licensetab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchcell").style.display = 'none';
		//	document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdfcell").style.display = 'none';
			//document.getElementById("pdftab").className ='profiletabinactive';
			//document.getElementById("licensediv").style.display = '';
		//	document.getElementById("licensecell").style.display = '';
		//	document.getElementById("licensetab").className ='profiletabactive';
		document.getElementById("booksdiv").style.display = 'none';
			document.getElementById("bookcell").style.display = 'none';
		//	document.getElementById("bookstab").className ='profiletabinactive';

		document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printcell").style.display = 'none';
			////document.getElementById("printtab").className ='profiletabinactive';
			
	}
	<? }?>
	function bookstab()
	{
			document.getElementById("merchdiv").style.display = 'none';
			document.getElementById("merchcell").style.display = 'none';
		//	document.getElementById("merchtab").className ='profiletabinactive';
			document.getElementById("pdfdiv").style.display = 'none';
			document.getElementById("pdfcell").style.display = 'none';
		//	document.getElementById("pdftab").className ='profiletabinactive';
			if (document.getElementById("licensecell") != null) {
	//	document.getElementById("licensediv").style.display = 'none';
	//	document.getElementById("licensecell").style.display = 'none';
		}
		//	document.getElementById("licensetab").className ='profiletabinactive';
			document.getElementById("booksdiv").style.display = '';
			document.getElementById("bookcell").style.display = '';
		//	document.getElementById("bookstab").className ='profiletabactive';
			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printcell").style.display = 'none';
		//	document.getElementById("printtab").className ='profiletabinactive';

		
			
	}
	
	function show_processing(value) {
	document.getElementById("pdfprocessing").style.display = '';
	document.getElementById("pdfmenu").style.display = 'none';
	
	}
</script>
<? if (!isset($_GET['type'])) {?>
<center>
<div class="warning">Select they type of product you want to make:</div>
<div class="spacer"></div>
<div style="color:#ffffff; font-size:14px;">
<table cellpadding="0" cellspacing="0" border="0" width="80%"><tr>
<td align="center" id="pdfcell">PDF BOOK<br/><img src="/<? echo $PFDIRECTORY;?>/images/pdf_btn.png" style="cursor:pointer;" onclick="pdftab();"/></td>
<td align="center" id="printcell">PRINTS<br/><img src="/<? echo $PFDIRECTORY;?>/images/prints_btn.png" style="cursor:pointer;" onclick="printstab();"/></td>
<td align="center" id="merchcell">MERCHANDISE<br/><img src="/<? echo $PFDIRECTORY;?>/images/merch_btn.png" style="cursor:pointer;" onclick="merchtab();"/> </td>
<td align="center" id="bookcell">PRINTED BOOKS<br/><img src="/<? echo $PFDIRECTORY;?>/images/books_btn.png" style="cursor:pointer;" onclick="bookstab();"/> </td>
<? if (in_array($_SESSION['userid'],$SiteAdmins)) { ?>
<!--
<td align="center" id="licensecell">LICENSED ART<br/><img src="/<? echo $PFDIRECTORY;?>/images/license_btn.png" style="cursor:pointer;" onclick="licensetab();"/> </td>-->
<? }?>

<td id="pdfdiv" style="display:none;"> 
<div id='pdfprocessing' align="center" style="color:#FFFFFF;display:none;">Please wait while your pages are imported...<div class="spacer"></div><img src='/<? echo $PFDIRECTORY;?>/images/processingbar.gif'><div class="spacer"></div></div>
<div id='pdfmenu'>
<div class="pagelinks">[<a href="/create/pdf/<? echo $SafeFolder;?>/" onclick="show_processing('pdf');"><span style="font-size:14px;">IMPORT CURRENT COMIC PAGES INTO PDF</span></a>]<br />
[<a href="/create/pdf/<? echo $SafeFolder;?>/?a=all" onclick="show_processing('pdf');"><span style="font-size:14px;">IMPORT COMIC PAGES & EXTRAS INTO PDF</span></a>]<br />
[<a href="/create/pdf/<? echo $SafeFolder;?>/?a=new"><span style="font-size:14px;">START BLANK PDF</span></a>]
<br />
[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=products&a=new&sub=ebook"><span style="font-size:14px;">UPLOAD PRE MADE PDF</span></a>]
<div class="spacer"></div>
[<a href="#" onclick="reset_select();return false;">CANCEL / START OVER</a>]</div>
</div>
</td>

<td id="merchdiv" style="display:none;">
<div class="pagelinks">

[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=products&a=new&sub=podmerch"><span style="font-size:14px;">CREATE PRINT ON DEMAND MERCH</span></a>]<br />

[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=products&a=new&sub=selfmerch"><span style="font-size:14px;">CREATE MERCH ITEM</span></a>]<br />
 <span style="color:#FFFFFF;">(You ship to buyer)</span>
<div class="spacer"></div>
[<a href="#" onclick="reset_select();return false;">CANCEL / START OVER</a>]
</div>
</td>

<td id="printsdiv" style="display:none;">
<div class="pagelinks">
<? if (in_array($_SESSION['userid'],$SiteAdmins)) { ?>[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=products&a=new&sub=podprint">CREATE PRINT ON DEMAND PRINT</a>]<br />
<? }?>

[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=products&a=new&sub=selfprint"><span style="font-size:14px;">CREATE PRINT </span></a>]<br />
 <span style="color:#FFFFFF;">(You ship to buyer)</span><div class="spacer"></div>
[<a href="#" onclick="reset_select();return false;">CANCEL / START OVER</a>]</div>
</td>

<td id="booksdiv" style="display:none;">
<div class="pagelinks">
<? if (in_array($_SESSION['userid'],$SiteAdmins)) { ?>
[<a href="/create/book/pod/<? echo $SafeFolder;?>/">CREATE PRINT ON DEMAND BOOK</a>]<br />
<? }?>

[<a href="/cms/edit/<? echo $SafeFolder;?>/?section=products&a=new&sub=selfbook"><span style="font-size:14px;">CREATE BOOK </span></a>]<br />
 <span style="color:#FFFFFF;">(You ship to buyer)</span><div class="spacer"></div>
[<a href="#" onclick="reset_select();return false;">CANCEL / START OVER</a>]</div>
</td>

<td id="licensediv" style="display:none;">
<div class="pagelinks"><font size="+1">[<a href="/create/license/<? echo $SafeFolder;?>/?a=digital">CREATE DIGITAL RIGHTS ONLY</a>]</div>
<div class="pagelinks">[<a href="/create/license/<? echo $SafeFolder;?>/?a=print">CREATE PRINTS RIGHTS ONLY</a>]</div>
<div class="pagelinks">[<a href="/create/license/<? echo $SafeFolder;?>/?a=full">CREATE PRINT AND DIGITAL RIGHTS</a>]<div class="spacer"></div>
[<a href="#" onclick="reset_select();return false;">CANCEL / START OVER</a>]</div>
</td>

</tr>
</table>
</div>
</center>

<? } else {?>

<? }?>
