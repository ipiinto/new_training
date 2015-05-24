<?php
    session_start();
	include('config/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ribon; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
    <link href="themes/2/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/2/js-image-slider.js" type="text/javascript"></script>
    <link href="generic.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <?php include "header.php"; ?>
</tr>
  <tr>
    <td height="46" background="images/bg_menu.png"><?php include('menu.php') ?></td>
  </tr>
  <tr>
	<td>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="70%" align="left" valign="top" >
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                                <tr>
                                                    <td width="100%" align="left" valign="top">
                                                    <!--Slide Banner-->
                                        
                                                    <?php include "news_slide.php"; ?>
                                        
                                                    <!-- End Slide Banner -->
                                                    </td>
                                                </tr>						
                                            </table>
                                        </td>
                                        <td width="30%" height="306" align="right" valign="top" >
                                        <div class="scrollit" >
											<table width="100%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                                                <tr>
                                                    <td bgcolor="#5f7ac3"><img src="images/news.png" width="187" height="33"  alt="ข่าวประชาสัมพันธ์"/></td>
                                                </tr>
                                                <tr>
                                                    <td><?php include "news_show.php"; ?></td> 
                                                </tr>
											</table>
                    					</div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="2" align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                    	<td colspan="2" align="center">
                                        	<table width="70%" cellspacing="0" cellpadding="1" border="0">
                                            	<tr>
                                            		
                                            	</tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>                 
                </td>
			</tr>
            <tr>
			<td align="center">
          	<!-- ||||||||||||||||||||||||||| แ ถ ว ล่ า ง |||||||||||||||||||||||||||||||||||||||||||| -->
          	<br /><br />

                    	<!-- |||||||||||||||||||||||||||||||| สิ้ น สุ ด แ ถ ว ล่ า ง |||||||||||||||||||||||||||||||| -->
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>

        

        </td>
  </tr>
</table>
</body>
</html>
<?php
	mysqli_close($dbcon);
?>