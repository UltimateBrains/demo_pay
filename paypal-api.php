<?php

class PaypalApi
{
	// Get Paypal Access Token
	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {
		$api_url = 'https://api.paypal.com/v1/oauth2/token';			
		
		$curl_post = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $api_url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $client_id . ":" . $client_secret);
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve access token');
			
		return $data['access_token'];
	}

	// Get Paypal user details
	public function GetUserInfo($access_token) {
		$api_url = 'https://api.paypal.com/v1/oauth2/token/userinfo?schema=openid';

		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $api_url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($http_code != 200)
			throw new Exception('Error : Failed to get user information');

		return $data;
	}
}

?>
