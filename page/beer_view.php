<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("beer_no", $_GET)) {
    $beer_no = $_GET["beer_no"];
    $query = "select * from beer natural join style natural join (select member_id, name from member)member2 natural join uses natural join (select ingredient_id, ingredient_name, kind_name from ingredient natural join kind)ingredient2 where beer_no = $beer_no " ;
    $res = mysqli_query($conn, $query);
    $beer = mysqli_fetch_assoc($res);
    if (!$beer) {
        msg("맥주가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>맥주 정보 상세 보기</h3>

        <p>
            <label for="beer_no">맥주 코드</label>
            <input readonly type="text" id="beer_no" name="beer_no" value="<?= $beer['beer_no'] ?>"/>
        </p>
		 <p>
            <label for="beer_name">맥주 이름</label>
            <input readonly type="text" id="beer_name" name="beer_name" value="<?= $beer['beer_name'] ?>"/>
        </p>
           <p>
            <label for="beer_name">ABV(알코올 도수)</label>
            <input readonly type="text" id="abv" name="abv" value="<?= $beer['abv'].'%' ?>"/>
        </p>
        
    	<p>
            <label for="ibu">IBU(쓴맛의 정도)</label>
            <input readonly type="text" id="ibu" name="ibu" value="<?= $beer['ibu'] ?>"/>
        </p>
        <p>
            <label for="srm">SRM(맥주의 색)</label>
            <input readonly type="text" id="srm" name="srm" value="<?= $beer['srm'] ?>"/>
        </p>
        <p>
            <label for="name">만든 사람</label>
            <input readonly type="text" id="name" name="name" value="<?= $beer['name'] ?>"/>
        </p>
		<p>
            <label for="style_name">스타일</label>
            <input readonly type="text" id="style_name" name="style_name" value="<?= $beer['style_name'] ?>"/>
        </p>
         <p>
            <label for="name">재료</label>
              <table class="table table-striped table-bordered">
		        <thead>
		        <tr>
		        	<th>No.</th>
		            <th>재료 이름</th>
		            <th>종류</th>
		        </tr>
		        </thead>
		        <tbody>
		        <?
		        $row_index = 1;
		        do {
		            echo "<tr>";
		            echo "<td>{$row_index}</td>";
		            echo "<td><a href='ingredient_view.php?ingredient_id={$beer['ingredient_id']}'>{$beer['ingredient_name']}</a></td>";
		            echo "<td>{$beer['kind_name']}</td>";
		            echo "</tr>";
		            $row_index++;
		        }while ($beer = mysqli_fetch_array($res)) 
		        ?>
		        </tbody>
		    </table>
            
            
            
            
        </p>
    </div>
<? include("footer.php") ?>