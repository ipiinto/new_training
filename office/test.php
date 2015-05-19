<?

					
						$action=$_POST["action"];
					if($action=="1"){
						$id=$_POST["id"];
						$action=$_POST["action"];
						$title_news=$_POST["title_news"];
						$content=$_POST["content"];
						$file = $_FILES["fileupload"]["name"];
						$news_date=date("Y-m-d");
						$tempfile = $news_date."-".$file;

						/*var_dump($_FILES);
						echo('</br>');
						var_dump($file);
						echo('</br>');
						echo($tempfile);
						echo('</br>');
						echo "Type: " . $_FILES["filupload"]["type"] . "<br>";**//
					}

?>