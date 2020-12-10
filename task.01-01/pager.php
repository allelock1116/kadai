<?php
require_once('crud.php');  // CRUD処理クラス所在ファイル

class PAGING
{
	public function pager($pagenum, $row_val)
	{
		//DBからデータ取得
		$db_emp = new CRUD();
		$data = $db_emp->SelectAllEmp(); // テーブル内データを取得

		//必要な変数用意
		$total_emp = count($data);	 // 取り出したデータの最大件数
		$max_page = ceil($total_emp / $row_val); 	//切り上げ割り算、最大ページ数

		$first_datanum = ($pagenum - 1) * $row_val; 	// ※1 現在のページの1行目のデータ番号
		$limitarray = [$first_datanum, ($first_datanum + $row_val), $total_emp];

		// ※1 の変数を使い現ページで表示すべきデータを切り取る
		$pagedata = array_slice($data, $first_datanum, $row_val);

		//tableを用意
		echo "<table> <tr><th>社員番号</th> <th>名前</th> <th>カナ</th></tr>";
		foreach ($pagedata as $row) {	//データを1行ずつ$rowに格納
			echo "<tr>";
			foreach ($row as $cel) {	//$row内のデータを1つずつ$celに格納 	
				echo "<td>" . $cel . "</td>";	//$celをhtmlテーブルのセルで表示
			}
			echo "</tr>";
		}
		echo "</table>";

		////////表下部のリンク動作////////

		if ($pagenum <= 2) {				////1,2ページ目の場合
			//中央ページ
			for ($i = 1; $i <= 5; $i++) {
				echo '<a href="?p=' . $i . "&limit=$row_val" . '">' . $i . '  </a>';
			}
			//「次」及び「最後」⇒常に表示
			echo '<a href="?p=' . ($pagenum + 1) . "&limit=$row_val" . '">' . "次" . '  </a>';
			echo '<a href="?p=' . $max_page . "&limit=$row_val" . '">' . "最後" . '  </a>';
		} else if ($pagenum >= ($max_page - 1)) {			////最後,最後の1ページ前の場合
			//「最初」及び「前」⇒常に表示
			echo '<a href="?p=' . 1 . "&limit=$row_val" . '">' . "最初" . '  </a>';
			echo '<a href="?p=' . ($pagenum - 1) . "&limit=$row_val" . '">' . "前" . '  </a>';
			//中央ページ
			for ($i = ($max_page - 5); $i <= $max_page; $i++) {
				echo '<a href="?p=' . $i . "&limit=$row_val" . '">' . $i . '  </a>';
			}
		} else {				////最初(+1)と最後(-1)ページ以外の場所
			//最初」及び「前」
			echo '<a href="?p=' . 1 . "&limit=$row_val" . '">' . "最初" . '  </a>';
			echo '<a href="?p=' . ($pagenum - 1) . "&limit=$row_val" . '">' . "前" . '  </a>';
			//中央ページ
			for ($i = $pagenum - 2; $i <= $pagenum + 2; $i++) {
				echo '<a href="?p=' . $i . "&limit=$row_val" . '">' . $i . '  </a>';
			}
			//「次」及び「最後」
			echo '<a href="?p=' . ($pagenum + 1) . "&limit=$row_val" . '">' . "次" . '  </a>';
			echo '<a href="?p=' . $max_page . "&limit=$row_val" . '">' . "最後" . '  </a>';
		}

		return $limitarray;
	}
}
