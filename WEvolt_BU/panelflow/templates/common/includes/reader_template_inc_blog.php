<? if (($Section == 'Reader') || ($Section == 'pages')) {?>
<script type="text/javascript">
function peelpage(peelid) {
	if (peelid == 'pagediv') {
		<? if ($PeelOne != '') {?>
			document.getElementById("PeelOne").style.display ='none';
			document.getElementById("onetab").className ='peeltabinactive';
		<? }?>
		
		<? if ($PeelTwo != '') {?>
			document.getElementById("PeelTwo").style.display ='none';
			document.getElementById("twotab").className ='peeltabinactive'; 
		<? } ?>
		<? if ($PeelThree != '') {?>
			document.getElementById("PeelThree").style.display ='none';
			document.getElementById("threetab").className ='peeltabinactive';
		<? } ?>
		<? if ($PeelFour != '') {?>
			document.getElementById("PeelFour").style.display ='none';
			document.getElementById("fourtab").className ='peeltabinactive';
			document.getElementById("pdfcell").style.display ='none';
		<? } ?>
			document.getElementById("pagediv").style.display ='';
			document.getElementById("finaltab").className ='peeltabactive';
	} else if (peelid == 'PeelOne') {
			document.getElementById("PeelOne").style.display ='';
			document.getElementById("onetab").className ='peeltabactive';
		<? if ($PeelTwo != '') {?>
			document.getElementById("PeelTwo").style.display ='none';
			document.getElementById("twotab").className ='peeltabinactive';
		<? } ?>
		<? if ($PeelThree != '') {?>
			document.getElementById("PeelThree").style.display ='none';
			document.getElementById("threetab").className ='peeltabinactive';
		<? } ?>
		<? if ($PeelFour != '') {?>
			document.getElementById("PeelFour").style.display ='none';
			document.getElementById("fourtab").className ='peeltabinactive';
			document.getElementById("pdfcell").style.display ='none';
		<? } ?>
			document.getElementById("pagediv").style.display ='none';
			document.getElementById("finaltab").className ='peeltabinactive';
	} else if (peelid == 'PeelTwo') {
		<? if ($PeelOne != '') {?>
			document.getElementById("PeelOne").style.display ='none';
			document.getElementById("onetab").className ='peeltabinactive';
		<? }?>
		
			document.getElementById("PeelTwo").style.display ='';
			document.getElementById("twotab").className ='peeltabactive';

		<? if ($PeelThree != '') {?>
			document.getElementById("PeelThree").style.display ='none';
			document.getElementById("threetab").className ='peeltabinactive';
		<? } ?>
		<? if ($PeelFour != '') {?>
			document.getElementById("PeelFour").style.display ='none';
			document.getElementById("fourtab").className ='peeltabinactive';
			document.getElementById("pdfcell").style.display ='none';
		<? } ?>
			document.getElementById("pagediv").style.display ='none';
			document.getElementById("finaltab").className ='peeltabinactive';
	} else if (peelid == 'PeelThree') {
	
		<? if ($PeelOne != '') {?>
			document.getElementById("PeelOne").style.display ='none';
			document.getElementById("onetab").className ='peeltabinactive';
		<? }?>
		<? if ($PeelTwo != '') {?>
			document.getElementById("PeelTwo").style.display ='none';
			document.getElementById("twotab").className ='peeltabinactive';
		<? } ?>
		<? if ($PeelFour != '') {?>
			document.getElementById("PeelFour").style.display ='none';
			document.getElementById("pdfcell").style.display ='none';
			document.getElementById("fourtab").className ='peeltabinactive';
		<? } ?>
			document.getElementById("PeelThree").style.display ='';
			document.getElementById("threetab").className ='peeltabactive';
			document.getElementById("pagediv").style.display ='none';
			document.getElementById("finaltab").className ='peeltabinactive';
			
	}  else if (peelid == 'PeelFour') {
	
		<? if ($PeelOne != '') {?>
			document.getElementById("PeelOne").style.display ='none';
			document.getElementById("onetab").className ='peeltabinactive';
		<? }?>
		<? if ($PeelTwo != '') {?>
			document.getElementById("PeelTwo").style.display ='none';
			document.getElementById("twotab").className ='peeltabinactive';
		<? } ?>
		<? if ($PeelThree != '') {?>
				document.getElementById("PeelThree").style.display ='none';
			document.getElementById("threetab").className ='peeltabinactive';
		<? } ?>
		
			document.getElementById("PeelFour").style.display ='';
			document.getElementById("pdfcell").style.display ='';
			document.getElementById("fourtab").className ='peeltabactive';
			document.getElementById("pagediv").style.display ='none';
			document.getElementById("finaltab").className ='peeltabinactive';
			
			
			
	}
	

}


</script>
<? }?>
<? 

//READER AND TOP ADS
$ReaderString = '<table border="0" cellspacing="0" cellpadding="0" id="readerstring"><tr>';
$PageReader = '<div>';
$ReaderString .= '<td valign="top" align="center">';
if (($ReaderType == 'html') && ($KeepWidth == 1)) 
	$Width = $GlobalSiteWidth;
else if (($Section != 'Pages') && ($Section != 'Extras')) 
	$Width = $GlobalSiteWidth;
	
if ($ReaderType == 'flash') {
	if ((($Section != 'Pages') && ($Section != 'Extras')) || ($KeepWidth == 1)) 
			$Width = $GlobalSiteWidth;
	
	$SiteHeaderString = $ReaderString;
}
	
if (($Homepage == 1) && ($HomepageActive == 1) && ($TodayBlog > 0) && ($TodayPage == 0)) {
	$PageArea .='<center><div class="boxcontent" style="color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;width:'.$Width.'px;" align="left"><div class="latestpageheader" style="cursor:pointer;" onclick="window.location=\'/reader/';
		
				$PageArea .= '/'.$SafeFolder.'/reader/';
			$PageArea .='page/'.$lastpage.'/\';"';
			
		$PageArea .='>';
		
		
		if ($LatestPageHeader != '')
			$PageArea .='<center><img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$LatestPageHeader.'" border="0"></center>';
		else
			 $PageArea .='READ THE LATEST PAGE HERE!';
		$PageArea .='</div>';
		$PageArea .='<div align="left" style="width:'.($Width-10).'px;height:600px;overflow:auto;padding:5px;">';
		
		$PageArea .='<div class="blogtitle">'.stripslashes($TodayBlogArray->Title).'</div>';
		
		$BlogContent = file_get_contents('http://www.wevolt.com/'.$TodayBlogArray->Filename);
				
				$content = $BlogContent;
				$content_lowercase = strtolower($content);
				$currpos = 0;
				$endpos = strlen($content);
				$newcontent = '';
				$lastimgtag = 0;

				do
				{
					$imgStart = strpos($content_lowercase, '<img', $currpos);
					if ($imgStart === false) 
						break;
					else 
					{
						$imgEnd = strpos($content_lowercase, '>', $imgStart);
						$imageTag = substr($content, $imgStart, $imgEnd - $imgStart + 1);
						
						$newimgtag = CreateNewImgTag($imageTag);
						$newcontent .= substr($content, $lastimgtag, $imgStart - $lastimgtag);
						$newcontent .= $newimgtag;
						$lastimgtag = $imgEnd + 1;
						$currpos = $lastimgtag;
					}
				} while ($currpos < $endpos);
		//print 'CONTENT = http://www.needcomics.com/comics/'.$ComicDir.'/'.$ComicName.'/blog/'.$TodayBlogArray->Filename;
		$PageArea .= '<div class="blogdate"><em>'.date('m-d-Y',strtotime($TodayBlogArray->PublishDate)).' by '.$TodayBlogArray->Author.', Posted in '.$TodayBlogArray->CategoryTitle.'</em></div><div class="spacer"></div>';
		$PageArea .= '<div class="blogpost">'.$newcontent.'</div>';
		$PageArea .='</div></div>';

} else {

	if (($Section == 'Pages') || ($Section == 'Extras')){
		if (($PeelOne != '') || ($PeelTwo != '') || ($PeelThree != '') || ($PeelFour != '')) {
					$PageArea .= '<center><div id="peeldiv" align="left" style="width:'.$Width.'px; background-color:#'.$ControlBarBGColor.';"><table cellspacing="0" cellpadding="0" border="0"><tr>';
					if ($ReaderType == 'flash') 
						$PageArea .= '<td width="10"></td>';					
					$PageArea .= '<td><div class="peeltabactive" onclick="peelpage(\'pagediv\');finaltab();" id="finaltab">FINAL</div></td><td width="5"></td>';
					if ($PeelThree != '') 
						$PageArea .= '<td><div class="peeltabinactive" onclick="peelpage(\'PeelThree\');threetab();" id="threetab">COLORS</div></td><td width="5"></td>';
					if ($PeelTwo != '') 
						$PageArea .= '<td><div class="peeltabinactive" onclick="peelpage(\'PeelTwo\');twotab();" id="twotab">INKS</div></td><td width="5"></td>';
					if ($PeelOne != '')  
						$PageArea .= '<td><div class="peeltabinactive" onclick="peelpage(\'PeelOne\');onetab();" id="onetab">PENCILS</div></td><td width="5"></td>';
					if ($PeelFour != '') 
						$PageArea .= '<td><div class="peeltabinactive" onclick="peelpage(\'PeelFour\');fourtab();" id="fourtab">SCRIPT</div></td><td id="pdfcell" style="display:none;" valign="top"><a href="http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$ScriptPDF.'" target="_blank"><img src="/'.$PFDIRECTORY.'/templates/common/images/pdf_icon.png" border="0"></a></td>';
					$PageArea .= '</tr></table></div></center>';
			   }
			   
			   $PageArea .= '<div id="pagediv" style="background-color:#'.$PageBGColor.'; width:'.$Width.'px;"><div id="pagereaderdiv" style="z-index:1;">';
				
				if (($FileType != 'flv') && ($FileType != 'swf')) 
					$PageArea .='<img src="http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$Image.'"';
				else if ($FileType =='flv') 
					$VideoFile = 'http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$MediaFile;
				else if ($FileType =='swf') 
					$FlashFile = 'http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$MediaFile;
				
				$PrevPageImage ='http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$PrevPageImage;
				$NextPageImage ='http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$NextPageImage;
				
				if (sizeof($AstArray) > 0) 
						$PageArea .= 'usemap="#hotmap" border="0"';
				if (($FileType != 'flv') && ($FileType != 'swf')) 
					$PageArea .='>';
				
				$PageArea .='</div></div><div id="PeelOne" style="display:none;">';
				/*
			   
				$PageArea .= '<div id="pagediv" style="background-color:#'.$PageBGColor.'; width:'.$Width.'px;"><div id="pagereaderdiv" style="z-index:1;"><img src="';
					
				$PageArea .='http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$Image.'"';
				$PrevPageImage ='http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$PrevPageImage;
			$NextPageImage ='http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$NextPageImage;
				if (sizeof($AstArray) > 0) 
						$PageArea .= 'usemap="#hotmap" border="0"';
				$PageArea .=' onload="resize_frame();"></div></div><div id="PeelOne" style="display:none;">';
					*/
				if ($PeelOne != '') 
						$PageArea .='<img src="http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$PeelOne.'">';
				
					
				$PageArea .='</div><div id="PeelTwo" style="display:none;">';
				if ($PeelTwo != '') 
						$PageArea .='<img src="http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$PeelTwo.'">';
				
				$PageArea .='</div><div id="PeelThree" style="display:none;">';
					
				if ($PeelThree != '') 
						$PageArea .='<img src="http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$PeelThree.'">';
				$PageArea .='</div><div id="PeelFour" style="display:none;">';
					
				if ($PeelFour != '')
						$PageArea .='<img src="http://www.wevolt.com/comics/'.$ComicDir.'/'.$ComicName.'/images/pages/'.$PeelFour.'">';
				
				$PageArea .='</div>';
	}
}
	$PageReader .= $PageArea .'</div>';
if ($ReaderType == 'flash') {
	$ReaderString .= $PageArea;
			//$ReaderString .= '<div id="bottombar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>';
}

if  ($ReaderType == 'html') { 
	$ControlBarString = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>';				
				
	$ButtonString = '<td align="';
					
	if ($NavBarAlignment == 'left') 
			$ButtonString .= 'right';
	else 
			$ButtonString .= 'left';
	$ButtonString .='">';	
	

	//BUILD STANDARD MENUS		
	if ($HomeButtonImage == '')
		$ButtonString .= '<div class="pagelinks">'; 
   
	$ButtonString .= '<span id="HomeButton"><a href="/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			$ButtonString .= $SafeFolder.'/';
		$ButtonString .='">';
	if ($HomeButtonImage != '') {
		$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$HomeButtonImage.'" id="HomeButtonImage" alt="Home" border="0"';
 		if ($HomeButtonRolloverImage != '') {
 			$ButtonString .= ' onMouseOver="swapimage(\'HomeButtonImage\',\''.$HomeButtonRolloverImage.'\')" onMouseOut="swapimage(\'HomeButtonImage\',\''.$HomeButtonImage.'\')"';
 		}
		$ButtonString .= '/>'; 
	} else {
		$ButtonString .= 'Home'; 
	}	
	$ButtonString .= '</a>';
		if ($HomeButtonImage == '') 
					$ButtonString .= '&nbsp;|&nbsp;';
		$ButtonString .='</span>';
	if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
		
	if ($ShowBio == 1) {
	$ButtonString .= '<span id="CreatorButton"><a href="/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			$ButtonString .= $SafeFolder.'/';
		$ButtonString .='creator/">';
	if ($CreatorButtonImage != '') {
		$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CreatorButtonImage.'" id="CreatorButtonImage" alt="Creator" border="0"';
 		if ($CreatorButtonRolloverImage != '') {
 			$ButtonString .= 'onMouseOver="swapimage(\'CreatorButtonImage\',\''.$CreatorButtonRolloverImage.'\')" onMouseOut="swapimage(\'CreatorButtonImage\',\''.$CreatorButtonImage.'\')"';
 		}
		$ButtonString .= '/>';
	} else {
		$ButtonString .= 'Creator'; 
	}
	$ButtonString .= '</a>';
	
		if ($CreatorButtonImage == '') 
					$ButtonString .= '&nbsp;|&nbsp;';
		$ButtonString .='</span>';
	
	if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
	}	
 	if ($Characters == 1) {
 		$ButtonString .= '<span id="CharactersButton"><a href="/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			$ButtonString .= $SafeFolder.'/';
		$ButtonString .='characters/">';
 		if ($CharactersButtonImage != '') {
			$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CharactersButtonImage.'" id="CharactersButtonImage" alt="Characters" border="0"';
 			if ($CharactersButtonRolloverImage != '') {
				$ButtonString .= 'onMouseOver="swapimage(\'CharactersButtonImage\',\''.$CharactersButtonRolloverImage.'\')" onMouseOut="swapimage(\'CharactersButtonImage\',\''.$CharactersButtonImage.'\')"';
 			}	
			$ButtonString .= '/>';
		} else {
			$ButtonString .= 'Characters'; 
		}
		$ButtonString .= '</a>';
		if ($CharactersButtonImage == '') 
					$ButtonString .= '&nbsp;|&nbsp;';
				$ButtonString .='</span>';
		if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
	} 

	if ($Downloads == 1) {
 		$ButtonString .= '<span id="DownloadsButton"><a href="/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			$ButtonString .= $SafeFolder.'/';
		$ButtonString .='downloads/">';
		if ($DownloadsButtonImage != '') {
			$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$DownloadsButtonImage.'" id="DownloadsButtonImage" alt="Downloads" border="0"';
 			if ($DownloadsButtonRolloverImage != '') {
 					$ButtonString .= 'onMouseOver="swapimage(\'DownloadsButtonImage\',\''.$DownloadsButtonRolloverImage.'\')" onMouseOut="swapimage(\'DownloadsButtonImage\',\''.$DownloadsButtonImage.'\')"';
 			}
			$ButtonString .= '/>';
		} else {
			$ButtonString .= 'Downloads'; 
		}
		$ButtonString .= '</a>';
		if ($DownloadsButtonImage == '') 
					$ButtonString .= '&nbsp;|&nbsp;';
					$ButtonString .='</span>';
		if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
 	}

	if ($Extras == 1) {
 		$ButtonString .= '<span id="ExtrasButton"><a href="/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			$ButtonString .= $SafeFolder.'/';
		$ButtonString .='extras/">';
			if ($ExtrasButtonImage != '') {
				$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$ExtrasButtonImage.'" id="ExtrasButtonImage" alt="Extras" border="0"';
				if ($ExtrasButtonRolloverImage != '') {
 					$ButtonString .= 'onMouseOver="swapimage(\'ExtrasButtonImage\',\''.$ExtrasButtonRolloverImage.'\')" onMouseOut="swapimage(\'ExtrasButtonImage\',\''.$ExtrasButtonImage.'\')"';
 				}
				$ButtonString .= '/>';
			} else {
				$ButtonString .= 'Extras'; 
			}
			$ButtonString .= '</a>';
			if ($ExtrasButtonImage == '') 
					$ButtonString .= '&nbsp;|&nbsp;';
					$ButtonString .='</span>';
			if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
	} 
	
	if ($MobileContent == 1) {
 		$ButtonString .= '<span id="MobileButton"><a href="/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			$ButtonString .= $SafeFolder.'/';
		$ButtonString .='mobile/">';
		if ($MobileButtonImage != '') {
			$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$MobileButtonImage.'" id="MobileButtonImage" alt="Mobile" border="0"';
 			if ($MobileButtonRolloverImage != '') {
 					$ButtonString .= 'onMouseOver="swapimage(\'MobileButtonImage\',\''.$MobileButtonRolloverImage.'\')" onMouseOut="swapimage(\'MobileButtonImage\',\''.$MobileButtonImage.'\')"';
 			}
			$ButtonString .= '/>';
		} else {
			$ButtonString .= 'Mobile'; 
		}
		$ButtonString .= '</a>';
		if ($MobileButtonImage == '') 
					$ButtonString .= '&nbsp;|&nbsp;';
					$ButtonString .='</span>';
		if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
 	}
	
	if ($Products == 1) {
 		$ButtonString .= '<span id="ProductsButton"><a href="/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			$ButtonString .= $SafeFolder.'/';
		$ButtonString .='products/">';
		if ($ProductsButtonImage != '') {
			$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$ProductsButtonImage.'" id="ProductsButtonImage" alt="Products" border="0"';
 			if ($ProductsButtonRolloverImage != '') {
 					$ButtonString .= 'onMouseOver="swapimage(\'ProductsButtonImage\',\''.$ProductsButtonRolloverImage.'\')" onMouseOut="swapimage(\'ProductsButtonImage\',\''.$ProductsButtonImage.'\')"';
 			}
			$ButtonString .= '/>';
		} else {
			$ButtonString .= 'Products'; 
		}
		$ButtonString .= '</a>';
		if ($ProductsButtonImage == '')  
					$ButtonString .= '&nbsp;|&nbsp;';
					$ButtonString .='</span>';
		if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
 	}
	
	if ($bcounter > 0) {
 		$ButtonString .= '<span id="BlogButton"><a href="/'.$SafeFolder.'/';
	//if (($ComicFolder != '') && ($ComicFolder != '/'))  
			//$ButtonString .= $ComicFolder.'/';
		$ButtonString .='blog/">';
		if ($ProductsButtonImage != '') {
			$ButtonString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$BlogButtonImage.'" id="BlogButtonImage" alt="Blog" border="0"';
 			if ($BlogButtonRolloverImage != '') {
 					$ButtonString .= 'onMouseOver="swapimage(\'BlogButtonImage\',\''.$BlogButtonRolloverImage.'\')" onMouseOut="swapimage(\'BlogButtonImage\',\''.$BlogButtonImage.'\')"';
 			}
			$ButtonString .= '/>';
		} else {
			$ButtonString .= 'Blog'; 
		}
		$ButtonString .= '</a>';
		if ($BlogButtonImage == '')  
					$ButtonString .= '&nbsp;|&nbsp;';
					$ButtonString .='</span>';
		if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
		$ButtonString .='<br/>';
 	}
	
	$ButtonString .= '</div>';
	if (($MenuOneLayout == 'top') || ($MenuOneLayout == 'bottom')){
		$ButtonString .='</td>';
		$NavString = '<td align="';
					if (($NavBarAlignment =='right')  || ($NavBarAlignment =='center'))
						$NavString .= 'right';
					else 
						$NavString .= 'left';
					$NavString .='">';	
	}				
					
	if ($HomeButtonImage == '') {
					$NavString .= '<div class="pagelinks">'; 
     } else {
					$NavString .= '<div class="buttonlinks">'; 
	}
		
	if ($CurrentIndex != 0) {
		$NavString .= '<span id=\'FirstButton\'><a href="/'.$SafeFolder.'/reader/';
		//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$NavString .= $ComicFolder.'/';
		$NavString .='page/1/">';
		
		$BottomNavString .= '<span id=\'FirstButton\'><a href="/'.$SafeFolder.'/reader/';
		//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$BottomNavString .= $ComicFolder.'/';
		$BottomNavString .='page/1/">';
		
		if ($FirstButtonImage != '') {
			$NavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$FirstButtonImage.'\' id=\'FirstButtonImage\' alt=\'First Page\' border="0"';
			$BottomNavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$FirstButtonImage.'\' id=\'FirstButtonImage_btm\' alt=\'First Page\' border="0"';
			if ($FirstButtonRolloverImage != '') {
				$NavString .= 'onMouseOver="swapimage(\'FirstButtonImage\',\''.$FirstButtonRolloverImage.'\')" onMouseOut="swapimage(\'FirstButtonImage\',\''.$FirstButtonImage.'\')"';
				$BottomNavString .= 'onMouseOver="swapimage(\'FirstButtonImage_btm\',\''.$FirstButtonRolloverImage.'\')" onMouseOut="swapimage(\'FirstButtonImage_btm\',\''.$FirstButtonImage.'\')"';
			}
			$NavString .= '/>';
			$BottomNavString .= '/>';
		} else {
			$NavString .= 'First Page';
			$BottomNavString .= 'First Page';
		}
		$NavString .= '</a>';
		$BottomNavString .= '</a>';
		if ($FirstButtonImage == '') {
					$NavString .= '&nbsp;|&nbsp;';
					$BottomNavString .= '&nbsp;|&nbsp;';
		}
				
		$NavString .='</span>';
		$BottomNavString .='</span>';
		
		if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
			$NavString .='<br/>';
		if (($MenuTwoLayout == 'right') || ($MenuTwoLayout == 'left'))
			$BottomNavString .='<br/>';
	
		$NavString .= '<span id=\'BackButton\'><a href="/'.$SafeFolder.'/reader/';
		//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$NavString .= $ComicFolder.'/';
		$NavString .='page/'.$PrevPage.'/">';
		
		$BottomNavString .= '<span id=\'BackButton\'><a href="/'.$SafeFolder.'/reader/';
		//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$BottomNavString .= $ComicFolder.'/';
		$BottomNavString .='page/'.$PrevPage.'/">';
		
		if ($BackButtonImage != '') {
			$BottomNavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$BackButtonImage.'\' id=\'BackButtonImage_btm\' alt=\'Previous Page\' border="0"';
			$NavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$BackButtonImage.'\' id=\'BackButtonImage\' alt=\'Previous Page\' border="0"';
			if ($BackButtonRolloverImage != '') {
				$NavString .= 'onMouseOver="swapimage(\'BackButtonImage\',\''.$BackButtonRolloverImage.'\')" onMouseOut="swapimage(\'BackButtonImage\',\''.$BackButtonImage.'\')"';
					$BottomNavString .= 'onMouseOver="swapimage(\'BackButtonImage_btm\',\''.$BackButtonRolloverImage.'\')" onMouseOut="swapimage(\'BackButtonImage_btm\',\''.$BackButtonImage.'\')"';
			}
			$NavString .= '/>';
			$BottomNavString .= '/>';
		} else {
			$NavString .= 'Previous Page';
			$BottomNavString .= 'Previous Page';
		}
		$NavString .= '</a>';
		$BottomNavString .= '</a>';
		if ($BackButtonImage == '')  {
					$NavString .= '&nbsp;|&nbsp;'; 
					$BottomNavString .= '&nbsp;|&nbsp;';
		}
		$NavString .='</span>';
		$BottomNavString .='</span>';
			if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
			$NavString .='<br/>';
		if (($MenuTwoLayout == 'right') || ($MenuTwoLayout == 'left'))
			$BottomNavString .='<br/>';
	}
 	if ($CurrentIndex != ($TotalPages-1)) {
	
 		$NavString .= '<span id=\'NextButton\'><a href="/'.$SafeFolder.'/reader/';
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
		//$NavString .= $ComicFolder.'/';
		$NavString .='page/'.$NextPage.'/">';
		
		$BottomNavString .= '<span id=\'NextButton\'><a href="/'.$SafeFolder.'/reader/';
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$BottomNavString .= $ComicFolder.'/';
		$BottomNavString .='page/'.$NextPage.'/">';
		
		if ($NextButtonImage != '') {
			$NavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$NextButtonImage.'\' id=\'NextButtonImage\' alt=\'Next Page\' border="0"';
			$BottomNavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$NextButtonImage.'\' id=\'NextButtonImage_btm\' alt=\'Next Page\' border="0"';
			if ($NextButtonRolloverImage != '') {
				$NavString .= 'onMouseOver="swapimage(\'NextButtonImage\',\''.$NextButtonRolloverImage.'\')" onMouseOut="swapimage(\'NextButtonImage\',\''.$NextButtonImage.'\')"';
				$BottomNavString .= 'onMouseOver="swapimage(\'NextButtonImage_btm\',\''.$NextButtonRolloverImage.'\')" onMouseOut="swapimage(\'NextButtonImage_btm\',\''.$NextButtonImage.'\')"';
			}
			$NavString .= '/>'; 
			$BottomNavString .= '/>'; 
		} else {
			$NavString .= 'Next Page';
			$BottomNavString .= 'Next Page';
		}
		$NavString .= '</a>';
		$BottomNavString .= '</a>';
		if ($NextButtonImage == '') {
					$NavString .= '&nbsp;|&nbsp;';
					$BottomNavString .= '&nbsp;|&nbsp;';
		}
		$NavString .='</span>';
		$BottomNavString .='</span>';
			if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
			$NavString .='<br/>';
		if (($MenuTwoLayout == 'right') || ($MenuTwoLayout == 'left'))
			$BottomNavString .='<br/>';
		$NavString .= '<span id=\'LastButton\'><a href="/'.$SafeFolder.'/reader/';
		//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$NavString .= $ComicFolder.'/';
		$NavString .='page/'.$lastpage.'/">';
		
		$BottomNavString .= '<span id=\'LastButton\'><a href="/'.$SafeFolder.'/reader/';
		//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$BottomNavString .= $ComicFolder.'/';
		$BottomNavString .='page/'.$lastpage.'/">';
		
		
		
		if ($LastButtonImage != '') {
			$NavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$LastButtonImage.'\' id=\'LastButtonImage\' alt=\'Last Page\' border="0"';
			$BottomNavString .= '<img src=\'/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$LastButtonImage.'\' id=\'LastButtonImage_btm\' alt=\'Last Page\' border="0"';
		if ($LastButtonRolloverImage != '') {
			$NavString .= 'onMouseOver="swapimage(\'LastButtonImage\',\''.$LastButtonRolloverImage.'\')" onMouseOut="swapimage(\'LastButtonImage\',\''.$LastButtonImage.'\')"';
				$BottomNavString .= 'onMouseOver="swapimage(\'LastButtonImage_btm\',\''.$LastButtonRolloverImage.'\')" onMouseOut="swapimage(\'LastButtonImage_btm\',\''.$LastButtonImage.'\')"';
		}
		$NavString .= '/>';
			$BottomNavString .= '/>';
		} else {
			$NavString .= 'Last Page';
			$BottomNavString .= 'Last Page';
		}
		$NavString .= '</a>';
		$BottomNavString .= '</a>';

					$NavString .= '</span>';
					$BottomNavString .= '</span>';
		if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))
			$NavString .='<br/>';
		if (($MenuTwoLayout == 'right') || ($MenuTwoLayout == 'left'))
			$BottomNavString .='<br/>';

	}
	$NavString .= '</div></td>';
	
	if (($NavBarPlacement== 'top') || ($NavBarPlacement== 'both')) {
			if (($NavBarAlignment == 'right') || ($NavBarAlignment == 'center')) {
				$ControlBarString .= $ButtonString.$NavString;
			} else {
				$ControlBarString .= $NavString.$ButtonString;
			}
	}
		
	$ControlBarString .= '</tr></table>';


	$StandardMenuOne = '<table cellpadding="0" cellspacing="0" border="0"';
	
	if (($MenuOneLayout == 'top') || ($MenuOneLayout == 'bottom'))	
		 	$StandardMenuOne .= 'width="'.$Width.'"';
	 
	$StandardMenuOne .= '><tr><td><div id="ControlBar">'.$ControlBarString.'</div></td></tr></table>';
	
	
	$MenuOneString = '<table cellpadding="0" cellspacing="0" border="0"';
	
	if (($MenuOneLayout == 'top') || ($MenuOneLayout == 'bottom'))	
		 	$MenuOneString .= 'width="'.$Width.'"';
			
	 $MenuOneString .= '><tr><td><div id="ControlBar"><div align=\'left\'>'.$CustomMenuOneString.'</div></td></tr></table>';
		
		$StandardMenuTwo = '<table cellpadding="0" cellspacing="0" border="0"';
	
		if (($MenuTwoLayout == 'top') || ($MenuTwoLayout == 'bottom'))	
		 	$StandardMenuTwo .= 'width="'.$Width.'"';
	 
		$StandardMenuTwo .= '><tr><td><div id="ControlBar"><div align=\''.$NavBarAlignment.'\'>'.$BottomNavString.'</div></div></td></tr></table>';
		
		$MenuTwoString = '<table cellpadding="0" cellspacing="0" border="0"';
	
		if (($MenuTwoLayout == 'top') || ($MenuTwoLayout == 'bottom'))	
		 	$MenuTwoString .= 'width="'.$Width.'"';
			
	 	$MenuTwoString .= '><tr><td><div id="ControlBar"><div align=\''.$NavBarAlignment.'\'>'.$CustomMenuTwoString.'</div></td></tr></table>';
		
	/*
	if (($MenuOneLayout == 'top') && ($MenuOneCustom == 0))
		$ReaderString .= $StandardMenuOne;
	else if (($MenuOneLayout == 'top') && ($MenuOneCustom==1))
		$ReaderString .= $MenuOneString;
	
	if (($MenuTwoLayout == 'top') && ($MenuTwoCustom == 0))
		$ReaderString .= $StandardMenuTwo;
	else if (($MenuTwoLayout == 'top') && ($MenuTwoCustom==1))
		$ReaderString .= $MenuTwoString;
		*/
	$SiteHeaderString = $ReaderString;
	$ReaderString .= $PageArea;
	/*		
	if (($MenuOneLayout == 'bottom') && ($MenuOneCustom == 0))
		$ReaderString .= $StandardMenuOne;
	else if (($MenuOneLayout == 'top') && ($MenuOneCustom==1))
		$ReaderString .= $MenuOneString;
	
	if (($MenuTwoLayout == 'bottom') && ($MenuTwoCustom == 0))
		$ReaderString .= $StandardMenuTwo;
	else if (($MenuTwoLayout == 'bottom') && ($MenuTwoCustom==1))
		$ReaderString .= $MenuTwoString;
		
	*/
} 

?>
<?
$ReaderString .='</td>';
if ($PositionThree == 1){ 
	$InsertAdThree = 0;
	$InsertAdTwo = 0;
	if ($TEMPLATE == 'TPL-002') {
		$InsertAdThree = 1;
	} else {
		$ReaderString .='<td valign="top" align="center" ';
	 	if ($PositionFour == 1) 
			$ReaderString .='rowspan="2"';
			
	  	$ReaderString .='><div>'.$PositionThreeAdCode."</div>";
		
 	}
}

$ReaderString .='</tr>';
$ReaderString .='<td valign="top" align="center" >';
if ($IsPro == 0) 
	$ReaderString .=$AdBox;
else if ($PositionFour == 1) 
	$ReaderString .='<div>'.$PositionFourAdCode."</div>";

$ReaderString .='</td>';
$ReaderString .='</table><div class="END OF READER STRING"></div>';
$HomeReaderString = $ReaderString;
$FullLastPageUrl = 'http://www.w3volt.com/'.$SafeFolder.'/reader/page/'.$lastpage.'/';
		$FullFirstPageUrl = 'http://www.w3volt.com/'.$SafeFolder.'/reader/page/1/';
		$FullBackPageUrl = 'http://www.w3volt.com/'.$SafeFolder.'/reader/page/'.$PrevPage.'/';
		$FullNextPageUrl = 'http://www.w3volt.com/'.$SafeFolder.'/reader/page/'.$NextPage.'/';
//$ReaderString = '';

?>
