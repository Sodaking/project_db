<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$beer_name = $_POST['beer_name'];
$abv = $_POST['abv'];
$ibu = $_POST['ibu'];
$srm = $_POST['srm'];
$style_id = $_POST['style_id'];
$ingredient_1_id = $_POST['ingredient_1_id'];
$ingredient_2_id = $_POST['ingredient_2_id'];
$ingredient_3_id = $_POST['ingredient_3_id'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation
$ret = mysqli_query($conn, "insert into beer (beer_name, abv, ibu, srm, added_date, member_id, style_id) values('$beer_name', '$abv', '$ibu', '$srm', NOW(), $_COOKIE[cookie_id], '$style_id')");

$beer_n = mysqli_query($conn, "select max(beer_no) as maxb from beer");
$beer_num = mysqli_fetch_array($beer_n)['maxb'];
$ret2 = mysqli_query($conn, "insert into uses(beer_no, ingredient_id) values($beer_num, $ingredient_1_id)");
$ret3 = mysqli_query($conn, "insert into uses(beer_no, ingredient_id) values($beer_num, $ingredient_2_id)");
$ret4 = mysqli_query($conn, "insert into uses(beer_no, ingredient_id) values($beer_num, $ingredient_3_id)");

if(!$ret || !$ret2 || !$ret3 || !$ret4)
{
    mysqli_query($conn, "rollback"); // 맥주 등록 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 맥주 등록 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=beer_list.php'>";
}

?>



