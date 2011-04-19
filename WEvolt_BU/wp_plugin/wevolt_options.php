<?php 
	if($_POST['oscimp_hidden'] == 'Y') {
		//Form data sent
		$email_code = $_POST['email_code'];
		update_option('email_code', $email_code);
		

		?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
		<?php
	} else {
		//Normal page display
		$email_code = get_option('email_code');
		
	}
	
	
?>


<div class="wrap">
<?php    echo "<h2>WEvolt Publish by Email Code (this is found in the settings section of your project on WEvolt)</h2>"; ?>

<form name="form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="oscimp_hidden" value="Y">
	
	<p><?php _e("Database host: " ); ?><input type="text" name="email_code" value="<?php echo $dbhost; ?>" size="20">

	<p class="submit">
	<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
    <input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="email_code" />
	</p>
</form>
</div>