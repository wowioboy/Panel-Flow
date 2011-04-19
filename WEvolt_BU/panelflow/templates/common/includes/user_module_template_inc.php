<? 
//USER MODULE 
$UserModuleString ='<div align="center">';
 if (is_authed()) {
		$UserModuleString .='<div align="center"><form method="POST" action="index.php?id='.$PageID.'">'.
		'<input type="hidden" name="addfav" id="addfav" value="1">'.
	'<input type="image"  src="../images/favorites.jpg" value="ADD TO FAVORITES" style="border:0;" />'.
	'</form>'.
	'<div class="medspacer"></div>'. 
	'<a href="http://www.panelflow.com/viewcomic.php?comicid='.$ComicID.'" target="_blank"><img src="../images/vote.jpg" border="0"/></a>'.
	'</div>';
} else {  
$UserModuleString .="Log in to access user controls for this comic.";
		
		} 
$UserModuleString .="</div>";
?>