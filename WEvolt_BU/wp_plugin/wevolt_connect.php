<?php
/*
Plugin Name: WEvolt connect
Plugin URI: http://www.wevolt.com/wordpress.php
Description: WEvolt connect will let you easily mirror your content you publish to your Wordpress/ComicPress site.
Version: 1.0
Author: Matt Jacobs
Author URI: http://users.wevolt.com/matteblack/
License: GPL2
*/

/*  Copyright 2010  Matt Jacobs  (email : matt@wevolt.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_action('admin_menu', 'my_plugin_menu');
add_action ( 'publish_post', 'email_wevolt' );

 function getFileList ($directory) 
  {

    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($directory);

    // open directory and walk through the filenames
    while ($file = readdir($handler)) {

      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != "..") {
        $results[] = $file;
      }

    }

    // tidy up: close the handler
    closedir($handler);

    // done!
    return $results;

  }

function email_wevolt($post_ID) {

include_once('../wp-content/themes/comicpress/comicpress-config.php');
	
	//echo getcwd();
	$email_code = get_option('email_code');
	$comicpress_cat = get_option('comicpress_cat');
	
	$DateFormat = get_option('comicpress-manager-cpm-date-format');
	 $post = get_post($post_ID);
	// print_r($post);
	// $CAt = the_category();
	// print_r($CAt); 
//$meta_values = get_post_meta($post_ID,''); 

// print ' CAT = ' . $Category->cat_ID;
 $category = get_the_category($post_ID); 
$CatID = $category[0]->cat_ID;
print 'GOT HERE';
print 'CAT = ' . $CatID ;
print 'comiccat = ' . $comiccat ;


if ($comiccat == '')
	$comiccat = $comicpress_cat;
if ($CatID  == $comiccat) {
	 $FileDate = date($DateFormat,strtotime($post->post_date));
	 $DateLive = date('m-d-Y',strtotime($post->post_date));
	print 'File DAte = '. $DateLive;
	
	// echo  $comic_folder;
	 $Files = getFileList ('../'.$comic_folder); 

	// echo  $comic_folder;
	 $Attachments = array();
	 foreach($Files as $file) {

			$pos = strpos($file,$FileDate);
			
			if($pos === false) {
			 // string needle NOT found in haystack
		
			
			}
			else {
			 // string needle found in haystack
			  $Attachments[] =$file;
			}

		 
		 
	 }
	//print_r($Attachments);
	

// email fields: to, from, subject, and so on
$to = 'matt@wevolt.com'; 
//$to = 'pages@wevolt.com';
$from = get_option('wevolt_email');
$subject =$email_code.'||'.$post->post_title.'||'.$DateLive;
$message = $post->post_content;

/*
$headers = "From: $from";
 
// boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
 
// headers for attachment 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
// multipart boundary 
$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
$message .= "--{$mime_boundary}\n";
 
// preparing attachments
for($x=0;$x<count($files);$x++){
	$file = fopen($files[$x],"rb");
	$data = fread($file,filesize($files[$x]));
	fclose($file);
	$data = chunk_split(base64_encode($data));
	$message .= "Content-Type: {\"image/jpeg\"};\n" . " name=\"$files[$x]\"\n" . 
	"Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" . 
	"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
	$message .= "--{$mime_boundary}\n";
}
 
// send
 
$ok = @mail($to, $subject, $message, $headers); 
if ($ok) { 
	echo "<p>mail sent to $to!</p>"; 
} else { 
	echo "<p>mail could not be sent!</p>"; 
} 


*/
//define the receiver of the email 

//define the subject of the email 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash 
$random_hash = md5(date('r', time())); 

//define the headers we want passed. Note that they are separated with \r\n 
//$headers = "From: ".$wevolt_email."\r\nReply-To: ".$wevolt_email.""; 
//add boundary string and mime type specification 
//$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 
//read the atachment file contents into a string,
//encode it with MIME base64,
//and split it into smaller chunks
//$attachment = chunk_split(base64_encode(file_get_contents('attachment.zip'))); 
//define the body of the message. 

$fileatt = '../'.$comic_folder.'/'.$Attachments[0]; // Path to the file 
$fileatt_type = "image/jpeg"; // File Type 
$fileatt_name = $Attachments[0]; // Filename that will be used for the file as the attachment 

$email_to = 'matt@wevolt.com'; 
//$to = 'pages@wevolt.com';
$email_from = get_option('wevolt_email');
$email_subject =$email_code.'||'.$post->post_title.'||'.$DateLive;
$email_message = $post->post_content;


$headers = "From: ".$email_from; 


$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

$headers .= "\nMIME-Version: 1.0\n" . 
"Content-Type: multipart/mixed;\n" . 
" boundary=\"{$mime_boundary}\""; 

$email_message .= "This is a multi-part message in MIME format.\n\n" . 
"--{$mime_boundary}\n" . 
"Content-Type:text/html; charset=\"iso-8859-1\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . 
$email_message . "\n\n"; 

foreach($Attachments as $attach) {


$file = fopen( '../'.$comic_folder.'/'.$attach,'rb'); 
$data = fread($file,filesize( '../'.$comic_folder.'/'.$attach)); 
fclose($file); 

$data = chunk_split(base64_encode($data)); 

$email_message .= "--{$mime_boundary}\n" . 
"Content-Type: {$fileatt_type};\n" . 
" name=\"{$fileatt_name}\"\n" . 
//"Content-Disposition: attachment;\n" . 
//" filename=\"{$fileatt_name}\"\n" . 
"Content-Transfer-Encoding: base64\n\n" . 
$data . "\n\n" . 
"--{$mime_boundary}--\n"; 

}

$ok = @mail($email_to, $email_subject, $email_message, $headers); 

if($ok) { 
echo "<font face=verdana size=2>The file was successfully sent!</font>"; 
} else { 
die("Sorry but the email could not be sent. Please go back and try again!"); 
} 
}

	 /*
	$to = "$name <$email>";


$from = "John-Smith <john.smith@domain.com>";

$subject = "Here is your attachment";

$fileatt = "/public_html/pdfs/mypdf.pdf";

$fileatttype = "application/pdf";

$fileattname = "newname.pdf";

$headers = "From: $from";

 $file = fopen($fileatt,'rb');     
 $data = fread($file,filesize($fileatt));     
 fclose($file);
 
 // Generate a boundary string     
 $semi_rand = md5(time());     
 $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
 
 // Add the headers for a file attachment     
 $headers .= "\nMIME-Version: 1.0\n" .     
             "Content-Type: multipart/mixed;\n" .     
             " boundary=\"{$mime_boundary}\""; 
			 
			 // Add a multipart boundary above the plain message     
 $message = "This is a multi-part message in MIME format.\n\n" .     
            "--{$mime_boundary}\n" .     
            "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .     
            "Content-Transfer-Encoding: 7bit\n\n" .     
            $message . "\n\n";
			
			// Base64 encode the file data     
 $data = chunk_split(base64_encode($data));
 
 // Add file attachment to the message     
 $message .= "--{$mime_boundary}\n" .     
             "Content-Type: {$fileatt_type};\n" .     
             " name=\"{$fileatt_name}\"\n" .     
             "Content-Disposition: attachment;\n" .     
             " filename=\"{$fileatt_name}\"\n" .     
             "Content-Transfer-Encoding: base64\n\n" .     
             $data . "\n\n" .     
             "--{$mime_boundary}--\n";     

// Send the message     
$ok = @mail($to, $subject, $message, $headers);     
if ($ok) {     
 echo "<p>Mail sent! Yay PHP!</p>";     
} else {     
 echo "<p>Mail could not be sent. Sorry!</p>";     
}     

mail('matt@wevolt.com', "code", 'MY POST ID='.$post_ID.'file='.$File);
echo $post_ID;
print_r($post);
return $post_ID;	
*/

/*
$file = fopen( $fileatt, 'rb' );

$data = fread( $file, filesize( $fileatt ) );

fclose( $file );
*/


}

function wevolt_admin() {
	include('wevolt_options.php');
}

function my_plugin_menu() {

  add_options_page('WEvolt Connect Options', 'WEvolt Connect', 'manage_options', 'wevolt_connect_options', 'my_plugin_options');

}



function wevolt_admin_options() {
	if (current_user_can('manage_options')) {
		
		 add_options_page("WEvolt Connect Options", "WEvolt Connect Options", "manage_options", "WEvolt Connect Options", "wevolt_connect/wevolt_options.php");
	}

   
}





function my_plugin_options() {

  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }


	if($_POST['action'] == 'update') {
		//Form data sent
		$email_code = $_POST['email_code'];
		update_option('email_code', $email_code);
		
		$wevolt_email = $_POST['wevolt_email'];
		update_option('wevolt_email', $wevolt_email);
		
		$comicpress_cat = $_POST['comicpress_cat'];
		update_option('comicpress_cat', $comicpress_cat);
		
		

		?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
		<?php
	} else {
		//Normal page display
		$email_code = get_option('email_code');
		$wevolt_email = get_option('wevolt_email');
		$comicpress_cat = get_option('comicpress_cat');
		
		
	}
	
	
?>


<div class="wrap">
<?php    echo "<h2>WEvolt Connect Options</h2>"; ?>

<form name="form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="oscimp_hidden" value="Y">
	
	<p>WEvolt Publish by Email Code (this is found in the settings section of your project on WEvolt)<br>
<input type="text" name="email_code" value="<?php echo $email_code; ?>" size="20">
<br/>
Enter the email you registered with WEvolt<br>

<input type="text" name="wevolt_email" value="<?php echo $wevolt_email; ?>" size="20">

<br/>
Enter the Category ID of your webcomic<br>

<input type="text" name="comicpress_cat" value="<?php echo $comicpress_cat; ?>" size="20">


	<p class="submit">
	<input type="submit" name="Submit" value="Update Options" />
    <input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="email_code,wevolt_email,comicpress_cat" />
	</p>
</form>
</div><?

}
?>