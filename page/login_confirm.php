<?php
include "config.php";   //데이터베이스연결 설정파일
include "util.php";     //유틸함수
$connect = dbconnect($host,$dbid,$dbpass,$dbname);

$id = $_POST['txt_ID'];
$pass = $_POST['passwd'];

$mem_ret= mysqli_query($connect, "select * from member where member_id= '$id'");
$mem_num= mysqli_num_rows($mem_ret);

if(!$mem_num) // id로 검색된 회원이 없을 경우
{
	msg('잘못된 아이디 입니다!');
}
else{
	$mem_array= mysqli_fetch_array($mem_ret);
	$db_name= $mem_array[name];
	$db_pass= $mem_array[password];
	$db_admin= $mem_array[admin];
	if($db_pass== $pass)
	{
		SetCookie("cookie_id", $id,0,"/"); // 0 : browser lifetime – 0 oromitted: end of session
		SetCookie("cookie_name", $db_name,0, "/");
		SetCookie("cookie_admin", $db_admin,0, "/");
		echo "<meta http-equiv='refresh' content='0;url=index.php'>";
	}
	else
	{
		msg('잘못된 패스워드입니다!');
	}
}
mysql_close($connect);?>
