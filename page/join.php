<? 
include ("header.php");
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$styles = array();
$query = "select * from style";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $styles[$row['style_id']] = $row['style_name'];
}
?>




	<div class="marg">
		<form name ="form" action="join_insert.php" method="post">
		<div align="center"><span class="margMenustyle1">[회원등록]</span></div>
		<table width="440" border="1">
			<tr><th width="92" scope="row">ID</th>
			<td width="332"><input type="text" name="txt_ID"/></td></tr>
			<tr><th scope="row">PASS</th>
			<td><input type="password" name="passwd"/></td></tr>
			<tr><th scope="row">PASS 확인</th>
			<td><input type="password" name="c_passwd"/></td></tr>
			<tr> <th scope="row">이름</th>
			<td><input type="text" name="txt_name"/></td></tr>
			<tr><th scope="row">전화번호</th>
			<td><input type="text" name="txt_phone"/></td></tr>
			<tr><th scope="row">주소</th>
			<td><textarea name="txt_add" cols="40"></textarea></td></tr>
			<tr><th scope="row">선호하는 맥주 스타일</th>
			<td>
                <label for="style">제조사</label>
                <select name="style_id" id="style_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($styles as $id => $name) {
                            echo "<option value='{$id}'>{$name}</option>";
                        }
                    ?>
                </select>
            </td>
		</table>   
		<label>
			<div align="center">
				<input type="submit" name="send" value="가입하기" />
			</div>
		</label>
		</form>
	</div>
<? include ("footer.php") ?>