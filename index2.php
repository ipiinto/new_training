<?php
    session_start();
	$_SESSION['login']="";
	include('config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.2.0-dist/css/bootstrap.css">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
  		if(isset($_SESSION['id'])==""){
	?>
		<div class="container-fluid" style="height:75px;background-color:#003366;" >
		
		    	<?php
		    		include('header.php');
		    	?>

	    </div>
	<?php
		}
	?>
    <div class="container-fluid">
    	<div class="row">
	    	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
	    		<div class="container">
		        	<div class="navbar-header">
		            	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		            		<span class="sr-only"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		            	</button>
		            	<a class="navbar-brand" href="#">WAC</a>
		            </div>
		            <div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="index2.php">หน้าแรก</a></li>
							<li><a href="registered.php">สมัครสมาชิก</a></li>
							<li><a href="howto-regis.php">การสมัครเรียน</a></li>
						</ul>
					</div>
				</div>
	        </nav>
	    </div>
    </div>
    <div class="container-fluid">
    	<div class="container">
    		<div class="col-md-6">
				<?php
	    			include('slide_news.php');
	    		?>
				<div class="scrollit">
	                <div class="container-fluid" style="background-color:#003366;">
	                	<img src="images/news.png" width="187" height="33"  alt="ข่าวประชาสัมพันธ์"/>
	                </div>
	               	<div class="container-fluid" style="background-color:#FFFFFF;">
	                	<?php
	                    	include('news_show.php');
	            		?>
	                </div>
        		</div>
			</div>
			<div class="col-md-6">
					<div class="container">
						<?php
							include('regis_form.php');
						?>
					</div>
				</div>
			</div>
    	</div>
    </div>
</body>
</html>