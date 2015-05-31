<?php
  session_start();
  // added in v4.0.0
  require_once 'autoload.php';

  use Facebook\FacebookSession;
  use Facebook\FacebookRedirectLoginHelper;
  use Facebook\FacebookRequest;
  use Facebook\FacebookResponse;
  use Facebook\FacebookSDKException;
  use Facebook\FacebookRequestException;
  use Facebook\FacebookAuthorizationException;
  use Facebook\GraphObject;
  use Facebook\Entities\AccessToken;
  use Facebook\HttpClients\FacebookCurlHttpClient;
  use Facebook\HttpClients\FacebookHttpable;
  use Facebook\GraphUser;
  use Facebook\GraphSessionInfo;

  // start session

  // init app with app id and secret
  FacebookSession::setDefaultApplication( '824341307659392','6a49c231121a9833784cbfb7b061cf1f' );

  // login helper with redirect_uri
  $helper = new FacebookRedirectLoginHelper('http://localhost/new_training/testfb2.php' );

  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
  } catch( Exception $ex ) {
    // When validation fails or other local issues
  }

  // see if we have a session
  if ( isset( $session ) ) {
    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $graph = $response->getGraphObject(GraphUser::className());
    echo "Hi " . $graph->getName() . "<br>";
    print_r($_SESSION['FBRLH_state']);
    // print data
    echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
    // get ID
    $fid = $graphObject->getProperty('id');
    echo $fid."<br>";
    echo "<img src='//graph.facebook.com/".$fid."/picture?type=large'><br>";
    echo '<a href="' . $helper->getLogoutUrl($session, 'http://localhost/new_training/index.php') . '">Logout</a>';
  } else {
    // show login url
    echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
  }
?>