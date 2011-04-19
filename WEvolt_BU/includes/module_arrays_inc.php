<? 

function remove_element($arr, $val){
$count = 0;
//print_r($arr);
	foreach ($arr as $value){
	
	
	//'k'. $arr[$key].'<br/>';
	//print'v'. $val.'<br/>';
		if ($value[0] == $val){
			unset($arr[$count]);
			//print 'Removed ' . $val.'<br/>'; 
		}
		$count++;
	}
	
	return $arr = array_values($arr);

}

$AvailableModuleArray = array (
					array('credits','Credits'),
					array('otherprojects','Other Projects'),
					array('synopsis','Synopsis'),
					array('custommod','Custom Mod'),
					
					array('comform','Comment Form'),
					array('linksbox','Links'),
					array('mobile','Mobile'),
					
					array('products','Products'),
					array('characters','Characters'),
					array('downloads','Downloads'),
					array('authcom','Author Comment'),
					array('twitter','Twitter'),
					array('blog','Blog'),
					array('pagecom','Page Comments'),
					array('latestpage','Latest Page'),
					array('forum','Forum Posts'),
					array('fbgroup','Facebook Group')
					);
					
					?>