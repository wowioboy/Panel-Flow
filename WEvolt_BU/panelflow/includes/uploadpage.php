<?php
//create the directory if doesn't exists (should have write permissons)
if(!is_dir("../temp")) mkdir("../temp", 0755); 
//move the uploaded file
move_uploaded_file($_FILES['Filedata']['tmp_name'], "../temp/". $_FILES['Filedata']['name']);
chmod("../temp/". $_FILES['Filedata']['name'], 0777);


?>

