<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "beer_insert.php";
if(!$_COOKIE[cookie_id]){
	msg("로그인 하시오!");
}
if (array_key_exists("beer_no", $_GET)) {
    $beer_no = $_GET["beer_no"];
    $query =  "select * from beer where beer_no = $beer_no";
    $res = mysqli_query($conn, $query);
    $beer = mysqli_fetch_array($res);
   	if(!$beer) {
        msg("맥주가 존재하지 않습니다.");
    }
    else if($_COOKIE[cookie_id]!= $beer['member_id'])
    {
    	msg("다른사람의 맥주는 수정할 수 없습니다.");
    }
    
    $mode = "수정";
    $action = "beer_modify.php";
}

$style = array();

$query = "select * from style";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $style[$row['style_id']] = $row['style_name'];
}

$ingredient_1 = array();
$query = "select * from ingredient where kind_id = 1";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $ingredient_1[$row['ingredient_id']] = $row['ingredient_name'];
}
$ingredient_2 = array();
$query = "select * from ingredient where kind_id = 2";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $ingredient_2[$row['ingredient_id']] = $row['ingredient_name'];
}
$ingredient_3 = array();
$query = "select * from ingredient where kind_id = 3";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $ingredient_3[$row['ingredient_id']] = $row['ingredient_name'];
}
?>
    <div class="container">
        <form name="beer_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="beer_no" value="<?=$beer['beer_no']?>"/>
            <h3>상품 정보 <?=$mode?></h3>
           
            <p>
                <label for="beer_name">맥주 이름</label>
                <input type="text" placeholder="맥주명 입력" id="beer_name" name="beer_name" value="<?=$beer['beer_name']?>"/>
            </p>
            <p>
                <label for="abv">ABV</label>
                <input type="number" step ="0.1" placeholder="맥주의 ABV입력" id="abv" name="abv" value="<?=$beer['abv']?>" />
            </p>
             <p>
                <label for="ibu">IBU</label>
                <input type="number" placeholder="맥주의 IBU입력" id="ibu" name="ibu" value="<?=$beer['ibu']?>" />
            </p>
             <p>
                <label for="srm">SRM</label>
                <input type="number" placeholder="맥주의 SRM입력" id="srm" name="srm" value="<?=$beer['srm']?>" />
            </p>
			<p>
                <label for="style_id">스타일</label>
                <select name="style_id" id="style_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($style as $id => $name) {
                            if($id == $beer['style_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="ingredient_1_id">재료-malt</label>
                <select name="ingredient_1_id" id="ingredient_1_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($ingredient_1 as $id => $name) {
                            if($id == $beer['ingredient_1_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="ingredient_2_id">재료-hop</label>
                <select name="ingredient_2_id" id="ingredient_2_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($ingredient_2 as $id => $name) {
                            if($id == $beer['ingredient_2_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="ingredient_3_id">재료-yeast</label>
                <select name="ingredient_3_id" id="ingredient_3_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($ingredient_3 as $id => $name) {
                            if($id == $beer['ingredient_3_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("beer_name").value == "") {
                        alert ("맥주이름을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("abv").value == "") {
                        alert ("abv을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("ibu").value == "") {
                        alert ("ibu을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("srm").value == "") {
                        alert ("srm을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("style_id").value == "-1") {
                        alert ("스타일을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("ingredient_1_id").value == "-1") {
                        alert ("malt를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("ingredient_2_id").value == "-1") {
                        alert ("hop을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("ingredient_3_id").value == "-1") {
                        alert ("yeast를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>