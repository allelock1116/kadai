<?php
require_once('crud.php');

function templateHeader($title)
{
    echo <<<EOT
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <meta name="description" content="CRUDアプリ">
        <link rel="stylesheet" href="style.css?v=2">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>

    <body>
        <nav class="navtop">
            <div>
                <h1>CRUDアプリ</h1>
                <a href="index.php"><i class="fas fa-home"></i>Home</a>
            </div>
        </nav>
EOT;
}

function templateFooter()
{
    echo <<<EOT
    </body>
</html>
EOT;
}

//連想配列格納用
function makeArray($array)
{
    $res = array(
        'id' => $array['id'],
        'name' => $array['name'],
        'email' => $array['email'],
        'phone' => $array['phone'],
        'title' => $array['title'],
        'created' => $array['created']
    );
    return $res;
}

//ID重複確認
function checkID($id)
{
    $msg = NULL;
    $crud = new Crud();
    $all_data = $crud->selectAll();

    foreach ($all_data as $id_array) {
        foreach ((array)$id_array['id'] as $checkid) {
            if ((int)$checkid === (int)$id) {
                $msg = $id . '番のIDは既に登録されています。' . count($all_data) . 'より大きい数値を入力してください。';
                return $msg;
                break;
            }
        }
    }
    return $msg;
}
