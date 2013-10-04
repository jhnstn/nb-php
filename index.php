<?php
require('lib/oauth2/Client.php');
require('lib/oauth2/GrantType/IGrantType.php');
require('lib/oauth2/GrantType/AuthorizationCode.php');

$clientId = 'yourClientId';
$clientSecret = 'yourClientSecret';
$client = new OAuth2\Client($clientId, $clientSecret);

phpinfo();
?>