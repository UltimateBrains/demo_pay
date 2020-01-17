<?php
require_once('settings.php');

$login_url = 'https://www.paypal.com/signin/authorize?scope=' . urlencode('') . '&redirect_uri=' . urlencode(PAYPAL_CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . PAYPAL_CLIENT_ID;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0" />
<style type="text/css">

a {
	display: block;
	margin: 100px auto;
	width: 150px;
}

</style>
</head>

<body>

<a href="<?= $login_url ?>"><img src="https://www.paypalobjects.com/webstatic/en_US/developer/docs/lipp/loginwithpaypalbutton.png" /></a>

</body>
</html>
