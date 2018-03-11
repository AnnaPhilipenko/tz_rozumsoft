<?php

class DBHelper
{
    protected $db;

    public function __construct($user, $pass, $host, $dbname)
    {
        try {
            $this->db = new PDO("mysql:host={$host};dbname={$dbname}; charset=utf8", $user, $pass);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function find_contact()
    {
        $block_field = uniqid('block_');
        $query = $this->db->prepare("UPDATE contact SET block_field = :block_field WHERE status IN ('0', '2', '3', '4') AND block_field IS NULL LIMIT 1");
        $query->bindParam(':block_field', $block_field);
        $query->execute();

        $query = $this->db->prepare("SELECT * FROM contact WHERE block_field = :block_field");
        $query->bindParam(':block_field', $block_field);
        $query->execute();
        $temp = $query->fetchAll();

        foreach($temp as $value){
            $this->db->query("UPDATE contact SET status = '1', block_field = NULL WHERE id = $value[id]");
        }
        return $temp;
    }
}

