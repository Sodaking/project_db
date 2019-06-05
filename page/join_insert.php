<?php
include "config.php";   //데이터베이스연결 설정파일
include "util.php";     //유틸함수
$connect = dbconnect($host,$dbid,$dbpass,$dbname);
$id = $_POST['txt_ID'];
$pass = $_POST['passwd'];
$c_pass= $_POST['c_passwd'];
$name = $_POST['txt_name'];
$phone = $_POST['txt_phone'];
$add = $_POST['txt_add']; 
$style_id = $_POST['style_id'];
$ret = mysqli_query($connect, "select member_id from member where member_id='$id'");  //ID 조사
$num = mysqli_num_rows($ret);
if(!$name){
	msg('이름을 입력하세요!');
}
else if($num)
{	
	msg('이미 존재하는회원ID입니다!');
}
else if(strcmp($pass,$c_pass)!=0)   //PASS 조사
{
	msg('패스워드가맞지 않습니다!');
}
else 
{
	if($style_id == -1){
		$insert_query= "insert into member (member_id, password, name, phone, address, admin) values ('$id','$pass','$name','$phone','$add', '0')";
	}
	else{
		$insert_query= "insert into member (member_id, password, name, phone, address, admin, style_id) values ('$id','$pass','$name','$phone','$add', '0', '$style_id')";
	}
	$insert_ret= mysqli_query($connect, $insert_query);
	
	if(!insert_ret){  
		msg('DB에 에러가 발생!');   
	}
	else
	{   
		s_msg('가입되었습니다');
		echo "<meta http-equiv='refresh' content='0;url=login.php'>"; 
	}
}

mysql_close($connect);
?>