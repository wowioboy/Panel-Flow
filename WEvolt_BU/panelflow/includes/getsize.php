<?php
$Source_pic = $_POST['source_pic'];
list($width,$height)=getimagesize($Source_pic);

echo "&imagewidth=".$width."&imageheight=".$height;
?>
