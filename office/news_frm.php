<?php
	session_start();

	include('../config/config.php');
	

	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}

	$id=$_GET["id"];
	if($id !=""){
		$sql="select * from news where news_id=$id ";
		$result=mysqli_query($dbcon,$sql);
		$row=mysqli_fetch_array($result);

		$title_news=$row["title_news"];
		$content=$row["content"];
	}

	$action=$_POST["action"];
	if($action=="1"){
		$id=$_POST["id"];
		$action=$_POST["action"];
		$title_news=$_POST["title_news"];
		$content=$_POST["content"];
		$file = $_FILES["fileupload"]["name"];
		$news_date=date("Y-m-d");
		echo($file);
        $tempfile = $news_date."-".$file;



		$save=1;
		if($title_news==""){
			$save=0;
		}

		if($content==""){
			$save=0;
		}

		/*
		//เริ่มบันทึก
		if($save==1){
			if($id !=""){
				$sql="update news set title_news='$title_news' , content='$content' where news_id=$id";
			}else{
				//$target_path = "../images/banner";
				//$target_path = $target_path . basename( $_FILES['filupload']['name']);
				if(move_uploaded_file($_FILES['filupload']['tmp_name'], '../images/banner')) {
   					$sql="insert into news(title_news,content,news_date,banner)";
					$sql=$sql."values('$title_news','$content','$news_date','$tempfile')";
				}else{
    				echo "There was an error uploading the file, please try again!";
				}
			}
			$result=mysqli_query($dbcon,$sql);
			echo "<script language=\"javascript\">window.location.href = 'news_frm.php'</script>";

			exit();
		}*/
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
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="bootstrap-3.2.0-dist/css/bootstrap.css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<link href="../bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function submitform(){
	if(confirm('ท่านต้องการลบข้อมูลที่เลือกไว้หรือไม่ !')==true){
  		document.form2.submit();
	}
}

<!--
 

//-->

</script>

</head>

<body>
	<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
  		<tr>
    		<?php include '../office/header.php'?>
  		</tr>
  		<tr>
    		<td height="46" background="../images/bg_menu.png"><?php include('menu.php') ?></td>
  		</tr>
  		<tr>
    		<td valign="middle"><img src="../images/press_bar.png" /><hr /></td>
  		</tr>
  		<tr>
    		<td>
    			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      				<tr>
        				<td width="10" valign="top">&nbsp;</td>
		        		<td width="250" valign="top"><?php include('member_menu.php') ?></td>
        				<td width="5" valign="top">&nbsp;</td>
		        		<td valign="top">
                			<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#5F7AC3" class="table table-hover table-condensed">
                				<thead>
									<tr bgcolor="#5F7AC3">
		  								<th class="wh" width="49%"><strong>รายการข่าวประชาสัมพันธ์ </strong>
	        							<?php
											switch($row["img_type"]){
												case "application/pdf" :
													$img="pdf.png";
													break;
													
												case "application/msword" :
													$img="word.png";
													break;
													
												case "application/vnd.openxmlformats-officedocument.spre" :
													$img="excel.png";
													break;
													
												case "application/vnd.openxmlformats-officedocument.pres" :
													$img="powerpoint.png";
													break;
													
												case "application/x-rar-compressed" :
													$img="winrar.png";
													break;
													
												case "application/zip" :
													$img="zip.png";
													break;
													
												default:
													$img="other.png";
											}
							
										?>
		  								</th>
										<th align="right" valign="middle" bgcolor="#5F7AC3" colspan="2">
		    								<form id="form3" name="form3" method="get" action="upload.php" enctype="multipart/form-data">
		    									<div class="form-inline">
		    											<div class="form-group">
					      									<select name="opt" id="opt" class="form-control">
					        									<option value="title_news" <?php if($opt=="title_news") echo " selected='selected'"; ?>>หัวข้อข่าว</option>
					        									<option value="content" <?php if($opt=="content") echo " selected='selected'"; ?>>เนื้อหาข่าว</option>
					        								</select>
					        							</div>
					        							<div class="form-group">
					      									<input name="find" type="text" id="find" class="form-control" placeholder="ค้นหา" value="<?php echo $find ?>" size="15"/>
					      									<!-- <input type="submit" name="button" id="button" value="ค้นหา" /> -->
					      								</div>
				      										<button type="submit" class="btn btn-info">
				      											<span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;
                                                            	<span>ค้นหา</span>
                                                            </button>
				      								</div>
				      							</div>
		      								</form>
		    							</th>
		  							</tr>
		  						</thead>
						    	<tr>
      								<td colspan="3">
        								<form id="form2" name="form2" method="post" action="news_del.php">
								          	<table width="100%" cellspacing="1" cellpadding="1" class="table table-hover table-condensed">
            								<?php
												$sql="select news_id , title_news, content, banner, news_date from news";
												if($find !=""){
													$sql=$sql . " where $opt like '%$find%' order by $opt";
												}
												$result=mysqli_query($dbcon,$sql);
												$nRow=mysqli_num_rows($result);
												$tr=$nRow%$list_page;
												if($rt!=0) { 
													$totalpage = floor($nRow/$list_page)+1; 
												}else {
													$totalpage = floor($nRow/$list_page)+1; 
												}
												$goto = ($page-1)*$list_page;
												$sql=$sql . " limit $goto,$list_page";
												$result=mysqli_query($dbcon,$sql);
												while($row=mysqli_fetch_array($result)){
											?>
		            								<tr>
														<td width="20" bgcolor="#FFFFFF"><input name="ch<?php echo $row[0] ?>" type="checkbox" id="ch<?php echo $row[0] ?>" value="1" /></td>
														<td width="20" bgcolor="#FFFFFF"><a href="news_frm.php?id=<?php echo $row[0] ?>"><img src="../images/edit.png" width="20" height="20" border="0" /></a></td>
														<td width="209" bgcolor="#FFFFFF"><strong><?php echo $row["title_news"] ?></strong><br />
										                <span class="t11"><?php echo $row["news_date"] ?></span></td>
														<td width="491" bgcolor="#FFFFFF">
															<?php
																if($row['banner'] != ""){
															?>
																	<img width="85" height="35" src="../images/banner/<?=$row['banner'];?>">
															<?php
																}else{
															?>
																	<img src="../images/banner/white.jpg">
															<?php
												              	}
															?>
														</td>
		             								 </tr>
											<?php
												}
											?>
            								</table>
            									<!-- <input name="sql" type="hidden" id="sql" value="<?php echo $sql ?>" /> -->
            							</form>
        							</td>
    							</tr>
    							<tr bgcolor="#5F7AC3">
    								<td colspan="2">
    									<button type="button" onclick="submitform()" class="btn btn-danger">
                            				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;
                            				<span>ลบข้อมูล</span>
                          				</button>
        								<!-- <a href="#" onclick="submitform()"><img src="../images/delete.png" width="30" height="30" border="0" /></a> -->
        							</td>
        							<td width="24%" align="right">
							          <?php
										if($nRow!=0){
											echo "<table width=100% border=0 bordercolor=black cellspacing=0 cellpadding=2>\n";
											echo "<tr><td align=right>\n";
											echo "<font size='2'>\n";
											if($page>1 && $page<=$totalpage){
												$prevpage = $page-1;
												echo "\t<a href='teacher.php?page=$prevpage&opt=$opt&find=$find'>[Back = $prevpage]</a>\n";
											}
											echo "\t Display $page/$totalpage \n";
											if($page!=$totalpage) {
												$nextpage = $page+1;
												echo "\t<a href='teacher.php?page=$nextpage&opt=$opt&find=$find'>[Next = $nextpage]</a>\n";
											}
											echo "</td></tr>\n";
											echo "<tr><td align=right>\n";
								
											// วนลูปแสดงเลขหน้าทั้งหมด
											for($i=1 ; $i<$page ; $i++) {
												echo "\t<a href='teacher.php?page=$i&opt=$opt&find=$find'>$i</a> \n";
											}
											echo "\t<font size=2 color=red><b>$page</b></font> \n";
											for($i=$page+1 ; $i<=$totalpage ; $i++) {
												echo "\t<a href='teacher.php?page=$i&opt=$opt&find=$find'>$i</a> \n";
											}
											echo "</font></td></tr>\n";
											echo "</table>\n";
										}
									?>
        							</td>
    							</tr>
							</table>
               	  		<form id="form1" name="form1" method="post" action="upload.php" enctype="multipart/form-data" >
               	    		<table width="100%" class="">
               	      			<tr>
               	        			<td colspan="2">&nbsp;</td>
           	          			</tr>
                      			<tr>
               	        			<td colspan="2"><strong></strong></td>
           	          			</tr>
               	      			<tr>
               	        			<td width="15%" align="right">หัวข้อข่าว :</td>
               	        			<td width="85%"><input name="title_news" type="text" autofocus="autofocus" id="title_news" placeholder="หัวข้อข่าว" value="<?php echo $title_news ?>" size="70" /></td>
           	          			</tr>
                      			<tr>
                      				<td width="15%" align="right" valign="top">ประเภทข่าว :</td>
                        			<td width="85%">
                        				<input name="news_type" type="radio" id="radio" value="0" <?php if($news_type==0) echo " checked='checked'"; ?> />ข่าวประชาสัมพันธ์หลักสูตร<br />
                						<input name="news_type" type="radio" id="radio2" value="1" <?php if($news_type==1) echo " checked='checked'"; ?> />ทั่วไป (แบนเนอร์)<br />
                						<input name="news_type" type="radio" id="radio3" value="2" <?php if($news_type==2) echo " checked='checked'"; ?> />ทั่วไป (ไม่มีแบนเนอร์) <br />							
										<input name="news_type" type="radio" id="radio5" value="4" <?php if($news_type==4) echo " checked='checked'"; ?> />ข่าวภายนอก &nbsp;<input name="news_type_other" type="text" id="news_type_other" value="<?php echo $news_type_other ?>" size="26"><br />
                					</td>
                      			</tr>
               	      			<tr>
               	        			<td align="right" valign="top">เนื้อข่าว :</td>
               	        			<td><textarea name="content" id="content" cols="45" rows="5" placeholder="เนื้อข่าว.."><?php echo $content ?></textarea></td>
           	          			</tr>
                      			<tr>
	                      			<td align="right">แบนเนอร์ :</td>
	                        		<td><input name="fileupload" type="file" id="fileupload" >
                        			<br /><font class="t10r">ขนาด 700*306 px</font></td>
                      			</tr>
               	      			<tr>
               	        			<td align="right">
                        				<input name="action" type="hidden" id="action" value="1" />
                    					<input name="id" type="hidden" id="id" value="<?php echo $id ?>" />
                        			</td>
               	        			<td>
                        				<input type="submit" name="submit" id="submit" value="ตกลง" />
                        			</td>
								</tr>
           	        		</table>
               	  		</form>
              			<br />
              		</td>
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
<?php
	mysqli_close($dbcon);
?>
