<?php
Class DB{
    //DB情報※ローカル環境なのでパスワード無し
    private $dsn = 'mysql:dbname=mysql;host=localhost;charset=utf8';
    private $user = 'root';
    private $password = '';

    //DB接続用関数
    private function Connectdb(){
        try{
            $pdo = new PDO($this->dsn, $this->user, $this->password);
            return $pdo;
        }catch (PDOException $e){
            print('Error:'.$e->getMessage());
            return false;
        }
    }
    
    //SQL実行用関数
    public function executeSQL($sql, $array){
        try{
            if(!$pdo=$this->Connectdb())return false;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($array);
            return $stmt;
        }catch(PDOException $e){
            print('Error:'.$e->getMessage());
            return false;
        }
    }
}
