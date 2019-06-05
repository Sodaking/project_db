<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>고맥</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="beer_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">고맥</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="맥주 통합검색">
                </li>
                <li><a href='ingredient_list.php'>재료</a></li>
                <li><a href='beer_list.php'>맥주 목록</a></a></li>
                <li><a href='magazine_list.php'>매거진</a></li>
                <li><a href='mybeer_list.php'>나의 맥주</a></li>
                <li><a href='beer_form.php'>내 맥주 만들기</a></li>
                <?php
                	if(!$_COOKIE[cookie_id] || !$_COOKIE[cookie_name])
                	{
                		echo "<a href='login.php'>로그인</a>";
                	}
                	else
                	{
                		if($_COOKIE[cookie_admin] == 0)
                		{
                			echo "<a href='logout.php'> $_COOKIE[cookie_name] 로그아웃</a>";
                		}
                		else
                		{
                			echo "<a href='logout.php'>관리자 로그아웃</a>";
                		}
                	}
               	?>
            </ul>
        </div>
    </div>
</form>