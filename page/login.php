<?php include "header.php"; ?>
	<form name ="form" action="login_confirm.php" method="post">
		<p>
			<font color="#0000CC" size="2">Login: </font> 
			<input name="txt_ID" type="text" size="15" />
		</p>
		<p>
			<font color="#0000CC" size="2">Passwd: </font> 
			<input name="passwd" type="password" class="marg" size="15" />
		</p>
		<p>
			<input type="submit" name="button2" value="로그인" />
			<a href="join.php">회원가입</a>
		</p>
	</form>
<?php include "footer.php"; ?>