<?php
require('lib/oauth2/Client.php');
require('lib/oauth2/GrantType/IGrantType.php');
require('lib/oauth2/GrantType/AuthorizationCode.php');

$clientId     = 'b8988631425a9c2856f69df878265576d602ee512472eac89c3e75614a24e9d9';
$clientSecret = '58ea2ff4bb1a5a3a4b33be5cb7a3e687c194f40bf5b3196a60d1c5c387956af6';

$redirectUri    = 'http://nb-php.herokuapp.com/';
$authorizeUri   = 'https://jasonjohnston.nationbuilder.com/oauth/authorize';
$accessTokenUri = 'https://jasonjohnston.nationbuilder.com/oauth/token';

$client       = new OAuth2\Client($clientId, $clientSecret);

if(!isset($_GET['code'])) {
  $authUrl = $client->getAuthenticationUrl($authorizeUri, $redirectUri);
  header('Location: ' . $authUrl);
  die('Redirect');
}
else {
  $params = array('code' => $_GET['code'], 'redirect_uri' => $redirectUri );
  $response = $client->getAccessToken($accessTokenUri,'authorization_code',$params);
  $client->setAccessToken($response['result']['access_token']);
  $results = $client->fetch('https://jasonjohnston.nationbuilder.com//api/v1/people');
  $people = $results['result'];
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