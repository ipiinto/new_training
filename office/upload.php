<?php
  	session_start();
	
	include('../config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	
	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
	$page=$_GET["page"];
	if (empty($page)){
		$page=1;
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $ribon; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <? include "../office/header.php";?>
  </tr>
  <tr>
    <td height="46" background="../images/bg_menu.png"><? include('menu.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
  	<td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><? include('member_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td width="759" valign="top">

       <table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center"></td>
			</tr>
			<tr>
				<td align="center"><p>กำลังอัปโหลด<br />
					กรุณารอสักครู่..........</p>
                  <p>
				<?
					$action=$_POST["action"];
					if($action=="1"){
						$id=$_POST["id"];
						$action=$_POST["action"];
						$title_news=$_POST["title_news"];
						$news_type=$_POST["news_type"];
						$news_type_other=$_POST["news_type_other"];
						$content=$_POST["content"];
						$file = $_FILES['fileupload']['name'];
						$news_date=date("Y-m-d");
						$tempfile = $news_date."-".$file;
						$new_images = "Thumbnails_".$tempfile;
						
						$save=1;
						if($title_news==""){
							$save=0;
						}

						if($content==""){
							$save=0;
						}



					//เริ่มบันทึก
					if($save==1){
						if($id !=""){
							$sql="update news set title_news='$title_news' , content='$content' where news_id=$id";
						}else{
							$target_path = "../images/banner/";
							$target_path = $target_path . basename($tempfile);
							if(move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_path)) {
								$width=1000;
								$height=500;
								$size=GetimageSize($target_path);
								$images_orig = imagecreatefromjpeg($target_path);
								$photoX = ImagesX($images_orig);
								$photoY = ImagesY($images_orig);
								$images_fin = ImageCreateTrueColor($width, $height);
								ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
								ImageJPEG($images_fin,"../images/banner/Resize/".$new_images);
								ImageDestroy($images_orig);
								ImageDestroy($images_fin);
								if($news_type=="4"){
									$sql="insert into news(title_news,news_type,content,banner,news_date)";
									$sql=$sql."values('$title_news','$news_type_other','$content','$tempfile','$news_date')";
								}elseif($news_type=="2") {
									$sql="insert into news(title_news,news_type,content,banner,news_date)";
									$sql=$sql."values('$title_news','$news_type','$content','','$news_date')";
								}elseif($news_type=="1"){
									$sql="insert into news(title_news,news_type,content,banner,news_date)";
									$sql=$sql."values('$title_news','$news_type','$content','$tempfile','$news_date')";
								}elseif($news_type=="0"){
									$sql="insert into news(title_news,news_type,content,banner,news_date)";
									$sql=$sql."values('$title_news','$news_type','$content','$tempfile','$news_date')";
								}
							}elseif($news_type=="2") {
								$sql="insert into news(title_news,news_type,content,banner,news_date)";
								$sql=$sql."values('$title_news','$news_type','$content','','$news_date')";
							}else{
								echo "There was an error uploading the file, please try again!";
							}
						}
							$result=mysql_db_query($database,$sql);
							echo "<script language=\"javascript\">window.location.href = 'news_frm.php'</script>";
							exit();
							}
						}

					?>
                  </p></td>
              </tr>
            </table>

        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?
	mysql_close();
?>