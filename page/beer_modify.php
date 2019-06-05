<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$beer_no = $_POST['beer_no'];
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

$ret = mysqli_query($conn, "update beer set beer_name = '$beer_name', abv = '$abv', ibu = '$ibu', srm = '$srm', style_id = '$style_id' where beer_no = $beer_no");
$ret1 = mysqli_query($conn, "delete from uses where beer_no = $beer_no");
$ret2 = mysqli_query($conn, "insert into uses(beer_no, ingredient_id) values($beer_no, $ingredient_1_id)");
$ret3 = mysqli_query($conn, "insert into uses(beer_no, ingredient_id) values($beer_no, $ingredient_2_id)");
$ret4 = mysqli_query($conn, "insert into uses(beer_no, ingredient_id) values($beer_no, $ingredient_3_id)");

if(!$ret || !$ret1 || !$ret2 || !$ret3 || !$ret4)
{
    mysqli_query($conn, "rollback"); // 맥주 수정 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 맥주 수정 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=beer_list.php'>";
}
?>