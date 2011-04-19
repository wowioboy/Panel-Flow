<? 
$filename = "tst.php";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$content = file_get_contents('http://www.wevolt.com/tst.php');
print 'CONTENT = ' . $contents;?>
