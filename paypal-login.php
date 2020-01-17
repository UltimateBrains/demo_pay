<?php
require_once('paypal-api.php');
require_once('settings.php');

// If Paypal passes the OAuth Code in the redirect url
if(isset($_GET['code'])) {
	try {
		$paypal = new PaypalApi();
		
		// Get a Paypal Access Token 
		$access_token = $paypal->GetAccessToken(PAYPAL_CLIENT_ID, PAYPAL_CLIENT_REDIRECT_URL, PAYPAL_CLIENT_SECRET, $_GET['code']);

		// Get user information
		$user_info = $paypal->GetUserInfo($access_token);

		echo '<pre>';print_r($user_info);echo '</pre>';
	}
	catch(Exception $e) {
		echo '<script>Error("' . $e->getMessage() . '");</script>';
		exit();
	}
}

?>