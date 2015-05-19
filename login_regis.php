<?
	session_start();
	
	include('config/config.php');
	mysql_connect($host,$hostuser,$hostpass);
	mysql_query("SET NAMES UTF8");
	//print_r($_SESSION);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><? echo $ribon; ?></title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    <script src="jquery/jquery-2.1.3.js"></script>

    <script>
    $(document).ready(function () {
      $("input#submit").click(function(){
        $.ajax({
          type: "POST",
          url: "process.php", // 
          data: $('form.contact').serialize(),
          success: function(msg){
            $("#thanks").html(msg)
            $("#form-content").modal('hide'); 
          },
          error: function(){
            alert("failure");
          }
        });
      });
    });
    </script>
  </head>

  <body>
    <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <?php include "header.php";?>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" height="46" valign="middle" background="images/bg_menu.png"><? include('menu.php') ?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
          <div class="alert alert-danger" role="alert">
            <strong>ขั้นตอนที่ 2 :</strong>เนื่องจากการสมัครเรียนจำเป้นต้องเป้นสมาชิกของเว็บก่อน จึงจะสามารถเข้าสู่ระบบเพื่อทำการสมัครเรียนได้
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div class="col-md-1">
            &nbsp;
          </div>
          <div class="col-md-5">
              <div class="bg-info">
                <div class="alert alert-primary">
                  <strong>สำหรับสมาชิกเก่า</strong>
                </div>
                <form class="form-horizontal" method="get" action="chklogin2.php">
                  <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">ชื่อผู้ใช้ :</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อผู้ใช้">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass" class="col-sm-3 control-label">รหัสผ่าน :</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="pass" id="pass" placeholder="รหัสผ่าน">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-2">
                      <input type="submit" class="btn btn-primary" value="เข้าสู่ระบบ">
                    </div>
                  </div>
                </form>
              <br />
            </div>
          </div> 
          <div class="col-md-5">
            <div class="bg bg-success">
                <div class="alert alert-primary">
                  <strong>สำหรับสมาชิกใหม่</strong>
                </div><br />
                <br />
                  <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-10">
                      <a type="button" data-toggle="modal" href="#form-content" class="btn btn-success btn-lg btn-block">สมัครสมาชิก</a>
                    </div>
                  </div>
                  <div>
                    &nbsp;
                  </div>
                  <div>
                    &nbsp;
                  </div>
                  <br /><br /><br /><br />
              </div>
            </div>
            <div id="form-content" class="modal hide fade in" style="display: none;">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                  <h3>Send me a message</h3>
              </div>
              <div class="modal-body">
                <form class="contact" name="contact">
                  <label class="label" for="name">Your Name</label><br>
                  <input type="text" name="name" class="input-xlarge"><br>
                  <label class="label" for="email">Your E-mail</label><br>
                  <input type="email" name="email" class="input-xlarge"><br>
                  <label class="label" for="message">Enter a Message</label><br>
                  <textarea name="message" class="input-xlarge"></textarea>
                </form>
              </div>
              <div class="modal-footer">
                <input class="btn btn-success" type="submit" value="Send!" id="submit">
                  <a href="#" class="btn" data-dismiss="modal">Nah.</a>
              </div>
            </div>
        </td>
      </tr>
    </table>
  </body>
</html>
<?	
	mysql_close();
?>