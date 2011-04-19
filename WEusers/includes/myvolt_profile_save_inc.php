<? 

$UserFields = array();
    $Now = date('Y-m-d H:i:s');
	
 	//BASIC PROFILE INFO	
	$Sex = $_POST['txtSex'];
	$SexPrivacy = $_POST['txtSexPrivacy'];
	if ($Sex != '') 
		$UserFields[] = array('Name'=>'sex','Privacy'=>$SexPrivacy,'Type'=>'basic','RecordValue'=>$Sex);
		
	$Resume = basename($_FILES['txtResume']['name']);
	$ResumePrivacy = $_POST['txtResumePrivacy'];
	if ($Resume != '') {
		$target_path =$_SERVER['DOCUMENT_ROOT'].'/temp/';
		$target_path = $target_path . basename( $_FILES['txtResume']['name']);
		if(move_uploaded_file($_FILES['txtResume']['tmp_name'], $target_path)) {
			$Filename = basename( $_FILES['txtResume']['name']);
			$file_extension = strtolower(substr(strrchr($Filename, "."), 1));	
			$randName = md5(rand() * time());

			if(!is_dir($_SERVER['DOCUMENT_ROOT']."/users/".trim($_SESSION['username']))) 
				mkdir($_SERVER['DOCUMENT_ROOT']."/users/".trim($_SESSION['username'])."/", 0777); 
			if(!is_dir($_SERVER['DOCUMENT_ROOT']."/users/".trim($_SESSION['username'])."/media")) 
				mkdir($_SERVER['DOCUMENT_ROOT']."/users/".trim($_SESSION['username'])."/media/", 0777);
			
			if (($file_extension == 'doc') || ($file_extension == 'pdf')) {
				$originalfile = $target_path;
				$TargetFile = 'users/'.trim($_SESSION['username']).'/media/'.$randName.'.'.$file_extension;
				copy($originalfile,$_SERVER['DOCUMENT_ROOT']."/".$TargetFile);
				unlink($originalfile);
				$UserFields[] = array('Name'=>'resume','Privacy'=>$ResumePrivacy,'Type'=>'basic','RecordValue'=>'http://users.wevolt.com/'.$TargetFile);
			}
		}
	}
		
	$Birthday = $_POST['txtBdayMonth'] .'-'. $_POST['txtBdayDay'] .'-'.$_POST['txtBdayYear'];
	$BirthdayPrivacy = $_POST['txtBirthdayPrivacy'];
	if (($Birthday != '')  && ($Birthday !='--'))
		$UserFields[] = array('Name'=>'birthday_date','Privacy'=>$BirthdayPrivacy,'Type'=>'basic','RecordValue'=>$Birthday);
	
	$Hometown = mysql_real_escape_string($_POST['txtHometown']);
	$HometownPrivacy = $_POST['txtHometownLocationPrivacy'];
	if ($Hometown != '') 
		$UserFields[] = array('Name'=>'hometown_location','Privacy'=>$HometownPrivacy,'Type'=>'basic','RecordValue'=>$Hometown);
	
	$Location = mysql_real_escape_string($_POST['txtLocation']);
	$LocationPrivacy = $_POST['txtLocationPrivacy'];
	if ($Location != '') 
		$UserFields[] = array('Name'=>'current_location','Privacy'=>$LocationPrivacy,'Type'=>'basic','RecordValue'=>$Location);
	
	$ProfileBlurb = mysql_real_escape_string($_POST['txtProfileBlurb']);
	$ProfileBlurbPrivacy = $_POST['txtProfileBlurbPrivacy'];
	if ($ProfileBlurb != '') 
		$UserFields[] = array('Name'=>'profile_blurb','Privacy'=>$ProfileBlurbPrivacy,'Type'=>'basic','RecordValue'=>$ProfileBlurb);
	
	$SelfTags = mysql_real_escape_string($_POST['txtSelfTags']);
	if ($SelfTags != '') 
		$UserFields[] = array('Name'=>'self_tags','Privacy'=>'private','Type'=>'basic','RecordValue'=>$SelfTags);
	
	//PERSONAL PROFILE INFO
	$About = mysql_real_escape_string($_POST['txtAbout']);
	$AboutPrivacy = $_POST['txtAboutPrivacy'];
	if ($About != '') 
		$UserFields[] = array('Name'=>'about_me','Privacy'=>$AboutPrivacy,'Type'=>'personal','RecordValue'=>$About);
	
	$Hobbies = mysql_real_escape_string($_POST['txtHobbies']);
	$HobbiesPrivacy = $_POST['txtHobbiesPrivacy'];
	if ($Hobbies != '') 
		$UserFields[] = array('Name'=>'activities','Privacy'=>$HobbiesPrivacy,'Type'=>'personal','RecordValue'=>$Hobbies);

	$Interests = mysql_real_escape_string($_POST['txtInterests']);
	$InterestsPrivacy = $_POST['txtInterestsPrivacy'];
	if ($Interests != '') 
		$UserFields[] = array('Name'=>'interests','Privacy'=>$InterestsPrivacy,'Type'=>'personal','RecordValue'=>$Interests);

	$Influences = mysql_real_escape_string($_POST['txtInfluences']);
	$InfluencesPrivacy = $_POST['txtInfluencesPrivacy'];
	if ($Influences != '') 
		$UserFields[] = array('Name'=>'influences','Privacy'=>$InfluencesPrivacy,'Type'=>'personal','RecordValue'=>$Influences);

	$Music = mysql_real_escape_string($_POST['txtMusic']);
	$MusicPrivacy = $_POST['txtMusicPrivacy'];
	if ($Music != '') 
		$UserFields[] = array('Name'=>'music','Privacy'=>$MusicPrivacy,'Type'=>'personal','RecordValue'=>$Music);
	
	$Books = mysql_real_escape_string($_POST['txtBooks']);
	$BooksPrivacy = $_POST['txtBooksPrivacy'];
	if ($Books != '') 
		$UserFields[] = array('Name'=>'books','Privacy'=>$BooksPrivacy,'Type'=>'personal','RecordValue'=>$Books);

	$Movies = mysql_real_escape_string($_POST['txtMovies']);
	$MoviesPrivacy = $_POST['txtMoviesPrivacy'];
	if ($Movies != '') 
		$UserFields[] = array('Name'=>'movies','Privacy'=>$MoviesPrivacy,'Type'=>'personal','RecordValue'=>$Movies);

	$TVShows = mysql_real_escape_string($_POST['txtTVShows']);
	$TVShowsPrivacy = $_POST['txtTVShowsPrivacy'];
	if ($TVShows != '') 
		$UserFields[] = array('Name'=>'tv','Privacy'=>$TVShowsPrivacy,'Type'=>'personal','RecordValue'=>$TVShows);

	//CONTACT PROFILE INFO
	$ScreenNames = mysql_real_escape_string($_POST['txtScreenNames']);
	$ScreenNamesPrivacy = $_POST['txtScreenNamesPrivacy'];
	if ($ScreenNames != '') 
		$UserFields[] = array('Name'=>'screennames','Privacy'=>$ScreenNamesPrivacy,'Type'=>'contact','RecordValue'=>$ScreenNames);

	$Phone = mysql_real_escape_string($_POST['txtPhone']);
	$PhonePrivacy = $_POST['txtPhonePrivacy'];
	if ($Phone != '') 
		$UserFields[] = array('Name'=>'phone','Privacy'=>$PhonePrivacy,'Type'=>'contact','RecordValue'=>$Phone);
	
	$Website = mysql_real_escape_string($_POST['txtWebsite']);
	$WebsitePrivacy = $_POST['txtWebsitePrivacy'];
	if ($Website != '') 
		$UserFields[] = array('Name'=>'website','Privacy'=>$WebsitePrivacy,'Type'=>'contact','RecordValue'=>$Website);

	$TwitterName = mysql_real_escape_string($_POST['txtTwitterName']);
	$TwitterNamePrivacy = $_POST['txtTwitterNamePrivacy'];
	if ($TwitterName != '') 
		$UserFields[] = array('Name'=>'twittername','Privacy'=>$TwitterNamePrivacy,'Type'=>'contact','RecordValue'=>$TwitterName);

	$FaceUrl = mysql_real_escape_string($_POST['txtFaceUrl']);
	$FaceUrlPrivacy = $_POST['txtFaceUrlPrivacy'];
	if ($FaceUrl != '') 
		$UserFields[] = array('Name'=>'profile_url','Privacy'=>$FaceUrlPrivacy,'Type'=>'contact','RecordValue'=>$FaceUrl);
	
	//CREDITS PROFILE INFO
	$EducationHistory = mysql_real_escape_string($_POST['txtEducation']);
	$EducationHistoryPrivacy = $_POST['txtEducationPrivacy'];
	if ($EducationHistory != '') 
		$UserFields[] = array('Name'=>'education_history','Privacy'=>$EducationHistoryPrivacy,'Type'=>'contact','RecordValue'=>$EducationHistory);

	$WorkHistory = mysql_real_escape_string($_POST['txtWorkHistory']);
	$WorkHistoryPrivacy = $_POST['txtWorkHistoryPrivacy'];
	if ($WorkHistory != '') 
		$UserFields[] = array('Name'=>'work_history','Privacy'=>$WorkHistoryPrivacy,'Type'=>'contact','RecordValue'=>$WorkHistory);

	$Credits = mysql_real_escape_string($_POST['txtCredits']);
	$CreditsPrivacy = $_POST['txtCreditsPrivacy'];
	if ($Credits != '') 
		$UserFields[] = array('Name'=>'credits','Privacy'=>$CreditsPrivacy,'Type'=>'contact','RecordValue'=>$Credits);
	//print_r($UserFields);
	foreach($UserFields as $entry) {
			$query ="SELECT ID from users_profile where UserID='".$_SESSION['userid']."' and RecordID='".$entry['Name']."'";
	        $IsData = $InitDB->queryUniqueValue($query);
			//print $query.'<br/>';
			if ($IsData == '') {
				$query ="INSERT into users_profile (UserID,RecordID,LongComment, PrivacySetting,LastUpdated,InfoType) values ('".$_SESSION['userid']."','".$entry['Name']."','".$entry['RecordValue']."','".$entry['Privacy']."','$Now','".$entry['Type']."')"; 			
			} else {
				$query = "UPDATE users_profile set LongComment='".$entry['RecordValue']."', PrivacySetting='".$entry['Privacy']."' where RecordID='".$entry['Name']."' and UserID='".$_SESSION['userid']."'";
			}
			$InitDB->execute($query);
			//print $query.'<br/><br/>';
	}	
	
	$WorkForHire = $_POST['txtWorkForHire'];
	$MainService = $_POST['txtMainService'];
	$Rates = mysql_real_escape_string($_POST['txtRates']);
	$OtherServices = mysql_real_escape_string($_POST['txtOtherServices']);
	$IsStudio = $_POST['txtIsStudio'];
	
	if ($WorkForHire != '') {
		$query = "SELECT count(*) from users_data where UserID='".$_SESSION['userid']."'";
		$Found = $InitDB->queryUniqueValue($query);
		if ($Found == 0) {
			$query ="INSERT into users_data (UserID, MainService, WorkForHire, Rates, OtherServices, IsStudio) values ('".$_SESSION['userid']."', '$MainService', '$WorkForHire', '$Rates', '$OtherServices', '$IsStudio')";
			$InitDB->execute($query);
	
		} else {
			$query = "UPDATE users_data SET MainService='$MainService',WorkForHire='$WorkForHire',Rates='$Rates',OtherServices='$OtherServices', IsStudio='$IsStudio' WHERE UserID='".$_SESSION['userid']."'";
			$InitDB->execute($query);
			//print $query.'<br/>';
		
		}
	}


?>