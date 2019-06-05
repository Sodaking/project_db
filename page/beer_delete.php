<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
$beer_no = $_GET['beer_no'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$beer = mysqli_query($conn, "select member_id from beer where beer_no = $beer_no");

if($_COOKIE[cookie_id]!= mysqli_fetch_array($beer)['member_id'] && $_COOKIE[cookie_admin] == 0){
	mysqli_query($conn, "rollback"); // 맥주 삭제 query 수행 취소. 수행 전으로 rollback
	msg('다른사람의 맥주는 삭제할 수 없습니다.');
}

$ret2 = mysqli_query($conn, "delete from uses where beer_no = $beer_no");
$ret3 = mysqli_query($conn, "delete from magazine where beer_no = $beer_no");
$ret = mysqli_query($conn, "delete from beer where beer_no = $beer_no");

if(!$ret || !$ret2 || !$ret3)
{
	mysqli_query($conn, "rollback"); // 맥주 삭제 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
mysqli_query($conn, "commit"); // 맥주 삭제 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=beer_list.php'>";
}

?>

