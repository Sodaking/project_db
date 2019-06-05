<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "ingredient_insert.php";

if (array_key_exists("ingredient_id", $_GET)) {
    $ingredient_id = $_GET["ingredient_id"];
    $query =  "select * from ingredient where ingredient_id = $ingredient_id";
    $res = mysqli_query($conn, $query);
    $ingredient = mysqli_fetch_array($res);
    if(!$ingredient) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "ingredient_modify.php";
}

$manufacturers = array();

$query = "select * from manufacturer";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $manufacturers[$row['manufacturer_id']] = $row['manufacturer_name'];
}
?>
    <div class="container">
        <form name="ingredient_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="ingredient_id" value="<?=$ingredient['ingredient_id']?>"/>
            <h3>상품 정보 <?=$mode?></h3>
            <p>
                <label for="ingredient_id">ingredient_id</label>
                <input type="number" placeholder="정수로 입력" id="ingredient_id" name="ingredient_id" value="<?=$ingredient['ingredient_id']?>" />
            </p>
           
            <p>
                <label for="ingredient_name">상품명</label>
                <input type="text" placeholder="상품명 입력" id="ingredient_name" name="ingredient_name" value="<?=$ingredient['ingredient_name']?>"/>
            </p>
            <p>
                <label for="feature">feature</label>
                <textarea placeholder="feature" id="feature" name="feature" rows="10"><?=$ingredient['feature']?></textarea>
            </p>
            <p>
                <label for="kind_id">kind_id</label>
                <input type="number" placeholder="정수로 입력" id="kind_id" name="kind_id" value="<?=$ingredient['kind_id']?>" />
            </p>
            

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("manufacturer_id").value == "-1") {
                        alert ("제조사를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("ingredient_name").value == "") {
                        alert ("상품명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("ingredient_desc").value == "") {
                        alert ("상품설명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("price").value == "") {
                        alert ("가격을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>