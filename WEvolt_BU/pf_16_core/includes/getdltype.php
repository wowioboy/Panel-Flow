<?php
$Source_dir = $_POST['source_dir'];
$DLtype = $_POST['dltype'];
$Filename = $_POST['filename'];

$image_type = strstr($Filename,  '.');
  switch($image_type) {
       case '.jpg':
             $source = imagecreatefromjpeg($Source_dir.$Filename);
              break;
            case '.png':
                $source = imagecreatefrompng($Source_dir.$Filename);
                break;
            case '.gif':
                $source = imagecreatefromgif($Source_dir.$Filename);
                break;
            default:
                echo("Error Invalid Image Type");
                die;
                break;
            }
   
$originalimage = $Source_dir.$Filename;
list($width,$height)=getimagesize($originalimage);

if ($DLtype == 1) {
$DownloadImage = "../images/downloads/desktops/".$Filename;
$DownloadThumb = "../images/downloads/desktops/thumbs/".$Filename;
copy($originalimage,$DownloadImage);
$thumb = imagecreatetruecolor(200,  160);
imagecopyresized($thumb,  $source,  0,  0,  0,  0,  200,  160,  $width,  $height);
imagejpeg($thumb,  $DownloadThumb,  80);
chmod($DownloadThumb, 0777);
chmod($DownloadImage, 0777);

}

if ($DLtype == 2) {
$DownloadImage = "../images/downloads/covers/".$Filename;
$DownloadThumb = "../images/downloads/covers/thumbs/".$Filename;
copy($originalimage,$DownloadImage);
$thumb = imagecreatetruecolor(150,  175);
imagecopyresized($thumb,  $source,  0,  0,  0,  0,  150, 175,  $width,  $height);
imagejpeg($thumb,  $DownloadThumb,  80);
chmod($DownloadThumb, 0777);
chmod($DownloadImage, 0777);
}

if ($DLtype == 3) {
$DownloadImage = "../images/downloads/avatars/".$Filename;
$DownloadThumb = "../images/downloads/avatars/".$Filename;
copy($originalimage,$DownloadImage);
$convertString = "convert $DownloadImage -resize 100 $DownloadThumb";
exec($convertString);
chmod($DownloadThumb, 0777);
chmod($DownloadImage, 0777);
}

echo "&imagewidth=".$width."&imageheight=".$height;
?>