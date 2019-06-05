<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("magazine_no", $_GET)) {
    $magazine_no = $_GET["magazine_no"];
    $query = "select * from magazine natural join (select beer_no, beer_name from beer)beer2 where magazine_no = $magazine_no";
    $res = mysqli_query($conn, $query);
    $magazine = mysqli_fetch_assoc($res);
    if (!$magazine) {
        msg("매거진이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>매거진 상세 보기</h3>

        <p>
            <label for="magazine_no">매거진 번호</label>
            <input readonly type="text" id="magazine_no" name="magazine_no" value="<?= $magazine['magazine_no'] ?>"/>
        </p>

        <p>
            <label for="title">타이틀</label>
            <input readonly type="text" id="title" name="tltle" value="<?= $magazine['title'] ?>"/>
        </p>

        <p>
            <label for="beer_name">관련 맥주</label>
            <input readonly type="text" id="beer_name" name="beer_name" value="<?= $magazine['beer_name'] ?>"/>
        </p>
		<p>
            <label for="content">내용</label>
            <textarea readonly id="content" name="content" rows="10"><?= $magazine['content'] ?></textarea>
        </p>

        <p>
            <label for="added_date">등록 일자</label>
            <input readonly type="text" id="added_date" name="added_date" value="<?= $magazine['added_date'] ?>"/>
        </p>

        
    </div>
<? include("footer.php") ?>