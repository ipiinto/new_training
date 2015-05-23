<?php
  session_start();
  include('../config/config.php');
  if($_SESSION["login"]==""){
    echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
    exit();
  }
?>
<html lang="en">
  <meta charset="UTF-8">
  <title><?php echo $ribon;?></title>
   <link rel="stylesheet" type="text/css" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
    <script type="text/javascript" src="../style.css"></script>
    <script src="../jquery/jquery-2.1.3.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <?php
    if(isset($_SESSION['id'])==""){
  ?>
    <nav class="navbar navbar-default navbar-fixed-top">
       <div class="navbar-header">
          <button class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#id_nav1"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index1.php">
            <div class="logo-xs visible-xs"></div>
            <div class="logo-lg hidden-xs"></div>
          </a>
       </div>
       <div class="collapse navbar-collapse navbar-ex1-collapse" id="id_nav1">
          <ul class="nav navbar-nav">
            <li><a href="index1.php">หน้าหลัก</a></li>
            <li><a href="registered.php">สมัครสมาชิก</a></li>
            <li><a href="howto-regis.php">การสมัครเรียน</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <label>Username</label>
              <input name="username" type="text" class="form-control input-sm" id="username" placeholder="กรอกชื่อผู้ใช้"  />
            </div>
            <div class="form-group">
              <label>Password</label>
              <input name="pass" type="password" class="form-control input-sm" id="pass" placeholder="รหัสผ่าน"  />
            </div>
            <button class="btn btn-primary btn-sm" type="button" >เข้าสู่ระบบ</button>
          </form>   
       </div>
    </nav>
  <?php
    }else{
  ?>
    <nav class="navbar navbar-default navbar-fixed-top">
       <div class="navbar-header">
          <button class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#id_nav1"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index1.php">
            <div class="logo-xs visible-xs"></div>
            <div class="logo-lg hidden-xs"></div>
          </a>
       </div>
       <div class="collapse navbar-collapse navbar-ex1-collapse" id="id_nav1">
          <ul class="nav navbar-nav">
            <li><a href="index1.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;หน้าหลัก</a></li>
            <li><a href="list_subject.php"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>&nbsp;รายวิชาที่เปิดสอน</a></li>
            <li><a href="schedule.php"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;ตารางเรียน</a></li>
            <li><a href="../forum/forum.php"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>&nbsp;กระดานถามตอบ</a></li>
          </ul>
          <ul class="nav navbar-right">
          	<?php
              $sql="select * from member where username='".$_SESSION['login']."'";
              $result=mysqli_query($dbcon,$sql);
              $rows=mysqli_fetch_array($result);
            ?>
            <li class="dropdown" style="margin-top:1px" style="margin-right:15px">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  if($rows['fileupload']!=''){
                ?>
                    <img src="../images/profile/<?=$rows['fileupload'];?>" class="profile-image img-rounded"  >&nbsp;&nbsp;<?=$rows['username'];?> <span class="caret"></span>
                <?php
                  }else{
                ?>
                    <img src="../images/avatar.jpg" class="profile-image img-rounded"  >&nbsp;&nbsp;<?=$rows['username'];?> <span class="caret"></span>
                <?php
                
                  }
                ?>
              </a>
              <ul class="dropdown-menu">
                <li sytle="width:100px"><a href="change_pwd.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;เปลี่ยนรหัสผ่าน</a></li>
                <li><a href="edit_profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;แก้ไขข้อมูลส่วนตัว</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;ออกจากระบบ</a></li>
              </ul>
            </li> 
          </ul>   
       </div>
    </nav>
  <?php
    }
  ?>
  <br /><br /><br /><br />
  <div class="table-responsive">
    <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-hover">
      <?php
        $sql="select * from course where num_sec<cos_max order by cos_name ";
        $result=mysqli_query($dbcon,$sql);
        while($row=mysqli_fetch_array($result)){
      ?>
      <tr>
        <td width="80"><img src="../images/course.png" width="80" height="81" /></td>
        <td>
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="97" align="right"><strong>ชื่อหลักสูตร :</strong></td>
              <td width="169" align="left">&nbsp;<a href='show_subject.php?cos_id=<?php echo $row[0] ?>'><?php echo $row["cos_name"] ?></a></td>
              <td width="699" rowspan="4" align="right" valign="middle">
              	<?php
                  $sql="select approve from learn where cos_id=$row[0] and member_id=".$_SESSION["id"];
                  $result_learn=mysqli_query($dbcon,$sql);
                  $nRow=mysqli_num_rows($result_learn);
                  if($nRow!=0){
                    $row_learn=mysqli_fetch_array($result_learn);
                    if($row_learn[0]==0){
                      echo "<font color='red'>รออนุมัติ</a>";
                    }else{
                      // echo "<input type='button' name='button' id=”button' value='แก้ไขข้อมูลส่วนตัว'  onclick='window.location="test.php"'  />";
                      echo "<a href='bill_sql.php?member_id=".$_SESSION['id']."&cos_id=".$row[0]."' class='btn btn-info' target='_blank'>พิมพ์บัตรลงทะเบียน</a>";
                    }
                  }else{
                    echo "<a href='course_regis.php?cos_id=$row[0]' class='btn btn-primary'>ลงทะเบียน</a>";
                  }
                ?>
              </td>
            </tr>
            <tr>
              <td align="right"><strong>จำนวนที่รับ :</strong></td>
              <td align="left">&nbsp;<?php echo $row["num_sec"] ?>/<?php echo $row["cos_max"] ?></td>
            </tr>
            <tr>
              <td align="right"><strong>ราคา :</strong></td>
              <td align="left">&nbsp;<?php echo $row["price"] ?> บาท</td>
            </tr>
            <tr>
              <td align="right"><strong>รายละเอียด :</strong></td>
              <td align="left">&nbsp;<?php echo $row["detail"] ?></td>
            </tr>
          </table>
        </td>
      </tr>
    <?php
      }
    ?>
      <tr>
        <td width="80"></td>
        <td>
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td colspan="3" align="right"></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>