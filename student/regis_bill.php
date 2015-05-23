<?php
    session_start();
	
	include('config/config.php');

	function date_format_sql($dmy){
		$dmyarr = array();
		$dmy = substr($dmy,0,10);
		$dmyarr = explode("/",$dmy);
		$dmy = ((trim($dmyarr[2]) -543)."-".trim($dmyarr[1])."-".(trim($dmyarr[0]) ));
		return($dmy);
	}
//===========================  แสดงวันที่ภาษาไทย  ==================================>>>>>>

$strBegin=$_GET['begin'];
$strEnd=$_GET['end'];

define('FPDF_FONTPATH','font/');
require('fpdf/ThaiPDF.class.php');
$pdf = new ThaiPDF();
$pdf->AddThaiFont('THSarabunNew','THSarabunNew.php');

$pdf->AddPage();
$pdf->SetX(30);
$pdf->Image('../images/bill_header.png',5,5);
$pdf->Ln(40);

$pdf->SetFont('THSarabunNew','B',20);
$pdf->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , 'เอกสารการรายงานสรุปข้อมูลการเบิกจ่ายยา' ) , 0 , 1 , 'C' );
$pdf->Ln(5);
$pdf->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , 'โรงเรียนถิ่นโอภาสวิทยา อำเภอเมืองแพร่' ) , 0 , 1 , 'C' );
$pdf->Ln(5);
$pdf->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , '----------------------------------------------------------------------------------------' ) , 0 , 1 , 'C' );
$pdf->Ln(6);
//--------- date ----------------//
$begin=date_format_sql($strBegin);
$end=date_format_sql($strEnd);
if($_REQUEST['begin']&&$_REQUEST['end']){
$pdf->cell(0,7,$pdf->conv( 'ระหว่างวันที่  '.DateThai($begin).' ถึงวันที่ '.DateThai($end)),0,1,'R');}
$pdf->Ln();


///////////////////////////////////////////// สร้างตาราง ที่ 1 /////////////////////////////
$html='
<hr>
<table border="1" align="center">
<tr>
<td width="700" align="left" height="80"><b>'.$pdf->conv("".ข้อมูลการเบิกจ่ายยา."").'</b></td>
</tr>
<tr>
<td width="200" height="60" align="center">'.$pdf->conv("".วันที่เบิก."").'</td>
<td width="200" height="60" align="center">'.$pdf->conv("".ชื่อยา."").'</td>
<td width="100" height="60" align="center">'.$pdf->conv("".จำนวน."").'</td>
<td width="200" height="60" align="center">'.$pdf->conv("".ผู้เบิก."").'</td>
</tr>';

$s2 = "select * from serviceusers,paydrug,drug
where serviceusers.serviceusers_id = paydrug.serviceusers_id 
and paydrug.drug_id = drug.drug_id and paydrug.paydrug_date between '".date_format_sql($strBegin)."' and '".date_format_sql($strEnd)."'";
	$result_show=mysqli_query($s2)or die(mysql_error());
	$totalp = mysqli_num_rows($result_show);
	while($row_show=mysqli_fetch_array($result_show)) 
	{
		$num++;
$html.='
<tr>
<td height="60">'.$pdf->conv("".dateThai($row_show["paydrug_date"])."").'</td>
<td height="60" width="200">'.$pdf->conv("".$row_show['drug_name']."").'</td>
<td width="100" height="60">'.$pdf->conv("".$row_show['paydrug_number']."").'</td>
<td height="60">'.$pdf->conv("".$row_show['name'].$row_show['surname']."").'</td>
</tr>';

}
$html.='</table>';

$pdf->WriteHTML($html);
$pdf->Output();

?>
