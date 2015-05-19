<?
    session_start();
    
    include('config/config.php');
    mysql_connect($host,$hostuser,$hostpass);
    mysql_query("SET NAMES UTF8");

    $sql=mysql_db_query($database,"select * from news  where banner !='' ") or die(mysql_error());
    while($row=mysql_fetch_array($sql)){
                        if($row['news_type']==0){
                            if($_SESSION["login"]==""){
                                $link="/new_training/list_course.php"; 
                            }else{
                                $link="../student/list_subject.php";
                            }
                        }elseif($row['news_type']=="1") {
                            $link="news_content.php?news_id=$row[0]";
                        }elseif($row['news_type']=="2") {
                            $link="news_content.php?news_id=$row[0]";
                        }elseif($row['news_type']=="3") {
                            $link="news_content.php?news_id=$row[0]";
                        }elseif ($row['news_type']=="4") {
                            $link=$row['news_type'];
                        } 
                        //print_r($link);           
                ?>
                

                        
                        <a href="<?=$link; ?>">
                            <img style='width:700;' height='306' src="images/banner/<?=$row['banner'];?>">
                        </a>
                <?
                    }
                ?>
            