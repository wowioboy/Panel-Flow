<div align="center">
	<?php if (is_authed()) {?>
	<?php if ($_SESSION['usertype'] == 1){?>

		<a href ="../<? echo $PFDIRECTORY;?>/admin.php?id=<? echo $ComicID;?>"><img src="../images/admin_btn.jpg" border="0"/></a> 
	<?php } else if ($_SESSION['usertype'] == 0){ ?>
	
		<div align="center"><form method="POST" action="index.php?id=<?php echo $PageID; ?>">
		<input type="hidden" name="addfav" id="addfav" value="1">
	<input type="image"  src="../images/favorites.jpg" value="ADD TO FAVORITES" style="border:0;" />
	</form>
	<div class="medspacer"></div> 
	<a href="http://www.panelflow.com/viewcomic.php?comicid=<? echo $ComicID ?>" target="_blank"><img src="../images/vote.jpg" border="0"/></a>
	</div>
	
		<?php }?>
		<?php } else {  
		
		echo "Log in to access user controls for this comic.";
		
		} ?>
	</div>