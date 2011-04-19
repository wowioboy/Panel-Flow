<? 

$PDFsString = "";
$PDFCount = 0;
$query = "select * from products where ComicID = '$ComicID' and IsActive=1 and (ProductType='selfpdf' or ProductType='pdf' or ProductType='ebook') order by Position";
$InitDB->query($query);
$PDFs = $InitDB->numRows();
 $PDFsString = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->ProductType;
$Price = $download->Price;
if ($Price == '') 
	$Price = 'FREE';
else 
	$Price = '$'.$Price;
$DlThumb = $download->ThumbMd;

$DLDescription = stripslashes($download->Description);
	$PDFsString .= "<td  align='center'><div class='downloadimage'><img src='http://www.panelflow.com/".$DlThumb."'  border='1' style='border-color:#000000;'></div><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."<br/>".$Price."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/products/".$DownID."/' target='blank'>[MORE INFO]</a></div><div class='spacer'></div></td>";
	$PDFCount++;
	if ($PDFCount == 4){
 			$PDFsString .= "</tr><tr>";
 			$PDFCount = 0;
 	}
	
}
if 	($PDFCount < 4){
		while($PDFCount <4) {
			$PDFsString .= "<td></td>";
			$PDFCount++;
		}
	}
 $PDFsString .= "</tr></table>";
 
 $PrintsString = "";
$PrintsCount = 0;
$query = "select * from products where ComicID = '$ComicID' and IsActive=1 and (ProductType='selfprint' or ProductType='podprint') order by Position";
$InitDB->query($query);
$Prints = $InitDB->numRows();
 $PrintsString = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->ProductType;
$DlThumb = $download->ThumbMd;
$Price = $download->Price;
if ($Price == '') 
	$Price = 'FREE';
else 
	$Price = '$'.$Price;

$DLDescription = stripslashes($download->Description);
	$PrintsString .= "<td  align='center'><div class='downloadimage'><img src='http://www.panelflow.com/";


		$PrintsString .= $DlThumb."'  border='1' style='border-color:#000000;'></div><div class='dltitle'><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."<br/>".$Price."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/products/".$DownID."/' target='blank'>[MORE INFO]</a></div><div class='spacer'></div></div></td>";
	$PrintsCount++;
	if ($PrintsCount == 4){
 			$PrintsString .= "</tr><tr>";
 			$PrintsCount = 0;
 	}
	
}
if 	($PrintsCount < 4){
		while($PrintsCount <4) {
			$PrintsString .= "<td></td>";
			$PrintsCount++;
		}
	}
 $PrintsString .= "</tr></table>";
 
$BooksString = "";
$BooksCount = 0;
$query = "select * from products where ComicID = '$ComicID' and IsActive=1 and (ProductType='selfbook' or ProductType='podbook') order by Position";
$InitDB->query($query);
$Books = $InitDB->numRows();
 $BooksString = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->ProductType;
$DlThumb = $download->ThumbMd;
$Price = $download->Price;
if ($Price == '') 
	$Price = 'FREE';
else 
	$Price = '$'.$Price;
$DLDescription = stripslashes($download->Description);
	$BooksString .= "<td  align='center'><div class='downloadimage'><img src='http://www.panelflow.com/";


		$BooksString .= $DlThumb."'  border='1' style='border-color:#000000;' ></div><div class='dltitle'><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."<br/>".$Price."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/products/".$DownID."/' target='blank'>[MORE INFO]</a></div><div class='spacer'></div></div></td>";
	$BooksCount++;
	if ($BooksCount == 4){
 			$BooksString .= "</tr><tr>";
 			$BooksCount = 0;
 	}
	
}
if 	($BooksCount < 4){
		while($BooksCount <4) {
			$BooksString .= "<td></td>";
			$BooksCount++;
		}
	}
 $BooksString .= "</tr></table>";
 
 $OtherMerchString = "";
$MerchCount = 0;
$query = "select * from products where ComicID = '$ComicID' and IsActive=1 and (ProductType='selfmerch' or ProductType='podmerch') order by Position";
$InitDB->query($query);
$Merch = $InitDB->numRows();
 $OtherMerchString = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->ProductType;
$Category = $download->ProductCategory;
$DlThumb = $download->ThumbMd;
$Price = $download->Price;
if ($Price == '') 
	$Price = 'FREE';
else 
	$Price = '$'.$Price;
$DLDescription = stripslashes($download->Description);
	$OtherMerchString .= "<td align='center'><div class='downloadimage'><img src='http://www.panelflow.com/".$DlThumb."'  border='1' style='border-color:#000000;'></div><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."<br/>".$Price."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/products/".$DownID."/' target='blank'>[MORE INFO]</a></div><div class='spacer'></div></td>";
	$MerchCount++;
	if ($MerchCount == 4){
 			$OtherMerchString .= "</tr><tr>";
 			$MerchCount = 0;
 	}
	
}
if 	($MerchCount < 4){
		while($MerchCount <4) {
			$OtherMerchString .= "<td></td>";
			$MerchCount++;
		}
	}
 $OtherMerchString .= "</tr></table>";
  
 $DigitalString = "";
$DigitalCount = 0;
$query = "select * from products where ComicID = '$ComicID' and ProductType = 'digital'";
$InitDB->query($query);
$Digital = $InitDB->numRows();
 $DigitalString = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->ProductType;
$Category = $download->ProductCategory;
$DlThumb = $download->ThumbMd;
$Price = $download->Price;
if ($Price == '') 
	$Price = 'FREE';
else 
	$Price = '$'.$Price;
$DLDescription = stripslashes($download->Description);
	$DigitalString .= "<td align='center'><div class='downloadimage'><img src='http://www.panelflow.com/".$DlThumb."'  border='1' style='border-color:#000000;'></div><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."<br/>".$Price."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/products/".$DownID."/' target='blank'>[MORE INFO]</a></div><div class='spacer'></div></td>";
	$DigitalCount++;
	if ($DigitalCount == 4){
 			$DigitalString .= "</tr><tr>";
 			$DigitalCount = 0;
 	}
	
}
if 	($DigitalCount < 4){
		while($DigitalCount <4) {
			$DigitalString .= "<td></td>";
			$DigitalCount++;
		}
	}
 $DigitalString .= "</tr></table>";
  

$Title = 'Products';
?>