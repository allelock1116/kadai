<?php
require_once('dbconnect.php');
require_once('function.php');

class Crud extends DB
{ //CRUD処理まとめ用クラス

    public function selectAll()     //一覧取得
    {
        $sql = "SELECT * FROM contacts";
        $res = parent::executeSQL($sql, null);
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectById($id)
    {
        $sql = "SELECT * FROM contacts WHERE id = ?";
        $array = [$id];
        $res = parent::executeSQL($sql, $array);
        $old_data = $res->fetchAll(PDO::FETCH_ASSOC);
        return $old_data[0];
    }

    public function insertContact()     //新規登録
    {
        if (!empty($_POST)) {
            $sql = "INSERT INTO contacts VALUES (?,?,?,?,?,?)";
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            //ID重複チェック
            $illegal_msg = checkID($id);
            if (isset($illegal_msg)) {
                return $illegal_msg;
            }
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $created = isset($_POST['created']) ? $_POST['created'] : date("Y-m-d H:i:s");

            $array = [$id, $name, $email, $phone, $title, $created];
            $res = parent::executeSQL($sql, $array);

            $msg = "登録しました。";
        } else {
            $msg = "登録情報を入力してください";
        }
        return $msg;
    }

    public function updateContact()
    {
        if (isset($_GET['id'])) {
            if (!empty($_POST)) {
                $id = isset($_POST['id']) ? $_POST['id'] : NULL;
                //ID重複チェック
                if ($_GET['id'] !== $id) {
                    $illegal_msg = checkID($id);
                    if (isset($illegal_msg)) {
                        $upd_data = $this->selectById($_GET['id']);
                        $upd_res = makeArray($upd_data);
                        $upd_res += array('msg' => $illegal_msg);
                        return $upd_res;
                    }
                }
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $created = isset($_POST['created']) ? $_POST['created'] : date("Y-m-d H:i:s");

                $sql = "UPDATE contacts SET id = ?,
                                            name = ?,
                                            email = ?,
                                            phone = ?,
                                            title = ?,
                                            created = ?
                                            WHERE id = ?";

                $array = [$id, $name, $email, $phone, $title, $created, $_GET['id']];
                $res = parent::executeSQL($sql, $array);
                $upd_data = $this->selectById($_POST['id']);

                $msg = "更新しました。";
            } else {
                $upd_data = $this->selectById($_GET['id']);
                $msg = "更新情報を入力してください";
            }
            $upd_res = makeArray($upd_data);
            $upd_res += array('msg' => $msg);

            return $upd_res;
        }
    }

    public function Delete()
    {
    }
}
