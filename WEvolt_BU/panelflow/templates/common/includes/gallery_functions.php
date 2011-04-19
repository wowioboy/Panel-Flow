<?php 
if (!isset($_GET['gid'])) {
	$query = "SELECT g.*, gc.ThumbMd as GallThumb, (SELECT count(*) from pf_gallery_content as gc2 where gc2.GalleryID=g.EncryptID) as Items,
	(SELECT count(DISTINCT CategoryID) from pf_gallery_content as gc3 where gc3.GalleryID=g.EncryptID) as TotalCats
			  from pf_galleries as g
			  left join pf_gallery_content as gc on (gc.GalleryID=g.EncryptID and gc.GalleryThumb=1)
			  where g.ProjectID ='$ProjectID'";
	$InitDB->query($query);
		while ($line = $InitDB->fetchNextObject()) { 
						
			$GalleryType = $GalleryType;
			
			if ($line->GallThumb == '')
				$Thumb = 'pf_16_core/images/no_thumb.jpg';
			else 
				$Thumb = $line->GallThumb;

			$Description = 	$line->Description;
						
			$GalleryContentString .='<table width="500"><tr><td valign="top" class="projectboxcontent" width="150"><a href="/'.$SafeFolder.'/'.$ContentUrl.'/?gid='.urlencode($line->EncryptID).'"><img src="/'.$Thumb.'" align="left" vspace="5" hspace="5" border="0"></a></td><td valign="top" style="padding-left:10px;"><div class="globalheader">'.$line->Title.'</div><br/><b>Gallery Type</b>: '.$line->GalleryType.'<br/><b>Total Items</b>: '.$line->Items.'<br/><b>Total Categories</b>: '.$line->TotalCats.'<br/><a href="/'.$SafeFolder.'/'.$ContentUrl.'/?gid='.urlencode($line->Title).'">VIEW GALLERY</a><br/>'.$Description.'</td></tr></table><div class="spacer"></div>';
						
	}					
 } else if ((isset($_GET['gid'])) && (!isset($_GET['item']))) {
			// SHOW READER0
				include_once($_SERVER['DOCUMENT_ROOT'].'/'.$PFDIRECTORY.'/classes/pagination.php');
			    $query = "SELECT * from pf_gallery_content where GalleryID='".$_GET['gid']."' order by Position ASC";
			    $pagination    =    new pagination();  
				print $query;
			    $pagination->createPaging($query,20); 
					$DownloadsString = '';
					$GalleryContentString = "<table  border='0' cellspacing='0' cellpadding='0'><tr>";
					while($line=mysql_fetch_object($pagination->resultpage)) {
						$GalleryContentString .= "<td width='110'><a href='/".$SafeFolder."/".$ContentUrl."/?gid=".$_GET['gid']."&item=".$line->EncryptID."' border='1' ><img src='/".$line->Thumb100."' class='g_module_thumb' vspace='5' hspace='5'></td>";
						if ($Count == 5) {
							$GalleryContentString .= "</tr><tr>";
							$Count = 1;
						} else {
							$Count++;
						}
					
					}
					if (($Count < 5) && ($Count != 1)) {
							while ($Count <=5) {
								$GalleryContentString .= '<td></td>';	
								$Count++;
							}
					
					}
					$GalleryContentString .= '</tr></table>';	
			}  else if ((isset($_GET['gid'])) && (isset($_GET['item']))) {
			   $query = "SELECT * from pf_gallery_content where GalleryID='".$_GET['gid']."' and EncryptID='".$_GET['item']."'";
			    $ContentItemArray = $InitDB->queryUniqueObject($query);
				$GalleryContentString = '<img src="/'.$ContentItemArray->GalleryImage.'" title="'.$ContentItemArray->Title.'">';
				
				
			} 
			
			
?>