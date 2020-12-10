<?php
require_once('crud.php');  // CRUD処理クラス所在ファイル

class PAGING
{
	public function pagelimit($limitarray)
	{
		if ($limitarray[1] > $limitarray[2]) $limitarray[1] = $limitarray[2];
		echo '<div id="limitval">' . $limitarray[0] . '～' . $limitarray[1] . '件を表示/全' . $limitarray[2] . '件中</div>';
		echo '<p>表示件数</p>';
		echo '<select name="limit">';
		for ($i = 1; $i <= $limitarray[2]; $i++) {
			if ($i === (int)$_GET['limit']) {
				echo '<option value="' . $i . '" selected>' . $i . '</option>';
			} else {
				echo '<option value="' . $i . '">' . $i . '</option>';
			}
		}
		echo '</select>';
	}

	public function pager($pagenum, $row_val)
	{
		//DBからデータ取得
		$db_emp = new CRUD();
		$data = $db_emp->SelectAllEmp(); // テーブル内データを取得

		//必要な変数用意
		$total_emp = count($data);	 // 取り出したデータの最大件数
		$max_page = ceil($total_emp / $row_val); 	//切り上げ割り算、最大ページ数

		$first_datanum = ($pagenum - 1) * $row_val; 	// 現在のページの1行目のデータ番号
		$pagedata = array_slice($data, $first_datanum, $row_val);	//現ページで表示すべきデータを切り取る

		$limitarray = [$first_datanum, ($first_datanum + $row_val), $total_emp];	//表示件数の情報

		//tableを用意
		$dispdata = '<table class="emppage"> <tr><th>社員番号</th> <th>名前</th> <th>カナ</th> <th>郵便番号</th> <th>住所</th></tr>';
		foreach ($pagedata as $row) {	//データを1行ずつ$rowに格納
			$dispdata .= "<tr>";
			foreach ($row as $cel) {	//$row内のデータを1つずつ$celに格納 	
				$dispdata .= "<td>" . $cel . "</td>";	//$celをhtmlテーブルのセルで表示
			}
			$dispdata .= "</tr>";
		}
		$dispdata .= "</table>";

		////////表下部のリンク動作////////

		$dispdata .= '<div id="nav"><ul id="pagenav">';

		//「最初」及び「最後」
		if ($pagenum > 1) {
			$dispdata .= '<a href="?p=' . 1 . "&limit=$row_val" . '"><li class="prevnextbtn">' . "最初" . '</li></a>';
			$dispdata .= '<a href="?p=' . ($pagenum - 1) . "&limit=$row_val" . '"><li class="prevnextbtn">' . "前" . '</li></a>';
		}

		if ($max_page > 5) {
			if ($pagenum >= 1 && $pagenum <= 3) {
				for ($i = 1; $i <= 5; $i++) {
					$dispdata .= '<a href="?p=' . $i . "&limit=$row_val" . '"><li class="pagebtn">' . $i . '</li></a>';
				}
			} elseif ($pagenum >= ($max_page - 2) && $pagenum <= $max_page) {
				for ($i = ($max_page - 4); $i <= $max_page; $i++) {
					$dispdata .= '<a href="?p=' . $i . "&limit=$row_val" . '"><li class="pagebtn">' . $i . '</li></a>';
				}
			} else {
				for ($i = ($pagenum - 2); $i <= ($pagenum + 2); $i++) {
					$dispdata .= '<a href="?p=' . $i . "&limit=$row_val" . '"><li class="pagebtn">' . $i . '</li></a>';
				}
			}
		} else {
			for ($i = 1; $i <= $max_page; $i++) {
				$dispdata .= '<a href="?p=' . $i . "&limit=$row_val" . '"><li class="pagebtn">' . $i . '</li></a>';
			}
		}

		//「次」及び「最後」
		if ($pagenum < $max_page) {
			$dispdata .= '<a href="?p=' . ($pagenum + 1) . "&limit=$row_val" . '"><li class="prevnextbtn">' . "次" . '</li></a>';
			$dispdata .= '<a href="?p=' . $max_page . "&limit=$row_val" . '"><li class="prevnextbtn">' . "最後" . '</li></a>';
		}
		$dispdata .= '</ul></div>';

		return [$dispdata, $limitarray];
	}
}
