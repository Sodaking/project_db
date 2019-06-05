<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("ingredient_id", $_GET)) {
    $ingredient_id = $_GET["ingredient_id"];
    $query = "select * from ingredient natural join kind where ingredient_id = $ingredient_id";
    $res = mysqli_query($conn, $query);
    $ingredient = mysqli_fetch_assoc($res);
    if (!$ingredient) {
        msg("재료가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>재료 정보 상세 보기</h3>

        <p>
            <label for="ingredient_id">No.</label>
            <input readonly type="number" id="ingredient_id" name="ingredient_id" value="<?= $ingredient['ingredient_id'] ?>"/>
        </p>

        <p>
            <label for="manufacturer_id">재료이름</label>
            <input readonly type="text" id="ingredient_name" name="ingredient_name" value="<?= $ingredient['ingredient_name'] ?>"/>
        </p>

        <p>
            <label for="feature">특징</label>
            <input readonly type="text" id="feature" name="feature" value="<?= $ingredient['feature'] ?>"/>
        </p>

        <p>
            <label for="kind_name">종류</label>
            <input readonly type="text" id="kind_name" name="kind_name" value="<?= $ingredient['kind_name'] ?>"/>
        </p>

    </div>
<? include("footer.php") ?>