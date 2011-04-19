<? 

$query = "select distinct e.Blurb, e.ContentID, e.ContentType, e.CreatedDate, e.Comment, e.Target, e.Link, u.avatar, u.username, p.thumb as ProjectThumb, e.thumb as ExciteThumb
		 				 			 from excites as e
		 				 			 left join users as u on (e.ContentID=u.encryptid and e.ContentType='user')
						 			left join projects as p on (e.ContentID=p.ProjectID and ProjectID!='')
									where e.UserID='$UserID' order by e.CreatedDate DESC";
									$ExciteArray = $InitDB->queryUniqueObject($query);

	 $query = "select * from users_profile where UserID='$UserID'";
	 $where = " and ((PrivacySetting='public')";
	 if ($IsOwner) 
	 	$where .= " or (PrivacySetting ='friends') or (PrivacySetting ='fans') or (PrivacySetting ='private') ";
		
	 else if ($IsFriend)
	 	$where .= " or (PrivacySetting ='friends') or (PrivacySetting ='fans') ";
	 else if ($IsFan)
	 	$where .= " or (PrivacySetting ='fans') ";

	$where .=")";
	
	 $query .= $where ." order by InfoType, ID";
     $InitDB->query($query);
	 $LastType = '';
	
	 while ($profile = $InitDB->FetchNextObject()){
	 	
		 switch($profile->RecordID) {
		 		case 'profile_blurb':
					  $ProfileBlurb = stripslashes($profile->LongComment);
					  $ProfileBlurbPrivacy = $profile->PrivacySetting;
					   $BasicInfo = true;
					  break;
				case 'sex':
					  $Sex = stripslashes($profile->LongComment);
					  $SexPrivacy = $profile->PrivacySetting;
					   $BasicInfo = true;
					  break;
				case 'about_me':
					  $About = stripslashes($profile->LongComment);
					  $AboutPrivacy = $profile->PrivacySetting;
					   $PersonalInfo = true;
					  
					  break;
				case 'hometown_location':
					  $HometownLocation = stripslashes($profile->LongComment);
					  $HometownLocationPrivacy = $profile->PrivacySetting;
					  $BasicInfo = true;
					  break;
				case 'resume':
					  $Resume = stripslashes($profile->LongComment);
					  $ResumePrivacy = $profile->PrivacySetting;
					  $ResumeInfo = true;
					  break;
				case 'current_location':
					  $Location = stripslashes($profile->LongComment);
					  $LocationPrivacy = $profile->PrivacySetting;
					   $BasicInfo = true;
					  break;
				case 'activities':
					  $Hobbies = stripslashes($profile->LongComment);
					  $HobbiesPrivacy = $profile->PrivacySetting;
					  $PersonalInfo = true;
					  break;
				case 'music':
					  $Music = stripslashes($profile->LongComment);
					  $MusicPrivacy = $profile->PrivacySetting;
					   $PersonalInfo = true;
					  break;
				case 'movies':
					  $Movies = stripslashes($profile->LongComment);
					  $MoviesPrivacy = $profile->PrivacySetting;
					   $PersonalInfo = true;
					  break;
				case 'books':
					  $Books = stripslashes($profile->LongComment);
					  $BooksPrivacy = $profile->PrivacySetting;
					  break;
				case 'tv':
					  $TVShows = stripslashes($profile->LongComment);
					  $TVShowsPrivacy = $profile->PrivacySetting;
					   $PersonalInfo = true;
					  break;
				case 'interests':
					  $Interests = stripslashes($profile->LongComment);
					  $InterestsPrivacy = $profile->PrivacySetting;
					   $PersonalInfo = true;
					  break;
				case 'website':
					  $Website = stripslashes($profile->LongComment);
					  $WebsitePrivacy = $profile->PrivacySetting;
					   $ContactInfo = true;
					  break;
				case 'profile_url':
					  $FaceUrl = stripslashes($profile->LongComment);
					  $FaceUrlPrivacy = $profile->PrivacySetting;
					  $ContactInfo = true;
					  break;
				case 'education_history':
					  $Education = stripslashes($profile->LongComment);
					  $EducationPrivacy = $profile->PrivacySetting;
					   $CreditsInfo = true;
					  break;
				case 'work_history':
					  $WorkHistory = stripslashes($profile->LongComment);
					  $WorkHistoryPrivacy = $profile->PrivacySetting;
					   $CreditsInfo = true;
					  break;
				case 'twittername':
					  $TwitterName = stripslashes($profile->LongComment);
					  $TwitterNamePrivacy = $profile->PrivacySetting;
					   $ContactInfo = true;
					  break;
				case 'influences':
					  $Influences = stripslashes($profile->LongComment);
					  $InfluencesPrivacy = $profile->PrivacySetting;
					   $PersonalInfo = true;
					  break;
				case 'credits':
					  $Credits = stripslashes($profile->LongComment);
					  $CreditsPrivacy = $profile->PrivacySetting;
					  $CreditsInfo = true;
					  break;
				case 'phone':
					  $Phone = stripslashes($profile->LongComment);
					  $PhonePrivacy = $profile->PrivacySetting;
					  $ContactInfo = true;
					  break;
				case 'self_tags':
					  $SelfTags = stripslashes($profile->LongComment);
					  break;
				case 'birthday_date':
					  $Birthday = $profile->LongComment;
					  $BirthdayPrivacy = $profile->PrivacySetting;
					   $BasicInfo = true;
					  break;
				case 'screennames':
					  $ScreenNames = stripslashes($profile->LongComment);
					  $ScreenNamesPrivacy = $profile->PrivacySetting;
					   $ContactInfo = true;
					  break;

		 }
	 }
	 
	  if (($Birthday == '') || (strlen($Birthday) < 5)) 
	  	  $Birthdate = explode('-',$user->birthdate);
	 else
	 	  $Birthdate = explode('-',$Birthday);
	 $BirthdayDay =$Birthdate[1];
	 $BirthdayMonth =$Birthdate[0];
	 $BirthdayYear =$Birthdate[2];
	 
	 if ($Music == '')
	 	$Music = stripslashes($user->music);
		
	 if ($Location == '')
 		 $Location = stripslashes($user->location);
		 
 	 if ($Books == '')
		 $Books = stripslashes($user->books);
		 
 	 if ($Hobbies == '')
		 $Hobbies = stripslashes($user->hobbies);
		 
 	 if ($Website == '') 	 
	 	 $Website= $user->website;
	 if ($About == '')
	    $About = stripslashes($user->about);
	 if ($Influences == '')
	   $Influences = $user->influences;
	 if ($TwitterName == '')
		 $TwitterName  = $user->Twittername; 
	if ($Credits == '') 
	 	$Credits = stripslashes($user->credits);
	 	   
	 $Status = $user->Status;
	 $TwitterCount = $user->TwitterCount;
	
	 if (substr($Website,0,3) == 'www') {
	 	$Website = 'http://'.$Website;
	 }
		
	 $IsCreator = $user->iscreator;
	 
	 
	 $Link1 = $user->link1;
	 if (substr($Link1,0,3) == 'www') {
	 	$Link1 = 'http://'.$Link1;
	 }
	 $Link2 = $user->link2;
	  if (substr($Link2,0,3) == 'www') {
	 	$Link2 = 'http://'.$Link2;
	 }
	 $Link3 = $user->link3;
	  if (substr($Link3,0,3) == 'www') {
	 	$Link3 = 'http://'.$Link3;
	 }
	 $Link4 = $user->link4;
	  if (substr($Link4,0,3) == 'www') {
	 	$Link4 = 'http://'.$Link4;
	 }
 	 if ($Sex == '')
	 	$Sex = $user->gender;
		
	 $AllowComments = $user->allowcomments;
	 $HostedAccount = $user->HostedAccount;

?>