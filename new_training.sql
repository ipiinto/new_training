-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `new_training`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `course`
-- 

CREATE TABLE `course` (
  `cos_id` int(11) NOT NULL auto_increment,
  `cos_name` varchar(150) NOT NULL,
  `cos_max` int(11) NOT NULL,
  `num_sec` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `detail` mediumtext NOT NULL,
  `begin_day` date NOT NULL,
  `end_day` date NOT NULL,
  `begin_reg` date NOT NULL,
  `end_reg` date NOT NULL,
  PRIMARY KEY  (`cos_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `course`
-- 

INSERT INTO `course` VALUES (1, 'O-NET 1 (ช่วงชั้นที่ 3)', 30, 5, 2800, 200, 'O-NET 1 (ช่วงชั้นที่ 3)', '2014-10-25', '2014-12-21', '2014-10-18', '2014-10-19');
INSERT INTO `course` VALUES (2, 'มัธยมศึกษาปีที่ 1', 30, 1, 3000, 250, 'มัธยมศึกษาปีที่ 1', '2014-10-25', '2015-01-31', '2014-10-18', '2014-10-19');
INSERT INTO `course` VALUES (3, 'มัธยมศึกษาปีที่ 2', 30, 2, 3000, 20, 'มัธยมศึกษาปีที่ 2', '2014-10-19', '2014-12-28', '2014-10-25', '2014-10-26');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `course_item`
-- 

CREATE TABLE `course_item` (
  `autoid` int(11) NOT NULL auto_increment,
  `cos_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  PRIMARY KEY  (`autoid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- dump ตาราง `course_item`
-- 

INSERT INTO `course_item` VALUES (1, 1, 1);
INSERT INTO `course_item` VALUES (2, 1, 2);
INSERT INTO `course_item` VALUES (3, 1, 3);
INSERT INTO `course_item` VALUES (4, 2, 4);
INSERT INTO `course_item` VALUES (5, 2, 5);
INSERT INTO `course_item` VALUES (6, 2, 6);
INSERT INTO `course_item` VALUES (7, 3, 7);
INSERT INTO `course_item` VALUES (8, 3, 8);
INSERT INTO `course_item` VALUES (9, 3, 9);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `document`
-- 

CREATE TABLE `document` (
  `autoid` int(11) NOT NULL auto_increment,
  `sub_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `day_in` date NOT NULL,
  `time_in` varchar(20) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  PRIMARY KEY  (`autoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `document`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `jobs`
-- 

CREATE TABLE `jobs` (
  `jobs_id` int(11) NOT NULL auto_increment,
  `username` varchar(12) NOT NULL,
  `pass` varchar(12) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `stat` varchar(5) NOT NULL,
  `nation` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `profile` varchar(200) NOT NULL,
  `address` mediumtext NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `subj` varchar(50) NOT NULL,
  PRIMARY KEY  (`jobs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- dump ตาราง `jobs`
-- 

INSERT INTO `jobs` VALUES (1, 'ipipipipipip', '1111', 'ipipipipipipipip', 'ipipipipipipipipipi', 'ipipipi', '1', '1', 'ไทย', '0000-00-00', '', 'ipipipipipipipipipipipipiipipipipipipipipipipipipiipipipipipipipipipipipipiipipipipipipipipipipipipi                    \r\n                  ', 'pkscm_pin@hotmail.com', '0894124218', 'physics');
INSERT INTO `jobs` VALUES (2, 'ipipipipipip', '1111', 'ipipipipipipipip', 'ipipipipipipipipipi', 'ipipipi', '1', '1', 'ไทย', '0000-00-00', '', 'ipipipipipipipipipipipipiipipipipipipipipipipipipiipipipipipipipipipipipipiipipipipipipipipipipipipi                    \r\n                  ', 'pkscm_pin@hotmail.com', '0894124218', 'physics');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `learn`
-- 

CREATE TABLE `learn` (
  `autoid` int(11) NOT NULL auto_increment,
  `sub_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `cos_id` int(11) NOT NULL,
  `day_reg` date NOT NULL,
  `time_reg` varchar(50) NOT NULL,
  `approve` int(11) NOT NULL,
  PRIMARY KEY  (`autoid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- dump ตาราง `learn`
-- 

INSERT INTO `learn` VALUES (4, 4, 7, 7, 2, '2014-10-22', '02:21:34 PM', 1);
INSERT INTO `learn` VALUES (5, 5, 10, 7, 2, '2014-10-22', '02:21:34 PM', 1);
INSERT INTO `learn` VALUES (6, 6, 12, 7, 2, '2014-10-22', '02:21:34 PM', 1);
INSERT INTO `learn` VALUES (7, 8, 16, 15, 3, '2014-10-31', '11:15:54 AM', 1);
INSERT INTO `learn` VALUES (8, 9, 17, 15, 3, '2014-10-31', '11:15:54 AM', 1);
INSERT INTO `learn` VALUES (10, 1, 2, 15, 1, '2014-11-18', '05:46:31 PM', 1);
INSERT INTO `learn` VALUES (11, 8, 16, 1, 3, '2014-11-19', '12:08:30 AM', 1);
INSERT INTO `learn` VALUES (12, 1, 2, 11, 1, '2015-01-16', '11:26:39 AM', 1);
INSERT INTO `learn` VALUES (13, 2, 4, 9, 1, '2015-01-21', '11:18:31 AM', 0);
INSERT INTO `learn` VALUES (14, 3, 6, 9, 1, '2015-01-21', '11:18:31 AM', 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `member`
-- 

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL auto_increment,
  `username` varchar(12) NOT NULL,
  `pass` varchar(12) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `fileupload` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `address` mediumtext NOT NULL,
  `birthday` date NOT NULL,
  `parents_name` varchar(40) NOT NULL,
  `parents_tel` varchar(20) NOT NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

-- 
-- dump ตาราง `member`
-- 

INSERT INTO `member` VALUES (53, 'pppp', '1111', 'pppp', 'pppp', 'pppp', '2015-03-30-Komson.jpg', 'poo@gmail.com', '0863262892', 'ชาย', 'pppp', '0000-00-00', 'mmmmmm', '0843138412');
INSERT INTO `member` VALUES (7, 'pkscm', '1234', 'Komson', 'Chaovamas', 'Pin', '', 'pkscm_pin@hotmail.com', '66863262894', 'ชาย', '534 Denchai Denchai Phrae 54110', '2531-08-05', '', '');
INSERT INTO `member` VALUES (9, 'siripak', '1234', 'สิริภาคย์', 'นพมาก', 'กอหญ้า', '', 'korkak@kak.com', '0831341249', 'หญิง', 'อุตรดิตถ์', '2542-09-27', 'แม่', '0831324941');
INSERT INTO `member` VALUES (11, 'jackky', '1234', 'พิเชษฐ์', 'บัวบังขัง', 'แจ็ค', '', 'jackky@dum.com', '0831238210', 'ชาย', 'อุตรดิตถ์', '2540-07-18', 'แต้ว', '0832314149');
INSERT INTO `member` VALUES (13, 'arsenalong', '1234', 'ณัฐกุล', 'วงษ์เจริญ', 'อ๋อง', '', 'arsenalong@hotmail.com', '0838210312', 'ชาย', 'อุตรดิตถ์', '2539-09-21', 'แม่อ๋อง', '0831324149');
INSERT INTO `member` VALUES (15, 'kasem', '1234', 'kasem', 'sanprasit', 'komin', '', 'kasem@gmail.com', '0974291339', '1', 'อุตรดิตถ์', '2006-03-22', 'พ่อ', '0971339429');
INSERT INTO `member` VALUES (52, 'Komson', '1111', 'Komson', 'Chaovamas', 'pin', '2015-03-20-Komson.jpg', 'pkscm.pin@gmail.com', '0863262894', 'ชาย', 'Denchai', '0000-00-00', 'mama papa', '0858676273');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `news`
-- 

CREATE TABLE `news` (
  `news_id` int(4) NOT NULL auto_increment,
  `title_news` varchar(50) NOT NULL,
  `news_type` varchar(255) NOT NULL,
  `content` varchar(100) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `news_date` date NOT NULL,
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- dump ตาราง `news`
-- 

INSERT INTO `news` VALUES (1, 'ข่าวประชาสัมพันธ์หลักสูตร', '0', 'ข่าวประชาสัมพันธ์หลักสูตร', '2015-03-31-slide-2.jpg', '2015-03-31');
INSERT INTO `news` VALUES (2, 'ทั่วไป (แบนเนอร์)', '1', 'ทั่วไป (แบนเนอร์)', '2015-03-31-2014-08-20-Test1.jpg', '2015-03-31');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `office`
-- 

CREATE TABLE `office` (
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `office`
-- 

INSERT INTO `office` VALUES ('Administrator', 'admin', 'admin');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `reply`
-- 

CREATE TABLE `reply` (
  `ReplyID` int(5) unsigned zerofill NOT NULL auto_increment,
  `QuestionID` int(5) unsigned zerofill NOT NULL,
  `CreateDate` datetime NOT NULL,
  `Details` text NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY  (`ReplyID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- dump ตาราง `reply`
-- 

INSERT INTO `reply` VALUES (00001, 00001, '2013-12-24 00:36:45', 'ตอบ ตอบ', 'admin');
INSERT INTO `reply` VALUES (00002, 00001, '2013-12-24 00:50:12', 'ตอบ ตอบ', 'admin');
INSERT INTO `reply` VALUES (00003, 00001, '2013-12-24 21:28:46', 'ตอบแอดมิน', 'ipiinto');
INSERT INTO `reply` VALUES (00004, 00001, '2013-12-24 21:32:45', 'answer', 'admin');
INSERT INTO `reply` VALUES (00005, 00003, '2013-12-25 01:22:13', 'ตอบมาหน่อยเหอะ', 'krupam');
INSERT INTO `reply` VALUES (00006, 00001, '2014-02-15 15:50:35', 'ตอบๆ', 'คมสัน');
INSERT INTO `reply` VALUES (00007, 00003, '2015-01-08 16:05:45', 'ตอบกะได้', 'คมสัน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `section`
-- 

CREATE TABLE `section` (
  `sec_id` int(11) NOT NULL auto_increment,
  `sec_name` varchar(20) NOT NULL,
  `cos_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `max_sec` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `since` varchar(2) NOT NULL,
  `until` varchar(2) NOT NULL,
  `room` varchar(4) NOT NULL,
  `num_sec` int(11) NOT NULL,
  `sec_count` int(11) NOT NULL,
  PRIMARY KEY  (`sec_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- dump ตาราง `section`
-- 

INSERT INTO `section` VALUES (1, '01', 1, 1, 2, 30, '7', '5', '6', '211', 0, 1);
INSERT INTO `section` VALUES (2, '02', 1, 1, 3, 30, '7', '5', '6', '212', 0, 2);
INSERT INTO `section` VALUES (3, '01', 1, 2, 5, 30, '7', '6', '7', '213', 0, 1);
INSERT INTO `section` VALUES (4, '02', 1, 2, 5, 30, '7', '6', '7', '214', 0, 2);
INSERT INTO `section` VALUES (5, '01', 1, 3, 4, 30, '7', '7', '8', '215', 0, 1);
INSERT INTO `section` VALUES (6, '02', 1, 3, 4, 30, '7', '7', '8', '216', 0, 2);
INSERT INTO `section` VALUES (7, '01', 2, 4, 2, 30, '7', '1', '2', '211', 0, 1);
INSERT INTO `section` VALUES (8, '02', 2, 4, 2, 30, '7', '2', '3', '211', 0, 2);
INSERT INTO `section` VALUES (9, '01', 2, 5, 4, 30, '7', '1', '2', '212', 0, 1);
INSERT INTO `section` VALUES (10, '02', 2, 5, 4, 30, '7', '2', '3', '212', 0, 2);
INSERT INTO `section` VALUES (11, '01', 2, 6, 4, 30, '7', '1', '2', '213', 0, 1);
INSERT INTO `section` VALUES (12, '02', 2, 6, 4, 30, '7', '2', '3', '213', 0, 2);
INSERT INTO `section` VALUES (13, '01', 3, 7, 3, 30, '7', '4', '5', '211', 0, 1);
INSERT INTO `section` VALUES (14, '02', 3, 7, 3, 30, '7', '4', '00', '212', 0, 2);
INSERT INTO `section` VALUES (15, '01', 3, 8, 5, 30, '7', '4', '5', '213', 0, 1);
INSERT INTO `section` VALUES (16, '02', 3, 8, 5, 30, '7', '4', '5', '214', 0, 2);
INSERT INTO `section` VALUES (17, '01', 3, 9, 4, 30, '6', '4', '5', '215', 0, 1);
INSERT INTO `section` VALUES (18, '02', 3, 9, 4, 30, '-- วัน --', '4', '5', '216', 0, 2);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `subject`
-- 

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL auto_increment,
  `sub_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `time_sub` varchar(50) NOT NULL,
  `detail` mediumtext NOT NULL,
  PRIMARY KEY  (`sub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- dump ตาราง `subject`
-- 

INSERT INTO `subject` VALUES (1, 'คณิตศาสตร์ (ม.ต้น) 1', 1001, '10', 'คณิตศาสตร์ (ม.ต้น) 1');
INSERT INTO `subject` VALUES (2, 'วิทยาศาสตร์ (ม.ต้น) 1', 1002, '10', 'วิทยาศาสตร์ (ม.ต้น) 1');
INSERT INTO `subject` VALUES (3, 'ภาษาอังกฤษ (ม.ต้น) 1', 1003, '10', 'ภาษาอังกฤษ (ม.ต้น) 1');
INSERT INTO `subject` VALUES (4, 'คณิตศาสตร์ 1', 1000, '30', 'คณิตศาสตร์ 1');
INSERT INTO `subject` VALUES (5, 'ภาษาอังกฤษ 1', 1000, '30', 'ภาษาอังกฤษ 1');
INSERT INTO `subject` VALUES (6, 'วิทยาศาสตร์ 1', 1000, '30', 'วิทยาศาสตร์ 1');
INSERT INTO `subject` VALUES (7, 'คณิตศาสตร์ 2', 1000, '30', 'คณิตศาสตร์ 2');
INSERT INTO `subject` VALUES (8, 'วิทยาศาสตร์ 2', 1000, '30', 'วิทยาศาสตร์ 2');
INSERT INTO `subject` VALUES (9, 'ภาษาอังกฤษ 2', 1000, '10', 'ภาษาอังกฤษ 2');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `subject_list`
-- 

CREATE TABLE `subject_list` (
  `autoid` int(11) NOT NULL auto_increment,
  `teacher_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  PRIMARY KEY  (`autoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `subject_list`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `teacher`
-- 

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL auto_increment,
  `username` varchar(12) NOT NULL,
  `pass` varchar(12) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `address` mediumtext NOT NULL,
  `birthday` date NOT NULL,
  PRIMARY KEY  (`teacher_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- dump ตาราง `teacher`
-- 

INSERT INTO `teacher` VALUES (3, 'manatsinee', '1234', 'มนัสศินี', 'ดาวแดน', 'ครูปอย', 'manatsinee_poy@hotmail.com', '', 'หญิง', '400  หมู่ที่ 2  ต.เด่นชัย  อ.เด่นชัย  จ.แพร่  54110', '2526-10-03');
INSERT INTO `teacher` VALUES (1, 'krupam', '4321', 'วิชญา', 'เมฆอากาศ', 'ครูแป้ม', 'pamjung@gmail.com', '0999999999', '0', '3', '2556-01-01');
INSERT INTO `teacher` VALUES (2, 'porpar3d', '1234', 'ภมร', 'ดาวแดน', 'ครูปอ', 'porpar3d@hotmail.com', '', 'หญิง', '400  หมู่ที่ 2  ต.เด่นชัย  อ.เด่นชัย  จ.แพร่  54110', '2528-09-07');
INSERT INTO `teacher` VALUES (4, 'i_maija', '1234', 'วิทมณ', 'เชาวน์มาศ', 'ครูใหม่', 'i_maija@hotmail.com', '0863452030', 'ชาย', '534 หมู่ที่ 2  ต.เด่นชัย  อ.เด่นชัย  จ.แพร่  54110', '2556-04-25');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `webboard`
-- 

CREATE TABLE `webboard` (
  `QuestionID` int(5) unsigned zerofill NOT NULL auto_increment,
  `CreateDate` datetime NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Details` text NOT NULL,
  `Name` varchar(50) NOT NULL,
  `View` int(5) NOT NULL,
  `Reply` int(5) NOT NULL,
  PRIMARY KEY  (`QuestionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `webboard`
-- 

INSERT INTO `webboard` VALUES (00001, '2013-12-24 00:34:33', 'ทดสอบจ่ะ', 'ทดสอบนะจ๊ะ', 'admin', 105, 7);
INSERT INTO `webboard` VALUES (00002, '2013-12-25 00:05:30', 'ทดสอบโพสต์2', 'ลายละเอียด 2', 'ipiinto', 10, 0);
INSERT INTO `webboard` VALUES (00003, '2013-12-25 01:21:54', 'ขอตั้งบ้าง', 'นะนะนะจ๊ะ', 'krupam', 13, 2);
