<?php 

function checklink($link)
{
if(!($handle=@fopen($link,'r')))
	{
		return 'Not Found';

	} else {
	$content = file_get_contents($link);

	fclose($handle);

	if (trim($content) == 'Found') {
	return 'Found';
	}  else {

	return 'Not Found';
	
	}
	
	
	}

}


?>