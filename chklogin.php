<?php
	session_start();
	include('config/config.php');
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
  $helper = new FacebookRedirectLoginHelper('http://localhost/new_training/chklogin.php' );

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
    // if (isset($_SESSION['FBRLH_state'])) {
    // 	print_r($_SESSION['FBRLH_state']);
    // }
    // get email
    $email = $graphObject->getProperty('email');
    $sql="select * from member where email='$email'";
		$result=mysqli_query($dbcon,$sql);
		$nRow=mysqli_num_rows($result);
		if($nRow != 0){
			$st_login=1;
			$row = mysqli_fetch_array($result);
			$_SESSION['login']=$row[1];
			$_SESSION['name']=$row[3];
			$_SESSION['state']='นักเรียน';
			$_SESSION['id']=$row[0];
			echo "<script language=\"javascript\">window.location.href = 'student/index1.php'</script>";
		}
    /*!
     * Show detail
     */
    // echo "Hi " . $graph->getName() . "<br>";
    // print_r($_SESSION['FBRLH_state']);
    // // print data
    // echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
    // // get ID
    // $fid = $graphObject->getProperty('id');
    // echo $fid."<br>";
    // echo "<img src='//graph.facebook.com/".$fid."/picture?type=large'><br>";
    // echo '<a href="' . $helper->getLogoutUrl($session, 'http://localhost/new_training/index.php') . '">Logout</a>';
    
  } else {
    echo "ข้อมูลที่คุณกรอกไม่ถูกต้อง กรุณาเข้าสู่ระบบ ใหม่อีกครั้ง"	;
  }
  if (isset($_POST['username']) && isset($_POST['pass']) || isset($_POST['remember'])) {
  	$username = $_POST['username'];
  	$pass = $_POST['pass'];
  	$remember = $_POST['remember'];
		$st_login=0;
	  $sql="select * from office where username='$username' and pass='$pass'";
		$result=mysqli_query($dbcon,$sql);
		$nRow=mysqli_num_rows($result);
		if($nRow != 0){
			$st_login=1;
			$row = mysqli_fetch_array($result);
			$_SESSION['login']=$row[1];
			$_SESSION['state']='ผู้ดูแลระบบ';
			echo "<script language=\"javascript\">window.location.href = 'office/index.php'</script>";
		}else{
			$sql="select * from teacher where username='$username' and pass='$pass'";
			$result=mysqli_query($dbcon,$sql);
			$nRow=mysqli_num_rows($result);
			if($nRow != 0){
				$st_login=1;
				$row = mysqli_fetch_array($result);
				$_SESSION['login']=$row[1];
				$_SESSION['name']=$row[3];
				$_SESSION['state']='อาจารย์';
				$_SESSION['id']=$row['teacher_id'];
				echo "<script language=\"javascript\">window.location.href = 'teacher/index.php'</script>";
			}else{
				$sql="select * from member where username='$username' and pass='$pass'";
				$result=mysqli_query($dbcon,$sql);
				$nRow=mysqli_num_rows($result);
				if($nRow != 0){
					$st_login=1;
					$row = mysqli_fetch_array($result);
					$_SESSION['login']=$row[1];
					$_SESSION['name']=$row[3];
					$_SESSION['state']='นักเรียน';
					$_SESSION['id']=$row[0];
					echo "<script language=\"javascript\">window.location.href = 'student/index1.php'</script>";
				}
			}
		}
		if($st_login==0){
			echo "ข้อมูลที่คุณกรอกไม่ถูกต้อง กรุณาเข้าสู่ระบบ ใหม่อีกครั้ง"	;
		}
	}
?>
