<?
function build_menu_link($LinkType, $Url, $Target, $ButtonImage, $RolloverImage, $Title) {
$MenuLinkString = '';
global $ComicFolder, $PFDIRECTORY, $CurrentIndex, $TotalPages,$FirstPage, $NextPage, $PrevPage, $lastpage,$BaseComicDirectory;
$FirstPage = 'page/1/';
	$MenuLinkString .= '<span class="global_button"><a href="';
	if (($LinkType == 'section') || ($LinkType == 'blog')) {
		$MenuLinkString .= '/';
		if (($ComicFolder != '') && ($ComicFolder != '/')) 
				$MenuLinkString .= $ComicFolder.'/';
		$MenuLinkString .= $Url;	
		$MenuLinkString .='">';
	} else if ($LinkType == 'page') {
		$MenuLinkString .= '/';
		if (($ComicFolder != '') && ($ComicFolder != '/')) 
				$MenuLinkString .= $ComicFolder.'/';
			
		if ($Url == '{FirstPage}')
			$Url = $FirstPage;
		else if ($Url == '{NextPage}')
				$Url = 'page/'.$NextPage.'/';
		else if ($Url == '{PrevPage}')
				$Url = 'page/'.$PrevPage.'/';
		else if ($Url == '{LastPage}')
				$Url = 'page/'.$lastpage.'/';
				
		$MenuLinkString .= $Url;	
			
		$MenuLinkString .='">';
	
	} else if ($LinkType == 'external') {
		$MenuLinkString .= $Url.'" target="'.$Target.'">';	
	}
	
	if ($ButtonImage != '') {
		//print 'ButtonImage = ' . $ButtonImage;
		$ButtonImagePath = $BaseComicDirectory.'images/'.$ButtonImage;
		$RolloverImagePath = $BaseComicDirectory.'images/'.$RolloverImage;
		//print 'ButtonImagePath = ' . $ButtonImagePath;
		$MenuLinkString .= '<img src="'.$ButtonImagePath.'" id="button_'.$ButtonImage.'" alt="'.$Title.'" border="0"';
 		if ($RolloverImage != '') {
 			$MenuLinkString .= ' onMouseOver="swapMenuimage(\'button_'.$ButtonImage.'\',\''.$RolloverImagePath.'\');" onMouseOut="swapMenuimage(\'button_'.$ButtonImage.'\',\''.$ButtonImagePath.'\');"';
 		}
		$MenuLinkString .= '/>'; 
	} else {
		$MenuLinkString .= stripslashes($Title); 
	}	
	$MenuLinkString .= '</a>';
	
	if ($ButtonImage == '') 
			$MenuLinkString .= '&nbsp;&nbsp;';
	$MenuLinkString .='</span>';

return $MenuLinkString;
}


$CustomMenuOneString ='';
$CustomMenuTwoString ='';
$BCount = 0;
if ($MenuOneLinks == null)
	$MenuOneLinks  = array();

if ($MenuOneCustom == 1) {
	foreach ($MenuOneLinks as $menu) {
			$LinkType = $menu['LinkType'];
			$Url = $menu['Url'];
			$Target = $menu['Target'];
			$ButtonMouseImage = $menu['ButtonImage'];
			$RolloverImage = $menu['RolloverImage'];
			$MenuTitle = $menu['Title'];
			if ($BCount == 0) {
				
					$CustomMenuOneString .= '<div class="pagelinks">'; 
				
			}
			$CustomMenuOneString .= build_menu_link($LinkType, $Url, $Target, $ButtonMouseImage, $RolloverImage, $MenuTitle);
			if (($MenuOneLayout == 'right') || ($MenuOneLayout == 'left'))	
				$CustomMenuOneString .='<br/>';
	$BCount++;
	}
	$CustomMenuOneString .= '</div>';

}
if ($MenuTwoLinks == null)
	$MenuTwoLinks  = array();
$BCount = 0;
if ($MenuTwoCustom == 1) {
	foreach ($MenuTwoLinks as $menu) {
			$LinkType = $menu['LinkType'];
			$Url = $menu['Url'];
			$Target = $menu['Target'];
			$ButtonMouseImage = $menu['ButtonImage'];
			$RolloverImage = $menu['RolloverImage'];
			$MenuTitle = $menu['Title'];
			if ($BCount == 0) {
				
					$CustomMenuTwoString .= '<div class="pagelinks">'; 
				
			}
			$CustomMenuTwoString .= build_menu_link($LinkType, $Url, $Target, $ButtonMouseImage, $RolloverImage, $MenuTitle);
			if (($MenuTwoLayout == 'right') || ($MenuTwoLayout == 'left'))	
				$CustomMenuTwoString .='<br/>';
	$BCount++;
	}
	$CustomMenuTwoString .= '</div>';

}

		
?>