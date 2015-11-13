<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookRedirectLoginHelper;
	session_start();
?>

<?php 

	FacebookSession::setDefaultApplication('374453862708387', 'd8ab419c4d092be99eb9911949c02208');
	
	
	$helper = new FacebookRedirectLoginHelper('http://www.cubeitbd.com/joy/maskcamp/public/logo');
	$params = array(
		  'scope' => 'read_stream,user_friends'
		  'redirect_uri' => 'http://www.cubeitbd.com/joy/maskcamp/public/test1'
	);
	$loginUrl = $helper->getLoginUrl($params);
	
 ?>
 <a href="<?php echo $loginUrl; ?>">Login</a>


 <!-- id: cubeitbd
	pass: snpdtdbhmatsn2015
  -->
<?php 
	
 ?>