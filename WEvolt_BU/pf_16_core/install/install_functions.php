<?
	  // include_once("http://www.outlandentertainment.com/users/connect.php"); 
	//print " MY OUTLAND CONFIG = " . $GLOBALS['userdb'] . " + " . $userdb_pass;

function generate_salt ()
{
     // Declare $salt
     $salt = '';

     // And create it with random chars
     for ($i = 0; $i < 3; $i++)
     {
          $salt .= chr(rand(35, 126));
     }
          return $salt;
}

function user_login($email, $password)
{
     // Try and get the salt from the database using the username
     $query = "select salt from user where email='$email' limit 1";
	//$userdb = "outland_users";
//$userdb_pass = "kugtov.02";
//$userhost = "localhost";
	// print "MY USER HOST = ".$userhost."\n\n\n\n\n";
	// print "MY USER DB = ".$userdb."\n\n\n\n\n";
	  //print "MY USER PASS = ".$userdb_pass."\n\n\n\n\n";

	 mysql_connect ($userhost,$dbuser,$userpass) or die ('Could not connect to the database.');
mysql_select_db ($userdb) or die ('Could not select database.');
     $result = mysql_query($query);
     $user = mysql_fetch_array($result);
	 
	// print "MY QUERY = " .  $query ."\n\n\n\n\n\n\n";
	// print "MY RESULT = " .  $result ."\n\n\n\n\n\n\n";
	 // print "MY USER = " .   $user. "\n\n\n\n\n\n\n";
	

     // Using the salt, encrypt the given password to see if it
     // matches the one in the database
     $encrypted_pass = md5(md5($password).$user['salt']);

     // Try and get the user using the username & encrypted pass
     $query = "select userid, username from user where email='$email' and password='$encrypted_pass'";
     $result = mysql_query($query);
     $user = mysql_fetch_array($result);
     $numrows = mysql_num_rows($result);

     // Now encrypt the data to be stored in the session
     $encrypted_id = md5($user['userid']);
     $encrypted_name = md5($user['username']);

     // Store the data in the session
	 $username = $user['username'];
	 $userid = $user['userid'];
     $_SESSION['userid'] = $userid;
     $_SESSION['username'] = $username;
     $_SESSION['encrypted_id'] = $encrypted_id;
     $_SESSION['encrypted_name'] = $encrypted_name;
	 
	

    if ($numrows == 1)
    {
        return 'Correct';
    }
    else
    {
        return false;
    }
}


function user_register($username, $email, $password)
{
     // Get a salt using our function
     $salt = generate_salt();

     // Now encrypt the password using that salt
     $encrypted = md5(md5($password).$salt);

     // And lastly, store the information in the database
     $query = "INSERT into user (username, email, password, type, salt) values ('$username', '$email', '$encrypted', '0', '$salt')";
	// print "MY QUERY =  " . $query . "\n\n\n";
	 // print "MY USER =".$username;
	  //print "MY email =".$email;
	  //  print "MY encrypted =".$encrypted;
mysql_connect ($userhost,$dbuser,$userpass) or die ('Could not connect to the database.');
mysql_select_db ($userdb) or die ('Could not select database.');
     mysql_query ($query) or die ('Could not create the user.');
}?>