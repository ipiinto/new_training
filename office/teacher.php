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
<title><?php echo $ribon ?></title>
<link href="../style.css" rel="stylesheet" type="text/css">
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
    <td align="left" valign="bottom" style="margin-top:10px"><img src="../images/teach_bar.png" /><hr /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td width="250" valign="top"><?php include('member_menu.php') ?></td>
        <td width="5" valign="top">&nbsp;</td>
        <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><strong>รายชื่ออาจารย์ผู้สอน</strong></td>
            <td align="right">
			        <form id="form1" name="form1" method="get" action="teacher.php">
                <div class="col-md-12">
                  <div class="form-inline">
                    <select name="opt" id="opt" class="form-control">
                    	<option value="name" <?php if($opt=="name") echo " selected='selected'"; ?>>ชื่อ</option>
                      <option value="surname" <?php if($opt=="surname") echo " selected='selected'"; ?>>นามสกุล</option>
                   	  <option value="nickname" <?php if($opt=="nickname") echo " selected='selected'"; ?>>ชื่อเล่น</option>
                    </select>
                    <input name="find" type="text" id="find" class="form-control" placeholder="ค้นหา" value="<?php echo $find ?>" />
                    <!-- <input type="submit" name="button" class="btn btn-primary" id="button" value="ค้นหา" /> -->
                    <button type="submit" name="button"  class="btn btn-primary">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;
                      <span>ค้นหา</span>
                    </button>
                  </div>
                </div>
              </form>
            </td>
          </tr>
                      
          <tr>
                  <td colspan="2"><form action="teacher_del.php" method="post" name="form2" id="form2">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                    <thead>
                      <tr>
                        <th colspan="2">
                          <!-- <a href="#" onclick="submitform()" class="btn btn-danger"></a> -->
                          <button type="button" onclick="submitform()" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;
                            <span>ลบข้อมูล</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                  </table></td>
                  </tr>
                <tr>
                  <td colspan="2">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-hover">
                      <?php
          					  	$sql="select teacher_id , name , surname , nickname from teacher ";
            						if($find !=""){
            							$sql=$sql . " where $opt like '%$find%' order by $opt";
            						}
              						$result=mysql_db_query($database,$sql);
              						$nRow=mysql_num_rows($result);
              						$tr=$nRow%$list_page;
              						if($rt!=0) { 
              							$totalpage = floor($nRow/$list_page)+1; 
              						}else {
              							$totalpage = floor($nRow/$list_page)+1; 
              						}
              						$goto = ($page-1)*$list_page;
              						$sql=$sql . " limit $goto,$list_page";
              						$result=mysql_db_query($database,$sql);
            						while($row=mysql_fetch_array($result)){
                      ?>
                          <tr>
                            <td width="20"><input name="ch<?php echo $row[0] ?>" type="checkbox" id="ch<?php echo $row[0] ?>" value="1" /></td>
                            <td width="20"><a href="teacher_frm.php?id=<?php echo $row[0] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                            <td><strong><?php echo $row["name"] ?>&nbsp;&nbsp;<?php echo $row["surname"] ?> </strong><br />
                              <span class="t11"><?php echo $row["nickname"] ?></span></td>
                          </tr>
                      <?php
						            }
                      ?>
                        <tr>
                          <td colspan="3"></td>
                        </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" align="right">
                  <?php
					if($nRow!=0){
						echo "<table width=100% border=0 bordercolor=black cellspacing=0 cellpadding=2>\n";
						echo "<tr><td align=right>\n";
						echo "<font size='2'>\n";
						if($page>1 && $page<=$totalpage) {
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
                  <input name="sql" type="hidden" id="sql" value="<?php echo $sql ?>" /></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    
    
    </td>
  </tr>
  <tr>
    <td height="74">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
	mysql_close();
?>