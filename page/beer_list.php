<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from (beer natural join style) natural join (select member_id, name from member)member2";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where beer_name like '%$search_keyword%' or name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>맥주 이름</th>
            <th>등록일</th>
            <th>스타일</th>
            <th>만든 사람</th>
            <th>비고</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='beer_view.php?beer_no={$row['beer_no']}'>{$row['beer_name']}</a></td>";
            echo "<td>{$row['added_date']}</td>";
            echo "<td>{$row['style_name']}</td>";
            echo "<td>{$row['name']}</td>";
           
            echo "<td width='17%'>
                <a href='beer_form.php?beer_no={$row['beer_no']}'><button class='button primary small'>수정</button></a>
                <button onclick='javascript:deleteConfirm({$row['beer_no']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(beer_no) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "beer_delete.php?beer_no=" + beer_no;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
