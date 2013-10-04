<?php
require('lib/oauth2/Client.php');
require('lib/oauth2/GrantType/IGrantType.php');
require('lib/oauth2/GrantType/AuthorizationCode.php');
require('lib/TokenStore.php');

$clientId       = $_ENV['CLIENT_ID'];
$clientSecret   = $_ENV['CLIENT_SECRET'];
$redirectUri    = $_ENV['REDIRECT_URL'];

$nationUrl      = $_ENV['NATION_URL'];
$authorizeUri   = $nationUrl . '/oauth/authorize';
$accessTokenUri = $nationUrl . '/oauth/token';

$client         = new OAuth2\Client($clientId, $clientSecret);

$tokenStore     = new TokenStore();
$token          = $tokenStore->read();

if($token){
  $client->setAccessToken($token);
  $results = $client->fetch($nationUrl . '/api/v1/people');
  $people = $results['result'];
}
elseif(!isset($_GET['code'])) {
  $authUrl = $client->getAuthenticationUrl($authorizeUri, $redirectUri);
  header('Location: ' . $authUrl);
  die('Redirect');
}
else {
  $params = array('code' => $_GET['code'], 'redirect_uri' => $redirectUri );
  $response = $client->getAccessToken($accessTokenUri,'authorization_code',$params);
  $tokenStore->write($response['result']['access_token']);
  header('Location: ' . $redirectUri);
  die('Redirect');
}
?>

<html>
  <head>
    <style>
      body{
        background-color: #CCD1F6;
        font-family: comic-sans;
      }
      .person {
        border-bottom: 1px solid #EEE;
      }
    </style>
  </head>
  <body>
    <h1> People </h1>

    <?php foreach( $people['results'] as $person ): ?>

      <div class="person" >
        <span> <?php echo $person['first_name']; ?> </span>
        &nbsp;
        <span> <?php echo $person['last_name'];  ?> </span>
      </div>

    <?php endforeach; ?>
  </body>
</html>