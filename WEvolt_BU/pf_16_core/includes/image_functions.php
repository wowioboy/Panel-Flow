<? 
function get_dpi_x($filename){
		list($width,$height)=getimagesize($filename);
        $a = fopen($filename,'r');
		$string = fread($a,20);
		fclose($a);
   		$data = bin2hex(substr($string,14,4));
    	$x = substr($data,0,4);
	//print 'MY y = ' . $y; 
    return hexdec($x);

}
function get_dpi_y($filename){
	
        $a = fopen($filename,'r');
		$string = fread($a,20);
		fclose($a);
   		$data = bin2hex(substr($string,14,4));
    	$y = substr($data,4,4);
	//print 'MY y = ' . $y; 
    return hexdec($y);

}
function get_print_width($width,$dpi) {
		$Inches = $width/$dpi;
		
		return $Inches;
}

function get_print_height($height,$dpi) {
		$Inches = $height/$dpi;

		return $Inches;
}
function createThumb($spath, $dpath, $maxd) {
 $src=@imagecreatefromjpeg($spath);
 if (!$src) {return false;} else {
  $srcw=imagesx($src);
  $srch=imagesy($src);
  if ($srcw<$srch) {$height=$maxd;$width=floor($srcw*$height/$srch);}
  else {$width=$maxd;$height=floor($srch*$width/$srcw);}
  if ($width>$srcw && $height>$srch) {$width=$srcw;$height=$srch;}  //if image is actually smaller than you want, leave small (remove this line to resize anyway)
  $thumb=imagecreatetruecolor($width, $height);
  imagecopyresampled($thumb, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));
  imagejpeg($thumb, $dpath);
  return true;
 }
}


function rotateImage($sourceFile,$destImageName,$degreeOfRotation)
{
  //function to rotate an image in PHP
  //developed by Roshan Bhattara (http://roshanbh.com.np)

  //get the detail of the image
  $imageinfo=getimagesize($sourceFile);
  switch($imageinfo['mime'])
  {
   //create the image according to the content type
   case 'image/jpg':
   $src_img = imagecreatefromjpeg($sourceFile);
                break;
   case 'image/jpeg':
   $src_img = imagecreatefromjpeg($sourceFile);
                break;
   case 'image/pjpeg': //for IE
        $src_img = imagecreatefromjpeg($sourceFile);
                break;
    case 'image/gif':
        $src_img = imagecreatefromgif($sourceFile);
                break;
    case 'image/pn':
        case 'image/x-png': //for IE
        $src_img = imagecreatefrompng($sourceFile);
                break;
  }
  //rotate the image according to the spcified degree
  $src_img = imagerotate($src_img, $degreeOfRotation, 0);
  //output the image to a file
  imagejpeg ($src_img,$destImageName);
}
?>