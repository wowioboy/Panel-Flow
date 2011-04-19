<?  
if (!file_exists('includes/config.php')) {
if (!file_exists('install/index.php')) {
     header('Location: /noconfig.php');
	 } else {
	 
	 header('Location: install/index.php');
	 }
   // echo "The file $filename exists";
}	


include 'includes/init.php'; 
$Pagetracking = 'Comics'; 
//include 'includes/comic_functions.php'; 
//include 'includes/admin_date_inc.php'; 
?>

<?

 function strictify ( $string ) {

       $fixed = htmlspecialchars( $string, ENT_QUOTES );

       $trans_array = array();
       for ($i=127; $i<255; $i++) {
           $trans_array[chr($i)] = "&#" . $i . ";";
       }

       $really_fixed = strtr($fixed, $trans_array);

       return $really_fixed;

   }
   
  $page = $_POST['page'];
  $ComicID = $_GET['id'];
   $comicsDB =  new DB($db_database,$db_host, $db_user, $db_pass);
if (!isset($_GET['id'])) {  
  if (!isset($page))
    $page = 1;
		if (((!isset($Genre)) && (!isset($search))) || ((isset($search)) && ($search == ""))){
			if ($sort == 1) {
				$sql = "select comiccrypt, title, url, thumb, pages, updated from comics where installed = 1 ORDER BY title ASC";
				
			} else if ($sort == 2) {
				$sql = "select comiccrypt, title, url, thumb, pages, updated from comics where installed = 1 ORDER BY createdate ASC";
				
			} else if ($sort == 3) {
				$sql = "select * from comics where installed = 1 ORDER BY updated ASC";
				
			} else {
		$sql = "select * from comics where installed = 1 ORDER BY updated ASC";
			
			}

		} else if (isset($Genre)) {

		$search = trim($Genre);
			$search = preg_replace('/\s+/', ' ', $search);

			//seperate multiple keywords into array space delimited
			$keywords = explode(" ", $search);

			//Clean empty arrays so they don't get every row as result
			$keywords = array_diff($keywords, array(""));

			//Set the MySQL query
			if ($search == NULL or $search == '%'){
			
			} else {
				for ($i=0; $i<count($keywords); $i++) {
					if ($sort == 1) {
					$sql = "SELECT * FROM comics " .
						"WHERE installed = 1 and genre LIKE '%".$keywords[$i]."%'".
						" and installed = 1 ORDER BY title ASC";
				
					} else if ($sort == 2) {
					$sql = "SELECT * FROM comics " .
						"WHERE installed = 1 and genre LIKE '%".$keywords[$i]."%'".
						" and installed = 1 ORDER BY createdate DESC";
				
					} else if ($sort == 3) {
					$sql = "SELECT * FROM comics " .
						"WHERE installed = 1 and genre LIKE '%".$keywords[$i]."%'".
						"  ORDER BY updated DESC";
				
					}
			}
	}
	//Create a PS_Pagination object
} else if ((isset($search)) && ($search != "")) {
			$search = trim($search);
			$search = preg_replace('/\s+/', ' ', $search);

			//seperate multiple keywords into array space delimited
			$keywords = explode(" ", $search);

			//Clean empty arrays so they don't get every row as result
			$keywords = array_diff($keywords, array(""));

			//Set the MySQL query
			if ($search == NULL or $search == '%'){
			} else {
				for ($i=0; $i<count($keywords); $i++) {
				
					if ($sort == 1) {
					$sql = "SELECT * FROM comics " .
						"WHERE installed = 1 and title LIKE '%".$keywords[$i]."%'".
					" OR creator LIKE '%".$keywords[$i]."%'" .
					" OR writer LIKE '%".$keywords[$i]."%'" .
					" OR artist LIKE '%".$keywords[$i]."%'" .
					" OR colorist LIKE '%".$keywords[$i]."%'" .
					" OR letterist LIKE '%".$keywords[$i]."%'" .
					" OR synopsis LIKE '%".$keywords[$i]."%'" .
					" OR short LIKE '%".$keywords[$i]."%'" .
					" OR url LIKE '%".$keywords[$i]."%'" .
					" OR artist LIKE '%".$keywords[$i]."%'" .
					" OR tags LIKE '%".$keywords[$i]."%'" .
					" OR genre LIKE '%".$keywords[$i]."%'" .
					" ORDER BY title ASC";
				
				} else if ($sort == 2) {
				$sql = "SELECT * FROM comics " .
						"WHERE installed = 1 and title LIKE '%".$keywords[$i]."%'".
					" OR creator LIKE '%".$keywords[$i]."%'" .
					" OR writer LIKE '%".$keywords[$i]."%'" .
					" OR artist LIKE '%".$keywords[$i]."%'" .
					" OR colorist LIKE '%".$keywords[$i]."%'" .
					" OR letterist LIKE '%".$keywords[$i]."%'" .
					" OR synopsis LIKE '%".$keywords[$i]."%'" .
					" OR short LIKE '%".$keywords[$i]."%'" .
					" OR url LIKE '%".$keywords[$i]."%'" .
					" OR artist LIKE '%".$keywords[$i]."%'" .
					" OR tags LIKE '%".$keywords[$i]."%'" .
					" OR genre LIKE '%".$keywords[$i]."%'" .
					"  ORDER BY createdate DESC";
				
				} else if ($sort == 3) {
				$sql = "SELECT * FROM comics " .
						"WHERE installed = 1 and title LIKE '%".$keywords[$i]."%'".
					" OR creator LIKE '%".$keywords[$i]."%'" .
					" OR writer LIKE '%".$keywords[$i]."%'" .
					" OR artist LIKE '%".$keywords[$i]."%'" .
					" OR colorist LIKE '%".$keywords[$i]."%'" .
					" OR letterist LIKE '%".$keywords[$i]."%'" .
					" OR synopsis LIKE '%".$keywords[$i]."%'" .
					" OR short LIKE '%".$keywords[$i]."%'" .
					" OR url LIKE '%".$keywords[$i]."%'" .
					" OR artist LIKE '%".$keywords[$i]."%'" .
					" OR tags LIKE '%".$keywords[$i]."%'" .
					" OR genre LIKE '%".$keywords[$i]."%'" .
					" and installed = 1 ORDER BY updated DESC";
				
				}
						
			}// end for
	} // end else

} // End Search if

 $cnt = 0;
 $comicString = "<table width='350'><tr>";
    $comicsDB->query($sql);
    while ($line = $comicsDB->fetchNextObject()) {      
      if (($cnt >= (($page-1)*10)) && ($cnt < ($page*10))){
	  		$UpdateDay = substr($line->updated, 5, 2); 
			$UpdateMonth = substr($line->updated, 8, 2); 
			$UpdateYear = substr($line->updated, 0, 4);
			$Updated = $UpdateDay.".".$UpdateMonth.".".$UpdateYear;
 			$comicString .= "<td valign='top'><div align='center'><div class='comictitlelist'>".stripslashes($line->title)."</div><a href='../".$line->url."'>";
				//$fileUrl = $line->thumb;
		    	//$AgetHeaders = @get_headers($fileUrl);
			//if (preg_match("|200|", $AgetHeaders[0])) {
			$comicString .="<img src='http://".$line->thumb."' border='2' alt='LINK' style='border-color:#000000;'>";
			//} else {
			 //	$comicString .="<img src='images/tempcover_thumb.jpg' border='2' alt='LINK' style='border-color:#000000;'>";
			//}
			$comicString .="</a><div class='updated'>updated: <b>".$Updated."</b></div><div class='pages'>Pages: ".$line->pages."</div></div></td>"; 
			 $counter++;
 				if ($counter == 3){
 					$comicString .= "</tr><tr>";
 					$counter = 0;
 				}
 	}
	//Display the full navigation in one go
  	 $cnt++;
  }
    $comicsDB->close();
	$comicString .= "</tr></table>";
  if ($cnt >= ($page*10)){
    	$nextpage = true;
	} else{
    	$nextpage = false;
	}
  if ($page > 1)
    $previouspage = true;
  else
    $previouspage = false;

}
$comicsDB->close();
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript">
  function nextpage()
  {
    document.getElementById('page').value = <? echo ($page+1); ?>;
    document.form1.submit();
  }
  
  function previouspage()
  {
    document.getElementById('page').value = <? echo ($page-1); ?>;
    document.form1.submit();
  }
</script>
<script type="text/javascript" src="/scripts/swfobject.js"></script>
<meta name="description" content="<?php echo $Synopsis ?>"></meta>
<meta name="keywords" content="<?php echo $Genre;?>, <?php echo $Tags;?>"></meta>
<LINK href="css/pf_css.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PANEL FLOW - WEBCOMICS</title>
</head>
<body background="images/admin_bg.jpg" style="background-repeat:repeat-x;">
<div class="wrapper" align="center">

<div style="height:100px"></div>
<font  style="font-size:16px;">COMICS</font>
<? echo $comicString;?>

	 <div class="spacer"></div>	
	<form name="form1" action="#" method="post">
    <input type="hidden" name="page" id="page" value="" />
    <input type="hidden" name="searchtext" value="<? echo $Search; ?>" />
   	</form>				
</div>
</body>
</html>