<?php 
$Filename = $_POST['txtFilename']; 
$Section = $_POST['txtSection'];

if ($Section == 'extras') {
$link = '../temp/'.$Filename;
} else if ($Section == 'creator') {
$link = '../creators/'.$Filename;
} else {
$link = '../temp/'.$Filename;
}

print $link;


if (file_exists($link)) {
    echo '&fileresult=Found';
} else {
    echo '&fileresult=Not found';
}

?>