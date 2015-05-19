<div class="table-responsive">
  <table width="100%" height="306px" border="0" align="right" cellpadding="2" cellspacing="2">
  <?php
  	$sql="select * from news order by news_id DESC";
  	$result=mysql_query($sql);
  	$nRow=mysql_num_rows($result);
  	while($row=mysql_fetch_array($result)){
  		if($row['news_type']=="0"){
              $link="/new_training/list_course.php"; 
          }elseif($row['news_type']=="1") {
              $link="news_content.php?news_id=$row[0]";
          }elseif($row['news_type']=="2") {
              $link="news_content.php?news_id=$row[0]";
          }else {
              $link=$row['news_type'];
          }               
  ?>
  	<tr>
  		<td height="81">
     		  <li><strong><a href="<?=$link; ?>" target="_blank" ><?php echo $row["title_news"] ?></a></strong><br>
  	        <p align="right"><font size="-2">ลงเมื่อวันที่:<?php echo $row["news_date"] ?></font></p></li>
     		  <hr / width="90%">
      </td>
    </tr>
  <?php
  	}
  ?>
  </table>
</div>