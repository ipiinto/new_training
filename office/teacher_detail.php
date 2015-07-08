<?php  
?>  
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
    <!-- Bootstrap Table -->
    <link rel="stylesheet" href="../bootstrap-3.2.0-dist/css/bootstrap-table.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../jquery/jquery-2.1.3.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
  <!-- JS Plug-in -->
  <script src="../bootstrap-3.2.0-dist/js/bootstrap-table.js"></script>
  <script src="../bootstrap-3.2.0-dist/js/bootbox.min.js"></script>
    <table data-toggle="table"
           data-height="400"
           data-url="fetch_teacher.php"
           data-search="true"
           data-sort-order="desc">
      <thead>
        <tr>
          <th data-field="name" data-width="200" data-align="center" data-sortable="true">ชื่ออาจารย์</th>        
          <th data-field="nickname" data-align="center" data-sortable="true">ชื่อเล่น</th>
          <th data-field="email" data-align="center" data-sortable="true">อีเมล</th>
          <th data-field="telephone" data-align="center" data-sortable="true">โทรศัพท์</th>
          <th data-field="address" data-width="400" data-align="center" data-sortable="true">ที่อยู่</th>
          <th data-field="action" data-formatter="actionFormatter" data-align="center" data-events="actionEvents">แก้ไข / ลบ</th>
        </tr>
      </thead>
    </table>
  <script type="text/javascript"> 
    function actionFormatter(value, row, index) {
      return [
        '<a class="edit ml10" href="javascript:void(0)" title="แก้ไข">',
        '<i class="glyphicon glyphicon-edit"></i>',
        '</a>&nbsp;&nbsp;&nbsp;',
        '<a class="remove ml10" href="javascript:void(0)" title="ลบ">',
        '<i class="glyphicon glyphicon-trash"></i>',
        '</a>'
      ].join('');
    }
    window.actionEvents = {
      'click .edit': function(e, value, row, index) {
        window.open('teacher_frm.php?id='+row.teacher_id,'_self');
      },
      'click .remove': function (e, value, row, index) {
        // console.log(row.teacher_id);
        var teacher_id = "teacher_id="+row.teacher_id;
        bootbox.confirm("ยืนยันการลบอาจารย์", function(result) {
          // return true/false from bootbox
          if (result === true) {
            $.ajax({
              type: "POST",
              url: "del_teacher.php",
              dataType: "JSON",
              data: teacher_id,
            });
            location.reload();
          };
        });
      }   
    }
  </script>
  </body>
</html>