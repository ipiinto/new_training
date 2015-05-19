<?php
	session_start();

	if($_SESSION["login"]==""){
		echo "<script language=\"javascript\">window.location.href = '../index.php'</script>";
		exit();
	}
	
?>
<link href="../bootstrap-3.2.0-dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="../bootstrap-3.2.0-dist/css/bootstrap.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	function printDiv(print_bill) {
     var printContents = document.getElementById(print_bill).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<style>
@media screen {
    p {
        font-size: 14px;
    }
}

@media print {
    p {
        font-size: 20px;
        color: red;
    }
}
</style>
<div id="print_bill">
<table cellspacing="0" cellpadding="0" width="80%" align="center" border="#000000">
	<tr>
		<td colspan="11"><img src="../images/bill_header1.jpg" width="100%" height="100px" border="1" ></td>
	</tr>
    <!--|||||||||||||||-->
	<tr>
	    <td bgcolor="#0099CC">
	        <table cellpadding="1" cellspacing="1" border="1" align="center" width="100%" class="table-condensed">
	        	<div class="panel-heading">
		        <tr bgcolor="#CED8F6">
		        	<td align="center" colspan="7"><strong> บัตรลงทะเบียนของคุณ &nbsp; <?php $callmem = call_member($_SESSION['id']); echo ($callmem['name']); ?>&nbsp;&nbsp;<?php echo ($callmem['surname']) ?></strong></td>
		        </tr>
		        </div>
<!--                 <tr align="center" bgcolor="#CED8F6">
    <td width="22%"><strong>หลักสูตร</strong></td>
    <td width="16%"><strong>รายวิชา</strong></td>
    <td width="8%"><strong>กลุ่มเรียน</strong></td>
    <td width="10%"><strong>ผู้สอน</strong></td>
    <td width="20%"><strong>เวลา/ห้อง</strong></td>
    <td width="5%"><strong>ส่วนลด</strong></td>
    <td width="15%"><strong>จำนวนเงิน</strong></td>
</tr> -->
<?php
    check_member_regis_in_course ($_SESSION['id']);
    function call_member($member_id){
        include('../config/config.php');
        mysql_connect($host,$hostuser,$hostpass);
        mysql_query("SET NAMES UTF8");
        $sql_name = "SELECT name, surname FROM member WHERE member_id = $member_id";
        $results = mysql_db_query($database,$sql_name);
        $rows = mysql_fetch_array($results);
        return $rows;
        //echo $sql_name;
    }

    function check_member_regis_in_course ($member_id){
        global $price_1;
        global $price_2;
        global $discount;
        #นับจำนวนรายวิชาที่ลงทะเบียนไปในแต่ละหลักสูตร
        include('../config/config.php');
        $cos_id=$_GET['cos_id'];
        /*mysql_connect($host,$hostuser,$hostpass);
        mysql_query("SET NAMES UTF8");
        $sql_select_course_in_member = "SELECT DISTINCT cos_id FROM learn WHERE member_id = $member_id";
        $results_4 = mysql_db_query($database,$sql_select_course_in_member);*/
       // while($rows = mysql_fetch_array($results_4)){
            
        $sql_count_subject_in_course = "SELECT COUNT( sub_id ) FROM learn WHERE cos_id = $cos_id AND member_id = $member_id";								
        $results_5 = mysql_db_query($database,$sql_count_subject_in_course);
        echo "<font color='#e31e1e'>";
        $row = mysql_fetch_array($results_5);
        echo $var_1 = $row[0];
        echo "</font>";
        $sql_select_course_in_course_item = "SELECT COUNT( sub_id ) FROM course_item WHERE cos_id = $cos_id";
        $results_5 = mysql_db_query($database,$sql_select_course_in_course_item);
        echo "<font color='#7B52E3'>";
        $row = mysql_fetch_array($results_5);
        echo $var_2 = $row[0];
        $sql_course_name="SELECT course.cos_name FROM course WHERE cos_id = $cos_id";
        $results_5 = mysql_db_query($database,$sql_course_name);
        $row = mysql_fetch_array($results_5);
        $var_name = $row[0];
        echo "</font>";
        $i = 0;
        if ($var_1 == $var_2) {
            echo "course";
            // redirect to regis subject
            //echo "<META HTTP-EQUIV='Refresh' CONTENT='1;URL=regis_subject.php'>";
        }else{
            echo "Subject";
            // redirect to regis subject
            //echo "<META HTTP-EQUIV='Refresh' CONTENT='1;URL=regis_subject.php'>";
        }

        //}
        
    }
    
echo "<tr bgcolor = '#F2F0F0'>";
echo "<td colspan = '4' align='right'>รวม","</td>";
echo "<td align='center'>",$discount,"</td>";
echo "<td align='center'>",$price_1+$price_2,"</td>";
echo "</tr>";
echo "<tr bgcolor = '#b7adad'>";
echo "<td colspan = '4' align='right'>รวมราคาทั้งสิ้น","</td>";
echo "<td align='center' colspan = '2'>",$price_1+$price_2-$discount,"</td>";
echo "</tr>";
echo "</table>";
echo "</table>";
echo "<br>";
?>
<br>
</div>

<div align="center"><input type="button" value="พิมพ์บัตรลงทะเบียน" onclick="printDiv('print_bill')"></div>
<?php
    function getDay($d){
        if($d==1){
            $da='อา.';	
        }elseif($d==2){
            $da='จ.';
        }elseif($d==3){
                $da='อ.';
        }elseif($d==4){
            $da='พ.';
        }elseif($d==5){
            $da='พฤ.';
        }elseif($d==6){
            $da='ศ.';
        }else{
            $da='ส.';
        }
        return $da;
    }
        
        function getSince($s){
            if($s==1){
                $si='8:30';	
            }elseif($s==2){
                $si='9:30';	
            }elseif($s==3){
                $si='10:30';	
            }elseif($s==4){
                $si='11:30';	
            }elseif($s==5){
                $si='12:30';	
            }elseif($s==6){
                $si='13:30';	
            }elseif($s==7){
                $si='14:30';	
            }elseif($s==8){
                $si='15:30';	
            }elseif($s==9){
                $si='16:30';	
            }elseif($s==10){
                $si='17:30';	
            }elseif($s==11){
                $si='18:30';	
            }else{
                $si='19:30';	
            }
            return $si;	
        }
        
        function getUntil($u){
            if($u==2){
                $ut='9:30';	
            }elseif($u==3){
                $ut='10:30';	
            }elseif($u==4){
                $ut='11:30';	
            }elseif($u==5){
                $ut='12:30';	
            }elseif($u==6){
                $ut='13:30';	
            }elseif($u==7){
                $ut='14:30';	
            }elseif($u==8){
                $ut='15:30';	
            }elseif($u==9){
                $ut='16:30';	
            }elseif($u==10){
                $ut='17:30';	
            }elseif($u==11){
                $ut='18:30';	
            }else{
                $ut='19:30';	
            }
            return $ut;	
        }
    ?>