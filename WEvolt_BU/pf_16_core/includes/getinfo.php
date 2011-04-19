<?php
$Source_dir = $_POST['source_dir'];
$Filename = $_POST['filename'];
$Section = $_POST['section'];

list($width,$height)=getimagesize($Source_dir.$Filename);

$originalimage = $Source_dir.$Filename;

$ext = substr(strrchr($Filename, "."), 1);

$randName = md5(rand() * time());

$filePath = $Source_dir . $randName . '.' . $ext;

$Finalimage = $filePath;

if ($width > 1024) {
$convertString = "convert $originalimage -resize 1024 $Finalimage";
exec($convertString);
chmod($characterimage, 0777);
list($width,$height)=getimagesize($Finalimage);
} else {
copy($originalimage,$Finalimage);
}
if ($Section == 'pages') {
$pagethumb = "../images/pages/thumbs/".$randName . '.' . $ext;
$chapterthumb = "../images/pages/largethumbs/".$randName . '.' . $ext;
} else if ($Section == 'extra') {
$pagethumb = "../images/extras/thumbs/".$randName . '.' . $ext;
}
$imgSrc = $Finalimage;   
   
//getting the image dimensions  
 list($width, $height) = getimagesize($imgSrc);   
 //saving the image into memory (for manipulation with GD Library)  
 $myImage = imagecreatefromjpeg($imgSrc);      
 ///--------------------------------------------------------  
 //setting the crop size  
 //--------------------------------------------------------  
 if($width > $height) $biggestSide = $width;   
 else $biggestSide = $height;   
    
 //The crop size will be half that of the largest side   
 $cropPercent = .6;   
 $cropPercentwidth = .5; 
 $cropWidth   = $biggestSide*$cropPercentwidth;   
 $cropHeight  = $biggestSide*$cropPercent;   
    
    
 //getting the top left coordinate  
 $c1 = array("x"=>($width-$cropWidth)/2, "y"=>($height-$cropHeight)/2);  
    
  //--------------------------------------------------------  
 // Creating the thumbnail  
 //--------------------------------------------------------  
 $thumbwidth = 110;
 $thumbheight = 70;   
 $thumb = imagecreatetruecolor($thumbwidth, $thumbheight);   
 imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbwidth, $thumbheight, $cropWidth, $cropHeight);   
  imagejpeg($thumb,$pagethumb);  
  imagedestroy($thumb); 
  chmod($pagethumb, 0777);
  //Create Episode and Chapter Thumb
 $thumbwidth = 150;
 $thumbheight = 200;   
 $thumb = imagecreatetruecolor($thumbwidth, $thumbheight);   
 imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbwidth, $thumbheight, $cropWidth, $cropHeight);   
  imagejpeg($thumb,$chapterthumb);  
  imagedestroy($thumb); 
  chmod($chapterthumb, 0777);
unlink($originalimage);

// ... same code as before
echo "&newfilename=".$randName . "." . $ext."&imagewidth=".$width."&imageheight=".$height;
?>
