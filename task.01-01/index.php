<?php
require_once('crud.php');  // CRUD処理クラス所在ファイル
require_once('pager.php'); //ページャー機能付き雇用者一覧所在ファイル
isset($_GET['p']) ? $pagenum = $_GET['p'] : $pagenum = 1; //入力されたページ数、初期値は1
isset($_GET['limit']) ? $row_val = $_GET['limit'] : $row_val = 10; //入力された表示件数、初期値は10
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>FStest11</title>
	<meta name="description" content="社員一覧を表示するページです">
	<link rel="stylesheet" href="style.css">
	<script src="main.js"></script>
</head>

<body>
	<div id="header">
		<h1>PHP.FStest11社員一覧</h1>
	</div>
	<div id="content">

		<form id="pagerlimit" action="index.php" method="get">
			<p>表示件数</p>
			<input type="number" name="limit"><input type="submit" value="変更">
		</form>

		<?php $pager = new PAGING();
		$limitarray = $pager->pager($pagenum, $row_val);
		echo '<div id="limitval">'.$limitarray[0].'～'.$limitarray[1].'件を表示/全'.$limitarray[2].'件中</div>';
		?>
	</div>

</body>

</html>