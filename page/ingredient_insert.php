<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$ingredient_id = $_POST['ingredient_id'];
$ingredient_name = $_POST['ingredient_name'];
$feature = $_POST['feature'];
$kind_id = $_POST['kind_id'];

$ret = mysqli_query($conn, "insert into ingredient (ingredient_id, ingredient_name, feature, kind_id) values('$ingredient_id', '$ingredient_name', '$feature', '$kind_id')");

if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'>";
}

?>

